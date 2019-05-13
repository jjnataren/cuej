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


	$nombre= trim( $_POST["nombre"] );
	$edad= $_POST["edad"];

	if ($edad && $edad > 0)
	   $birthDate = date('Y-m-d', strtotime($edad . ' years ago'));
	else
	    $birthDate = null;
	$telefono=trim( $_POST["telefono"]);
	$correo= trim($_POST["correo"]);
	$medio= $_POST["medio"];
	$cuenta= trim($_POST["cuenta"]);
	$pais= $_POST["pais"];
	$estado= $_POST["estado"];
	$localidad= trim($_POST["localidad"]);
	$topico= $_POST["topico"];
	$comentarios=trim( $_POST["comentarios"]);
	$grado= $_POST["grado"];
    $fechaCaptura = date('Y-m-d H:i:s');
    $estatus = 1;

	//creacion de usuario y contraseña

	$sql = "INSERT INTO captacion (localidad, cliente_nombre, cliente_telefono, cliente_correo_electronico, tipo_medio_contacto, medio_contacto, pais, estado, cliente_fecha_nacimiento, id_topico_interes, comentarios, captacion_fecha_alta, id_empleado, estatus,ultima_modificacion ,grado_estudios) ".
	           "VALUES ( '$localidad' ,'".$nombre."', '".$telefono."', '".$correo."', $medio, '".$cuenta."',$pais, $estado,'".
	           $birthDate."', $topico, '".$comentarios."','".$fechaCaptura."', $id_usuario, $estatus,'".$fechaCaptura."',$grado);";

	 mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);

	if(!mysqli_error($conexion))
	{

		echo "¡Se registro el proceso correctamente ID  Exitoso!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Registrar...";
	}
?>