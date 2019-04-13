<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nueva Materia
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");

	$sql_plan_estudio = "SELECT plan_estudios, carrera, duracion FROM planes_estudio JOIN carreras USING(id_carrera) WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
	$resultado_plan_estudio = mysqli_query($conexion, $sql_plan_estudio);
	$fila_plan_estudio = mysqli_fetch_array($resultado_plan_estudio);	
?>
<form id="Frm_Materia_Nueva">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">NUEVA ASIGNATURA PARA <?php echo $fila_plan_estudio["carrera"]." PLAN DE ESTUDIOS ".$fila_plan_estudio["plan_estudios"]; ?></th>
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
          	<input class="campo" type = "text" name = "Nombre_Materia" id = "Nombre_Materia" value = ""  size="100"/>
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
          	<input class="campo" type = "text" name = "Clave_Materia" id = "Clave_Materia" value = "" size="15" />
        </td>
		<td class="cuej">
			<input class="campo" type = "text" name = "Creditos" id = "Creditos" value = "" size="5" />
        </td>
		<td class="cuej">
          	<select class="campo" name = "Semestre" id = "Semestre" >
<?php
	for($semestre = 1; $semestre <= $fila_plan_estudio["duracion"]; $semestre++)
	{
?>
				<option value="<?php echo $semestre; ?>" ><?php echo $semestre; ?></option>
<?php
	}
?>
        </td>
	 </tr>
	 <tr>
		<td colspan="3" align="center" class="cuej">
			<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
			<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" /> 
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