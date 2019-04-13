<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 2016]	
	-- País: México
	-- Objetivo: Eliminar Ciclo Escolar
	-- Última Modificación: [Mayo, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_registros = "SELECT COUNT(*) AS registros FROM grupos WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_registros = mysqli_query($conexion, $sql_registros);
	$fila_registros = mysqli_fetch_array($resultado_registros);	
	
	if($fila_registros["registros"] == 0)
	{		
		$sql = "DELETE FROM ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
			echo "¡El Ciclo Escolar se eliminó con Éxito!";
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