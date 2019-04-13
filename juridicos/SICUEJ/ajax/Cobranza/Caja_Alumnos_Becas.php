<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 30 2016]	
	-- País: México
	-- Objetivo: Búsqueda de alumnos por nombre
	-- Última Modificación: [Junio, 30 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	include ("../../php/Funciones.php");
	
	$sql_alumno = "SELECT apellido_paterno, apellido_materno, nombre, carrera, alumnos_programas.clave FROM alumnos JOIN alumnos_programas USING(id_alumno) JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";	
	$resultado_alumno = mysqli_query($conexion, $sql_alumno);
	$fila_alumno = @mysqli_fetch_array($resultado_alumno);
	
	$sql_ciclo = "SELECT MAX(id_ciclo_escolar) AS ciclo_escolar FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
	$fila_ciclo = @mysqli_fetch_array($resultado_ciclo);
	
	$sql_ciclo_escolar = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_ciclo["ciclo_escolar"]."';";
	
	$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
	$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);
	
	$sql_ciclos = "SELECT ciclos_escolares.id_ciclo_escolar, ciclo_escolar FROM ciclos_escolares JOIN carreras USING(id_carrera_tipo) JOIN planes_estudio USING(id_carrera) JOIN alumnos_programas USING(id_plan_estudio) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_ciclos = mysqli_query($conexion, $sql_ciclos);
	
	$sql_recibo = "SELECT MAX(id_recibo_pago) AS maximo_recibo FROM recibos_pago;";
	$resultado_recibo = mysqli_query($conexion, $sql_recibo);
	$fila_recibo = @mysqli_fetch_array($resultado_recibo);
	
	$recibo_pago = $fila_recibo["maximo_recibo"]+1;
	
	
?>
	<table class="cuej" width="90%">
		<thead>
			<tr>
				<th class="cuej" colspan="4" >DATOS GENERALES DEL ALUMNO</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th class="cuej">NOMBRE</th>
				<th class="cuej">APELLIDO PATERNO</th>
				<th class="cuej">APELLIDO MATERNO</th>
				<th class="cuej">CLAVE</th>
			</tr>
			<tr>
				<td class="cuej" align="center"><?php echo utf8_encode($fila_alumno["nombre"]); ?></td>
				<td class="cuej" align="center"><?php echo utf8_encode($fila_alumno["apellido_paterno"]); ?></td>
				<td class="cuej" align="center"><?php echo utf8_encode($fila_alumno["apellido_materno"]); ?></td>
				<td class="cuej" align="center"><?php echo utf8_encode($fila_alumno["clave"]); ?></td>
			</tr>
			<tr>
				<th class="cuej" colspan="3">PROGRAMA ACAD&Eacute;MICO</th>
				<th class="cuej">&Uacute;LTIMO CICLO ESCOLAR</th>
			</tr>
			<tr>
				<td class="cuej" colspan="3" align="center"><?php echo utf8_encode($fila_alumno["carrera"]); ?></td>
				<td class="cuej" align="center"><?php echo $fila_ciclo_escolar["ciclo_escolar"] ?></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="4"></th>
			</tr>
		</tfoot>
	</table>
	<p>&nbsp;</p>
	<table class="cuej" width="90%">
		<thead>
			<tr>
				<th class="cuej" colspan="5"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th class="cuej" colspan="5">CICLO ESCOLAR</th>				
			</tr>
			<tr>
				<td class="cuej" align="center" colspan="5">
					<select class="campo" name="id_Ciclo_Escolar" id="id_Ciclo_Escolar">
						<option value="" selected ></option>
<?php
	while($fila_ciclos = mysqli_fetch_array($resultado_ciclos))
	{
?>
						<option value="<?php echo $fila_ciclos["id_ciclo_escolar"]; ?>"><?php echo utf8_encode($fila_ciclos["ciclo_escolar"]); ?></option>
<?php
	}
?>
					</select>
				</td>				
			</tr>
            <tr>
               	<td class="cuej" colspan="5">&nbsp;</td>
            </tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="5"></th>
			</tr>
		</tfoot>
	</table>
	<div id="div_Becas">
	</div>
<?php	
	mysqli_close($conexion);
?>