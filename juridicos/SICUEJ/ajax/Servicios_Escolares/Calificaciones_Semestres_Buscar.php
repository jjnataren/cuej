<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Busqueda de Semestres segun el plan estudios seleccionado
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT duracion FROM planes_estudio WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";	
	$resultado = mysqli_query($conexion, $sql);
	$fila = mysqli_fetch_array($resultado);
?>
	<option value="" selected >&nbsp;</option>
<?php	
	for($i = 1; $i <= $fila["duracion"]; $i++)
	{
?>
	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php	
	}
?>