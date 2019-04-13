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
	
	$sql = "SELECT DISTINCT(semestre) FROM horarios JOIN grupos USING(id_grupo) JOIN planes_estudio USING(id_plan_estudio) WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."' AND id_profesor = '".$_SESSION["id_Profesor"]."';";
	
	echo $sql;
	
	$resultado = mysqli_query($conexion, $sql);
?>
	<option value="" selected >&nbsp;</option>
<?php	
	while($fila = mysqli_fetch_array($resultado))
	{
?>
	<option value="<?php echo $fila["semestre"]; ?>"><?php echo $fila["semestre"]; ?></option>
<?php	
	}
?>