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


$id_usuario =  $_SESSION["id_Usuario"];




$mpdf= new mPDF('',    // mode - default ''
    array(254,190.5),    // format - A4, for example, default ''
    0,     // font size - default 0
    '',    // default font family
    1,    // margin_left
    1,    // margin right
    1,     // margin top
    1,    // margin bottom
    0,     // margin header
    0,     // margin footer
    'L');  // L - landscape, P - portrait


$html_generales = file_get_contents('./dip.html');

$diploma = $_REQUEST["diploma"];
$alumno =  $_REQUEST["alumno"];

$sql = "SELECT * FROM alumnos WHERE id_alumno = $alumno;";

mysqli_query($conexion, "SET NAMES 'utf8'");

$resultsAlumno = mysqli_query($conexion,$sql);

$sql = "SELECT * FROM diploma WHERE id = $diploma;";

$resultsDiploma = mysqli_query($conexion,$sql);

$rowDiploma = @mysqli_fetch_assoc($resultsDiploma);
$rowAlumno = @mysqli_fetch_assoc($resultsAlumno);

if ( $rowDiploma && $rowAlumno ){

    $html_generales = str_replace('{{el_nombre}}',ucwords(mb_strtolower( $rowAlumno["nombre"]) )  . " " .ucwords ( mb_strtolower($rowAlumno["apellido_paterno"] )) . " " . ucwords(mb_strtolower($rowAlumno["apellido_materno"])) , $html_generales);
    $html_generales = str_replace('{{el_curso}}', $rowDiploma["nombre"]  , $html_generales);

    $html_generales = str_replace('{{el_inicio}}',date('d/m/Y', strtotime( $rowDiploma["inicio"] )) , $html_generales);

    $html_generales = str_replace('{{el_fin}}',date('d/m/Y', strtotime( $rowDiploma["fin"] )) , $html_generales);

    $html_generales = str_replace('{{la_fecha}}',date('d/m/Y') , $html_generales);

    $html_generales = str_replace('{{el_ponente_1}}',$rowDiploma["ponente1"] , $html_generales);

    $html_generales = str_replace('{{el_ponente_2}}',$rowDiploma["ponente2"] , $html_generales);

    $html_generales = str_replace('{{la_clave}}',$rowDiploma["clave"] , $html_generales);

    $html_generales = str_replace('{{la_duracion}}',$rowDiploma["duracion"] , $html_generales);


    $mpdf->SetWatermarkImage('../../imagenes/watermark.png');
    $mpdf->showWatermarkImage = true;


    $mpdf->AddPage('P','','','','',1,1,1,1,0,0);
    $mpdf->WriteHTML($html_generales);



    $mpdf->Output();
    exit;

}else{

    echo "Datos no validos";

}





?>






