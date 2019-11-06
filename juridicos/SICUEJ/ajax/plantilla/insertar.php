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


	$nombre= trim( $_POST["nombre"] );
	$asunto= $_POST["asunto"];
	$estatus = $_POST["estatus"];

    $descripcion = $_POST["descripcion"];
	$fechaAlta = date('Y-m-d H:i:s');

	$fechaModificacion = date('Y-m-d H:i:s');

	$contenido = null;
	$documentName = '';


	if (isset($_FILES['documento']) &&
	    $_FILES['documento']['error'] == UPLOAD_ERR_OK) {
	       $currDocument = $_FILES['documento']['tmp_name'];
	         $documentName =    $_FILES['documento']['name'];

	         $contenido = base64_encode( file_get_contents ($currDocument) );

	    }else{

	        echo  "Error: No se pudo acceder al archivo";
	        return;

	    }





	//creacion de usuario y contraseña

	$sql = "INSERT INTO tbl_plantilla (nombre,asunto, nombre_archivo,fecha_alta, fecha_modificacion, usuario, estatus, contenido) ".
	   	"VALUES ( '$nombre','$asunto' ,   '".$documentName."', '".$fechaAlta."', '".$fechaModificacion."', $id_usuario, $estatus,'$contenido');";

	 mysqli_query($conexion, "SET NAMES 'utf8'");
	//$resultado = mysqli_query($conexion, $sql);

	if ($conexion->query($sql) === TRUE) {
	     $last_id = $conexion->insert_id;

	     $_SESSION["PLANTILLA_OK"] = "Plantilla creada correctamente ID: $last_id ";

	} else {


	    Logs_Errores($conexion->error, $sql, $_SESSION["id_Usuario"]);
	   // echo  "Error: <br>" . $conexion->error;

	    $_SESSION["PLANTILLA_ERROR"]  = "\n No fue posible dar de alta la plantilla. ERROR:   " .  $conexion->error;

	}


	header( "Location: /SICUEJ/ERP/plantilla" );


/*
	if(!mysqli_error($conexion))
	{

		echo "¡Se registro el proceso correctamente ID  Exitoso!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Registrar...";
	}*/
?>
