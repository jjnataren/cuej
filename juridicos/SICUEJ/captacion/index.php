
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

?>




<script type="text/javascript" src="../js/flexigrid.pack.js"></script>
<script type="text/javascript" src="../js/Funciones_Jquery_Captacion.js"></script>
<script type="text/javascript" >

	$('Body').ready(function(){

		var table = 	 $('#tbl_captacion').DataTable();

	/*	Captacion_B
	uscar();

		$('#Btn_Buscar').click(function(){
			Captacion_Buscar();
		});
		*/
		$('#Btn_Nuevo').click(function(){
			Captacion_Nuevo();
		});


		$('#Btn_Update').click(function(){
			Captacion_Nuevo();
		});


		$('#tbl_captacion tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');
	    } );


		$('#btnContactar').click(function(){

			contactar(JSON.stringify(table.rows('.selected').data()) );

		});


	});

</script>

<?php include ("../php/Body.php"); ?>

<?php

$sql = "SELECT cap.*,
                    (Select car.carrera from carreras car
                            where car.id_carrera =  cap.id_topico_interes limit 1) as carrera,
                                 (Select pa.paisnombre from pais pa where pa.id =  cap.pais limit 1) as paisdesc,
                                    (SELECT edo.estadonombre FROM estado edo where edo.id =  cap.estado limit 1) as estadodesc
                                FROM sicuej.captacion cap where id_empleado = $id_usuario;";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);

?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">Procesos de captación <div class="header_01"><hr /></div></th>
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


				<input class="button" type="button" id = "Btn_Nuevo" name = "Btn_Nuevo"  value = "Nuevo" />
				<input class="button" type="button" id = "btnContactar" name = "Btn_Nuevo"  value = "Contactar" />
<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>
<div id="div_captacion">
<div class="table-responsive">
	<table id="tbl_captacion" class="table table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>Id</th>
			<th>Alta</th>
			<th>Estatus</th>
			<th>Cliente</th>

			<th>Correo</th>
			<th>Tel</th>
			<th>Social</th>
			<th>Interes</th>
			<th>Estado</th>


		</tr>

		</thead>

		<tbody>

			<?php

			while ($row = @mysqli_fetch_assoc($results))

			{

			    $estatusNuevo = "";
			    $icon = "fa fa-calendar";

			    switch ($row["estatus"]){

			        case "1":
			            $estatusNuevo = "registrado";
			            break;
			        case "2":
			            $estatusNuevo = "contactado";
			            $icon = "fa fa-calendar-check-o";
			            break;
			        default:
			            $estatusNuevo = "desconocido";

			    }

			    ?>



			<tr>
				<td><a href="javascript: Captacion_Datos(<?php echo $row['id'];?>)"><?php echo $row["id"]; ?></a> </td>
				<td><?php echo $row["captacion_fecha_alta"]; ?></td>
				<td>
					<?php echo  $estatusNuevo; ?>
					<i class="<?php echo $icon;?>"></i>

				</td>
				<td><?php echo $row["cliente_nombre"]; ?></td>

				<td><?php echo $row["cliente_correo_electronico"]; ?></td>
				<td><?php echo $row["cliente_telefono"]; ?></td>
				<td><?php echo $row["medio_contacto"]; ?></td>
				<td><?php echo $row["carrera"]; ?></td>
				<td><?php echo $row["estadodesc"]; ?></td>



			</tr>



			<?php }?>


		</tbody>

	</table>
</div>
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>