<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Busqueda de Profesor segun las opciones seleccionadas
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT * FROM profesores JOIN horarios USING(id_profesor) WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";	
	$resultado = mysqli_query($conexion, $sql);
	$fila = mysqli_fetch_array($resultado);
	
	echo utf8_encode($fila["titulo"]." ".$fila["nombre"]." ".$fila["apellido_paterno"]." ".$fila["apellido_materno"]);
?>