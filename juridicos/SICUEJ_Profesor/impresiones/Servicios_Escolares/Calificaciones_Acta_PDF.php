<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Acta de Calificaciones Formato PDF
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");

$mpdf=new mPDF('c');

$sql_programa = "SELECT carrera, plan_estudios, id_ciclo_escolar, semestre, grupo, tipo_grupo FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_grupo = '".$_POST["id_Grupo"]."';";
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = @mysqli_fetch_array($resultado_programa);

$sql_ciclo = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_programa["id_ciclo_escolar"]."';";
$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
$fila_ciclo = @mysqli_fetch_array($resultado_ciclo);

$sql_materia = "SELECT * FROM materias WHERE id_materia = '".$_POST["id_Materia"]."';";
$resultado_materia = mysqli_query($conexion, $sql_materia);
$fila_materia = mysqli_fetch_array($resultado_materia);

$sql_profesor = "SELECT * FROM profesores JOIN horarios USING(id_profesor) WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";
$resultado_profesor = mysqli_query($conexion, $sql_profesor);
$fila_profesor = mysqli_fetch_array($resultado_profesor);

$sql_administrativo = "SELECT * FROM administrativos WHERE id_administrativo = '1';";
$resultado_administrativo = mysqli_query($conexion, $sql_administrativo);
$fila_administrativo = mysqli_fetch_array($resultado_administrativo);


$sql = "SELECT alumnos_evaluaciones.* FROM alumnos_evaluaciones JOIN alumnos_programas USING(id_alumno_programa) JOIN alumnos USING(id_alumno) WHERE alumnos_evaluaciones.id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."' AND id_periodo = 3 AND estatus = 1 ORDER BY apellido_paterno, apellido_materno, nombre; ";	
$resultado = mysqli_query($conexion, $sql);	
$registros = @mysqli_num_rows($resultado);


if($fila_programa["tipo_grupo"] == "ORDINARIO")
{
	$titulo_acta = "ACTA DE CALIFICACIÓN FINAL";
}
else if($fila_programa["tipo_grupo"] == "EXTRAORDINARIO")
{
	$titulo_acta = "ACTA DE EXTRAORDINARIO";
}
	

$html_generales = '
	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
				<h3>'.$titulo_acta.'</h3>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table style="font-size: 11px;">
		<tr>
			<td>Programa Acad&eacute;mico: </td>
			<td>'.utf8_encode($fila_programa["carrera"]).' PLAN '.$fila_programa["plan_estudios"].'</td>
		</tr>
		<tr>
			<td>Ciclo Escolar: </td>
			<td>'.utf8_encode($fila_ciclo["ciclo_escolar"]).'</td>
		</tr>
		<tr>
			<td>Grupo: </td>
			<td>'.utf8_encode($fila_programa["grupo"]).'</td>
		</tr>
		<tr>
			<td>Semestre: </td>
			<td>'.utf8_encode($fila_programa["semestre"]).'</td>
		</tr>
		<tr>
			<td>Asignatura: </td>
			<td>'.utf8_encode($fila_materia["materia"]).'</td>
		</tr>
		<tr>
			<td>Clave de Asignatura: </td>
			<td>'.utf8_encode($fila_materia["clave_materia"]).'</td>
		</tr>
		<tr>
			<td>Profesor: </td>
			<td>'.utf8_encode($fila_profesor["titulo"]." ".$fila_profesor["nombre"]." ".$fila_profesor["apellido_paterno"]." ".$fila_profesor["apellido_materno"]).'</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table  width="100%" class="cuej">
     	<thead>
          	<tr>
               	<th class="cuej" width="25px" >No.</th>
                <th class="cuej" >Cuenta</th>
                <th class="cuej" width="250px" >Alumno</th>
                <th class="cuej" >Calificaci&oacute;n</th>
				<th class="cuej" >Calificaci&oacute;n Letra</th>
               </tr>              
          </thead>
          <tbody>
	';
	
	$i=0;
		
	while($fila = mysqli_fetch_array($resultado))
	{
		$i++;
			
		$sql_alumno = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN  alumnos_programas USING(id_alumno) WHERE id_alumno_programa = '".$fila["id_alumno_programa"]."';";
		$resultado_alumno = mysqli_query($conexion, $sql_alumno);
		$fila_alumno = mysqli_fetch_array($resultado_alumno);
		
		if($fila["calificacion"] == '10')
			$letra = "DIEZ";
		if($fila["calificacion"] == '9')
			$letra = "NUEVE";
		if($fila["calificacion"] == '8')
			$letra = "OCHO";
		if($fila["calificacion"] == '7')
			$letra = "SIETE";
		if($fila["calificacion"] == '6')
			$letra = "SEIS";
		if($fila["calificacion"] == '5')
			$letra = "CINCO";
		if($fila["calificacion"] == '4')
			$letra = "CUATRO";
		if($fila["calificacion"] == '3')
			$letra = "TRES";
		if($fila["calificacion"] == '2')
			$letra = "DOS";
		if($fila["calificacion"] == '1')
			$letra = "UNO";
		if($fila["calificacion"] == '0')
			$letra = "CERO";
		if($fila["calificacion"] == 'NP')
			$letra = "NO PRESENTÓ";
		if($fila["calificacion"] == 'NA')
			$letra = "NO ACREDITÓ";
		if($fila["calificacion"] == 'EX')
			$letra = "EX";
		if($fila["calificacion"] == 'SE')
			$letra = "SE";		
		
		
		$html_generales .= '
			<tr>
				<td class="cuej cuej_actas" >'.$i.'</td>                    
				<td class="cuej cuej_actas" align="center" >'.$fila_alumno["cuenta"].'</td>
				<td class="cuej cuej_actas" width="250px">'.utf8_encode($fila_alumno["apellido_paterno"]." ".$fila_alumno["apellido_materno"]." ".$fila_alumno["nombre"]).'</td>
				<td class="cuej cuej_actas" align="center">'.$fila["calificacion"].'</td>
				<td class="cuej cuej_actas" align="center">'.$letra.'</td>
			</tr>';		
	}
	
	$html_generales .= '
		</tbody>
          <tfoot>
          	<tr>
               	<th class="cuej" colspan="5"></th>
               </tr>
          </tfoot>
     </table>
	<p>&nbsp;</p>
	<table align="center" style="font-size:11px">
		<tr>
			<td align="center" width="50%">
				<hr />
			</td>
			<td align="center" width="50%">
				<hr />
			</td>
		</tr>
		<tr>
			<td align="center" width="50%">
				'.utf8_encode($fila_profesor["titulo"]." ".$fila_profesor["nombre"]." ".$fila_profesor["apellido_paterno"]." ".$fila_profesor["apellido_materno"]).'
			</td>
			<td align="center" width="50%">
				'.utf8_encode($fila_administrativo["titulo"]." ".$fila_administrativo["nombre"]." ".$fila_administrativo["apellido_paterno"]." ".$fila_administrativo["apellido_materno"]).'
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
 
$mpdf->AddPage('P','','','','',15,15,10,50,18,20);
$mpdf->WriteHTML($html_generales);
$mpdf->Output();
exit;

?>
