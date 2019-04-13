<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 29 2016]	
	-- País: México
	-- Objetivo: Registro de Nueva Carrera
	-- Última Modificación: [Abril, 29 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_registros = "SELECT COUNT(*) AS registros FROM planes_estudio WHERE id_carrera = '".$_POST["id_Carrera"]."';";
	$resultado_registros = mysqli_query($conexion, $sql_registros);
	$fila_registros = mysqli_fetch_array($resultado_registros);
	
	if($fila_registros["registros"] == 0)
	{		
		$sql = "DELETE FROM carreras WHERE id_carrera = '".$_POST["id_Carrera"]."';";
	
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
			echo "¡El Programa Académico se eliminó con Éxito!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Eliminar...";
		}
	}
	else
	{
		echo "No se puede eleiminar un programa académico con planes de estudio registrados!";
	}
	
	
	
?>