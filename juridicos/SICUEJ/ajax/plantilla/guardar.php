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


	$id_usuario =  $_SESSION["id_Usuario"];

	$id = trim( $_POST["id"] );
	$nombre= trim( $_POST["nombre"] );
	$asunto= $_POST["asunto"];
	$estatus = $_POST["estatus"];
    $descripcion = $_POST["descripcion"];



	$fechaModificacion = date('Y-m-d H:i:s');

	$contenido = null;
	$documentName = '';


	if (isset($_FILES['documento']) &&
	    $_FILES['documento']['error'] == UPLOAD_ERR_OK) {
	       $currDocument = $_FILES['documento']['tmp_name'];
	         $documentName =    $_FILES['documento']['name'];

	         $contenido = base64_encode( file_get_contents ($currDocument) );

	    }




	//creacion de usuario y contraseña


	$sql = "UPDATE  tbl_plantilla SET  descripcion = '$descripcion', nombre = '$nombre', asunto = '$asunto', fecha_modificacion = '$fechaModificacion', usuario= '$id_usuario', estatus= '$estatus' ";

	if ($contenido){

	    $sql = $sql . ", contenido='$contenido' ,  nombre_archivo = '$documentName'  ";
	}

    $sql = $sql  . " WHERE id = $id";


	mysqli_query($conexion, "SET NAMES 'utf8'");
	//$resultado = mysqli_query($conexion, $sql);

	if ($conexion->query($sql) === TRUE) {
	     $last_id = $conexion->insert_id;

	     $_SESSION["PLANTILLA_OK"] = "Plantilla actualizada correctamente  ID: $id ";

	} else {


	    Logs_Errores($conexion->error, $sql, $_SESSION["id_Usuario"]);
	   // echo  "Error: <br>" . $conexion->error;

	    $_SESSION["PLANTILLA_ERROR"]  = "\n No fue posible actualizar la plantilla. ERROR:   " .  $conexion->error;

	}


	header( "Location: /SICUEJ/ERP/plantilla" );


?>
