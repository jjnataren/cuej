<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral de la Centro Universitario de Estudios Jurídicos - Alumno
	-- Autor: Ing. Julio César Morales Crispín
	-- Responsable: Ing. Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 18 2017]
	-- País: México
	-- Objetivo: Muestra las preguntas de la evaluación para profesor
	-- Última Modificación: [Octubre, 18 2017]
	-- Realizó: Ing. Julio César Morales Crispín
	-- Observaciones: Creación de archivo
	-- ===============================================================================
*/

session_start();
include ("../../php/Funciones.php");
?>

<table class="cuej" align="center">
  <thead>
      <tr>
        <th class="cuej" align="center">Asignatura</th>
        <th class="cuej" align="center">Grupo</th>
        <th class="cuej" align="center">Semestre</th>
        <th class="cuej" align="center">Profesor</th>
      </tr>
  </thead>
<?php
		$sql_alumnos_evaluaciones = "SELECT id_alumno_evaluacion, id_materia, evaluacion_profesor, grupo, materia, clave_materia, materias.semestre FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' AND id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."' ORDER BY clave_materia;";
		$resultado_alumnos_evaluaciones = mysqli_query($conexion,$sql_alumnos_evaluaciones);
		
		while($fila_alumnos_evaluaciones = mysqli_fetch_array($resultado_alumnos_evaluaciones))
			{
				$sql_profesor = "SELECT id_profesor, apellido_paterno, apellido_materno, nombre, titulo FROM horarios JOIN profesores USING (id_profesor) WHERE id_horario = '".$_POST["id_Horario"]."';";
				$resultado_profesor = mysqli_query($conexion,$sql_profesor);
				$fila_profesor = mysqli_fetch_array($resultado_profesor);
?>
  <tr>
    <td class="cuej"><?php echo utf8_encode($fila_alumnos_evaluaciones["clave_materia"] ." - " . $fila_alumnos_evaluaciones["materia"]); ?><input type="hidden" name="id_Alumno_Evaluacion" id="id_Alumno_Evaluacion" value="<?php echo $fila_alumnos_evaluaciones["id_alumno_evaluacion"]; ?>" /></td>
    <td class="cuej" align="center"><?php echo $fila_alumnos_evaluaciones["grupo"]; ?></td>
    <td class="cuej" align="center"><?php echo $fila_alumnos_evaluaciones["semestre"]; ?></td>
    <td class="cuej"><?php echo utf8_encode($fila_profesor["titulo"]." ".$fila_profesor["nombre"]." ".$fila_profesor["apellido_paterno"]." ".$fila_profesor["apellido_materno"]); ?></td>
  </tr>
<?php
			}
?>
	<tfoot>
    	<tr>
    		<th class="cuej" colspan="4">&nbsp;</th>
        </tr>
    </tfoot>
</table>

<br />
<div align="justify">
  <p>El presente cuestionario tiene como prop&oacute;sito conocer tu opini&oacute;n objetiva sobre la calidad de la docencia de cada uno de tus profesores. Para que esta evaluaci&oacute;n cumpla su finalidad, te pedimos emitas tus respuestas con honestidad y madurez. Por favor lee cuidadosamente los siguientes enunciados y selecciona el c&iacute;rculo correspondiente a la respuesta que consideres m&aacute;s adecuada</p>
  </div>
<br />

<table width="99%" align="center" class="cuej">
	<thead>
      <tr>
        <th align="center" class="cuej" width="1%">#</th>
        <th align="center" class="cuej" width="39%">PREGUNTA</th>
        <th align="center" class="cuej" width="10%">OPCI&Oacute;N 1</th>
        <th align="center" class="cuej" width="15%">OPCI&Oacute;N 2</th>
        <th align="center" class="cuej" width="15%">OPCI&Oacute;N 3</th>
        <th align="center" class="cuej" width="12%">OPCI&Oacute;N 4</th>
        <th align="center" class="cuej" width="8%">OPCI&Oacute;N 5</th>
      </tr>
  	</thead>
    <tbody>
