<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Julio, 07 2016]	
	-- País: México
	-- Objetivo: Registro de Pago y muestra opción de impresión de recibo
	-- Última Modificación: [Julio, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$fecha = date("Y");
	$fecha_corte = substr($fecha,2,2).date("m").date("d");
	
	$sql_becas = "SELECT alumnos_becas.*, clave FROM alumnos_becas JOIN alumnos_programas USING(id_alumno_programa) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_becas = mysqli_query($conexion, $sql_becas);
	$fila_becas = mysqli_fetch_array($resultado_becas);
	
	$sql_ciclo_escolar = "SELECT * FROM  ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
	$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);
	
	switch($_POST["Concepto"])
	{
		case 1: //INSCRIPCIÓN
		
			$monto = $fila_becas["inscripcion"];
			$beca = $fila_becas["beca_inscripcion"];
			$recargo = 0;
			$id_referencia = "0113";
			$importe = $fila_becas["inscripcion"] - (($fila_becas["inscripcion"] * $fila_becas["beca_inscripcion"])/100);
			
		break;
		
		case 2: //REINSCRIPCIÓN
		
			$monto = $fila_becas["inscripcion"];
			$beca = $fila_becas["beca_inscripcion"];
			$recargo = 0;
			$id_referencia = "0114";
			$importe = $fila_becas["inscripcion"] - (($fila_becas["inscripcion"] * $fila_becas["beca_inscripcion"])/100);
			
		break;
		
		/*case 3: //REINSCRIPCIÓN
		
			$monto = $fila_becas["inscripcion"];
			$beca = $fila_becas["beca_inscripcion"];
			$recargo = 0;
			$id_referencia = "0114";
			$importe = $fila_becas["inscripcion"] - (($fila_becas["inscripcion"] * $fila_becas["beca_inscripcion"])/100);
			
		break;*/
		
	}
	
	$sql_recibo = "INSERT INTO recibos_pago (id_alumno_programa, concepto, importe, observaciones, fecha_pago, forma_pago) VALUES ('".$_POST["id_Alumno_Programa"]."','".$_POST["Concepto"]."','".$importe."','".$_POST["Observaciones"]."','".date("Y-m-d")."','".$_POST["Forma_Pago"]."');";
	$resultado_recibo = mysqli_query($conexion, $sql_recibo);
	
	if(!mysqli_error($conexion))
	{
		$id_recibo = mysqli_insert_id($conexion);
		
		//Insertar detalle de pago
		
		
		Logs_Errores('REGISTRO', $sql, $_SESSION["id_Usuario"]);
		echo "¡Pago Exitoso!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Pagar...";
	}	
	
	
	$sql = "INSERT INTO pagos (id_ciclo_escolar, fecha_corte, clave, id_referencia, monto, beca, recargo, id_descuento, importe, tipo_pago) VALUES ('".$_POST["id_Ciclo_Escolar"]."','".$fecha_corte."','".$fila_becas["clave"]."','".$id_referencia."','".$monto."','".$beca."','0','0','".$importe."','2');";
	$resultado = mysqli_query($conexion, $sql);
	
	if(!mysqli_error($conexion))
	{
		Logs_Errores('REGISTRO', $sql, $_SESSION["id_Usuario"]);
		echo "¡Pago Exitoso!";
	}
	else
	{
		Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		echo "Error al Pagar...";
	}
	
	
?>