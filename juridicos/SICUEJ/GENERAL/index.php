
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
	<p align="center">Bienvenido(a): <?php echo htmlentities($_SESSION["Titulo"]." ".$_SESSION["Nombre"]." ".$_SESSION["Apellido_Paterno"]." ".$_SESSION["Apellido_Materno"]); ?></p>

<?php 
	include ("../php/Pie_Pagina.php"); 
?>