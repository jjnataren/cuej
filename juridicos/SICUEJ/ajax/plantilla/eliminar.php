<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Octubre., 21 2019]
	-- País: México
	-- Objetivo: Registro de nueva plantilla de correo
	-- Última Modificación: [Octubre., 21 2016]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");


	$id = trim( $_POST["id"] );


	$sql = "DELETE FROM tbl_plantilla  WHERE id = $id; ";

	mysqli_query($conexion, "SET NAMES 'utf8'");
	//$resultado = mysqli_query($conexion, $sql);

	if ($conexion->query($sql) === TRUE) {
	     $last_id = $conexion->insert_id;

	     $_SESSION["PLANTILLA_OK"] = "Plantilla eliminada correctamente ID: $id ";

	} else {


	    Logs_Errores($conexion->error, $sql, $_SESSION["id_Usuario"]);

	    $_SESSION["PLANTILLA_ERROR"]  = "\n No fue posible eliminar la plantilla. ERROR:   " .  $conexion->error;

	}


	header( "Location: /SICUEJ/ERP/plantilla" );


?>
