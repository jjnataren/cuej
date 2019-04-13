<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 26 Abril]	
	-- País: México
	-- Objetivo: Actualización de permisos para un proceso
	-- Última Modificación: [Abril, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "UPDATE permisos SET ".strtolower($_POST["Campo"])." = '".$_POST["Valor"]."' WHERE id_permiso = '".$_POST["id_Permiso"]."';";	
	$resultado = mysqli_query($conexion, $sql);
	
	if(!mysqli_error($conexion))
	{
		Logs_Errores('ACTUALIZAR', $sql, $_SESSION["id_Usuario"]);
		echo "true";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "false";
	}	
?>