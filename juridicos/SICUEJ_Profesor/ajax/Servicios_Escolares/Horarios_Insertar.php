<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 17 2016]	
	-- País: México
	-- Objetivo: Registro de Nuevo Horario
	-- Última Modificación: [Mayo, 17 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_verifica = "SELECT COUNT(*) AS registros FROM horarios WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."'";
	
	$resultado_verifica = mysqli_query($conexion, $sql_verifica);
	$fila_verifica = mysqli_fetch_array($resultado_verifica);
	
	if($fila_verifica["registros"] == 0)
	{	
		$sql = "INSERT INTO horarios (id_grupo, id_materia, id_profesor, hora_inicio_1, hora_fin_1, hora_inicio_2, hora_fin_2, hora_inicio_3, hora_fin_3, hora_inicio_4, hora_fin_4, hora_inicio_5, hora_fin_5, hora_inicio_6, hora_fin_6) VALUES ('".$_POST["id_Grupo"]."','".$_POST["id_Materia"]."','".$_POST["id_Profesor"]."','".$_POST["Hora_Inicio_1"]."','".$_POST["Hora_Fin_1"]."','".$_POST["Hora_Inicio_2"]."','".$_POST["Hora_Fin_2"]."','".$_POST["Hora_Inicio_3"]."','".$_POST["Hora_Fin_3"]."','".$_POST["Hora_Inicio_4"]."','".$_POST["Hora_Fin_4"]."','".$_POST["Hora_Inicio_5"]."','".$_POST["Hora_Fin_5"]."','".$_POST["Hora_Fin_6"]."','".$_POST["Hora_Fin_6"]."')";
		
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			Logs_Errores('REGISTRO', $sql, $_SESSION["id_Usuario"]);
			echo "¡Registro Exitoso!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Registrar...";
		}
	}
	else
	{
		echo "El horario para la materia seleccionada ya ha sido registrado anteriormente";	
	}
?>