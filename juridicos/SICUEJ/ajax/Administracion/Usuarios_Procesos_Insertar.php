<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 27 2016]	
	-- País: México
	-- Objetivo: Registro de Proceso en Permisos para el Usuario
	-- Última Modificación: [Abril, 27 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_verifica = "SELECT COUNT(*) AS registros FROM permisos WHERE id_usuario = '".$_POST["id_Usuario"]."' AND id_proceso = '".$_POST["id_Proceso"]."';";
	$resultado_verifica = mysqli_query($conexion, $sql_verifica);
	$fila_verifica = mysqli_fetch_array($resultado_verifica);
	
	if($fila_verifica["registros"] == 0)
	{
	
		$sql = "INSERT INTO permisos (id_usuario, id_proceso, insertar, eliminar, actualizar ) VALUE('".$_POST["id_Usuario"]."', '".$_POST["id_Proceso"]."','1','1','1');";
		
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
	}
	else
	{
		echo "El usuario ya tiene asignados permisos para éste proceso";	
	}
?>