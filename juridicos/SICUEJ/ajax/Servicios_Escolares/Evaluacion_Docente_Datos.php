<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 16 2016]	
	-- País: México
	-- Objetivo: Busqueda de Evaluacion Docente el horario seleccionado
	-- Última Modificación: [Junio, 16 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//Datos del horario y de la materia
	
	$sql_horario = "SELECT * FROM  horarios JOIN materias USING(id_materia) WHERE id_horario = '".$_POST["id_Horario"]."';";
	$resultado_horario = mysqli_query($conexion, $sql_horario);
	$fila_horario = @mysqli_fetch_array($resultado_horario);
	
	//Datos del profesor
	
	$sql_profesor = "SELECT * FROM profesores WHERE id_profesor = '".$fila_horario["id_profesor"]."';";
	$resultado_profesor = mysqli_query($conexion, $sql_profesor);
	$fila_profesor = @mysqli_fetch_array($resultado_profesor);
	
	//Datos de la carrera y plan de estudio
	
	$sql_carrera = "SELECT carrera, plan_estudios, grupos.id_ciclo_escolar FROM carreras JOIN planes_estudio USING(id_carrera) JOIN grupos USING(id_plan_estudio) WHERE id_grupo='".$fila_horario["id_grupo"]."';";
	$resultado_carrera = mysqli_query($conexion, $sql_carrera);
	$fila_carrera = @mysqli_fetch_array($resultado_carrera);
	
	//Ciclo Escolar
	$sql_ciclo = "SELECT * FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_carrera["id_ciclo_escolar"]."';";
	$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
	$fila_ciclo = @mysqli_fetch_array($resultado_ciclo);
	
	//Total de alumnos para evaluacion
	$sql_alumnos = "SELECT COUNT(*) AS total_alumnos FROM alumnos_evaluaciones WHERE id_grupo= '".$fila_horario["id_grupo"]."' AND id_materia = '".$fila_horario["id_materia"]."'";
	
	$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);
	$fila_alumnos = @mysqli_fetch_array($resultado_alumnos);
	
	$total_alumnos = $fila_alumnos["total_alumnos"];

	
	//Total de evaluaciones realizadas
	$sql_evaluaciones = "SELECT COUNT(*) AS total_alumnos FROM alumnos_evaluaciones WHERE id_grupo= '".$fila_horario["id_grupo"]."' AND id_materia = '".$fila_horario["id_materia"]."' AND evaluacion_profesor != '0000-00-00';";
	
	$resultado_evaluaciones = mysqli_query($conexion, $sql_evaluaciones);
	$fila_evaluaciones = @mysqli_fetch_array($resultado_evaluaciones);
	
	$total_evaluaciones = $fila_evaluaciones["total_alumnos"];
?>
	<table class="cuej" width="90%">
		<thead>
			<tr>
				<th class="cuej" colspan="2">DATOS GENERALES</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="cuej"><label>PROGRAMA ACAD&Eacute;MICO:</label></td>
				<td class="cuej"><?php echo utf8_encode($fila_carrera["carrera"]." PLAN ".$fila_carrera["plan_estudios"]); ?></td>
			</tr>
			<tr>
				<td class="cuej"><label>ASIGNATURA:</label></td>
				<td class="cuej"><?php echo utf8_encode($fila_horario["materia"]); ?></td>
			</tr>
			<tr>
				<td class="cuej"><label>CICLO ESCOLAR: </label></td>
				<td class="cuej"><?php echo utf8_encode($fila_ciclo["ciclo_escolar"]); ?></td>
			</tr>
			<tr>
				<td class="cuej"><label>PROFESOR: </label></td>
				<td class="cuej"><?php echo utf8_encode($fila_profesor["titulo"].' '.$fila_profesor["nombre"].' '.$fila_profesor["apellido_paterno"].' '.$fila_profesor["apellido_materno"]); ?></td>
			</tr>
			<tr>
				<td class="cuej"><label>TOTAL DE ALUMNOS: </label></td>
				<td class="cuej"><?php echo $total_alumnos; ?></td>
			</tr>
			<tr>
				<td class="cuej"><label>EVALUACIONES: </label></td>
				<td class="cuej"><?php echo $total_evaluaciones; ?></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="2"></th>
			</tr>
		</tfoot>
	</table>
	<p>&nbsp;</p>
	<table class="cuej" width="90%">
		<thead>
			<tr>
				<th class="cuej" colspan="6">RESULTADOS</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th class="cuej">Pregunta</th>
				<th class="cuej">Opci&oacute;n 1</th>
				<th class="cuej">Opci&oacute;n 2</th>
				<th class="cuej">Opci&oacute;n 3</th>
				<th class="cuej">Opci&oacute;n 4</th>
				<th class="cuej">Opci&oacute;n 5</th>
			</tr>
