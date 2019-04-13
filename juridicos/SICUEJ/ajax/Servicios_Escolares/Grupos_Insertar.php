<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 10 2016]	
	-- País: México
	-- Objetivo: Registro de Nuevo Grupo
	-- Última Modificación: [Mayo, 10 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "INSERT INTO grupos (id_ciclo_escolar, id_plan_estudio, grupo, tipo_grupo, semestre, salon) VALUES ('".$_POST["id_Ciclo_Escolar_Nuevo"]."', '".$_POST["id_Plan_Estudio"]."','".$_POST["Grupo"]."', '".$_POST["Tipo_Grupo"]."','".$_POST["Semestre"]."','".$_POST["Salon"]."');";	
	
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