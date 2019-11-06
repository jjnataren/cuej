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
	$id = $_POST["id"];



    $sql = "SELECT * FROM tbl_plantilla WHERE id =  $id;";


    mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);



	if(!mysqli_error($conexion))
	{

	    $row = @mysqli_fetch_assoc($resultado);

	    $tpl = base64_decode( $row["contenido"] );


	    echo '<h1>Asunto:  '. $row["asunto"] .'</h1>';

        echo '<br />';

	    echo $tpl;





	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "No se pudo cargar la plantilla " . mysqli_error($conexion);
	}
?>
