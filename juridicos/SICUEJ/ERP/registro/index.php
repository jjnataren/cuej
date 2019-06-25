
<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Abril, 19 2019]
	-- País: México
	-- Objetivo: Registro de actividades de un empleado
	-- Última Modificación: [Abril, 19 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../../php/Funciones.php");

$id_Proceso = 18;


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




<script type="text/javascript" src="/SICUEJ/js/registro/funciones.js"></script>
<script src="/SICUEJ/js/jquery-ui.js" ></script>

<script type="text/javascript" >

	$('Body').ready(function(){

		var table = 	 $('#tbl_registro').DataTable({
		    language: {
		        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
		    }
		});


		$('#btnNuevo').click(function(){

			nuevo();

		});


	});

</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT * FROM  registro_actividad WHERE id_usuario = $id_usuario ORDER BY fecha_captura LIMIT 100 ;  ";

mysqli_query($conexion, "SET NAMES 'utf8'");


$results = mysqli_query($conexion,$sql);

?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4"><i class="fa fa-fax"></i> Registro de actividades <div class="header_01"><hr /></div></th>
		</tr>
	</thead>
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
				<input class="button" type="button" id = "btnNuevo" name = "btnNuevo"  value = "Nuevo" />
<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>
<div id="divRegistro">
<div class="table-responsive small">
	<table id="tbl_registro" class="table table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>Fecha captura</th>
			<th>ID</th>
			<th>Nombre</th>
			<th>Solicito</th>
			<th>Avance</th>
			<th>Final</th>
			<th>Estatus</th>
		</tr>
		</thead>

		<tbody>

			<?php
			while ($row = @mysqli_fetch_assoc($results)){


			    $estatus = '';

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

			    ?>
			<tr>
				<td><?php echo date ('d/m/Y H:i',strtotime($row['fecha_captura']) )?> </td>
				<td><a href="javascript: ver(<?php echo $row['id'];?>)"><?php echo $row["id"]; ?></a> </td>
				<td><?php echo $row["nombre"]; ?></td>
				<td><?php echo $row["persona"]; ?></td>
				<td><?php echo date ('d/m/Y',strtotime($row['avance']) )?> </td>
				<td><?php echo date ('d/m/Y',strtotime($row['final']) )?> </td>
				<td><?php echo $estatus ?></td>

			</tr>
			<?php }?>

		</tbody>

	</table>
</div>
</div>
<br />
<br />
<?php include ("../../php/Pie_Pagina.php"); ?>