<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 2016]	
	-- País: México
	-- Objetivo: Registro de Nuevo Ciclo_Escolar
	-- Última Modificación: [Mayo, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	switch($_POST["Carrera_Tipo"])
	{
		case 1:
			if($_POST["Periodo"] == 1)
			{
				$mes_inicio = 1;
				$mes_fin = 6;
			}
			if($_POST["Periodo"] == 2)
			{
				$mes_inicio = 7;
				$mes_fin = 12;
			}
			break;
		case 2:
			if($_POST["Periodo"] == 1)
			{
				$mes_inicio = 1;
				$mes_fin = 4;
			}
			if($_POST["Periodo"] == 2)
			{
				$mes_inicio = 5;
				$mes_fin = 8;
			}
			if($_POST["Periodo"] == 3)
			{
				$mes_inicio = 9;
				$mes_fin = 12;
			}
			break;
		case 3:
			if($_POST["Periodo"] == 1)
			{
				$mes_inicio = 1;
				$mes_fin = 6;
			}
			if($_POST["Periodo"] == 2)
			{
				$mes_inicio = 7;
				$mes_fin = 12;
			}
			break;
		
	}
	
	$sql = "INSERT INTO ciclos_escolares (ciclo_escolar, id_carrera_tipo, fecha_inicio, fecha_fin, mes_inicio, mes_fin, periodo) VALUES ('".utf8_decode($_POST["Ciclo_Escolar"])."','".$_POST["Carrera_Tipo"]."','".$_POST["Fecha_Inicio"]."','".$_POST["Fecha_Fin"]."','".$mes_inicio."','".$mes_fin."','".$_POST["Anio"]."');";
	
	$resultado = mysqli_query($conexion, $sql);
	
	if(!mysqli_error($conexion))
	{
		$id_ciclo_escolar = mysqli_insert_id($conexion);
		
		$sql_carreras = "SELECT * FROM carreras WHERE id_carrera_tipo = '".$_POST["Carrera_Tipo"]."';";
		$resultado_carreras = mysqli_query($conexion, $sql_carreras);
		
		while($fila_carreras = mysqli_fetch_array($resultado_carreras))
		{
			$sql_maxima = "SELECT MAX(generacion) AS maxima FROM carreras_generaciones WHERE id_carrera = '".$fila_carreras["id_carrera"]."';";
			$resultado_maxima = mysqli_query($conexion, $sql_maxima);
			$fila_maxima = mysqli_fetch_array($resultado_maxima);
			
			$siguiente = $fila_maxima["maxima"] + 1;
			
			$sql_generacion = "INSERT INTO carreras_generaciones (id_carrera, id_ciclo_escolar, generacion) VALUES ('".$fila_carreras["id_carrera"]."','".$id_ciclo_escolar."','".$siguiente."');";
			
			$resultado_generacion = mysqli_query($conexion, $sql_generacion);
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