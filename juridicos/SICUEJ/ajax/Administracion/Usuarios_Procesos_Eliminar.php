<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 27 2016]	
	-- País: México
	-- Objetivo: Eliminar permiso para un proceso para un usuario
	-- Última Modificación: [Abril, 27 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "DELETE FROM permisos WHERE id_permiso = '".$_POST["id_Permiso"]."' LIMIT 1;";
		
	$resultado = mysqli_query($conexion, $sql);
		
	if(!mysqli_error($conexion))
	{
		Logs_Errores('ELIMINAR', $sql, $_SESSION["id_Usuario"]);
		echo "¡Eliminación Exitosa!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Eliminar...";
	}	
?>