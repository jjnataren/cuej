<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 26 Abril]	
	-- País: México
	-- Objetivo: Actualización del campo modificado
	-- Última Modificación: [Abril, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	if($_POST["Campo"] == 'password')
		$sql = "UPDATE usuarios SET ".$_POST["Campo"]." = MD5('".$_POST["Valor"]."') WHERE id_usuario = '".$_POST["id_Usuario"]."';";
	else
		$sql = "UPDATE usuarios SET ".$_POST["Campo"]." = '".$_POST["Valor"]."' WHERE id_usuario = '".$_POST["id_Usuario"]."';";
	
	
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