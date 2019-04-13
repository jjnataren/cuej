<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 14 2016]	
	-- País: México
	-- Objetivo: Registro de Nuevo Profesor
	-- Última Modificación: [Mayo, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//creacion de usuario y contraseña
	$nombre = explode(" ", $_POST["Nombre"]);
	
	$usuario = strtolower(substr($_POST["Apellido_Paterno"],0,1).substr($_POST["Apellido_Materno"],0,1).$nombre[0]);
	
	$usuario = iconv('UTF-8', 'ASCII//TRANSLIT', $usuario);	
	$usuario = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $usuario));
	
	$sql_usuario = "SELECT COUNT(*) AS coincidencias FROM profesores WHERE usuario LIKE '".$usuario."%';";
	$resultado_usuario = mysqli_query($conexion, $sql_usuario);
	$fila_usuario = mysqli_fetch_array($resultado_usuario);
	
	if($fila_usuario["coincidencias"] > 0)
		$usuario .= $fila_usuario["coincidencias"];
		
	$password = strtolower($nombre[0].substr($_POST["Apellido_Paterno"],0,1).substr($_POST["Apellido_Materno"],0,1));
	$password = iconv('UTF-8', 'ASCII//TRANSLIT', $password);	
	$password = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $password));
	
	$pass = Genera_Password($password);
	
	$sql = "INSERT INTO profesores (apellido_paterno, apellido_materno, nombre, curp, rfc, nivel_estudios, estudios, titulo, cedula_profesional, usuario, password, estatus) VALUES ('".utf8_decode($_POST["Apellido_Paterno"])."', '".utf8_decode($_POST["Apellido_Materno"])."','".utf8_decode($_POST["Nombre"])."','".utf8_decode($_POST["CURP"])."','".utf8_decode($_POST["RFC"])."','".utf8_decode($_POST["Nivel_Estudios"])."','".utf8_decode($_POST["Estudios"])."','".utf8_decode($_POST["Titulo"])."','".$_POST["Cedula_Profesional"]."','".$usuario."','".$pass."','1');";	
	
	$resultado = mysqli_query($conexion, $sql);
	
	if(!mysqli_error($conexion))
	{
		$id_profesor = mysqli_insert_id($conexion);
		
		$sql_documentacion = "SELECT * FROM documentacion_profesores ORDER BY id_documentacion_profesor;";
		$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);
		
		while($fila_documentacion = mysqli_fetch_array($resultado_documentacion))
		{
			$sql_documentos = "INSERT INTO profesores_documentacion (id_profesor, id_documentacion_profesor, fecha_entrega) VALUES ('".$id_profesor."','".$fila_documentacion["id_documentacion_profesor"]."','".$_POST["Fecha_Entrega_".$fila_documentacion["id_documentacion_profesor"]]."');";
			
			$resultado_documentos = mysqli_query($conexion, $sql_documentos);
				
		}
		
		$sql_carreras = "SELECT * FROM carreras ORDER BY id_carrera_tipo, carrera;";
		$resultado_carreras = mysqli_query($conexion, $sql_carreras);
		
		while($fila_carreras = mysqli_fetch_array($resultado_carreras))
		{
			if(isset($_POST["Carrera_".$fila_carreras["id_carrera"]]))
			{
				if($_POST["Carrera_".$fila_carreras["id_carrera"]] == 1)
				{
					$sql_carrera = "INSERT INTO profesores_carreras (id_profesor, id_carrera) VALUES ('".$id_profesor."','".$fila_carreras["id_carrera"]."');";
					$resultado_carrera = mysqli_query($conexion, $sql_carrera);
				}
			}
		}
		
		if($_POST["Correo_Electronico"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','3','".$_POST["Correo_Electronico"]."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}
		
		if($_POST["Telefono_Casa"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','1','".$_POST["Telefono_Casa"]."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}
		
		if($_POST["Telefono_Celular"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','2','".$fila["Telefono_Celular"]."');";
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