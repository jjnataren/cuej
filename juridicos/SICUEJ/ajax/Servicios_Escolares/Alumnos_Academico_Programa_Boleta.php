<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 31 2016]	
	-- País: México
	-- Objetivo: Datos del Alumno con Opción a Modificación
	-- Última Modificación: [Mayo, 31 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_programa = "SELECT id_plan_estudio, plan_estudios, id_carrera, id_carrera_tipo, carrera FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = @mysqli_fetch_array($resultado_programa);
	
	$sql_ciclo_escolar = "SELECT MAX(id_ciclo_escolar) AS maximo_ciclo FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."'";
	$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
	$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);
	
	$sql_evaluacion = "SELECT * FROM alumnos_evaluaciones JOIN materias USING(id_materia) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$fila_ciclo_escolar["maximo_ciclo"]."' ORDER BY semestre, clave_materia;";
	$resultado_evaluacion = mysqli_query($conexion, $sql_evaluacion);
	
	$sql_ciclos = "SELECT * FROM ciclos_escolares WHERE id_carrera_tipo = '".$fila_programa["id_carrera_tipo"]."';";
	$resultado_ciclos = mysqli_query($conexion, $sql_ciclos);
	
	$sql_materias = "SELECT * FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$fila_ciclo_escolar["maximo_ciclo"]."'";
	$resultado_materias = mysqli_query($conexion, $sql_materias);
	
?>
<form id="Frm_Alumnos_Academico_Boleta">
<table align="left" width="100%" >
	<tr>
		<th align="center">CICLO ESCOLAR:</th>
	</tr>
	<tr>
		<th align="center">
			<select id="id_Ciclo_Escolar" class="campo">
				<option value=""></option>
<?php
	while($fila_ciclos = mysqli_fetch_array($resultado_ciclos))
	{
?>
				<option value="<?php echo $fila_ciclos["id_ciclo_escolar"]; ?>" <?php if($fila_ciclos["id_ciclo_escolar"] == $fila_ciclo_escolar["maximo_ciclo"]) echo "selected"; ?>><?php echo $fila_ciclos["ciclo_escolar"]; ?></option>
<?php
	}
?>
			</select>
		</th>
	</tr>
</table>
<p>&nbsp;</p>
<div name="div_Boleta" id="div_Boleta">
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
					<a href="javascript: Alumnos_Academico_Programa_Boleta_Materia_Eliminar(<?php echo $fila_materias["id_alumno_evaluacion"]; ?>,<?php echo $_POST["id_Alumno_Programa"]; ?>,<?php echo $_POST["id_Alumno"]; ?>,<?php echo $fila_ciclo_escolar["maximo_ciclo"]; ?>)">Eliminar</a>
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
</div>
</form>