<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 08 2016]	
	-- País: México
	-- Objetivo: Busqueda de Materias segun las opciones seleccionadas
	-- Última Modificación: [Junio, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT materias.* FROM materias JOIN alumnos_programas USING(id_plan_estudio) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND semestre='".$_POST["Semestre"]."';";
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