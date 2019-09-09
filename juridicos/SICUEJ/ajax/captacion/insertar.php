<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 21 2019]
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



	$medio=   $_POST["medio"];
	$medio = !empty($medio) ? "'$medio'" : "NULL";


	$cuenta= trim($_POST["cuenta"]);
	$pais= $_POST["pais"];
	$estado= $_POST["estado"];
	$estado = !empty($estado) ? "'$estado'" : "NULL";


	$localidad= trim($_POST["localidad"]);
	$topico= $_POST["topico"];
	$topico = !empty($topico) ? "'$topico'" : "NULL";


	$comentarios=trim( $_POST["comentarios"]);
	$grado= $_POST["grado"];
	$grado = !empty($grado) ? "'$grado'" : "NULL";

	$fechaCaptura = date('Y-m-d H:i:s');
    $estatus = 1;

	//creacion de usuario y contraseña

	$sql = "INSERT INTO captacion (localidad, cliente_nombre, cliente_telefono, cliente_correo_electronico, tipo_medio_contacto, medio_contacto, pais, estado, cliente_fecha_nacimiento, id_topico_interes, comentarios, captacion_fecha_alta, id_empleado, estatus,ultima_modificacion ,grado_estudios) ".
	           "VALUES ( '$localidad' ,'".$nombre."', '".$telefono."', '".$correo."', $medio, '".$cuenta."',$pais, $estado,'".
	           $birthDate."', $topico, '".$comentarios."','".$fechaCaptura."', $id_usuario, $estatus,'".$fechaCaptura."',$grado);";

	 mysqli_query($conexion, "SET NAMES 'utf8'");
	//$resultado = mysqli_query($conexion, $sql);

	if ($conexion->query($sql) === TRUE) {
	    $last_id = $conexion->insert_id;
	    echo $last_id;
	} else {
	    Logs_Errores($conexion->error, $sql, $_SESSION["id_Usuario"]);
	    echo  "Error: <br>" . $conexion->error;
	}

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