<?php
	if($total_evaluaciones >0)
	{
	
		$sql_preguntas = "SELECT * FROM evaluaciones_preguntas ORDER BY id_evaluacion_pregunta;";
		$resultado_preguntas = mysqli_query($conexion, $sql_preguntas);
		
		while($fila_preguntas = mysqli_fetch_array($resultado_preguntas))
		{
?>
			<tr>
				<td class="cuej"><?php echo utf8_encode($fila_preguntas["id_evaluacion_pregunta"].".- ".$fila_preguntas["pregunta"]); ?></td>
<?php	
			for($opcion = 1; $opcion <= 5; $opcion++)
			{
				if($fila_preguntas["opcion_".$opcion] != "")
				{
					$sql_respuestas = "SELECT COUNT(*) AS total_respuestas FROM evaluaciones_docentes WHERE id_horario = '".$_POST["id_Horario"]."' AND id_evaluacion_pregunta = '".$fila_preguntas["id_evaluacion_pregunta"]."' AND respuesta = '".$opcion."';";
					$resultado_respuestas = mysqli_query($conexion, $sql_respuestas);
					$fila_respuestas = mysqli_fetch_array($resultado_respuestas);
					
					$porcentaje = @($fila_respuestas["total_respuestas"] * 100)/$total_evaluaciones;

				}
				else
				{
					$porcentaje = 0;
				}
?>
				<td class="cuej"><?php echo $porcentaje; ?></td>
<?php			
			}
			unset($fila_preguntas);
?>
			</tr>
<?php			
		}
	}
	else
	{
?>
			<tr>
				<th class="cuej" colspan="6">No existen evaluaciones para la asignatura</th>
			</tr>
<?php
	}
?>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="6"></th>
			</tr>
		</tfoot>
	</table>
<?php
	if($total_evaluaciones > 0)
	{
?>
	<p>&nbsp;</p>
	<table class="cuej" width="90%">
		<thead>
			<tr>
				<th class="cuej" >COMENTARIOS AL PROFESOR</th>
			</tr>
		</thead>
		<tbody>
<?php
		$sql_observaciones = "SELECT * FROM evaluaciones_observaciones WHERE id_horario='".$_POST["id_Horario"]."' ORDER BY id_evaluacion_observacion;";
		$resultado_observaciones = mysqli_query($conexion, $sql_observaciones);
		
		while($fila_observaciones = @mysqli_fetch_array($resultado_observaciones))
		{
?>
			<tr>
				<td class="cuej"><?php echo utf8_encode($fila_observaciones["observaciones"]); ?></td>
			</tr>
<?php
		}
?>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" ></th>
			</tr>
		</tfoot>
	</table>
<?php
	}
?>
<form action="../impresiones/Servicios_Escolares/Evaluacion_Docente_PDF.php" target="_blank" method="post" >
	<p align="center">
		<input type="hidden" value="<?php echo $_POST["id_Horario"]; ?>" name="id_Horario" id="id_Horario" />
		<input class="button" type="submit" value="Evaluaci&oacute;n PDF" name="Btn_PDF" id="Btn_PDF" />
		<input class="button" type="button" value="Regresar" name="Btn_Regresar" id="Btn_Regresar" />
	</p>
</form>