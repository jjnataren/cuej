<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 21 2016]	
	-- País: México
	-- Objetivo: Busqueda de Colonias conforme al codigo postal indicado
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT id_codigo_postal, colonia FROM codigos_postales WHERE codigo_postal = '".$_POST["Codigo_Postal"]."';";	
	$resultado = mysqli_query($conexion, $sql);
?>
	<option value="" selected >&nbsp;</option>
<?php	
	while($fila = mysqli_fetch_array($resultado))
	{
?>
	<option value="<?php echo $fila["id_codigo_postal"]; ?>"><?php echo utf8_encode($fila["colonia"]); ?></option>
<?php	
	}
?>