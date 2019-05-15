<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Abril,  21 2019]
	-- País: México
	-- Objetivo: Actualizar un registro de actividad
	-- Última Modificación: [Abril,  21 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");

	$id = $_POST["id"];

	$id_usuario =  $_SESSION["id_Usuario"];


	$nombre= trim( $_POST["nombre"] );
	$persona =trim( $_POST["persona"] );
	$estatus = $_POST["estatus"];
	$descripcion =trim( $_POST["descripcion"] );


	$modificacion = date('Y-m-d H:i:s');

	$avance = date_create_from_format('d/m/Y', isset ($_POST["avance"])?$_POST["avance"]:null);

	$final = date_create_from_format('d/m/Y',  isset($_POST["final"])?$_POST["final"]:null);

	if($avance)
	    $avance = $avance->format('Y-m-d');
	    else $avance = null;


	    if($final)
	        $final = $final->format('Y-m-d');
	        else $final = null;



	    $sql = "UPDATE registro_actividad SET  nombre= '$nombre', persona= '$persona', estatus= $estatus, avance= '$avance', final='$final' , descripcion = '$descripcion' , modificacion = '$modificacion' WHERE id = $id;";

	    mysqli_query($conexion, "SET NAMES 'utf8'");

	    $resultado = mysqli_query($conexion, $sql);


	    if(mysqli_error($conexion)){
	        Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
	        echo "Error al actualiar el registro intente nuevamente \n Detalle \n " . mysqli_error($conexion);
	      return;
	    }


	    echo "¡Actividad actualizada correctamente!";
?>
