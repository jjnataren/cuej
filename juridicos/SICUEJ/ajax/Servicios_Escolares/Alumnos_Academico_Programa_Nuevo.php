<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 26 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Programa Académico para el alumno seleccionado
	-- Última Modificación: [Mayo, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
?>
<form id="Frm_Programa_Nuevo">
	<table align="center" width="100%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="2">NUEVO PROGRAMA ACAD&Eacute;MICO</th>
		    </tr>
		</thead>
		<tbody>
			<tr>
				<td class="cuej">
					<label>Programa Acad&eacute;mico: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "id_Carrera" id = "id_Carrera" >
						<option value="">&nbsp;</option>
<?php
	$sql_carreras = "SELECT * FROM carreras WHERE id_carrera_estatus = '1' ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras = mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = mysqli_fetch_array($resultado_carreras))
	{
	?>
						<option value="<?php echo $fila_carreras["id_carrera"]; ?>"><?php echo utf8_encode($fila_carreras["carrera"]); ?></option>
<?php
	}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Plan de Estudio: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "id_Plan_Estudio" id = "id_Plan_Estudio" >
					</select>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Ciclo Escolar: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "id_Ciclo_Escolar" id = "id_Ciclo_Escolar" >
					</select>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Semestre/Cuatrimestre: </label>
				</td>
				<td class="cuej">
					<select class="campo" name = "Semestre" id = "Semestre" >
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
					<label>N&uacute;mero de Cuenta: </label>
				</td>
				<td class="cuej">
					<input type="text" class="campo" name="Cuenta" id="Cuenta"  maxlength="10" value="" />
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Observaciones: </label>
				</td>
				<td class="cuej">
					<textarea class="campo" name="Observaciones" id="Observaciones" cols="80" rows="4"></textarea>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="2"></th>
			</tr>
		</tfoot>
	</table>
	<p align="center">
		<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
		<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" />
	</p>
</form>