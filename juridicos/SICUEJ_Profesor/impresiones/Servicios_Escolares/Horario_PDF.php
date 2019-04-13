<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Agosto, 02 2016]	
	-- País: México
	-- Objetivo: Horario en Formato PDF
	-- Última Modificación: [Agosto, 02 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");

$mpdf=new mPDF('c');

$sql_programa = "SELECT id_carrera_tipo, carrera, plan_estudios, id_ciclo_escolar, semestre, grupo FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_grupo = '".$_POST["id_Grupo"]."';";
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = @mysqli_fetch_array($resultado_programa);

$sql_ciclo = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_programa["id_ciclo_escolar"]."';";
$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
$fila_ciclo = @mysqli_fetch_array($resultado_ciclo);

$sql_materia = "SELECT * FROM materias WHERE id_materia = '".$_POST["id_Materia"]."';";
$resultado_materia = mysqli_query($conexion, $sql_materia);
$fila_materia = mysqli_fetch_array($resultado_materia);

$html_generales = '
	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
				<h3>HORARIO DE ASIGNATURAS</h3>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table>
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
	</table>
	<p>&nbsp;</p>
	';

$sql = "SELECT * FROM horarios JOIN profesores USING(id_profesor) WHERE id_grupo = '".$_POST["id_Grupo"]."'; ";	
$resultado = mysqli_query($conexion, $sql);	
$registros = @mysqli_num_rows($resultado);

$html_generales .= '
	<table class="cuej" width="100%">
     	<thead>
          	<tr>
               	<th class="cuej">Materia</th>
                    <th class="cuej">Profesor</th>
                    <th class="cuej">Lun</th>
                    <th class="cuej">Mar</th>
                    <th class="cuej">Mi&eacute;r</th>
                    <th class="cuej">Jue</th>
                    <th class="cuej">Vie</th>
                    <th class="cuej">S&aacute;b</th>
               </tr>
          </thead>
          <tbody>	
';

$i=0;

while($fila = mysqli_fetch_array($resultado))
{
	$i++;
	
	if($i%2 == 0)
		$fondo = "#ccc";
	else
		$fondo = "#fff";
	
	$sql_materia = "SELECT materia FROM materias WHERE id_materia = '".$fila["id_materia"]."';";
	$resultado_materia = mysqli_query($conexion, $sql_materia);
	$fila_materia = @mysqli_fetch_array($resultado_materia);
	
	if($fila["hora_inicio_1"] != "00:00:00")
		$horario_1 = utf8_encode(substr($fila["hora_inicio_1"],0,5)." <br />a<br /> ".substr($fila["hora_fin_1"],0,5)); 
	else 
		$horario_1 = "-";
		
	if($fila["hora_inicio_2"] != "00:00:00")
		$horario_2 = utf8_encode(substr($fila["hora_inicio_2"],0,5)." <br />a<br /> ".substr($fila["hora_fin_2"],0,5)); 
	else 
		$horario_2 = "-";
		
	if($fila["hora_inicio_3"] != "00:00:00")
		$horario_3 = utf8_encode(substr($fila["hora_inicio_3"],0,5)." <br />a<br /> ".substr($fila["hora_fin_3"],0,5)); 
	else 
		$horario_3 = "-";
		
	if($fila["hora_inicio_4"] != "00:00:00")
		$horario_4 = utf8_encode(substr($fila["hora_inicio_4"],0,5)." <br />a<br /> ".substr($fila["hora_fin_4"],0,5)); 
	else 
		$horario_4 = "-";
		
	if($fila["hora_inicio_5"] != "00:00:00")
		$horario_5 = utf8_encode(substr($fila["hora_inicio_5"],0,5)." <br />a<br /> ".substr($fila["hora_fin_5"],0,5)); 
	else 
		$horario_5 = "-";
		
	if($fila["hora_inicio_6"] != "00:00:00")
		$horario_6 = utf8_encode(substr($fila["hora_inicio_6"],0,5)." <br />a<br /> ".substr($fila["hora_fin_6"],0,5)); 
	else 
		$horario_6 = "-";
	
	$html_generales .= '
		<tr>
          	<td class="cuej" style="background-color: '.$fondo.'; color: #000;">'.utf8_encode($fila_materia["materia"]).'</td>
               <td class="cuej" style="background-color: '.$fondo.'; color: #000;">'.utf8_encode($fila["titulo"]." ".$fila["nombre"]." ".$fila["apellido_paterno"]." ".$fila["apellido_materno"]).'</td>
               <td class="cuej" align="center" style="background-color: '.$fondo.'; color: #000;">'.$horario_1.'</td>
			<td class="cuej" align="center" style="background-color: '.$fondo.'; color: #000;">'.$horario_2.'</td>
			<td class="cuej" align="center" style="background-color: '.$fondo.'; color: #000;">'.$horario_3.'</td>
			<td class="cuej" align="center" style="background-color: '.$fondo.'; color: #000;">'.$horario_4.'</td>
			<td class="cuej" align="center" style="background-color: '.$fondo.'; color: #000;">'.$horario_5.'</td>
			<td class="cuej" align="center" style="background-color: '.$fondo.'; color: #000;">'.$horario_6.'</td>
		</tr>
	';	
}

$html_generales .= '
	 </tbody>
          <tfoot>
          	<tr>
               	<th class="cuej" colspan="8"></th>
               </tr>
          </tfoot>
     </table>
     <br />
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
 
$mpdf->AddPage('L','','','','',15,15,10,15,18,12);
$mpdf->WriteHTML($html_generales);
$mpdf->Output();
exit;

?>
