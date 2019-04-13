<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Julio, 19 2016]	
	-- País: México
	-- Objetivo: Actualización del campo modificado
	-- Última Modificación: [Julio, 19 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_verifica = "SELECT COUNT(*) AS registros FROM profesores_contactos WHERE id_profesor = '".$_POST["id_Profesor"]."' AND tipo_contacto = '".$_POST["Tipo_Contacto"]."';";
	
	$resultado_verifica = mysqli_query($conexion, $sql_verifica);
	$fila_verifica = @mysqli_fetch_array($resultado_verifica);
	
	
	if($fila_verifica["registros"] == 0)
	{
		$sql = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$_POST["id_Profesor"]."','".$_POST["Tipo_Contacto"]."','".$_POST["Valor"]."');";
	}
	else
	{	
		$sql = "UPDATE profesores_contactos SET ".$_POST["Campo"]." = '".utf8_decode($_POST["Valor"])."' WHERE id_profesor= '".$_POST["id_Profesor"]."' AND tipo_contacto = '".$_POST["Tipo_Contacto"]."';";
	}
	
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