<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 Mayo]	
	-- País: México
	-- Objetivo: Actualización del campo modificado
	-- Última Modificación: [Mayo, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	if($_POST["Campo"] != "mes_inicio")
	{
		$sql = "UPDATE ciclos_escolares SET ".$_POST["Campo"]." = '".utf8_decode($_POST["Valor"])."' WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";		
	}
	else
	{
		$datos = explode(",",$_POST["Valor"]);

		$periodo = $datos[0];
		$carrera_tipo = $datos[1];
		
		if($carrera_tipo == 1 || $carrera_tipo == 3)
		{
			if($periodo == 1)
			{
				$mes_inicio = 1;
				$mes_fin = 6;
			}
			
			if($periodo == 2)
			{
				$mes_inicio = 7;
				$mes_fin = 12;
			}
		}
		
		if($carrera_tipo == 2)
		{
			if($periodo == 1)
			{
				$mes_inicio = 1;
				$mes_fin = 4;
			}
			
			if($periodo == 2)
			{
				$mes_inicio = 5;
				$mes_fin = 8;
			}
			
			if($periodo == 3)
			{
				$mes_inicio = 9;
				$mes_fin = 12;
			}
		}
		
		$sql = "UPDATE ciclos_escolares SET mes_inicio = '".$mes_inicio."', mes_fin = '".$mes_fin."' WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	}
	
	$resultado = mysqli_query($conexion, $sql);
	
	if(!mysqli_error($conexion))
	{
		Logs_Errores('ACTUALIZAR', $sql, $_SESSION["id_Usuario"]);
		echo "true";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "false";
	}	
?>