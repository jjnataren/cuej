<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 21 2016]
	-- País: México
	-- Objetivo: Registro de Nuevo Alumno
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];


	$id_evento= trim( $_POST["id_evento"] );
	$comentario = $_POST["comentario"];

	$horario = date('Y-m-d H:i:s');



	$sql = "SELECT * FROM  bitacora_horario WHERE id_evento = $id_evento AND id_empleado = $id_usuario AND horario >= CURDATE();";
	$resultado = mysqli_query($conexion, $sql);
	$row = @mysqli_fetch_assoc($resultado);


	if ($row){

	    echo "Ya se ha registrado el evento indicado";
	   return ;
	}

	$sql = "INSERT INTO bitacora_horario (id_empleado, id_evento, horario, comentario) ".
	           "VALUES ( $id_usuario ,$id_evento, '$horario', '$comentario');";

	 mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);

	if(!mysqli_error($conexion))
	{

		echo "¡Se registro el evento correctamente!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Registrar...";
	}
?>
