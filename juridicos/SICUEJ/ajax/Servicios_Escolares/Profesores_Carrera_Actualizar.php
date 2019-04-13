<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 24 2016]	
	-- País: México
	-- Objetivo: Actualización del campo modificado
	-- Última Modificación: [Junio, 24 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_profesores_carreras = "SELECT COUNT(*) AS registros FROM profesores_carreras WHERE id_profesor = '".$_POST["id_Profesor"]."' AND id_carrera = '".$_POST["id_Carrera"]."';";
	$resultado_profesores_carreras = mysqli_query($conexion,$sql_profesores_carreras);
	$fila_profesores_carreras = @mysqli_fetch_array($resultado_profesores_carreras);
	
	
	if($_POST["Activo"] == 1 && $fila_profesores_carreras["registros"] == 0)
	{
		$sql = "INSERT INTO profesores_carreras (id_profesor, id_carrera) VALUES ('".$_POST["id_Profesor"]."','".$_POST["id_Carrera"]."');";
		$resultado = mysqli_query($conexion, $sql);
	
		if(!mysqli_error($conexion))
		{
			Logs_Errores('INSERTAR', $sql, $_SESSION["id_Usuario"]);
			echo "true";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "false";
		}
	}
	else if($_POST["Activo"] == 0 && $fila_profesores_carreras["registros"] > 0)
	{
		$sql = "DELETE FROM profesores_carreras WHERE id_carrera='".$_POST["id_Carrera"]."' AND id_profesor = '".$_POST["id_Profesor"]."';";
		$resultado = mysqli_query($conexion, $sql);
	
		if(!mysqli_error($conexion))
		{
			Logs_Errores('ELIMINAR', $sql, $_SESSION["id_Usuario"]);
			echo "true";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "false";
		}		
	}		
?>