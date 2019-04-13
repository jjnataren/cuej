<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 09 2016]	
	-- País: México
	-- Objetivo: Registro de Materia para Evaluacion
	-- Última Modificación: [Junio, 09 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	
	//identificamos a qué tipo de carrera corresponde la materia
	$sql_tipo_carrera = "SELECT id_carrera_tipo FROM carreras_tipo JOIN carreras USING(id_carrera_tipo) JOIN planes_estudio USING(id_carrera) JOIN materias USING(id_plan_estudio) WHERE id_materia = '".$_POST["id_Materia"]."';";
	$resultado_tipo_carrera = mysqli_query($conexion, $sql_tipo_carrera);
	$fila_tipo_carrera = @mysqli_fetch_array($resultado_tipo_carrera);
	
	if($fila_tipo_carrera["id_carrera_tipo"] == 1)
	{
		$sql_historial = "SELECT COUNT(*) AS materia_aprobada FROM  alumnos_historial  WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_materia = '".$_POST["id_Materia"]."' AND (calificacion != 'NP' AND calificacion != 'NA' AND calificacion != '5' AND calificacion != '6' AND calificacion != '');";		
	}
	else if($fila_tipo_carrera["id_carrera_tipo"] == 2 || $fila_tipo_carrera["id_carrera_tipo"] == 3)
	{
		$sql_historial = "SELECT COUNT(*) AS materia_aprobada FROM  alumnos_historial  WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_materia = '".$_POST["id_Materia"]."' AND (calificacion != 'NP' AND calificacion != 'NA' AND calificacion != '5' AND calificacion != '6' AND calificacion != '7' AND calificacion != '');";
	}	
	
	//Validación para no agregar la materia si ya se encuentra aprobada en historial
	
	$resultado_historial = mysqli_query($conexion, $sql_historial);
	$fila_historial = mysqli_fetch_array($resultado_historial);
	
	if($fila_historial["materia_aprobada"] == 0 && (!mysqli_error($conexion)))
	{
		//Verificacmos que el grupo y ma materia no esten registradas en evaluacion
		
		$sql_valida_evaluacion = "SELECT COUNT(*) AS registros_evaluacion FROM alumnos_evaluaciones WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";
		$resultado_valida_evaluacion = mysqli_query($conexion, $sql_valida_evaluacion);
		$fila_valida_evaluacion = mysqli_fetch_array($resultado_valida_evaluacion);
		
		if($fila_valida_evaluacion["registros_evaluacion"] ==  0)
		{
			$sql = "INSERT INTO alumnos_evaluaciones (id_alumno_programa, id_grupo, id_materia, id_periodo) VALUES('".$_POST["id_Alumno_Programa"]."','".$_POST["id_Grupo"]."','".$_POST["id_Materia"]."','3');";
			
			$resultado = mysqli_query($conexion, $sql);
			
			if(!mysqli_error($conexion))
			{
				Logs_Errores('REGISTRO', $sql, $_SESSION["id_Usuario"]);
				echo "¡Registro Exitoso!";
			}
			else
			{
				Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
				echo "Error al Registrar...";
			}
		}
		else
		{
			echo "El alumno ya tiene registrada la materia para evaluacion";
		}		
	}
	else
	{
		echo "El alumno ya tiene aprobada la asignatura, no se puede asignar";
	}
?>