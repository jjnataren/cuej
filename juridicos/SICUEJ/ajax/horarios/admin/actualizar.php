<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 21 2016]
	-- País: México
	-- Objetivo: Registro de Nuevo Alumno
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];



	$ids = $_POST["id"];

	$descripciones = $_POST["descripcion"];

	$estatuses = $_POST["estatus"];

	$horarios =  $_POST["horario"];

	$tolerancias  = $_POST["tolerancia"];

	mysqli_query($conexion, "SET NAMES 'utf8'");


	foreach ($ids as $key =>$value){



	    $descripcion =trim($descripciones[$key]);
	    $horario = $horarios[$key];
	    $tolerancia = $tolerancias[$key];
	    $estatus = $estatuses[$key];

	    $sql = "UPDATE evento_horario SET  descripcion= '$descripcion', horario= '$horario', estatus= $estatus, tolerancia= $tolerancia WHERE id = $value;";


	    $resultado = mysqli_query($conexion, $sql);


	    if(mysqli_error($conexion)){
	        Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
	        echo "Error al actualiar el registro intente nuevamente \n Detalle \n " . mysqli_error($conexion);
	       break;
	    }
	}

	    echo "¡Horarios actualizados correctamente!";
?>
