<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Jumio, 05 2016]	
	-- País: México
	-- Objetivo: Datos del Alumno con Opción a Modificación
	-- Última Modificación: [Junio, 05 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_programa = "SELECT id_plan_estudio, plan_estudios, id_carrera, id_carrera_tipo, carrera FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = @mysqli_fetch_array($resultado_programa);
	
	$sql_materias = "SELECT * FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."' ORDER BY clave_materia;";
	$resultado_materias = mysqli_query($conexion, $sql_materias);
	
	$registros_materias = @mysqli_num_rows($resultado_materias);
	
	if($registros_materias > 0)
	{
?>
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="5">BOLETA DE CALIFICACIONES <?php echo utf8_encode($fila_programa["carrera"]." PLAN DE ESTUDIOS ".$fila_programa["plan_estudios"]); ?></th>
        </tr>
        <tr>
			   <th class="cuej">Clave</th>
               <th class="cuej">Materia</th>
               <th class="cuej">Grupo</th>
               <th class="cuej">Calificacion</th>
               <th class="cuej">Opciones</th>
          </tr>
     </thead>
     <tbody>
<?php
		while($fila_materias = mysqli_fetch_array($resultado_materias))
		{
?>
		 <tr>
          	   <td class="cuej" align="center">
					<?php echo $fila_materias["clave_materia"]; ?>
			   </td>
               <td class="cuej" align="left">
					<?php echo utf8_encode($fila_materias["materia"]); ?>
			   </td>
               <td class="cuej" align="center">
					<?php echo $fila_materias["grupo"]; ?>
			   </td>
               <td class="cuej" align="center">
					<?php echo $fila_materias["calificacion"]; ?>
			   </td>
               <td class="cuej" align="center">
				<a href="javascript: Alumnos_Academico_Programa_Boleta_Materia_Eliminar(<?php echo $fila_materias["id_alumno_evaluacion"]; ?>,<?php echo $_POST["id_Alumno_Programa"]; ?>,<?php echo $_POST["id_Alumno"]; ?>,<?php echo $_POST["id_Ciclo_Escolar"]; ?>)">Eliminar</a>
			</td>
          </tr>
<?php
		}
?>
		  <tr>
				<td class="cuej" colspan="5" align="center">&nbsp;
					
				</td>
		  </tr>
	</tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="5"></th>
        </tr>
     </tfoot>
</table>
<p align="center"><input type="button" value="Agregar Materia" id="Btn_Materia" name="Btn_Materia" class="button" /><input type="button" value="Regresar" id="Btn_Regresar" name="Btn_Regresar" class="button" /></p>
<?php
	}
	else
	{
?>
		<p align="center" >No existen registros para el ciclo escolar seleccionado</p>
<?php
	}
?>