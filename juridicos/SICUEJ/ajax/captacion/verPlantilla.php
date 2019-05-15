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

	include ("../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];
	$id = $_POST["id"];



    $sql = "SELECT * FROM tbl_plantilla WHERE id =  $id;";


    mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);



	if(!mysqli_error($conexion))
	{

	    $row = @mysqli_fetch_assoc($resultado);

	    $tpl = file_get_contents('../../ERP/captacion/tpl/' . $row["contenido"]);

	    echo $tpl;

	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "No se pudo cargar la plantilla " . mysqli_error($conexion);
	}
?>
