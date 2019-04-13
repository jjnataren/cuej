<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral del Centro Universitario de Estudios Jurídicos - Alumno
	-- Autor: Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 16 2017]
	-- País: México
	-- Objetivo: Historial Académico del Alumno Formato PDF
	-- Última Modificación: [Octubre, 16 2017]
	-- Realizó: Julio César Morales Crispín
	-- Observaciones: Creación de archivo
	-- ===============================================================================
*/
include ("../../php/Funciones.php");
include("../../impresiones/mpdf/mpdf.php");

$mpdf=new mPDF('c');

$sql_alumnos = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN alumnos_programas USING (id_alumno) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);
$registros_alumnos = mysqli_num_rows($resultado_alumnos);

if ($registros_alumnos > 0)
	{
		$fila_alumnos = mysqli_fetch_array($resultado_alumnos);
		
		$sql_programa = "SELECT plan_estudios, carrera FROM alumnos_programas JOIN planes_estudio USING (id_plan_estudio) JOIN carreras USING (id_carrera) JOIN carreras_tipo USING (id_carrera_tipo) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
		$resultado_programa = mysqli_query($conexion, $sql_programa);
		$fila_programa = @mysqli_fetch_array($resultado_programa);
		
		$sql_ciclo_escolar = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	    $resultado_ciclo_escolar = mysqli_query($conexion,$sql_ciclo_escolar);
	    $fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);
		
		//$sql_grupo = "SELECT DISTINCT id_grupo FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' ORDER BY ciclo_escolar DESC;";
		$sql_grupo = "SELECT DISTINCT id_grupo FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN ciclos_escolares USING (id_ciclo_escolar) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."' ORDER BY ciclo_escolar DESC;";
		$resultado_grupo = mysqli_query($conexion,$sql_grupo);
		
		$fila_grupo = mysqli_fetch_array($resultado_grupo);

$html_generales = '
	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
	  <tr>
		<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
		<td align="center">
		  <h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
		  <h3>BOLETA DE CALIFICACIONES</h3>
		</td>
	  </tr>
	</table>
	
	<p>&nbsp;</p>
	
	<table align="left" width="100%" class="cuej">
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
		   <td class="cuej"><span class="dato">'.utf8_encode($fila_alumnos["nombre"]).'</span></td>			
		   <td class="cuej"><span class="dato">'.utf8_encode($fila_alumnos["apellido_paterno"]).'</span></td>
		   <td class="cuej"><span class="dato">'.utf8_encode($fila_alumnos["apellido_materno"]).'</span></td>
		   <td class="cuej"><span class="dato">'.utf8_encode($fila_alumnos["cuenta"]).'</span></td>
		 </tr>
	   </tbody>
	   <tfoot>
	     <tr>
		   <th class="cuej" colspan="4"></th>
		 </tr>
	  </tfoot>
	</table>
	
	<p>&nbsp;</p>
	
	<table align="left" width="100%" class="cuej">
	  <thead>
     	<tr>
		  <th class="cuej" colspan="4">'.utf8_encode($fila_programa["carrera"]).' PLAN DE ESTUDIOS '.utf8_encode($fila_programa["plan_estudios"]).'</th>
        </tr>
		<tr>
		  <th class="cuej" colspan="4">CICLO ESCOLAR '.$fila_ciclo_escolar["ciclo_escolar"].'</th>
        </tr>
		<tr>
		  <th class="cuej" align="center" width="50%">Asignatura</th>
		  <th class="cuej" align="center" width="15%">Grupo</th>
		  <th class="cuej" align="center" width="15%">Semestre</th>
		  <th class="cuej" align="center" width="20%">Calificaci&oacute;n</th>
		</tr>
	  </thead>
    <tbody>
	';
		$sql_evaluacion = "SELECT calificacion, grupo, materia, clave_materia, materias.semestre FROM alumnos_evaluaciones JOIN grupos USING (id_grupo) JOIN materias USING (id_materia) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_grupo = '".$fila_grupo["id_grupo"]."' ORDER BY clave_materia;";
		$resultado_evaluacion = mysqli_query($conexion,$sql_evaluacion);
		
		echo $sql_evaluacion ."<br>";
		
		while($fila_evaluacion = mysqli_fetch_array($resultado_evaluacion))
			{
				$i++;
				
				if($i%2 == 0) $fondo = "#ccc";
				else $fondo = "#fff";
			
$html_generales .= '
    <tr bgcolor="'.$fondo.'">
      <td class="cuej">'.htmlentities($fila_evaluacion["clave_materia"] ." - " . $fila_evaluacion["materia"]).'</td>
      <td class="cuej" align="center">'.$fila_evaluacion["grupo"].'</td>
      <td class="cuej" align="center">'.$fila_evaluacion["semestre"].'</td>
      <td class="cuej" align="center">'.$fila_evaluacion["calificacion"].'</td>
    </tr>
	';
				
			}	//Termina while($fila_evaluacion = mysqli_fetch_array($resultado_evaluacion))
			
$html_generales .= '
    </tbody>
    <tfoot>
    <tr>
      <th class="cuej" colspan="4" align="center"></th>
    </tr> 	
    </tfoot>
  </table>
	';







	
	
$html_generales .= '
	<p>&nbsp;</p>
	
	<table align="left" width="50%">
	  <tr>
	    <td align="left" width="50%">* Documento No Oficial</td>
	  </tr>
	</table>
	';

$footer = '
	<table width="100%">
	  <tr>
		<td align="center"><h6>Centro Universitario de Estudios Jurídicos</h6></td>
	  </tr>
	  <tr>
		<td align="center"><h6>Municipio  Libre 103 Col. Portales. Benito Juárez. C.P. 03300 Ciudad de México</h6></td>
	  </tr>
	  <tr>
		<td align="center"><h6>Tel:55-75-98-40</h6></td>
	  </tr>
	</table>
';

		$mpdf->setHTMLFooter($footer);
		 
		$mpdf->AddPage('P','','','','',15,15,10,30,18,12);
		$mpdf->WriteHTML($html_generales);
		$mpdf->Output();
		exit;
	}
else
	{
?>
	<p align="center">No hay registros para el alumno</p>
<?php
		echo $sql_alumnos;
	}

mysqli_close($conexion);
?>

