<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 21 2016]	
	-- País: México
	-- Objetivo: Eliminación de Alumno
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_registros = "SELECT COUNT(*) AS registros FROM alumnos_programas WHERE id_alumno = '".$_POST["id_Alumno"]."';";
	$resultado_registros = mysqli_query($conexion, $sql_registros);
	$fila_registros = mysqli_fetch_array($resultado_registros);
	
	if($fila_registros["registros"] == 0)
	{		
		$sql = "DELETE FROM alumnos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			$sql_contacto = "DELETE FROM alumnos_contactos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		
			Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
			echo "¡El Alumno se eliminó con Éxito!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Eliminar...";
		}
	}
	else
	{
		echo "No se puede eliminar un alumno con programas academicos registrados!";
	}
	
	
	
?>