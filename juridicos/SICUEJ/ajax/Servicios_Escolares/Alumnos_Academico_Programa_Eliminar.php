<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 26 2016]	
	-- País: México
	-- Objetivo: Eliminacion de Programa Académico para un alumno
	-- Última Modificación: [Mayo, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//validar que el alumno no tenga registro de evaluaciones para el programa que se quiere eliminar
		
	$sql_evaluacion = "SELECT COUNT(*) AS evaluaciones FROM alumnos_evaluaciones WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_evaluacion = mysqli_query($conexion, $sql_evaluacion);
	$fila_evaluacion = mysqli_fetch_array($resultado_evaluacion);
	
	$sql_historial = "SELECT COUNT(*) AS historial FROM alumnos_historial WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_historial = mysqli_query($conexion, $sql_historial);
	$fila_historial = mysqli_fetch_array($resultado_historial);
	
	
	if($fila_evaluacion["evaluaciones"] == 0 && $fila_historial["historial"] == 0)
	{		
		$sql = "DELETE FROM alumnos_programas WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			$sql_documentacion = "DELETE FROM alumnos_documentacion WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
			$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);
			
			Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
			echo "¡El Programa Académico se eliminó con Éxito!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Eliminar...";
		}
	}
	else
	{
		echo "No se puede eliminar un programa académico cuando el alumno tiene evaluaciones o registros en historial!";
	}	
?>