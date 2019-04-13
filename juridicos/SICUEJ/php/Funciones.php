<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jur�dicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creaci�n: [Abril, 01 2016]
	-- Pa�s: M�xico
	-- Objetivo: Funciones PHP
	-- �ltima Modificaci�n: [Abril, 01 2016]
	-- Realiz�: Nancy Flores Torrecilla
	-- Observaciones: Creaci�n de Archivo
	-- ===============================================================================
*/

function Conectar()
	{
		if(!($conexion = mysqli_connect("localhost","root","","sicuej")))
		   {
	    	  echo "Error conectando a la base de datos.<br />";
		   }
		return $conexion;
	}
	$conexion = Conectar();

function Mayusculas($palabra)
	{
		$palabra = strtoupper(utf8_decode($palabra));
		return $palabra;
	}

function Minusculas($palabra)
	{
		$palabra = strtolower(utf8_decode($palabra));
		return $palabra;
	}

function Iniciales($cadena)
	{
		$palabras = explode(" ",$cadena);

		foreach ($palabras as $palabra) {
			$inicial = $inicial.substr($palabra,0,1);
		}

		return $inicial;
	}

function Validar_Correo($Correo)
	{
		if (ereg('^[0-9A-Za-z\_\.]{3,}@([0-9A-Za-z]{2,}\.)*([0-9A-Za-z]{2,}\.)[0-9A-Za-z]{2,4}$',$Correo))
			return $Correo;
		else
			return "Correo no valido";
	}

function Validar_Fecha($dia,$mes,$a�o)
	{
 		if(checkdate($mes,$dia,$a�o))
			return $dia.'-'.$mes.'-'.$a�o;
		else
			return "Fecha incorrecta";
	}

function Validar_RFC($cadena)
	{
		$cadena=strtoupper($cadena);
		$letra=substr($cadena,0,4);
		$digito=substr($cadena,4,6);

		if(ereg("[A-Z][AEIOU][A-Z]{2}",$letra) && Validar_Fecha (substr($digito,4,2), substr($digito,2,2), "19".substr($digito,0,2)) != "Fecha incorrecta" && strlen($cadena)==10)
			return $cadena;
		else
			return "RFC no valido";
	}

function Validar_RFCH($cadena)
	{
	$cadena=strtoupper($cadena);
	$digito=substr($cadena,4,6);

	if(ereg("[A-Z][AEIOU][A-Z]{2}[0-9]{2}[01][0-9][0123][0-9][0-9A-Z]{3}",$cadena) && Validar_Fecha ( substr($digito,4,2), substr($digito,2,2), "19".substr($digito,0,2)) != "Fecha incorrecta" && strlen($cadena)==13)
			return $cadena;
		else
			return "RFC no valido";
	}

function Validar_CURP($cadena)
	{
	$cadena=strtoupper($cadena);
	$digito=substr($cadena,4,6);

	if(ereg("[A-Z][AEIOU][A-Z]{2}[0-9]{2}[01][0-9][0123][0-9][HM][A-Z]{2}[BCDFGHJKLMN�PQRSTVWXYZ]{3}[0-9A-Z]{2}",$cadena) && Validar_Fecha ( substr($digito,4,2), substr($digito,2,2), "19".substr($digito,0,2)) != "Fecha incorrecta" && strlen($cadena)==18)
			return $cadena;
		else
			return "CURP no valido";
	}

function Logs_Errores($error, $sql, $id_usuario)
{
		$archivo = @fopen("../../Logs.txt", 'a+');

		if($archivo)
		{
			$cadena = "|||\t".date("Y-m-d")."\t".date("h:i:s ")."\t".$id_usuario."\t".$error."\t".utf8_encode($sql)."\n";

			fwrite($archivo, $cadena);
			fclose($archivo);
		}
}

function Genera_Password($cadena){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena_1 = "1234567890";
	$cadena_2 = "&%$/.@*_-#";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena_1=strlen($cadena_1);
	$longitudCadena_2=strlen($cadena_2);

    //Se define la variable que va a contener la contrase�a
    $pass = "";
    //Se define la longitud de la contrase�a, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=4;

	$pass = $cadena.substr($cadena_1,rand(0,$longitudCadena_1-1),1).substr($cadena_1,rand(0,$longitudCadena_1-1),1).substr($cadena_2,rand(0,$longitudCadena_2-1),1).substr($cadena_2,rand(0,$longitudCadena_2-1),1);

    return $pass;
}

?>