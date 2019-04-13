<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 27 Abril]	
	-- País: México
	-- Objetivo: Búaqueda de Procesos por Area
	-- Última Modificación: [Abril, 27 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	include ("../../php/Funciones.php");
	
	$sql = "SELECT * FROM procesos WHERE id_area_sicuej = '".$_POST["id_Area"]."';";
	$resultado = mysqli_query($conexion,$sql);
	
	while($fila = @mysqli_fetch_array($resultado))
	{
?>
	<option value="<?php echo $fila["id_proceso"]; ?>"><?php echo $fila["proceso_nombre"]; ?></option>
<?php	
	}
?>