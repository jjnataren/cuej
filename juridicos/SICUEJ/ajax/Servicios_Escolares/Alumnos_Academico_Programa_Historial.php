<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 31 2016]	
	-- País: México
	-- Objetivo: Historial Académico del Alumno
	-- Última Modificación: [Mayo, 31 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_programa = "SELECT id_plan_estudio, plan_estudios, id_carrera, carrera, planes_estudio.duracion, carreras_tipo.duracion AS tipo_duracion FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) JOIN carreras_tipo USING(id_carrera_tipo) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = @mysqli_fetch_array($resultado_programa);

?>
<form id="Frm_Alumnos_Academico_Historial" name="Frm_Alumnos_Academico_Historial" action="../impresiones/Servicios_Escolares/Historial_Academico_PDF.php" method="post" target="_blank" >
<input type="hidden" name="id_Alumno_Programa" id="id_Alumno_Programa" value="<?php echo $_POST["id_Alumno_Programa"]; ?>" />
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="8">HISTORIAL ACAD&Eacute;MICO <?php echo utf8_encode($fila_programa["carrera"]." PLAN DE ESTUDIOS ".$fila_programa["plan_estudios"]); ?></th>
        </tr>
        <tr>
			   <th class="cuej">Semestre</th>
               <th class="cuej">Clave</th>
               <th class="cuej">Materia</th>
               <th class="cuej">Calificacion</th>
               <th class="cuej">Paso en</th>
               <th class="cuej">Curso en</th>
               <th class="cuej">Equivalencia</th>
               <th class="cuej">Opciones</th>
          </tr>
     </thead>
     <tbody>
<?php
	for($semestre = 1; $semestre <= $fila_programa["duracion"]; $semestre++)
	{	
		$sql_historial = "SELECT * FROM alumnos_historial JOIN materias USING(id_materia) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND semestre = '".$semestre."' ORDER BY semestre, clave_materia;";
		$resultado_historial = mysqli_query($conexion, $sql_historial);

?>
		<tr>
          	<th class="cuej" colspan = "8"><?php echo $fila_programa["tipo_duracion"]." ".$semestre; ?></th>
        </tr>
<?php	
		while($fila_historial = mysqli_fetch_array($resultado_historial))
		{
			$sql_ciclo_escolar = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_historial["id_ciclo_escolar"]."';";
			$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
			$fila_ciclo_escolar = @mysqli_fetch_array($resultado_ciclo_escolar);
?>		
		<tr>
          	   <td class="cuej" align="center">
					<?php echo $fila_historial["semestre"]; ?>
			   </td>
               <td class="cuej" align="center">
					<?php echo $fila_historial["clave_materia"]; ?>
			   </td>
               <td class="cuej">
					<?php echo utf8_encode($fila_historial["materia"]); ?>
			   </td>
               <td class="cuej" align="center">
					<?php echo $fila_historial["calificacion"];  ?>
			   </td>
               <td class="cuej" align="center">
					<?php if($fila_historial["tipo"] == 0) echo ""; else if($fila_historial["tipo"] == 1) echo "ORD"; else if($fila_historial["tipo"] == 2) echo "EXT";  ?>
			   </td>
               <td class="cuej" align="center">
					<?php echo $fila_ciclo_escolar["ciclo_escolar"]; ?>
			   </td>
               <td class="cuej" align="center">
					<?php if($fila_historial["equivalencia"] == 0) echo ""; else if($fila_historial["equivalencia"] == 1) echo "NO"; else if($fila_historial["equivalencia"] == 2) echo "NO";  ?>
			   </td>
               <td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
               	<a href="javascript: Alumnos_Academico_Programa_Historial_Dato(<?php echo $_POST["id_Alumno_Programa"]; ?>, <?php echo $_POST["id_Alumno"]; ?>,<?php echo $fila_historial["id_alumno_historial"]; ?>)">Modificar</a>
<?php
	}
	else
	{
		echo "-";
	}
?>
               </td>
          </tr>
<?php	
		}
	}
?>
		  <tr>
				<td class="cuej" colspan="8" align="center">&nbsp;
					
				</td>
		  </tr>
	</tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="8"></th>
        </tr>
     </tfoot>
</table>
<p align="center"><input type="button" value="Regresar" id="Btn_Regresar" name="Btn_Regresar" class="button" /><input type="submit" value="Imprimir" id="Btn_Imprimir" name="Btn_Imprimir" class="button" /></p>
</form>