<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 13 2016]	
	-- País: México
	-- Objetivo: Comprobante de Inscripción en Formato PDF
	-- Última Modificación: [Junio, 13 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");

$mpdf=new mPDF('c');


$sql_alumno = "SELECT * FROM alumnos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
$resultado_alumno = mysqli_query($conexion, $sql_alumno);
$fila_alumno = mysqli_fetch_array($resultado_alumno);

$sql_codigo_postal = "SELECT codigo_postal, colonia FROM codigos_postales WHERE id_codigo_postal = '".$fila_alumno["id_codigo_postal"]."';";
$resultado_codigo_postal = mysqli_query($conexion, $sql_codigo_postal);
$fila_codigo_postal = mysqli_fetch_array($resultado_codigo_postal);

$sql_estado = "SELECT estado, municipio FROM codigos_postales JOIN municipios USING(id_municipio) JOIN estados USING(id_estado) WHERE id_codigo_postal = '".$fila_alumno["id_codigo_postal"]."';";
$resultado_estado = mysqli_query($conexion, $sql_estado);
$fila_estado = mysqli_fetch_array($resultado_estado);
    
$sql_contactos = "SELECT * FROM alumnos_contactos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
$resultado_contactos = mysqli_query($conexion, $sql_contactos);

$telefono_casa = "";
$telefono_celular = "";
$correo_electronico = "";

$id_telefono_casa = 0;
$id_telefono_celular = 0;
$id_correo_electronico = 0;

while($fila_contactos = mysqli_fetch_array($resultado_contactos))
{
    if($fila_contactos["tipo_contacto"] == 1)
    {
	    $telefono_casa = $fila_contactos["contacto"];
	    $id_telefono_casa = $fila_contactos["id_alumno_contacto"];
    }
    if($fila_contactos["tipo_contacto"] == 2)
    {
	    $telefono_celular = $fila_contactos["contacto"];
	    $id_telefono_celular = $fila_contactos["id_alumno_contacto"];
    }
    if($fila_contactos["tipo_contacto"] == 3)
    {
	    $correo_electronico = $fila_contactos["contacto"];
	    $id_correo_electronico = $fila_contactos["id_alumno_contacto"];
    }
}

$sql_programa = " SELECT id_plan_estudio, plan_estudios, id_carrera, id_carrera_tipo, carrera, alumnos_programas.* FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = mysqli_fetch_array($resultado_programa);



$sql_documentacion = "SELECT * FROM alumnos_documentacion JOIN documentacion USING(id_documento) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);	


$sql_duracion = "SELECT duracion FROM carreras_tipo WHERE id_carrera_tipo='".$fila_programa["id_carrera_tipo"]."';";
$resultado_duracion = mysqli_query($conexion, $sql_duracion);
$fila_duracion = @mysqli_fetch_array($resultado_duracion);

$sql_semestre = "SELECT MAX(semestre) AS semestre, id_grupo FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) WHERE id_alumno_programa='".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."'";
$resultado_semestre = mysqli_query($conexion, $sql_semestre);
$fila_semestre = @mysqli_fetch_array($resultado_semestre);

$sql_grupo = "SELECT * FROM grupos WHERE id_grupo = '".$fila_semestre["id_grupo"]."';";
$resultado_grupo = mysqli_query($conexion, $sql_grupo);
$fila_grupo = mysqli_fetch_array($resultado_grupo);


$html_generales = '
	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
				<h3>COMPROBANTE DE INSCRIPCI&Oacute;N</h3>
			</td>
		</tr>
	</table>
	
	<table align="left" width="100%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="3">DATOS DEL ALUMNO</th>
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
					<span class="dato">'.utf8_encode($fila_alumno["nombre"]).'</span>	
				</td>			
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["apellido_paterno"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["apellido_materno"]).'</span>	
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
					
				</td>
			 </tr>           
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["curp"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["rfc"]).'</span>	
				</td>
				<td class="cuej">
					
				</td>
			 </tr>
			 <tr>
				<td colspan="3" class="cuej">&nbsp;</td>
			 </tr>
			 		 
			 <tr>
				<td class="cuej">
					<label>Codigo Postal <span id="lbl_Codigo_Postal"></span></label>                   
				</td>
				<td class="cuej">
					<label>Estado<span id="lbl_Estado"></span></label>                   
				</td>
				<td class="cuej">
					<label>Municipio<span id="lbl_Municipio"></span></label>
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_codigo_postal["codigo_postal"]).'</span>	
				</td>
				<td class="cuej">
	
					<span class="dato">'.utf8_encode($fila_estado["estado"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_estado["municipio"]).'</span>	
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<label>Colonia <span id="lbl_id_Codigo_Postal"></span></label>                   
				</td>
				<td class="cuej" colspan="2">
					<label>Calle<span id="lbl_Calle"></span></label>                   
				</td>			
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_codigo_postal["colonia"]).'</span>	
				</td>
				<td class="cuej" colspan="2">
					<span class="dato">'.utf8_encode($fila_alumno["calle"]).'</span>	
				</td>			
			 </tr>
			 <tr>
				<td colspan="3" class="cuej">&nbsp;</td>
			 </tr>
			 
			 <tr>
				<td class="cuej">
					<label>Tel&eacute;fono Casa <span id="lbl_Telefono_Casa"></span></label>                   
				</td>
				<td class="cuej">
					<label>Tel&eacute;fono Celular <span id="lbl_Telefono_Celular"></span></label>                   
				</td>
				<td class="cuej">
					<label>Correo Electr&oacute;nico <span id="lbl_Correo_Electronico"></span></label>
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($telefono_casa).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($telefono_celular).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($correo_electronico).'</span>	
				</td>
			 </tr>
			 <tr>
				<td colspan="3" class="cuej">&nbsp;</td>
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
					<span class="dato">'.utf8_encode($fila_alumno["usuario"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["password"]).'</span>	
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
				<th class="cuej" colspan="4">DATOS DEL PROGRAMA ACAD&Eacute;MICO</th>
			</tr>
		</thead>
		<tbody>
			 <tr>		 
				<td class="cuej">
					<label>Programa Acad&eacute;mico<span id="lbl_Programa_Academico"></span></label>
				</td>
			 </tr>
			 <tr>
				<td colspan="4" class="cuej">
					<span class="dato">'.utf8_encode($fila_programa["carrera"])." PLAN ".utf8_encode($fila_programa["plan_estudios"]).'</span>
				</td>
			 </tr>
			 <tr>
				<td class="cuej" >
					<label>Ciclo Escolar <span id="lbl_Ciclo_Escolar"></span></label>                   
				</td>
				<td class="cuej" >
					<label>'.$fila_duracion["duracion"].'<span id="lbl_'.$fila_duracion["duracion"].'"></span></label>                   
				</td>
				<td class="cuej" >
					<label>Grupo<span id="lbl_Grupo"></span></label>                   
				</td>
				<td class="cuej" >
					<label>Fecha Inicio <span id="lbl_Fecha_Inicio"></span></label>                   
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato" align="center">'.utf8_encode($_POST["Ciclo_Escolar"]).'</span>
				</td>
				<td class="cuej">
					<span class="dato" align="center">'.utf8_encode($fila_semestre["semestre"]).'</span>
				</td>
				<td class="cuej" >
					<span class="dato" align="center">'.utf8_encode($fila_grupo["grupo"]).'</span>
				</td>
				<td class="cuej" >
					<span class="dato" align="center">'.utf8_encode($fila_programa["fecha_inicio"]).'</span>
				</td>
			 </tr>
			 <tr>
				<td colspan="4" class="cuej">	
					<label>Observaciones<span id="lbl_Observaciones"></span></label>
				</td>
			 </tr>
			 <tr>
				<td colspan="4" class="cuej">
					<span class="dato">'.utf8_encode($fila_programa["observaciones"]).'</span>
				</td>
			 </tr>           		 
		 </tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="4"></th>
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

while($fila_documentacion = @mysqli_fetch_array($resultado_documentacion))
{
	if($fila_documentacion["fecha_entrega"] == '0000-00-00')
		$fecha_entrega = "Sin Entrega";
	else
		$fecha_entrega = $fila_documentacion["fecha_entrega"];

	
	$html_generales .= '
			<tr>
				<td class="cuej">'.utf8_encode($fila_documentacion["documento_largo"]).'</td>
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
	<p>&nbsp;</p>
	<p align="center"><h4>Me comprometo a entregar la documentaci&oacute;n completa en el tiempo establecido, en caso contrario mis estudios carecer&aacute;n de validez.</h4></p>
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
				<h3>NOMBRE Y FIRMA DEL ALUMNO</h3>
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
 
$mpdf->AddPage('P','','','','',15,15,10,15,18,12);
$mpdf->WriteHTML($html_generales);
$mpdf->Output();
exit;

?>
