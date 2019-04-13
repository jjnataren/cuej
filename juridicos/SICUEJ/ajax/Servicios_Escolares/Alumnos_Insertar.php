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
	
	$sql = "SELECT MAX(usuario) AS maximo FROM alumnos;";
	$resultado = mysqli_query($conexion, $sql);
	$fila = @mysqli_fetch_array($resultado);
	
	$siguiente = $fila["maximo"] + 1;
	
	$nombre = explode(" ", trim($_POST["Nombre"]));	
	$password = strtolower(substr(trim($_POST["Apellido_Paterno"]),0,1).substr(trim($_POST["Apellido_Materno"]),0,1).$nombre[0]);
	$password = iconv('UTF-8', 'ASCII//TRANSLIT', $password);	
	$password = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $password));
	
	$pass = Genera_Password($password);
	
	//creacion de usuario y contraseña
	
	$sql = "INSERT INTO alumnos (id_codigo_postal, usuario, password, curp, rfc, apellido_paterno, apellido_materno, nombre, calle) VALUES ('".utf8_decode($_POST["id_Codigo_Postal"])."', '".$siguiente."', '".$pass."', '".utf8_decode(trim($_POST["CURP"]))."', '".utf8_decode(trim($_POST["RFC"]))."','".utf8_decode(trim($_POST["Apellido_Paterno"]))."', '".utf8_decode(trim($_POST["Apellido_Materno"]))."','".utf8_decode(trim($_POST["Nombre"]))."', '".utf8_decode(trim($_POST["Calle"]))."');";	
	
	$resultado = mysqli_query($conexion, $sql);
	
	if(!mysqli_error($conexion))
	{
	
		$id_alumno = mysqli_insert_id($conexion);
		
		for($i = 1; $i <= 3; $i++ )
		{
		
			if($i == 1)
				$contacto = $_POST["Telefono_Casa"];
			if($i == 2)
				$contacto = $_POST["Telefono_Celular"];
			if($i == 3)
				$contacto = $_POST["Correo_Electronico"];
		
			$sql_contacto = "INSERT INTO alumnos_contactos (id_alumno, tipo_contacto, contacto) VALUES ('".$id_alumno."', '".$i."','".$contacto."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}	
		
		Logs_Errores('REGISTRO', $sql, $_SESSION["id_Usuario"]);
		echo "¡Registro Exitoso!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Registrar...";
	}
?>
