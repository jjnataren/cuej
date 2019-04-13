<?php
	session_start();	
	if(!(isset($_SESSION["Permisos"])))
	{
		header("Location: index.php");
	}
	include("../php/Funciones.php");
	 
	include ("../php/HTML.php");
	include ("../php/Body.php"); 
?>
	<p align="center">Usted no cuenta con permisos para ingresar a &eacute;sta p&aacute;gina</p>

<?php 
	include ("../php/Pie_Pagina.php"); 
?>