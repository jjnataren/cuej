<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Julio, 01 2016]	
	-- País: México
	-- Objetivo: Formato de Beca con Fechas Límite Pago
	-- Última Modificación: [Julio, 01 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
include("../mpdf/mpdf.php");

$mpdf=new mPDF('c');


$sql_alumno = "SELECT apellido_paterno, apellido_materno, nombre FROM alumnos JOIN alumnos_programas USING(id_alumno) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
$resultado_alumno = mysqli_query($conexion, $sql_alumno);
$fila_alumno = mysqli_fetch_array($resultado_alumno);

$sql_programa = " SELECT id_plan_estudio, plan_estudios, id_carrera, id_carrera_tipo, carrera, alumnos_programas.* FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = mysqli_fetch_array($resultado_programa);

$sql_duracion = "SELECT duracion FROM carreras_tipo WHERE id_carrera_tipo='".$fila_programa["id_carrera_tipo"]."';";
$resultado_duracion = mysqli_query($conexion, $sql_duracion);
$fila_duracion = @mysqli_fetch_array($resultado_duracion);

$sql_semestre = "SELECT MAX(semestre) AS semestre FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) WHERE id_alumno_programa='".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."'";
$resultado_semestre = mysqli_query($conexion, $sql_semestre);
$fila_semestre = @mysqli_fetch_array($resultado_semestre);

$sql_becas = "SELECT alumnos_becas.*, clave FROM alumnos_becas JOIN alumnos_programas USING(id_alumno_programa) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
$resultado_becas = mysqli_query($conexion, $sql_becas);
$fila_becas = mysqli_fetch_array($resultado_becas);
	
$sql_ciclo_escolar = "SELECT * FROM  ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);	


$html_generales = '	
	<link type="text/css" href="../../css/default.css" rel="stylesheet" >
	
	<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="center">
				<h3>CENTRO UNIVERSITARIO DE ESTUDIOS JUR&Iacute;DICOS</h3>
				<h3>FORMATO DE MONTOS Y BECAS</h3>
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
					<span class="dato">'.$fila_alumno["nombre"].'</span>	
				</td>			
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["apellido_paterno"]).'</span>	
				</td>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_alumno["apellido_materno"]).'</span>	
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
					<label>Programa Acad&eacute;mico<span id="lbl_Fecha_Inicio"></span></label>
				</td>
				<td class="cuej" cols>
					<label>Ciclo Escolar <span id="lbl_Ciclo_Escolar"></span></label>                   
				</td>
				<td class="cuej" cols>
					<label>'.$fila_duracion["duracion"].'<span id="lbl_'.$fila_duracion["duracion"].'"></span></label>                   
				</td>
				<td class="cuej" cols>
					<label>Fecha Inicio <span id="lbl_Fecha_Inicio"></span></label>                   
				</td>
			 </tr>
			 <tr>
				<td class="cuej">
					<span class="dato">'.utf8_encode($fila_programa["carrera"])." PLAN ".utf8_encode($fila_programa["plan_estudios"]).'</span>
				</td>
				<td class="cuej">
					<span class="dato" align="center">'.$fila_ciclo_escolar["ciclo_escolar"].'</span>
				</td>
				<td class="cuej" align="center">
					<span class="dato">'.$fila_semestre["semestre"].'</span>
				</td>
				<td class="cuej">
					<span class="dato" align="center">'.$fila_programa["fecha_inicio"].'</span>
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
	<table width="100%" class="cuej">
     	<thead>
			<tr>
				<th class="cuej" colspan="5">DETALLE DE PAGO DE COLEGIATURAS</th>
		   </tr>
		</thead>
		<tr>
          	<th class="cuej">MES</th>
            <th class="cuej">COLEGIATURA</th>
            <th class="cuej">BECA</th>
            <th class="cuej">IMPORTE A PAGAR</th>
            <th class="cuej">FECHA L&Iacute;MITE DE PAGO</th>
        </tr>
';
for($i = $fila_ciclo_escolar["mes_inicio"]; $i <= $fila_ciclo_escolar["mes_fin"]; $i++)
{
	//Buscamos si el pago ya fue realizado
	$sql_pagos = "SELECT * FROM pagos WHERE clave = '".$fila_becas["clave"]."' AND id_referencia = '".$i."' AND periodo = '".$fila_ciclo_escolar["periodo"]."';";
	$resultado_pagos = mysqli_query($conexion, $sql_pagos);
	$registros_pagos = @mysqli_num_rows($resultado_pagos);
		
	$sql_referencia = "SELECT * FROM referencias WHERE id_referencia = '".$i."';";
	$resultado_referencia = mysqli_query($conexion, $sql_referencia);
	$fila_referencia = @mysqli_fetch_array($resultado_referencia);
	
	$sql_fecha = "SELECT * FROM fechas_limite_pago WHERE id_referencia = '".$fila_referencia["id_referencia"]."' AND periodo = '".$fila_ciclo_escolar["periodo"]."';";
	$resultado_fecha = mysqli_query($conexion, $sql_fecha);
	$fila_fecha = mysqli_fetch_array($resultado_fecha);
		
	//Monto de colegiatura con beca aplicada
		
	$monto_colegiatura = $fila_becas["colegiatura"]-(($fila_becas["colegiatura"] * $fila_becas["beca_".$i])/100);
	
	$html_generales .= '
		<tr>
			<td class="cuej">'.$fila_referencia["concepto"].'</td>
            <td class="cuej" align="center"> $ '.number_format($fila_becas["colegiatura"],2).'</td>
            <td class="cuej" align="center">'.$fila_becas["beca_".$i].' %</td>
            <td class="cuej" align="center"> $ '.number_format($monto_colegiatura,2).'</td>
            <td class="cuej" align="center">'.date("d/m/Y",strtotime($fila_fecha["fecha_limite"])).'</td>
        </tr>
	';
}

$html_generales .= '
	<tfoot>
         <tr>
			<th class="cuej" colspan="5"></th>
         </tr>
    </tfoot>
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
exit;

?>