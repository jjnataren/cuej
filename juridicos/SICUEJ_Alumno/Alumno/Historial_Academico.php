<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral del Centro Universitario de Estudios Jurídicos - Alumno
	-- Autor: Julio César Morales Crispín
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 09 2017]
	-- País: México
	-- Objetivo: Consulta de Historial Académico del Alumno
	-- Última Modificación: [Octubre, 09 2017]
	-- Realizó: Julio César Morales Crispín
	-- Observaciones: Creación de archivo
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

if(!(isset($_SESSION["Autenticado"])))
{
	header("Location: ../index.php");
}

include ("../php/HTML.php");
?>
<script language="javascript" src="../js/Funciones_Jquery_Alumno.js"></script>
<script language="javascript">
</script>

<?php include ("../php/Body.php"); ?>

<?php
$sql_programa = "SELECT id_plan_estudio, plan_estudios, id_carrera, carrera, planes_estudio.duracion, carreras_tipo.duracion AS tipo_duracion FROM alumnos_programas JOIN planes_estudio USING (id_plan_estudio) JOIN carreras USING (id_carrera) JOIN carreras_tipo USING (id_carrera_tipo) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."';";
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = @mysqli_fetch_array($resultado_programa);

$sql_alumnos = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN alumnos_programas USING (id_alumno) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."';";
$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);
$fila_alumnos = @mysqli_fetch_array($resultado_alumnos);

$sql_promedio = "SELECT AVG(calificacion) AS promedio FROM alumnos_historial WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' AND calificacion != '';";
$resultado_promedio = mysqli_query($conexion, $sql_promedio);
$fila_promedio = @mysqli_fetch_array($resultado_promedio);
?>

<link type="text/css" href="../css/default.css" rel="stylesheet" >

<p>&nbsp;</p>

<form name="Formulario" method="post" action="../impresiones/Alumno/Historial_Academico_PDF.php" target="_blank">

<table align="center" class="cuej">
  <thead>
    <tr>
      <th class="cuej">HISTORIAL ACAD&Eacute;MICO</th>
    </tr>
  </thead>
</table>

<p>&nbsp;</p>

<table align="center" width="100%" class="cuej">
  <thead>
    <tr>
      <th class="cuej" colspan="5">DATOS GENERALES DEL ALUMNO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="cuej"><label>Nombre <span id="lbl_Nombre"></span></label></td>			
      <td class="cuej"><label>Apellido Paterno<span id="lbl_Apellido_Paterno"></span></label></td>
      <td class="cuej"><label>Apellido Materno <span id="lbl_Apellido_Materno"></span></label></td>
      <td class="cuej"><label>Cuenta <span id="lbl_Cuenta"></span></label></td>
      <td class="cuej"><label>Promedio <span id="lbl_Promedio"></span></label></td>
    </tr>
    <tr>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["nombre"]); ?></span></td>			
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["apellido_paterno"]); ?></span></td>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["apellido_materno"]); ?></span></td>
      <td class="cuej"><span class="dato"><?php echo utf8_encode($fila_alumnos["cuenta"]); ?></span></td>
      <td class="cuej"><span class="dato"><?php echo number_format($fila_promedio["promedio"],2); ?></span></td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th class="cuej" colspan="5"></th>
    </tr>
  </tfoot>
</table>

<p>&nbsp;</p>
	
<table align="center" width="100%" class="cuej">
  <thead>
    <tr>
      <th class="cuej" colspan="7"><?php echo utf8_encode($fila_programa["carrera"]) ?> PLAN DE ESTUDIOS <?php echo utf8_encode($fila_programa["plan_estudios"]); ?></th>
    </tr>
    <tr>
      <th class="cuej">Semestre</th>
      <th class="cuej">Clave</th>
      <th class="cuej">Materia</th>
      <th class="cuej">Calificacion</th>
      <th class="cuej">Paso en</th>
      <th class="cuej">Curso en</th>
      <th class="cuej">Equivalencia</th>
    </tr>
  </thead>
  <tbody>
<?php
	for($semestre = 1; $semestre <= $fila_programa["duracion"]; $semestre++)
	{	
		$sql_historial = "SELECT * FROM alumnos_historial JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' AND semestre = '".$semestre."' ORDER BY semestre, clave_materia;";
		$resultado_historial = mysqli_query($conexion, $sql_historial);
?>
    <tr>
        <th class="cuej" colspan = "7"><?php echo $fila_programa["tipo_duracion"].' '.$semestre; ?></th>
    </tr>
<?php
		while($fila_historial = mysqli_fetch_array($resultado_historial))
		{
			$sql_ciclo_escolar = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_historial["id_ciclo_escolar"]."';";
			$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
			$fila_ciclo_escolar = @mysqli_fetch_array($resultado_ciclo_escolar);
			
			if($fila_historial["tipo"] == 0)
				$tipo = ""; 
			else if($fila_historial["tipo"] == 1)
				$tipo = "ORD"; 
			else if($fila_historial["tipo"] == 2)
				$tipo = "EXT";
				
			if($fila_historial["equivalencia"] == 0) 
				$equivalencia = ""; 
			else if($fila_historial["equivalencia"] == 1)
				$equivalencia = "NO"; 
			else if($fila_historial["equivalencia"] == 2)
				$equivalencia = "NO";
				
			$i++;
			if ($i%2 == 0) $fondo = "#EFF5FB";
			else $fondo = "#FFFFFF";
?>
    <tr bgcolor="<?php echo $fondo; ?>">
      <td class="cuej" align="center"><?php echo $fila_historial["semestre"]; ?></td>
      <td class="cuej" align="center"><?php echo $fila_historial["clave_materia"]; ?></td>
      <td class="cuej" align="left"><?php echo utf8_encode($fila_historial["materia"]); ?></td>
      <td class="cuej" align="center"><?php echo $fila_historial["calificacion"]; ?></td>
      <td class="cuej" align="center"><?php echo $tipo; ?></td>
      <td class="cuej" align="center"><?php echo $fila_ciclo_escolar["ciclo_escolar"]; ?></td>
      <td class="cuej" align="center"><?php echo $equivalencia; ?></td>
    </tr>
<?php		
		}			
	}
?>
    <tr>
      <td class="cuej" colspan="7" align="center">&nbsp;</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th class="cuej" colspan="7"></th>
    </tr>
  </tfoot>
</table>

<input type="hidden" name="id_Alumno_Programa" id="id_Alumno_Programa" value="<?php echo $_SESSION["id_Alumno_Programa"]; ?>" />
<div align="center"><input class="button" type="submit" name="Imprimir" value="Generar PDF" /></div>
</form>

<br />

<?php include ("../php/Pie_Pagina.php"); ?>