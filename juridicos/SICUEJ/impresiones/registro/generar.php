<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Abril, 2019]
	-- País: México
	-- Objetivo: Formato de Beca con Fechas Límite Pago
	-- Última Modificación: [Abril, 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");
session_start();

$id_usuario =  $_SESSION["id_Usuario"];

$trabajador = $_REQUEST["trabajador"];

$inicio = date_create_from_format('d/m/Y', isset ($_REQUEST["inicio"])?$_REQUEST["inicio"]:null);

$fin = date_create_from_format('d/m/Y',  isset($_REQUEST["fin"])?$_REQUEST["fin"]:null);

$jefe = $_REQUEST["jefe"];


$inicio = $inicio->format('Y-m-d');

$sqlUsuario = "SELECT * FROM usuarios WHERE id_usuario = $trabajador;";

mysqli_query($conexion, "SET NAMES 'utf8'");

$resultsUsuario = mysqli_query($conexion,$sqlUsuario);

$rowUsuario = @mysqli_fetch_assoc($resultsUsuario);

$nombreUsuario = $rowUsuario["nombre"]  . " " . $rowUsuario["apellido_paterno"] . " " . $rowUsuario["apellido_materno"];


$fin = $fin->format('Y-m-d');

$sql = "SELECT ra.* , (SELECT concat(nombre, ' ' , apellido_paterno,' ' ,apellido_materno) FROM usuarios where id_usuario = ra.id_usuario) AS nombre_usuario from  registro_actividad ra  where  id_usuario = $trabajador AND CAST(fecha_captura AS DATE) between CAST( '$inicio' AS DATE) AND CAST( '$fin' AS DATE) order by fecha_captura desc";

mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);

$fechaHoy = date('Y-m-d H:i');

$sql = "INSERT INTO reporte (usuario, tipo, fecha, estatus) VALUES ($id_usuario,1,'$fechaHoy',1);";

if ($conexion->query($sql) === TRUE) {
    $last_id = $conexion->insert_id;
    $message =  "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    $message =   "Error: " . $sql . "<br>" . $conexion->error;
}

$folio = substr('000' . $last_id ,-3);

$mpdf=new mPDF('c');

$html_generales = '



	<table align="center" width="100%">
		<tr>
			<td rowspan="2" align="left"   ><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center" valign="bottom">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>

			</td>
            <td align="center"  valign="middle"  style="border: solid 1px #909798; " width="15%">
				<label>FOLIO</label>
                <br />
				<label>No. '.$folio.'</label>
			</td>
		</tr>

          <tr>
            <td colspan="2" align="left">&nbsp;</td>
        </tr>


         <tr>
            <td colspan="3" align="center"><h2>REPORTE SEMANAL DE PRODUCTIVIDAD</h2></td>
        </tr>



	</table> <br />';



$html_generales .= '
<table align="center"  width="100%" style="border-collapse: collapse;">
		<tr>
			<td width="20%" style="border-left: thin; border-left-style: solid; border-left-color: #969ca1; border-top: thin; border-top-style: solid; border-top-color: #969ca1;">NOMBRE</td>
			<td colspan="3" style="border-right: thin; border-right-style: solid; border-right-color: #969ca1; border-top: thin; border-top-style: solid; border-top-color: #969ca1;">'.$nombreUsuario.'</td>
		</tr>

        <tr>
            <td style="border-left: thin; border-left-style: solid; border-left-color: #969ca1;" >AREA</td>
            <td style="border-right: thin; border-right-style: solid; border-right-color: #969ca1;" colspan="3">'.$rowUsuario["area"].'</td>
        </tr>


         <tr>
            <td style="border-left: thin; border-left-style: solid; border-left-color: #969ca1;" >JEFE INMEDIATO</td>
            <td style="border-right: thin; border-right-style: solid; border-right-color: #969ca1;" colspan="3">'.$jefe.'</td>
        </tr>

  		<tr>
            <td style="border-left: thin; border-left-style: solid; border-left-color: #969ca1; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #969ca1;">REPORTE DEL:</td>
            <td style="border-bottom: thin; border-bottom-style: solid; border-bottom-color: #969ca1;">'.$_REQUEST["inicio"].'</td>
            <td style="border-bottom: thin; border-bottom-style: solid; border-bottom-color: #969ca1;">AL:</td>
            <td style="border-right: thin; border-right-style: solid; border-right-color: #969ca1; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #969ca1;">'.$_REQUEST["fin"].'</td>
        </tr>


	</table>

