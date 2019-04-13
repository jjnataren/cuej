<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 20 2016]	
	-- País: México
	-- Objetivo: Eliminacion de Profesor
	-- Última Modificación: [Mayo, 20 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//validar que grupo no tenga relación en otras tablas para poder eliminar
		
	$sql_horario = "SELECT COUNT(*) AS horarios FROM horarios WHERE id_profesor = '".$_POST["id_Profesor"]."';";
	$resultado_horario = mysqli_query($conexion, $sql_horario);
	$fila_horario = mysqli_fetch_array($resultado_horario);
	
		
	if($fila_horario["horarios"] == 0 )
	{		
		$sql = "DELETE FROM profesores WHERE id_profesor = '".$_POST["id_Profesor"]."';";	
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			$sql_documentacion = "DELETE FROM profesores_documentacion WHERE id_profesor = '".$_POST["id_Profesor"]."';";
			$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);
			
			$sql_carreras = "DELETE FROM profesores_carreras WHERE id_profesor = '".$_POST["id_Profesor"]."';";
			$resultado_carreras = mysqli_query($conexion, $sql_carreras);
		
			Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
			echo "¡El Profesor se eliminó con Éxito!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Eliminar...";
		}
	}
	else
	{
		echo "No se puede eliminar un profesor con horario registrado!";
	}	
?>