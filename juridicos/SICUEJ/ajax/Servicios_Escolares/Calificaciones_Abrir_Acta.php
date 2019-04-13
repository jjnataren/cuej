<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 22 2016]	
	-- País: México
	-- Objetivo: Apertura de Acta
	-- Última Modificación: [Junio, 22 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_abrir = "UPDATE horarios SET acta_cerrada = 0, migracion = 0 WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";
	$resultado = mysqli_query($conexion, $sql_abrir);
		
	if(!mysqli_error($conexion))
	{
		Logs_Errores('ACTUALIZAR', $sql_abrir, $_SESSION["id_Usuario"]);			
		echo "Acta Abierta!";			
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql_cerrar, $_SESSION["id_Usuario"]);
		echo "Ocurrió un problema, el acta no pudo ser abierta!";
	}
?>