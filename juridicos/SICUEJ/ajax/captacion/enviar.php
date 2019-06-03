<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../lib/PHPMailer/src/Exception.php';
require '../../lib/PHPMailer/src/PHPMailer.php';
require '../../lib/PHPMailer/src/SMTP.php';

/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor: Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 21 2019]
	-- País: México
	-- Objetivo: Envio de notificaciones por email
	-- Última Modificación: [Mayo, 21 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Versión inicial
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];

	$nombres = $_POST["nombre"];

	$ids = $_POST["id"];

	$correos = $_POST["correo"];

	$topicos = $_POST["topico"];

	$errors = "";

	$content = utf8_encode( $_POST["bodyText"] );

	$plantilla =  $_POST["plantilla"];


	$sql = "SELECT * FROM tbl_plantilla WHERE id =  $plantilla;";



	mysqli_query($conexion, "SET NAMES 'utf8'");
	$resultado = mysqli_query($conexion, $sql);



	if(!mysqli_error($conexion))
	{

	    $row = @mysqli_fetch_assoc($resultado);

	    $tpl =  file_get_contents('../../ERP/captacion/tpl/' . $row["contenido"]) ;



	}else 	$tpl =  file_get_contents('../../ERP/captacion/tpl/sample.html') ;


	$tpl = str_replace('{{content}}', $content, $tpl);


	foreach ($ids as $key =>$value){


	    $mail = new PHPMailer;
	    $mail->isSMTP();
	    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
	    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
	    $mail->Port = 587; // TLS only
	    $mail->SMTPSecure = 'tls'; // ssl is depracated
	    $mail->SMTPAuth = true;
	    $mail->Username = 'maaahernandezgarcia@gmail.com';
	    $mail->Password = 'Natax621.';
	    $mail->setFrom('maaahernandezgarcia@gmail.com', 'maaahernandezgarcia@gmail.com');
	    $mail->addAddress($correos[$key], $correos[$key]);
	    $mail->Subject = 'CUEJ CONTACTO:  ' . $topicos[$key];
	    $mail->CharSet = 'UTF-8';

	    $tpl = str_replace('{{nombre}}', $nombres[$key], $tpl);

	    $mail->msgHTML($tpl); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
	    $mail->AltBody = 'Ninguno';

	    if (isset($_FILES['file1']) &&
	        $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
	            $mail->AddAttachment($_FILES['file1']['tmp_name'],
	                $_FILES['file1']['name']);
	        }

        if (isset($_FILES['file2']) &&
            $_FILES['file2']['error'] == UPLOAD_ERR_OK) {
                $mail->AddAttachment($_FILES['file2']['tmp_name'],
                    $_FILES['file2']['name']);
            }

        if (isset($_FILES['file3']) &&
            $_FILES['file3']['error'] == UPLOAD_ERR_OK) {
                $mail->AddAttachment($_FILES['file3']['tmp_name'],
                    $_FILES['file3']['name']);
            }

        if (isset($_FILES['file4']) &&
            $_FILES['file4']['error'] == UPLOAD_ERR_OK) {
                $mail->AddAttachment($_FILES['file4']['tmp_name'],
                    $_FILES['file4']['name']);
            }


	    if(!$mail->send()){


	        if (isset( $_SESSION["MAIL_ERRORS"])){
    	        $_SESSION["MAIL_ERRORS"] .= "\n No fue posible enviar el mensaje al destinatario:  " . $correos[$key] .", Id proceso: "  .  $ids[$key] .  ", Error: "  . $mail->ErrorInfo;

	        }else
	            $_SESSION["MAIL_ERRORS"] = "\n No fue posible enviar el mensaje al destinatario:  " . $correos[$key] .", Id proceso: "  .  $ids[$key] .  ", Error: "  . $mail->ErrorInfo;



	    }else{

	        $sql = 'UPDATE captacion SET estatus = 2 WHERE id = ' .$ids[$key] . ';';

	        mysqli_query($conexion, "SET NAMES 'utf8'");

	        $results = mysqli_query($conexion,$sql);


	      }

	}

	if (!isset($_SESSION["MAIL_ERRORS"]))
	   $_SESSION["MAIL_OK"] = '!Se ha enviado la inforación a todos los destinatarios!';



 	header( "Location: /SICUEJ/ERP/captacion" );


?>
