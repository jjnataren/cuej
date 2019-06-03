<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral de la Centro Universitario de Estudios Jurídicos - Alumno
	-- Autor: Ing. Julio César Morales Crispín
	-- Responsable: Ing. Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 09 2017]
	-- País: México
	-- Objetivo: Muestra la boleta de calificaciones
	-- Última Modificación: [Octubre, 17 2017]
	-- Realizó: Ing. Julio César Morales Crispín
	-- Observaciones: Se agregan ciclos escolares para consulta dinámica de la Boleta
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

if(!(isset($_SESSION["Autenticado"])))
{
	header("Location: ../index.php");
}

include ("../php/HTML.php");

$idAlumno = $_SESSION["id_Alumno_Programa"];

$sql = "SELECT DISTINCT id_grupo FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '$idAlumno' ORDER BY ciclo_escolar DESC;";
$result = mysqli_query($conexion,$sql);
$row = mysqli_fetch_array($result);

$grupo = $row["id_grupo"];

$sql = "SELECT  COUNT(evaluacion_profesor) as evaluacion FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '$idAlumno' AND id_grupo = '$grupo' and evaluacion_profesor = '0000-00-00'  ORDER BY clave_materia;";
$result = mysqli_query($conexion,$sql);
$row = mysqli_fetch_array($result);

$pendientes = $row["evaluacion"];

if ($pendientes > 0){

    header("Location: /SICUEJ_Alumno/Alumno/Evaluacion_Profesor.php?pendientes=$pendientes");
}

?>
<script language="javascript" src="../js/Funciones_Jquery_Alumno.js"></script>
<script language="javascript">
</script>

<?php include ("../php/Body.php"); ?>

<?php
$sql_alumnos = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN alumnos_programas USING (id_alumno) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."';";
$resultado_alumnos = mysqli_query($conexion,$sql_alumnos);
$registros_alumnos = @mysqli_num_rows($resultado_alumnos);

if ($registros_alumnos > 0)
	{
		$fila_alumnos = @mysqli_fetch_array($resultado_alumnos);

		$sql_programa = "SELECT plan_estudios, carrera FROM alumnos_programas JOIN planes_estudio USING (id_plan_estudio) JOIN carreras USING (id_carrera) JOIN carreras_tipo USING (id_carrera_tipo) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."';";
		$resultado_programa = mysqli_query($conexion, $sql_programa);
		$fila_programa = @mysqli_fetch_array($resultado_programa);

		$sql_grupo = "SELECT DISTINCT id_grupo FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' ORDER BY ciclo_escolar DESC;";
		$resultado_grupo = mysqli_query($conexion,$sql_grupo);

		$fila_grupo = @mysqli_fetch_array($resultado_grupo);
?>

<p>&nbsp;</p>

<form name="Formulario" method="post" action="../impresiones/Alumno/Boleta_PDF.php" target="_blank">

<table align="center" class="cuej">
  <thead>
    <tr>
      <th class="cuej">BOLETA DE CALIFICACIONES</th>
    </tr>
  </thead>
</table>

<p>&nbsp;</p>

<table align="center" width="100%" class="cuej">
  <thead>
    <tr>
      <th class="cuej" colspan="4">DATOS GENERALES DEL ALUMNO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="cuej"><label>Nombre <span id="lbl_Nombre"></span></label></td>
      <td class="cuej"><label>Apellido Paterno<span id="lbl_Apellido_Paterno"></span></label></td>
      <td class="cuej"><label>Apellido Materno <span id="lbl_Apellido_Materno"></span></label></td>
      <td class="cuej"><label>Cuenta <span id="lbl_Cuenta"></span></label></td>
    </tr>
    <tr>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["nombre"]); ?></span></td>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["apellido_paterno"]); ?></span></td>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["apellido_materno"]); ?></span></td>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["cuenta"]); ?></span></td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th class="cuej" colspan="4"></th>
    </tr>
  </tfoot>
</table>

<p>&nbsp;</p>

<table class="cuej" align="center">
  <thead>
    <tr>
      <th class="cuej"><?php echo utf8_encode($fila_programa["carrera"]); ?> PLAN DE ESTUDIOS <?php echo utf8_encode($fila_programa["plan_estudios"]); ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="cuej">&nbsp;</td>
    </tr>
    <tr>
      <td class="cuej" align="center">CICLO ESCOLAR:
        <select name="id_Ciclo_Escolar" id="id_Ciclo_Escolar" onChange="Boleta_Buscar();">
  <?php
        $sql_ciclo_escolar = "SELECT DISTINCT id_ciclo_escolar, ciclo_escolar FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' ORDER BY ciclo_escolar DESC;";
        $resultado_ciclo_escolar = mysqli_query($conexion,$sql_ciclo_escolar);

        while($fila_ciclo_escolar = @mysqli_fetch_array($resultado_ciclo_escolar))
            {
  ?>
            <option value="<?php echo $fila_ciclo_escolar["id_ciclo_escolar"]; ?>" <?php if ($fila_ciclo_escolar["id_ciclo_escolar"] == $fila_grupo["id_ciclo_escolar"]) echo "selected"; ?>><?php echo $fila_ciclo_escolar["ciclo_escolar"]; ?></option>
  <?php
            }
  ?>
        </select>
      </td>
    </tr>
  </tbody>
  <tfoot>
  <tr>
    <th class="cuej" align="center">&nbsp;</th>
  </tr>
  </tfoot>
</table>

<br />

<div id="Boleta">	<!-- Inicio div Boleta -->
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

		while($fila_evaluacion = @mysqli_fetch_array($resultado_evaluacion))
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

  <div align="center"><input class="button" type="submit" name="Imprimir" value="Generar PDF" /></div>
</div>	<!-- Fin div Boleta -->

<input type="hidden" name="id_Alumno_Programa" id="id_Alumno_Programa" value="<?php echo $_SESSION["id_Alumno_Programa"]; ?>" />
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
?>

<?php include ("../php/Pie_Pagina.php"); ?>
