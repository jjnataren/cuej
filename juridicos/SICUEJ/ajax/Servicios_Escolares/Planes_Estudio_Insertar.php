<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2017]	
	-- País: México
	-- Objetivo: Registro de Nuevo Plan de Estudios
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "INSERT INTO planes_estudio (id_carrera, plan_estudios, acuerdo_sep, clave_sep, fecha, antecedente, creditos, duracion) VALUES ('".$_POST["id_Carrera"]."','".utf8_decode($_POST["Nombre_Plan_Estudio"])."','".$_POST["Acuerdo_Sep"]."','".$_POST["Clave_Sep"]."','".$_POST["Fecha"]."','".$_POST["Antecedente"]."','".$_POST["Creditos"]."','".$_POST["Duracion"]."');";
	
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