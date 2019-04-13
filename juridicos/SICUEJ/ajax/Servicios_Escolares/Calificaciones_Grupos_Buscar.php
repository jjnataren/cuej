<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Busqueda de Grupos segun las opciones seleccionadas
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT * FROM grupos WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."' AND semestre = '".$_POST["Semestre"]."';";	
	$resultado = mysqli_query($conexion, $sql);
?>
	<option value="" selected >&nbsp;</option>
<?php	
	while($fila = mysqli_fetch_array($resultado))
	{
?>
	<option value="<?php echo $fila["id_grupo"]; ?>"><?php echo $fila["grupo"]; ?></option>
<?php	
	}
?>