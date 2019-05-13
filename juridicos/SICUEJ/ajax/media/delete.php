<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 20 2019]
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Alumno
	-- Última Modificación: [Mayo, 20 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");

	$id= $_POST["id"];

	$sql = "DELETE FROM files WHERE id  = $id";

	mysqli_query($conexion, "SET NAMES 'utf8'");

	$results = mysqli_query($conexion,$sql);

	if(! $row = @mysqli_fetch_assoc($results)){
	    echo "Borrado exitosamente";
	}else
	    echo "Ocurrio un error intente mas tarde";

?>


