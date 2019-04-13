<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 12 2016]	
	-- País: México
	-- Objetivo: Reinscripción de Alumno a Nuevo Ciclo Escolar
	-- Última Modificación: [Junio, 12 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

	session_start();
		
	include ("../../php/Funciones.php");

	$sql_programa = "SELECT id_carrera_tipo, carrera, id_plan_estudio, plan_estudios, duracion FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = mysqli_fetch_array($resultado_programa);
	
	$sql_ciclos_escolares = "SELECT * FROM ciclos_escolares WHERE id_carrera_tipo = '".$fila_programa["id_carrera_tipo"]."';";
	$resultado_ciclos_escolares = mysqli_query($conexion, $sql_ciclos_escolares);
	
?>
<table  width="100%" align="center">
	
</table>
<form id="Frm_Reinscripcion">
	<table width="70%" align="center" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="2"> Reinscripci&oacute;n de Alumno </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="cuej">
					<label>Programa Acad&eacute;mico: </label>
				</td>
				<td class="cuej">
					<input type="hidden" name="id_Plan_Estudio" id="id_Plan_Estudio" value="<?php echo $fila_programa["id_plan_estudio"]; ?>" />
					<label><?php echo utf8_encode($fila_programa["carrera"]); ?> PLAN <?php echo utf8_encode($fila_programa["plan_estudios"]); ?> </label>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Ciclo Escolar: </label>
				</td>
				<td class="cuej">
					<select class="campo" name="id_Ciclo_Escolar" id="id_Ciclo_Escolar">
						<option value="" selected ></option>
<?php
	while($fila_ciclos_escolares = @mysqli_fetch_array($resultado_ciclos_escolares))
	{
?>
						<option value="<?php echo $fila_ciclos_escolares["id_ciclo_escolar"]; ?>"><?php echo $fila_ciclos_escolares["ciclo_escolar"]; ?></option>
<?php
	}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Semestre/Cuatrimestre: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "Semestre" id = "Semestre" >
						<option value="">&nbsp;</option>
<?php
	for($semestre = 1; $semestre <= $fila_programa["duracion"]; $semestre++)
	{
?>
						<option value="<?php echo $semestre; ?>"><?php echo $semestre; ?></option>
<?php
	}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Grupo: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "id_Grupo" id = "id_Grupo" >
							<option value="">&nbsp;</option>
					</select>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="2"></th>
			</tr>
		</tfoot>
	</table>
     <br />     
</form>
<p align="center"><input type="button" value="Reinscripci&oacute;n" id="Btn_Reinscribir" name="Btn_Reinscribir" class="button" /><input type="button" value="Regresar" id="Btn_Regresar" name="Btn_Regresar" class="button" /></p>
<p>&nbsp;</p>