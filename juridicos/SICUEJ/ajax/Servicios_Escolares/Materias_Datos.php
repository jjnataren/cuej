<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2016]	
	-- País: México
	-- Objetivo: Información de la Materia Seleccionada
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_materia = "SELECT * FROM materias WHERE id_materia = '".$_POST["id_Materia"]."';";
	$resultado_materia = mysqli_query($conexion, $sql_materia);
	$fila_materia = mysqli_fetch_array($resultado_materia);
	
	$sql_plan_estudio = "SELECT plan_estudios, carrera, duracion FROM planes_estudio JOIN carreras USING(id_carrera) WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
	$resultado_plan_estudio = mysqli_query($conexion, $sql_plan_estudio);
	$fila_plan_estudio = mysqli_fetch_array($resultado_plan_estudio);
?>
<div >
<br />
<form id="Frm_Actualizar">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">ASIGNATURA DE <?php echo $fila_plan_estudio["carrera"]." PLAN DE ESTUDIOS ".$fila_plan_estudio["plan_estudios"]; ?></th>
          </tr>
     </thead>
     <tbody>
	 <tr>
		<td class="cuej" colspan="3">
          	<label>Asignatura<span id="lbl_Materia"></span></label>                   
		</td>
	 </tr>
     <tr>
		<td class="cuej" colspan="3">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Nombre_Materia" id = "Nombre_Materia" value = "<?php echo utf8_encode($fila_materia["materia"]); ?>" onBlur="Materias_Actualizar(<?php echo $_POST["id_Materia"] ?>, 'materia', $(this).val(), 'lbl_Materia')" size="100"/>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_materia["materia"]);
?>
		</span>	
<?php
	}
?>
		</td>
	 </tr>
	 <tr>
		<td class="cuej">
			<label>Clave<span id="lbl_Clave_Materia"></span></label>
		</td>
		<td class="cuej">
          	<label>Cr&eacute;ditos<span id="lbl_Materia"></span></label>                   
		</td>
        <td class="cuej">
			<label>Semestre<span id="lbl_Semestre"></span></label>
		</td>
	 </tr>
	 <tr>
		<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Clave_Materia" id = "Clave_Materia" value = "<?php echo utf8_encode($fila_materia["clave_materia"]); ?>" onBlur="Materias_Actualizar(<?php echo $_POST["id_Materia"] ?>, 'clave_materia', $(this).val(), 'lbl_Clave_Materia')" size="15" />
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_materia["clave_materia"]);
?>
		</span>	
<?php
	}
?>
        </td>
		<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
			<input class="campo" type = "text" name = "Creditos" id = "Creditos" value = "<?php echo $fila_materia["creditos"]; ?>" onBlur="Materias_Actualizar(<?php echo $_POST["id_Materia"] ?>, 'creditos', $(this).val(), 'lbl_Creditos')" size="5" />
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo $fila_materia["creditos"];
?>
		</span>	
<?php
	}
?>
        </td>
		<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<select class="campo" name = "Semestre" id = "Semestre" onChange="Materias_Actualizar(<?php echo $_POST["id_Materia"] ?>, 'semestre', $(this).val(), 'lbl_Semestre')">
<?php
	for($semestre = 1; $semestre <= $fila_plan_estudio["duracion"]; $semestre++)
	{
?>
				<option value="<?php echo $semestre; ?>" <?php if($semestre == $fila_materia["semestre"]) echo "selected"; ?> ><?php echo $semestre; ?></option>
<?php
	}
?>
			</select>			
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_materia["semestre"]);
?>
		</span>	
<?php
	}
?>
        </td>
	 </tr>
     </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
     </tfoot>
</table>
</form>
<br />
<p>&nbsp;</p>
<center>
	<input class="button" type="button" id = "Btn_Regresar" name = "Btn_Regresar"  value = "Regresar" /> 
</center>
</div>