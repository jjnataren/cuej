<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 22 2016]	
	-- País: México
	-- Objetivo: Actualización del campo modificado
	-- Última Modificación: [Mayo, 22 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_verifica = "SELECT COUNT(*) AS registros FROM alumnos_contactos WHERE id_alumno = '".$_POST["id_Alumno"]."' AND tipo_contacto = '".$_POST["Tipo_Contacto"]."';";
	
	$resultado_verifica = mysqli_query($conexion, $sql_verifica);
	$fila_verifica = @mysqli_fetch_array($resultado_verifica);
	
	
	if($fila_verifica["registros"] == 0)
	{
		$sql = "INSERT INTO alumnos_contactos (id_alumno, tipo_contacto, contacto) VALUES ('".$_POST["id_Alumno"]."','".$_POST["Tipo_Contacto"]."','".$_POST["Valor"]."');";
	}
	else
	{	
	
		$sql = "UPDATE alumnos_contactos SET ".$_POST["Campo"]." = '".utf8_decode($_POST["Valor"])."' WHERE id_alumno = '".$_POST["id_Alumno"]."' AND tipo_contacto = '".$_POST["Tipo_Contacto"]."';";
		
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