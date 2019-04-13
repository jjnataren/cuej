<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Cierre de Acta y Migración a Historial
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_grupo = "SELECT * FROM grupos WHERE id_grupo = '".$_POST["id_Grupo"]."';";
	$resultado_grupo = mysqli_query($conexion, $sql_grupo);
	$fila_grupo = mysqli_fetch_array($resultado_grupo);
	
	if($fila_grupo["tipo_grupo"] == "ORDINARIO")
		$tipo = 1;
	else if($fila_grupo["tipo_grupo"] == "EXTRAORDINARIO")
		$tipo = 2;	
	
	$sql_evaluacion = "SELECT * FROM alumnos_evaluaciones WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."' AND id_periodo = '3'; ";	
	$resultado_evaluacion = mysqli_query($conexion, $sql_evaluacion);
	
	$errores = 0;
	
	while($fila_evaluacion = mysqli_fetch_array($resultado_evaluacion))
	{
		$sql_historial = "UPDATE alumnos_historial SET calificacion = '".$fila_evaluacion["calificacion"]."', id_ciclo_escolar = '".$fila_grupo["id_ciclo_escolar"]."', tipo = '".$tipo."', equivalencia = 1 WHERE id_alumno_programa = '".$fila_evaluacion["id_alumno_programa"]."' AND id_materia = '".$fila_evaluacion["id_materia"]."';";
		
		$resultado_historial = mysqli_query($conexion, $sql_historial);
		
		if(!mysqli_error($conexion))
		{
			Logs_Errores('ACTUALIZAR', $sql_historial, $_SESSION["id_Usuario"]);
			
			$sql_migracion_evaluacion = "UPDATE alumnos_evaluaciones SET migracion_fecha = '".date("Y-m-d")."' WHERE id_alumno_evaluacion = '".$fila_evaluacion["id_alumno_evaluacion"]."' AND id_periodo=3;";
			$resultado_migracion_evaluacion = mysqli_query($conexion, $sql_migracion_evaluacion);
			
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql_historial, $_SESSION["id_Usuario"]);			
			$errores++;			
		}
			
	}
	
	if($errores > 0)
		echo "Ocurrió un problema, el acta no pudo ser cerrada!";
	else
	{
		$sql_cerrar = "UPDATE horarios SET acta_cerrada = 1, migracion = 1 WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";
		$resultado = mysqli_query($conexion, $sql_cerrar);
		
		if(!mysqli_error($conexion))
		{
			Logs_Errores('ACTUALIZAR', $sql_cerrar, $_SESSION["id_Usuario"]);			
			echo "Acta Cerrada!";			
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql_cerrar, $_SESSION["id_Usuario"]);
			echo "Ocurrió un problema, el acta no pudo ser cerrada!";
		}	
	}	
?>