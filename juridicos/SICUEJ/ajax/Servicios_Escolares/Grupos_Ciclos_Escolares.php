<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 2016]	
	-- País: México
	-- Objetivo: Busqueda de Ciclos Escolares para la Carrera seleccionada
	-- Última Modificación: [Mayo, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT id_ciclo_escolar, ciclo_escolar FROM ciclos_escolares JOIN carreras_tipo USING(id_carrera_tipo) JOIN carreras USING(id_carrera_tipo) WHERE id_carrera = '".$_POST["id_Carrera"]."';";
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