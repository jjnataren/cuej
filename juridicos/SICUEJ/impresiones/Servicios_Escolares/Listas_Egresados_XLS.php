<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor: Julio César Morales Crispín
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 19 2017]
	-- País: México
	-- Objetivo: Lista de alumnos egresados en formato XLS
	-- Última Modificación: [Octubre, 19 2017]
	-- Realizó:Julio César Morales Crispín
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: filename=\"Listas_Egresados.xls\";");

$sql_alumnos = "SELECT id_alumno_programa, apellido_paterno, apellido_materno, nombre, cuenta, creditos FROM alumnos JOIN alumnos_programas USING (id_alumno) JOIN planes_estudio USING (id_plan_estudio) WHERE id_carrera = '".$_POST["id_Carrera"]."' AND id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' ORDER BY apellido_paterno, apellido_materno, nombre;";
$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);

$sql_programa = "SELECT carrera, plan_estudios FROM carreras JOIN planes_estudio USING (id_carrera) WHERE id_carrera = '".$_POST["id_Carrera"]."' AND id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = @mysqli_fetch_array($resultado_programa);
?>
<table align="center" width="100%">
  <tr>
    <td colspan="4" align="center"><h3>LISTAS DE EGRESADOS</h3></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Programa Acad&eacute;mico: <?php echo htmlentities($fila_programa["carrera"]).' PLAN '.$fila_programa["plan_estudios"]; ?></td>
  </tr>
</table>

<br />

<table class="cuej" width="100%">
  <thead>
    <tr>
      <th class="cuej" width="25px">No.</th>
      <th class="cuej" width="80px">Cuenta</th>
      <th class="cuej" width="200px">Alumno</th>
      <th class="cuej" width="25px">Cr&eacute;ditos</th>
    </tr>
  </thead>
  <tbody>
<?php
		$i = 0;

		while($fila_alumnos = mysqli_fetch_array($resultado_alumnos))
			{
				$sql_alumnos_historial = "SELECT SUM(creditos) AS creditos FROM materias JOIN alumnos_historial USING (id_materia) WHERE id_alumno_programa = '".$fila_alumnos["id_alumno_programa"]."' AND (calificacion = 6 || calificacion = 7 || calificacion = 8 || calificacion = 9 || calificacion = 10);";
				$resultado_alumnos_historial = mysqli_query($conexion, $sql_alumnos_historial);
				$fila_alumnos_historial = mysqli_fetch_array($resultado_alumnos_historial);

				if ($fila_alumnos["creditos"] == round($fila_alumnos_historial["creditos"],2))
					{
?>
    <tr>
      <td class="cuej" align="center"><?php echo ++$i; ?></td>
      <td class="cuej" align="center"><?php echo $fila_alumnos["cuenta"]; ?></td>
      <td class="cuej"><?php echo ($fila_alumnos["apellido_paterno"]." ".$fila_alumnos["apellido_materno"]." ".$fila_alumnos["nombre"]); ?></td>
      <td class="cuej" align="center"><?php echo round($fila_alumnos_historial["creditos"],2) ." de ". $fila_alumnos["creditos"]; ?></td>
    </tr>
<?php
					}
		}
?>
  </tbody>
  <tfoot>
    <tr>
      <th class="cuej" colspan="4"></th>
    </tr>
  </tfoot>
</table>

<br />

<table width="100%">
  <tr>
    <td align="center" colspan="4"><h6>Centro Universitario de Estudios Jur&iacute;dicos</h6></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><h6>Municipio  Libre 103 Col. Portales. Benito Ju&aacute;rez. C.P. 03300 Ciudad de M&eacute;xico </h6></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><h6>Tel:55-75-98-40</h6></td>
  </tr>
</table>
