<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Busqueda de Materias segun las opciones seleccionadas
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT DISTINCT(id_materia), materia FROM horarios JOIN materias USING(id_materia) WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' AND semestre = '".$_POST["Semestre"]."' AND id_profesor = '".$_SESSION["id_Profesor"]."';";	
	$resultado = mysqli_query($conexion, $sql);
?>
	<option value="" selected >&nbsp;</option>
<?php	
	while($fila = mysqli_fetch_array($resultado))
	{
?>
	<option value="<?php echo $fila["id_materia"]; ?>"><?php echo utf8_encode($fila["materia"]); ?></option>
<?php	
	}
?>