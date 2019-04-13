<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Julio, 27 2016]	
	-- País: México
	-- Objetivo: Acta de Calificaciones Formato PDF
	-- Última Modificación: [Julio, 27 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");

$mpdf=new mPDF('c');

$sql_programa = "SELECT id_plan_estudio, plan_estudios, id_carrera, carrera, planes_estudio.duracion, carreras_tipo.duracion AS tipo_duracion FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) JOIN carreras_tipo USING(id_carrera_tipo) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = @mysqli_fetch_array($resultado_programa);

$sql_alumno = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN  alumnos_programas USING(id_alumno) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
$resultado_alumno = mysqli_query($conexion, $sql_alumno);
$fila_alumno = mysqli_fetch_array($resultado_alumno);

$sql_promedio = "SELECT AVG(calificacion) AS promedio FROM alumnos_historial WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND calificacion != '';";
$resultado_promedio = mysqli_query($conexion, $sql_promedio);
$fila_promedio = mysqli_fetch_array($resultado_promedio);


$html_generales = '
	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
				<h3>HISTORIAL ACAD&Eacute;MICO</h3>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table align="left" width="100%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="5">DATOS GENERALES DEL ALUMNO</th>
			  </tr>
		 </thead>
		 <tbody>
			 <tr>
				<td class="cuej">
					<label>Nombre <span id="lbl_Nombre"></span></label>                   
				</td>			
				<td class="cuej">
					<label>Apellido Paterno<span id="lbl_Apellido_Paterno"></span></label>                   
				</td>
				<td class="cuej">
					<label>Apellido Materno <span id="lbl_Apellido_Materno"></span></label>
				</td>
				<td class="cuej">
					<label>Cuenta <span id="lbl_Cuenta"></span></label>
				</td>
				<td class="cuej">
					<label>Promedio <span id="lbl_Promedio"></span></label>
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["nombre"]).'</span>
				</td>			
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["apellido_paterno"]).'</span>
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["apellido_materno"]).'</span>
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["cuenta"]).'</span>
				</td>
				<td class="cuej">
					<span class="dato">'.number_format($fila_promedio["promedio"],2).'</span>
				</td>
			 </tr>
		 </tbody>
		 <tfoot>
			<tr>
				<th class="cuej" colspan="5"></th>
			</tr>
		 </tfoot>
	</table>
	<p>&nbsp;</p>
	<table align="left" width="100%" class="cuej" style="font-size: 10px;">
	<thead>
     	<tr>
          	<th class="cuej" colspan="7">'.utf8_encode($fila_programa["carrera"]).' PLAN DE ESTUDIOS '.utf8_encode($fila_programa["plan_estudios"]).'</th>
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
	';
	
	for($semestre = 1; $semestre <= $fila_programa["duracion"]; $semestre++)
	{	
		$sql_historial = "SELECT * FROM alumnos_historial JOIN materias USING(id_materia) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND semestre = '".$semestre."' ORDER BY semestre, clave_materia;";
		$resultado_historial = mysqli_query($conexion, $sql_historial);
		
		$html_generales .= '
			<tr>
				<th class="cuej" colspan = "7">'.$fila_programa["tipo_duracion"].' '.$semestre.'</th>
			</tr>';
		
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
			
			$html_generales .= '
			<tr>
          	   <td class="cuej" align="center">
					'.$fila_historial["semestre"].'
			   </td>
               <td class="cuej" align="center">
					'.$fila_historial["clave_materia"].'
			   </td>
               <td class="cuej">
					'.utf8_encode($fila_historial["materia"]).'
			   </td>
               <td class="cuej" align="center">
					'.$fila_historial["calificacion"].'
			   </td>
               <td class="cuej" align="center">
					'.$tipo.'
			   </td>
               <td class="cuej" align="center">
					'.$fila_ciclo_escolar["ciclo_escolar"].'
			   </td>
               <td class="cuej" align="center">
					'.$equivalencia.'
			   </td>
           </tr>';			
		}			
	}
	
	$html_generales .= '
			<tr>
				<td class="cuej" colspan="8" align="center">&nbsp;
					
				</td>
		  </tr>
		</tbody>
		 <tfoot>
			<tr>
				<th class="cuej" colspan="7"></th>
			</tr>
		 </tfoot>
	</table>
	<p>&nbsp;</p>
	<table align="left" width="50%">
		<tr>
			<td align="left" width="50%">
				* Documento No Oficial
			</td>
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

?>
