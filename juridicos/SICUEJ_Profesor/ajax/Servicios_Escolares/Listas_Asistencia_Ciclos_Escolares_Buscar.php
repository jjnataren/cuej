<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Busqueda de Ciclos Escolares para la Carrera seleccionada
	-- Última Modificación: Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/	
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT DISTINCT(id_ciclo_escolar), ciclo_escolar FROM horarios JOIN grupos USING(id_grupo) JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) JOIN ciclos_escolares USING(id_ciclo_escolar) WHERE id_carrera = '".$_POST["id_Carrera"]."' AND id_profesor = '".$_SESSION["id_Profesor"]."' ORDER BY ciclo_escolar DESC;";
	
	$resultado = mysqli_query($conexion, $sql);
?>
	<option value="" selected>&nbsp;</option>
<?php	
	while($fila = @mysqli_fetch_array($resultado))
	{
?>
	<option value="<?php echo $fila["id_ciclo_escolar"]; ?>" ><?php echo utf8_encode($fila["ciclo_escolar"]); ?></option>
<?php
	}
?>