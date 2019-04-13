<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 25 2016]	
	-- País: México
	-- Objetivo: Comprobante de Inscripción en Formato PDF
	-- Última Modificación: [Junio, 25 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");

$mpdf=new mPDF('c');


$sql_profesor = "SELECT * FROM profesores WHERE id_profesor = '".$_POST["id_Profesor"]."';";
$resultado_profesor = mysqli_query($conexion, $sql_profesor);
$fila_profesor = mysqli_fetch_array($resultado_profesor);

if($fila_profesor["nivel_estudios"] == 1)
	$nivel_estudios = "LICENCIATURA";
else if($fila_profesor["nivel_estudios"] == 2)
	$nivel_estudios = "ESPECIALIDAD";
else if($fila_profesor["nivel_estudios"] == 3)
	$nivel_estudios = "MAESTRÍA";
else if($fila_profesor["nivel_estudios"] == 4)
	$nivel_estudios = "DOCTORADO";
	


$html_generales = '
	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
				<h3>HOJA DE INFORMACI&Oacute;N DE PROFESOR</h3>
			</td>
		</tr>
	</table>
	
	<table align="left" width="100%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="3">DATOS GENERALES DEL PROFESOR</th>
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
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.$fila_profesor["nombre"].'</span>	
				</td>			
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["apellido_paterno"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["apellido_materno"]).'</span>	
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<label>CURP <span id="lbl_CURP"></span></label>                   
				</td>
				<td class="cuej">
					<label>RFC<span id="lbl_RFC"></span></label>                   
				</td>
				<td class="cuej">
					<label>C&eacute;dula Profesional<span id="lbl_RFC"></span></label>
				</td>
			 </tr>           
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["curp"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["rfc"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["cedula_profesional"]).'</span>
				</td>
			 </tr>
			 <tr>
				<td colspan="3" class="cuej">&nbsp;</td>
			 </tr>
			 		 
			 <tr>
				<td class="cuej">
					<label>Nivel de Estudios <span id="lbl_Nivel_Estudios"></span></label>                   
				</td>
				<td class="cuej">
					<label>Carrera<span id="lbl_Estudios"></span></label>                   
				</td>
				<td class="cuej">
					<label>T&iacute;tulo<span id="lbl_Titulo"></span></label>
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.$nivel_estudios.'</span>	
				</td>
				<td class="cuej">
	
					<span class="dato">'.utf8_encode($fila_profesor["estudios"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["titulo"]).'</span>	
				</td>
			 </tr>
			 	
			 <tr>
				<td class="cuej">
					<label>Usuario <span id="lbl_Usuario"></span></label>                   
				</td>
				<td class="cuej">
					<label>Contrase&ntilde;a<span id="lbl_Password"></span></label>                   
				</td>
				<td class="cuej">
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["usuario"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_profesor["password"]).'</span>	
				</td>
				<td class="cuej">
				</td>
			 </tr>
		 </tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="3"></th>
		   </tr>
		</tfoot>
	</table>
	<p>&nbsp;</p>
	<table align="center" width="100%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="2">DOCUMENTACI&Oacute;N</th>
			  </tr>
		 </thead>
		 <tbody>
';

$sql_documentacion = "SELECT descripcion, fecha_entrega FROM profesores_documentacion JOIN documentacion_profesores USING(id_documentacion_profesor) WHERE id_profesor = '".$_POST["id_Profesor"]."';";
$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);

while($fila_documentacion = @mysqli_fetch_array($resultado_documentacion))
{
	if($fila_documentacion["fecha_entrega"] == '0000-00-00')
		$fecha_entrega = "Sin Entrega";
	else
		$fecha_entrega = $fila_documentacion["fecha_entrega"];

	
	$html_generales .= '
			<tr>
				<td class="cuej">'.utf8_encode($fila_documentacion["descripcion"]).'</td>
				   <td class="cuej">
						<span class="dato">'.$fecha_entrega.'</span>
				</td>
			</tr>';
}

	$html_generales .= '
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="2"></th>
			</tr>
		</tfoot>
	</table>
	';
$sql_carreras = "SELECT * FROM carreras ORDER BY id_carrera_tipo, carrera;";
$resultado_carreras = mysqli_query($conexion, $sql_carreras);

	$html_generales .= '
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<table align="center" width="80%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="3">PROGRAMAS ACAD&Eacute;MICOS</th>
			</tr>
		</thead>
		<tbody>	
	';

while($fila_carreras = @mysqli_fetch_array($resultado_carreras))
{
	$sql_carrera = "SELECT COUNT(*) AS registro FROM profesores_carreras WHERE id_carrera='".$fila_carreras["id_carrera"]."' AND id_profesor = '".$_POST["id_Profesor"]."';";
		
	$resultado_carrera = mysqli_query($conexion, $sql_carrera);
	$fila_carrera = @mysqli_fetch_array($resultado_carrera);
	
	if($fila_carrera["registro"] > 0)
		$imagen = '<img src="../../imagenes/Ok.png" width="15px" />';
	else
		$imagen = '&nbsp;';
		
	$html_generales .= '
			<tr>
				<td class="cuej">'.utf8_encode($fila_carreras["carrera"]).'</td>
				<td class="cuej">'.$imagen.'</td>
				<td class="cuej"></td>
			</tr>
	';
}

	$html_generales .= '
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="3"></th>
			</tr>
		</tfoot>
	</table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<table width="60%" align="center" border="0">
		<tr>
			<td>
				<hr />
			</td>
		</tr>
		<tr>
			<td align="center">
				Acepto que todos los datos aqu&iacute; asentados son ver&iacute;dicos
			</td>
		</tr>
		<tr>
			<td align="center">
				<h3>NOMBRE Y FIRMA DEL profesor</h3>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
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
 
$mpdf->AddPage('P','','','','',15,15,10,15,18,12);
$mpdf->WriteHTML($html_generales);
$mpdf->Output();
exit;

?>