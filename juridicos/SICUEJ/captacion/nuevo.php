<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 19 2016]
	-- País: México
	-- Objetivo: Administración de Alumnos
	-- Última Modificación: [Mayo, 19 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

$id_Proceso = 14;


$id_usuario =  $_SESSION["id_Usuario"];


if(!(isset($_SESSION["Permisos"])))
{
	header("Location: ../index.php");
}
else
{
	$permisos = explode(",",$_SESSION["Permisos"]);

	if(false &&  !(@in_array($id_Proceso,$permisos)))
	{
		header("Location: ../GENERAL/Permisos.php");
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

include ("../php/HTML.php");



$sql = "SELECT cap.*,
                    (Select car.carrera from carreras car
                            where car.id_carrera =  cap.id_topico_interes limit 1) as carrera
                                FROM sicuej.captacion cap where id_empleado = $id_usuario;";

$results = mysqli_query($conexion,$sql);


?>
<script type="text/javascript" src="../js/flexigrid.pack.js"></script>
<script type="text/javascript" src="../js/Funciones_Jquery_Captacion.js"></script>
<script type="text/javascript" >

	$('Body').ready(function(){

		$('#tbl_captacion').DataTable();

	/*	Captacion_B
	uscar();

		$('#Btn_Buscar').click(function(){
			Captacion_Buscar();
		});

		$('#Btn_Nuevo_Alumno').click(function(){
			Captacion_Buscar();
		});*/
	});

</script>

<?php include ("../php/Body.php"); ?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">Nuevo proceso de captación <div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>


<form>
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
				<a href="nuevo" class="button"  >
					Guardar

				</a>
<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>
<div id="div_nuevo">

	<table id="tbl_captacion" class="display table-condensed table-striped" style="width:100%">
		<thead>
		<tr>
			<th>Id</th>
			<th>Fecha captura</th>
			<th>Cliente</th>
			<th>Correo electronico</th>
			<th>Telefono</th>
			<th>Medio de contacto</th>
			<th>Topico de interes</th>
			<th>País</th>
			<th>Estado</th>
		</tr>

		</thead>

		<tbody>

			<?php

			while ($row = @mysqli_fetch_assoc($results))
			{?>



			<tr>
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["captacion_fecha_alta"]; ?></td>
				<td><?php echo $row["cliente_nombre"]; ?></td>
				<td><?php echo $row["cliente_correo_electronico"]; ?></td>
				<td><?php echo $row["cliente_telefono"]; ?></td>
				<td><?php echo $row["medio_contacto"]; ?></td>
				<td><?php echo $row["carrera"]; ?></td>
				<td><?php echo $row["pais"]; ?></td>
				<td><?php echo $row["estado"]; ?></td>


			</tr>



			<?php }?>


		</tbody>

	</table>

</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>