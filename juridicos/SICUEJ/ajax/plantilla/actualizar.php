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


	$nombre= trim( $_POST["nombre"] );
	$edad= $_POST["edad"];

	$edadBack= $_POST["edadBack"];
    $birthDateBack = $_POST["birthDateBack"];


	if ($edad && $edad > 0 && $edad !== $edadBack)
	   $birthDate = date('Y-m-d', strtotime($edad . ' years ago'));
	else
	    $birthDate = $birthDateBack;



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
    //$fechaCaptura = date('Y-m-d');
    $estatus = 1;
    $today =  date('Y-m-d H:i:s');

	//creacion de usuario y contraseña

    $sql = "UPDATE captacion SET localidad='$localidad' , cliente_nombre= '$nombre', cliente_telefono= '$telefono', cliente_correo_electronico= '$correo', tipo_medio_contacto= $medio, medio_contacto= '$cuenta', pais= $pais, estado= $estado, cliente_fecha_nacimiento= '$birthDate', id_topico_interes= $topico, comentarios= '$comentarios',  id_empleado= $id_usuario, ultima_modificacion = '$today',grado_estudios = $grado WHERE id = $id;";


    mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);

	if(!mysqli_error($conexion))
	{

		echo "¡Se actualizo el registro correctamente!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al actualiar el registro intente nuevamente \n Detalle \n " . mysqli_error($conexion);
	}
?>
