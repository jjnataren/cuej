
<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 19 2019]
	-- País: México
	-- Objetivo: Regitro de horas de un empleado
	-- Última Modificación: [Mayo, 19 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../../php/Funciones.php");

$id_Proceso = 16;


$id_usuario =  $_SESSION["id_Usuario"];


if(!(isset($_SESSION["Permisos"])))
{
	header("Location: ../../index.php");
}
else
{
	$permisos = explode(",",$_SESSION["Permisos"]);

	if(false &&  !(@in_array($id_Proceso,$permisos)))
	{
		header("Location: ../../GENERAL/Permisos.php");
	}
	else
	{
		$sql_permisos_proceso = "SELECT * FROM permisos WHERE id_usuario = '".$_SESSION["id_Usuario"]."' AND id_proceso = '".$id_Proceso."';";
		$resultado_permiso_proceso = mysqli_query($conexion, $sql_permisos_proceso);
		$fila_permiso_proceso = @mysqli_fetch_array($resultado_permiso_proceso);

		$_SESSION["Insert"] = $fila_permiso_proceso["insertar"];
		$_SESSION["Delete"] = $fila_permiso_proceso["eliminar"];
		$_SESSION["Update"] = $fila_permiso_proceso["actualizar"];
	}
}

include ("../../php/HTMLERP.php");

?>




<script type="text/javascript" src="/SICUEJ/js/media/funciones.js"></script>
<script src="/SICUEJ/lib/jfu/js/vendor/jquery.ui.widget.js"></script>
<script src="/SICUEJ/lib/jfu/js/jquery.iframe-transport.js"></script>
<script src="/SICUEJ/lib/jfu/js/jquery.fileupload.js"></script>
<script type="text/javascript" >

	$('Body').ready(function(){


		var t = $('#tblCarreras').DataTable();


	});

</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT * FROM carreras order by carrera;";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);




?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4"><i class="fa fa-book"></i>  CONTENIDO MULTIMEDIA  <div class="header_01"><hr /></div></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td  colspan="4">Seleccione un topico para desplegar el contenido</td>
		</tr>
	</tbody>

</table>
	<table width="100%" align="center">
		<tr>
			<td>
			</td>
			<td ></td>
			<td align="right" valign="top">
<?php
	if($_SESSION["Insert"] == 1)
	{
?>



<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>
<div id="divMedia">
<div class="table-responsive">
	<form id="frmMedia">
	<table id="tblCarreras" class="table" style="width:100%">

		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Abreviatura</th>
				<th>Clave</th>
			</tr>
		</thead>

		<tbody>

			<?php


			while ($row = @mysqli_fetch_assoc($results))

			{
			    ?>



			<tr>

				<td>
					<a href="javascript:ver(<?php echo $row['id_carrera'];?>)"><?php echo $row["id_carrera"]; ?></a>
				</td>
				<td>
					<?php echo $row["carrera"]?>
				</td>

				<td>
					<?php echo $row["abreviatura"]?>
				</td>

					<td>
					<?php echo $row["clave"]?>
				</td>


			</tr>



			<?php }?>


		</tbody>

	</table>

	</form>
</div>
</div>
<br />
<br />
<?php include ("../../php/Pie_Pagina.php"); ?>