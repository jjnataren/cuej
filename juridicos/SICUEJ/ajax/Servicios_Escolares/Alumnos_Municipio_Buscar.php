<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 21 2016]	
	-- País: México
	-- Objetivo: Busqueda del Municipio correspondiente al codigo postal indicado
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT DISTINCT municipio FROM codigos_postales JOIN municipios USING(id_municipio) WHERE codigo_postal = '".$_POST["Codigo_Postal"]."';";
	$resultado = mysqli_query($conexion, $sql);
	$fila = mysqli_fetch_array($resultado);
	
	echo utf8_encode($fila["municipio"]);	
?>