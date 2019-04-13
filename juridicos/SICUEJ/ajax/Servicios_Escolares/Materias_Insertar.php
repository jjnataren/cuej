<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2017]	
	-- País: México
	-- Objetivo: Registro de Nueva Asignatura
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "INSERT INTO materias (id_plan_estudio, materia, clave_materia, semestre, creditos) VALUES ('".$_POST["id_Plan_Estudio"]."','".utf8_decode($_POST["Nombre_Materia"])."','".$_POST["Clave_Materia"]."','".$_POST["Semestre"]."','".$_POST["Creditos"]."');";
	
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
?>