<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 11 2016]	
	-- País: México
	-- Objetivo: Eliminacion de Grupo
	-- Última Modificación: [Mayo, 11 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//validar que grupo no tenga relación en otras tablas para poder eliminar
		
	$sql_horario = "SELECT COUNT(*) AS horarios FROM horarios WHERE id_grupo = '".$_POST["id_Grupo"]."';";
	$resultado_horario = mysqli_query($conexion, $sql_horario);
	$fila_horario = @mysqli_fetch_array($resultado_horario);
	
	$sql_evaluacion = "SELECT COUNT(*) AS evaluaciones FROM alumnos_evaluaciones WHERE id_grupo = '".$_POST["id_Grupo"]."';";
	$resultado_evaluacion = mysqli_query($conexion, $sql_evaluacion);
	$fila_evaluacion = @mysqli_fetch_array($resultado_evaluacion);
	
	
	if($fila_horario["horarios"] == 0 && $fila_evaluacion["evaluaciones"] == 0)
	{		
		$sql = "DELETE FROM grupos WHERE id_grupo = '".$_POST["id_Grupo"]."';";
	
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
			echo "¡El Grupo se eliminó con Éxito!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Eliminar...";
		}
	}
	else
	{
		echo "No se puede eliminar un grupo con horario y/o alumnos registrados!";
	}	
?>