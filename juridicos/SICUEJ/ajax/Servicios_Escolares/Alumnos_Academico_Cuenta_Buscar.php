<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 25 2016]	
	-- País: México
	-- Objetivo: Numero de Cuenta correspondiente a la carrera y ciclo escolar seleccionados
	-- Última Modificación: [Junio, 25 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//Digitos del año en curso
	$year = substr(date("Y"),2,2);
	
	//Generacion y Clave
	$sql_generacion = "SELECT clave, generacion FROM carreras_generaciones JOIN carreras USING(id_carrera) WHERE id_carrera = '".$_POST["id_Carrera"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_generacion = mysqli_query($conexion, $sql_generacion);
	$fila_generacion = mysqli_fetch_array($resultado_generacion);
	
	$clave = $fila_generacion["clave"];
	$generacion = $fila_generacion["generacion"];
	
	//Consecutivo
	
	$sql_alumno = "SELECT COUNT(*) AS registros FROM alumnos_programas;";
	$resultado_alumno = mysqli_query($conexion, $sql_alumno);
	$fila_alumno = mysqli_fetch_array($resultado_alumno);
	
	$consecutivo = str_pad(($fila_alumno["registros"]+1), 3, "0", STR_PAD_LEFT);
	
	echo $year.$generacion.$clave.$consecutivo;	
?>