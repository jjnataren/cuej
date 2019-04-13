<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral de la Centro Universitario de Estudios Jurídicos - Alumno
	-- Autor: Ing. Julio César Morales Crispín
	-- Responsable: Ing. Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 17 2017]
	-- País: México
	-- Objetivo: Muestra la boleta de calificaciones del ciclo escolar indicado
	-- Última Modificación: [Octubre, 17 2017]
	-- Realizó: Ing. Julio César Morales Crispín
	-- Observaciones: Creación de archivo
	-- ===============================================================================
*/
session_start();
include ("../../php/Funciones.php");

$sql_grupo = "SELECT id_grupo FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
$resultado_grupo = mysqli_query($conexion,$sql_grupo);
$registros_grupo = mysqli_num_rows($resultado_grupo);
		
if ($registros_grupo > 0)
	{
		$fila_grupo = mysqli_fetch_array($resultado_grupo);
		
		//echo $sql_grupo."<br>";
?>
  <table class="cuej" align="center" width="100%">
    <thead>
      <tr>
        <th class="cuej" align="center" width="70%">Asignatura</th>
        <th class="cuej" align="center" width="10%">Grupo</th>
        <th class="cuej" align="center" width="10%">Semestre</th>
        <th class="cuej" align="center" width="10%">Calificaci&oacute;n</th>
      </tr>
    </thead>
    <tbody>
<?php		
		$sql_evaluacion = "SELECT calificacion, grupo, materia, clave_materia, materias.semestre FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' AND id_grupo = '".$fila_grupo["id_grupo"]."' ORDER BY clave_materia;";
		$resultado_evaluacion = mysqli_query($conexion,$sql_evaluacion);
		
		//echo $sql_evaluacion ."<br>";
		
		while($fila_evaluacion = mysqli_fetch_array($resultado_evaluacion))
			{
				$i++;
				if ($i%2 == 0) $fondo = "#EFF5FB";
				else $fondo = "#FFFFFF";
?>
    <tr bgcolor="<?php echo $fondo; ?>">
      <td class="cuej"><?php echo utf8_encode($fila_evaluacion["clave_materia"] ." - " . $fila_evaluacion["materia"]); ?></td>
      <td class="cuej" align="center"><?php echo $fila_evaluacion["grupo"]; ?></td>
      <td class="cuej" align="center"><?php echo $fila_evaluacion["semestre"]; ?></td>
      <td class="cuej" align="center"><?php echo $fila_evaluacion["calificacion"]; ?></td>
    </tr>
<?php
			}	//Termina while($fila_evaluacion = mysqli_fetch_array($resultado_evaluacion))
?>
    </tbody>
    <tfoot>
    <tr>
      <th class="cuej" colspan="4" align="center">&nbsp;</th>
    </tr> 	
    </tfoot>
  </table>
  
  <br />

  <div align="center"><input type="submit" class="button" name="Imprimir" value="Generar PDF" /></div>

</form>
<?php
	}
else
	{
?>
	<p align="center">No hay registros para el alumno</p>
<?php
	}

mysqli_close($conexion);
