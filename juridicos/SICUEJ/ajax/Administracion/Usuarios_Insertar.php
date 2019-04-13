<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 27 2016]	
	-- País: México
	-- Objetivo: Registro de Nueva Usuario
	-- Última Modificación: [Abril, 27 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "INSERT INTO usuarios (area, usuario_estatus, usuario, password, titulo, nombre, apellido_paterno, apellido_materno, correo_electronico) VALUES ('".$_POST["Area"]."','1','".$_POST["Usuario"]."',MD5('".$_POST["Password"]."'),'".$_POST["Titulo"]."','".$_POST["Nombre_Usuario"]."','".$_POST["Apellido_Paterno"]."','".$_POST["Apellido_Materno"]."','".$_POST["Correo_Electronico"]."');";
	
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