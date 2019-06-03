<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral de la Centro Universitario de Estudios Jurídicos - Alumno
	-- Autor: Ing. Julio César Morales Crispín
	-- Responsable: Ing. Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 18 2017]
	-- País: México
	-- Objetivo: Evaluación de Profesores del Semestre en curso
	-- Última Modificación: [Octubre, 18 2017]
	-- Realizó: Ing. Julio César Morales Crispín
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

$pendientes = isset($_REQUEST["pendientes"])? $_REQUEST["pendientes"] : 0 ;

?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/Funciones_Jquery_Alumno.js"></script>
<script language="javascript">

function Contar_Texto(Campo, Contador, Limite_Maximo)
	{
		if (Campo.value.length > Limite_Maximo)
			Campo.value = Campo.value.substring(0, Limite_Maximo);
		else
			Contador.value = Limite_Maximo - Campo.value.length;
	}

function Validar_Guardar()
	{
		for (pregunta = 1; pregunta <= document.Formulario.Registros.value; pregunta++)
			{
				opciones = document.getElementsByName("Respuesta_"+pregunta);
				var seleccionado = false;

				for(var i=0; i<opciones.length; i++)
					{
					  if(opciones[i].checked)
						{
							seleccionado = true;
							break;
						}
					}

				if(!seleccionado) {
					alert ("Debes contestar la pregunta "+pregunta);
					if (pregunta%2 == 0)
						$('#Renglon_'+pregunta).removeClass('odd');

					$('#Renglon_'+pregunta).addClass('pregunta');
					return false;
				}else{
					$('#Renglon_'+pregunta).removeClass('pregunta');

					if (pregunta%2 == 0)
						$('#Renglon_'+pregunta).addClass('odd');
				}
			}

		Evaluacion_Profesor_Guardar();
	}

function Actualizar()
	{
		setTimeout("document.location.href='Evaluacion_Profesor.php';",100);
	}


$('Body').ready(function(){



	if ($('#hidPendientes').val() > 0 ){

		alert( '¡Para poder consultar tus calificaciones debes completar las ' +	$('#hidPendientes').val() + ' evaluaciones pendientes!');

	}

});

</script>

<?php include ("../php/Body.php"); ?>

<?php
$sql_alumnos = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN alumnos_programas USING (id_alumno) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."';";
$resultado_alumnos = mysqli_query($conexion,$sql_alumnos);
@$registros_alumnos = mysqli_num_rows($resultado_alumnos);

//echo $sql_alumnos."<br>";

if ($registros_alumnos > 0)
	{
		$fila_alumnos = mysqli_fetch_array($resultado_alumnos);

		$sql_grupo = "SELECT DISTINCT id_grupo FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' ORDER BY ciclo_escolar DESC;";
		$resultado_grupo = mysqli_query($conexion,$sql_grupo);

		$fila_grupo = mysqli_fetch_array($resultado_grupo);

		//echo $sql_grupo."<br>";
?>

<p>&nbsp;</p>

<form name="Formulario" id="Formulario">

<table class="cuej" align="center">
  <thead>
    <tr>
      <th class="cuej" align="center">Evaluaci&oacute;n de Profesores</th>
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

<div id="Evaluacion">
<table width="100%" class="cuej" align="center">
	<thead>
      <tr>
        <th class="cuej" align="center">Asignatura</th>
        <th class="cuej" align="center">Grupo</th>
        <th class="cuej" align="center">Semestre</th>
        <th class="cuej" align="center">Profesor</th>
        <th class="cuej" align="center">Evaluaci&oacute;n</th>
      </tr>
    </thead>
    <tbody>
<?php
		$sql_alumnos_evaluaciones = "SELECT id_materia, evaluacion_profesor, grupo, materia, clave_materia, materias.semestre FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_SESSION["id_Alumno_Programa"]."' AND id_grupo = '".$fila_grupo["id_grupo"]."' ORDER BY clave_materia;";
		$resultado_alumnos_evaluaciones = mysqli_query($conexion,$sql_alumnos_evaluaciones);

		//echo $sql_alumnos_evaluaciones."<br>";

		while($fila_alumnos_evaluaciones = mysqli_fetch_array($resultado_alumnos_evaluaciones))
			{
				$sql_profesor = "SELECT id_horario, id_profesor, apellido_paterno, apellido_materno, nombre, titulo FROM horarios JOIN profesores USING (id_profesor) WHERE id_grupo = '".$fila_grupo["id_grupo"]."' AND id_materia = '".$fila_alumnos_evaluaciones["id_materia"]."';";
				$resultado_profesor = mysqli_query($conexion,$sql_profesor);
				$fila_profesor = mysqli_fetch_array($resultado_profesor);

				//echo $sql_profesor."<br>";

				$i++;

				if ($i%2 == 0) $fondo = "#EFF5FB";
				else $fondo = "#FFFFFF";
?>
  <tr bgcolor="<?php echo $fondo; ?>">
    <td class="cuej"><?php echo utf8_encode($fila_alumnos_evaluaciones["clave_materia"] ." - " . $fila_alumnos_evaluaciones["materia"]); ?></td>
    <td class="cuej" align="center"><?php echo $fila_alumnos_evaluaciones["grupo"]; ?></td>
    <td class="cuej" align="center"><?php echo $fila_alumnos_evaluaciones["semestre"]; ?></td>
    <td class="cuej"><?php echo utf8_encode($fila_profesor["titulo"]." ".$fila_profesor["nombre"]." ".$fila_profesor["apellido_paterno"]." ".$fila_profesor["apellido_materno"]); ?></td>
    <td class="cuej" align="center">
<?php
				if ($fila_alumnos_evaluaciones["evaluacion_profesor"] == "0000-00-00")
					{
?>
    <a href="javascript:Evaluacion_Profesor_Buscar('<?php echo $fila_profesor["id_horario"]; ?>', '<?php echo $fila_grupo["id_grupo"]; ?>', '<?php echo $fila_alumnos_evaluaciones["id_materia"]; ?>');">NO</a>
<?php
					}
				else if ($fila_alumnos_evaluaciones["evaluacion_profesor"] != "0000-00-00")
					{
						echo "SI";
					}
?>
    </td>
  </tr>
<?php
			}
?>
	</tbody>
    <tfoot>
    	<th class="cuej" colspan="5"></th>
    </tfoot>
</table>
</div>
<br />
<input type="hidden" id="hidPendientes" value="<?php echo $pendientes; ?>" />
</form>
<?php
	}
?>

<?php include ("../php/Pie_Pagina.php"); ?>
