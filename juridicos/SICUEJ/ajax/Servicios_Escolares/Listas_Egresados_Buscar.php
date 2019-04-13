<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor: Julio César Morales Crispín
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 19 2017]	
	-- País: México
	-- Objetivo: Busqueda de alumnos egresados por carrera y plan de estudios
	-- Última Modificación: [Octubre, 19 2017]
	-- Realizó:Julio César Morales Crispín
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
	
include ("../../php/Funciones.php");

$sql_alumnos = "SELECT id_alumno_programa, apellido_paterno, apellido_materno, nombre, cuenta, creditos FROM alumnos JOIN alumnos_programas USING (id_alumno) JOIN planes_estudio USING (id_plan_estudio) WHERE id_carrera = '".$_POST["id_Carrera"]."' AND id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' ORDER BY apellido_paterno, apellido_materno, nombre;";
$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);	
$registros_alumnos = @mysqli_num_rows($resultado_alumnos);

if($registros_alumnos > 0)
	{
?>
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
				
				if ($fila_alumnos["creditos"] == $fila_alumnos_historial["creditos"])
					{
?>
    <tr>
      <td class="cuej" align="center"><?php echo ++$i; ?></td>
      <td class="cuej" align="center"><?php echo $fila_alumnos["cuenta"]; ?></td>
      <td class="cuej"><?php echo utf8_encode($fila_alumnos["apellido_paterno"]." ".$fila_alumnos["apellido_materno"]." ".$fila_alumnos["nombre"]); ?></td>
      <td class="cuej" align="center"><?php echo $fila_alumnos_historial["creditos"] ." de ". $fila_alumnos["creditos"]; ?></td>
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
     
<p align="center">

<form name="Formulario" id="Formulario" action="../impresiones/Servicios_Escolares/Listas_Egresados_XLS.php" method="POST" target="_blank" >
  <input type="hidden" name="id_Carrera" id="id_Carrera" value="<?php echo $_POST["id_Carrera"]; ?>" />
  <input type="hidden" name="id_Plan_Estudio" id="id_Plan_Estudio" value="<?php echo $_POST["id_Plan_Estudio"]; ?>" />
  <center><input class="button" type="submit" value="Descargar XLS" /></center>
</form>
</p>
<?php
	}
else
	{
?>
<p align="center">No existen alumnos inscritos o activos para &eacute;sta materia</p>
<?php
	}
?>