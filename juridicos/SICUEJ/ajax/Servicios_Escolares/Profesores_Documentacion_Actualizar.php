<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 22 Mayo]	
	-- País: México
	-- Objetivo: Actualización del campo modificado
	-- Última Modificación: [Junio, 22 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "UPDATE profesores_documentacion SET ".$_POST["Campo"]." = '".utf8_decode($_POST["Valor"])."' WHERE id_profesor_documentacion = '".$_POST["id_Profesor_Documentacion"]."';";
	
	
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