<?php
		$sql_preguntas = "SELECT * FROM evaluaciones_preguntas ORDER BY id_evaluacion_pregunta;";
		$resultado_preguntas = mysqli_query($conexion,$sql_preguntas);
		$registros_preguntas = mysqli_num_rows($resultado_preguntas);
		
		while($fila_preguntas = mysqli_fetch_array($resultado_preguntas))
			{				
				$i++;
				
				if ($i%2 == 0) $fondo = "#EFF5FB";
				else $fondo = "#FFFFFF";
?>
  <tr bgcolor="<?php echo $fondo; ?>">
    <td class="cuej"><?php echo $fila_preguntas["id_evaluacion_pregunta"]; ?></td>
    <td class="cuej"><?php echo utf8_encode($fila_preguntas["pregunta"]); ?></td>
    <td class="cuej"><input type="radio" name="Respuesta_<?php echo $i; ?>" id="Respuesta_<?php echo $i; ?>" value="1" /><?php echo utf8_encode($fila_preguntas["opcion_1"]); ?></td>
    <td class="cuej"><input type="radio" name="Respuesta_<?php echo $i; ?>" id="Respuesta_<?php echo $i; ?>" value="2" /><?php echo utf8_encode($fila_preguntas["opcion_2"]); ?></td>
    <td class="cuej"><input type="radio" name="Respuesta_<?php echo $i; ?>" id="Respuesta_<?php echo $i; ?>" value="3" /><?php echo utf8_encode($fila_preguntas["opcion_3"]); ?></td>
    <td class="cuej"><input type="radio" name="Respuesta_<?php echo $i; ?>" id="Respuesta_<?php echo $i; ?>" value="4" /><?php echo utf8_encode($fila_preguntas["opcion_4"]); ?></td>
    <td class="cuej"><input type="radio" name="Respuesta_<?php echo $i; ?>" id="Respuesta_<?php echo $i; ?>" value="5" /><?php echo utf8_encode($fila_preguntas["opcion_5"]); ?></td>
  </tr>
<?php
			}
?>
	</tbody>
    <tfoot>
    	<tr>
        	<th class="cuej" colspan="7">&nbsp;</th>
        </tr>
    </tfoot>
</table>
<br />

<table width="99%" class="cuej" align="center" >
  <thead>
  	<tr>
      <th class="cuej">OBSERVACIONES</th>
    </tr>
  </thead>
  <tr>
    <td align="justify" class="cuej">En caso de tener un comentario adicional a los rubros del cuestionario, en los siguientes campos de texto puedes expresar 2 aspectos que te gustan de la pr&aacute;ctica docente de tu profesor y/o 2 aspectos que te gustar&iacute;a que cambiara. Recuerda que este cuestionario es an&oacute;nimo, con el prop&oacute;sito de darte la mayor libertad y confianza. Por favor emite tu opini&oacute;n con madurez y respeto.</td>
  </tr>
  <tr>
    <td class="cuej" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td class="cuej" align="center"><textarea name="Observaciones" id="Observaciones" cols="100" rows="5" onKeyDown="Contar_Texto(this.form.Observaciones,this.form.Longitud_Observaciones,500);" onKeyUp="Contar_Texto(this.form.Observaciones,this.form.Longitud_Observaciones,500);" onblur="this.value=this.value.toUpperCase()"></textarea>&nbsp;<input readonly type="text" name="Longitud_Observaciones" size="3" maxlength="3" value="500">
    </td>
  </tr>
  <tfoot>
  	<tr>
      <th class="cuej">&nbsp;</th>
    </tr>
  </tfoot>
</table>

<br />

<input type="hidden" name="id_Horario" id="id_Horario" value="<?php echo $_POST["id_Horario"]; ?>" />
<input type="hidden" name="Registros" id="Registros" value="<?php echo $registros_preguntas; ?>" />
<div id="divResultado" align="center">
  <input class="button" type="button" name="Guardar" id="Guardar" value="Guardar" onClick="Validar_Guardar()" />&nbsp;&nbsp;
  <input class="button" type="button" name="Regresar" id="Regresar" value="Regresar" onClick="Actualizar()" />
</div>
