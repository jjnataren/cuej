<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 14 2016]	
	-- País: México
	-- Objetivo: Administración de Profesores
	-- Última Modificación: [Mayo, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

	session_start();
		
	include ("../../php/Funciones.php");

	$sql_programa = "SELECT carrera, plan_estudios, duracion FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = mysqli_fetch_array($resultado_programa);
	
	$sql_ciclo_escolar = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_ciclo_escolar = mysqli_query($conexion,$sql_ciclo_escolar);
	$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);
?>
<table  width="100%" align="center">
	
</table>
<form id="Frm_Horario">
	<table width="70%" align="center" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="2"> Agregar Materia para Evaluaci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="cuej">
					<label>Programa Acad&eacute;mico: </label>
				</td>
				<td class="cuej">
					<label><?php echo utf8_encode($fila_programa["carrera"]); ?> PLAN <?php echo utf8_encode($fila_programa["plan_estudios"]); ?> </label>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Ciclo Escolar: </label>
				</td>
				<td class="cuej">
					<label><?php echo utf8_encode($fila_ciclo_escolar["ciclo_escolar"]); ?></label>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Semestre/Trimestre: </label>
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
			<tr>
				<td class="cuej">
					<label id="Respuesta">Asignatura: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "id_Materia" id = "id_Materia" >
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
<p align="center"><input type="button" value="Registrar Materia" id="Btn_Registro_Materia" name="Btn_Registro_Materia" class="button" /><input type="button" value="Regresar" id="Btn_Regresar" name="Btn_Regresar" class="button" /></p>
<p>&nbsp;</p>