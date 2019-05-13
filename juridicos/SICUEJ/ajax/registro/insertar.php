<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Abril, 19 2019]
	-- País: México
	-- Objetivo: Registro de Nuevo Alumno
	-- Última Modificación: [Abril, 19 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];


	$nombre= trim( $_POST["nombre"] );
	$persona =trim( $_POST["persona"] );
	$estatus = $_POST["estatus"];
	$descripcion =trim( $_POST["descripcion"] );


	$fecha_captura = date('Y-m-d H:i:s');

	$avance = date_create_from_format('d/m/Y', isset ($_POST["avance"])?$_POST["avance"]:null);

	$final = date_create_from_format('d/m/Y',  isset($_POST["final"])?$_POST["final"]:null);

	if($avance)
	      $avance = $avance->format('Y-m-d');
	else $avance = null;


	if($final)
	    $final = $final->format('Y-m-d');
	    else $final = null;



	$sql = "INSERT INTO registro_actividad (id_usuario, nombre, persona, avance, final, descripcion, estatus, fecha_captura) ".
	           "VALUES ( $id_usuario,'$nombre' ,'$persona', '$avance', '$final','$descripcion', $estatus, '$fecha_captura');";

	 mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);

	if($resultado)
	{

		echo "¡Se registro la actividad correctamente!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "ERROR al registrar la actividad. \n Error:  " . mysqli_error($conexion);
	}
?>