';


$html_generales .= '
<br />
<table align="center"  width="100%" style="border-collapse: collapse;">

		<thead>

			<tr>
				<th style="color:#FFFFFF; background-color:#464e9c;" width="43%" >NOMBRE DE LA</th>
				<th style="color:#FFFFFF; background-color:#464e9c;" width="20%" >PERSONA QUE</th>
				<th style="color:#FFFFFF; background-color:#464e9c;" width="22%" colspan="2">FECHA DE TERMINO</th>
				<th style="color:#FFFFFF;background-color:#464e9c;" width="15%">  ESTATUS DE</th>
			</tr>
			<tr>
				<th style="color:#FFFFFF;background-color:#464e9c;" >ACTIVIDAD</th>
				<th style="color:#FFFFFF;background-color:#464e9c;">SOLICITA</th>
				<th style="color:#FFFFFF;background-color:#464e9c;">AVANCE  -</th>
				<th style="color:#FFFFFF;background-color:#464e9c;">FINAL</th>
				<th style="color:#FFFFFF;background-color:#464e9c;">LA ENTREGA</th>
			</tr>
		</thead>
		<tbody> ';


$maxRows = 0;
while ($row = @mysqli_fetch_assoc($results)){


    $estatus = '';
    $maxRows++;

    switch ($row["estatus"]){

        case 1:
            $estatus = 'Iniciada';

            break;
        case 2:
            $estatus = 'Finalizada';
            break;
        default:
            $estatus = 'Desconocido';

    }


	$html_generales.='<tr>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;"><small> '.$row["nombre"].'</small></td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;"><small>'.$row["persona"].'</small></td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;"><small>'.date ('d/m/Y',strtotime($row['avance']) ) .'</small></td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;"><small>'.date ('d/m/Y',strtotime($row['final']) ).'</small></td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-right: thin; border-right-style: solid; border-right-color: #464e9c;" ><small>'.$estatus.'</small></td>

		</tr> ';

}

for ($i=$maxRows; $i<27; $i++){


$html_generales .= '<tr>
    	<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-right: thin; border-right-style: solid; border-right-color: #464e9c;" >&nbsp;</td>
           </tr>';

}


        $html_generales .= '

            <tr>
    	    <td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-right: thin; border-right-style: solid; border-right-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;" >&nbsp;</td>
           </tr>

            <tr>
    	    <td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; ">&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; ">&nbsp;</td>
			<td >&nbsp;</td>
			<td style="border-left: thin; border-left-style: solid; border-left-color: #464e9c; ">&nbsp;</td>
			<td style="border-right: thin; border-right-style: solid; border-right-color: #464e9c;" >&nbsp;</td>
           </tr>

            <tr>
    	    <td align="center" style="vertical-align:bottom;  border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;">COORDINADOR DE AREA</td>
			<td align="center" colspan="2" style="vertical-align:bottom;  border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;">EMPLEADO</td>
			<td align="center" colspan="2" style="vertical-align:bottom;  border-left: thin; border-left-style: solid; border-left-color: #464e9c; border-right: thin; border-right-style: solid; border-right-color: #464e9c; border-bottom: thin; border-bottom-style: solid; border-bottom-color: #464e9c;" >V.o. B.o. ADMINISTRACION</td>
           </tr>


            ';




$html_generales.='</tbody>
	</table>
';




$header = '<table width="100%">
	<tr>
		<td align="center"><h6>Centro Universitario de Estudios Jurídicos</h6></td>
        <td align="center"><h6>Centro Universitario de Estudios Jurídicos</h6></td>
        <td align="center"><h6>Centro Universitario de Estudios Jurídicos</h6></td>

	</tr>
	<tr>
		<td align="center"><h6>Municipio  Libre 103 Col. Portales. Benito Juárez. C.P. 03300 México D.F.</h6></td>
	</tr>
	<tr>
		<td align="center"><h6>Tel:55-75-98-40</h6></td>
	</tr>
</table>
';



$footer = '
<table width="100%">
	<tr>
		<td align="center"><h6>Centro Universitario de Estudios Jurídicos</h6></td>
	</tr>
	<tr>
		<td align="center"><h6>Municipio  Libre 103 Col. Portales. Benito Juárez. C.P. 03300 México D.F.</h6></td>
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

//$pdffilecontent = $mpdf->Output('', 'S');


exit;



?>





