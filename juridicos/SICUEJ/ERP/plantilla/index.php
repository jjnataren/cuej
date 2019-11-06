
<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Octubre, 19 2019]
	-- País: México
	-- Objetivo: Administración de plantillas de correo electronico
	-- Última Modificación: [Octubre, 19 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../../php/Funciones.php");

$id_Proceso = 14;


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




<script type="text/javascript" src="/SICUEJ/js/plantilla/funciones.js"></script>
<script src="/SICUEJ/js/ck/ckeditor.js"></script>
<script src="/SICUEJ/js/jquery-ui.js" ></script>
<script src="/SICUEJ/js/jquery.form.min.js" ></script>

<script type="text/javascript" src="/SICUEJ/js/dp/datepicker-es.js"></script>

<script type="text/javascript" >

	$('Body').ready(function(){

		var table = 	 $('#tbl_captacion').DataTable({
				    language: {
				        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
				    }
	    		});

		table
	    .order( [ 0, 'desc' ] )
	    .draw();


		$('#btnNuevo').click(function(){
			nuevo();
		});


		$('#btnBuscar').click(function(){

			if($('#inicio').val().trim() != ""){


				if($('#fin').val().trim() != ""){

					//buscar();

					if ($('#inicio').val() > $('#fin').val()){

						alert("La fecha de inicio debe ser menor o igual a la de fin.");
						$('#inicio').focus();

						}else{

							buscar();

							}

				}else{

					alert("Debe introducir una fecha de fin");
					$('#fin').focus();
				}


			}else{

				alert("Debe introducir una fecha de inicio");
				$('#inicio').focus();
			}



		});

		$.datepicker.regional[ "es" ];

		$( "#inicio" ).datepicker({dateFormat: "dd/mm/yy"});

		$( "#fin" ).datepicker({dateFormat: "dd/mm/yy"});


		$('#btnContactar').click(function(){



			if ( table.rows('.selected').data().length > 0)

				contactar(JSON.stringify(table.rows('.selected').data()) );

			else
				alert ("Debe seleccionar un elemento.");

		});


	});

</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT pl.*, us.nombre as nombre_usuario  FROM sicuej.tbl_plantilla pl, usuarios us
WHERE  pl.usuario = us.id_usuario  AND pl.estatus = 1;";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);


$rowSelected = isset($_GET["rowSelected"]) ? $_GET["rowSelected"] : null;

?>




<table style="width: 100%;" align="center">
	<thead>
		<tr>
			<th  colspan="4"><i class="fa fa-file-code-o"></i> PLANTILLAS DE CORREO<div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
	<table style="width: 100%;"  align="center">
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

<div id="div_body">


<h4>
	Indice
</h4>
<hr />
<div class="table-responsive small">

<?php if (isset($_SESSION["PLANTILLA_ERROR"])):?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error: </strong> <?php echo $_SESSION["PLANTILLA_ERROR"];?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php unset( $_SESSION["PLANTILLA_ERROR"]);?>

<?php elseif(isset($_SESSION["PLANTILLA_OK"])):?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Correcto: </strong> <?php echo $_SESSION["PLANTILLA_OK"];?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<?php unset( $_SESSION["PLANTILLA_OK"]);?>

<?php endif;?>


	<table id="tbl_captacion" class="table  table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>ID</th>
			<th>Alias</th>
			<th>Documento</th>
			<th>Fecha modificación</th>
			<th>Usuario</th>
			<th>Disponible</th>

			<th></th>


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
			            $estatusNuevo = "Disponible";
			            break;
			        case "2":
			            $estatusNuevo = "No disponible";
			            $icon = "fa fa-calendar-check-o";
			            break;
			        default:
			            $estatusNuevo = "desconocido";

			    }

			    ?>





			<tr <?php echo $rowSelected === $row['id'] ? "class='selected'" : ""  ?>>
				<td>
					<a onclick="javascript:verPlantilla(<?php echo $row['id'];?>)" href="javascript: verPlantilla(<?php echo $row['id'];?>)"  data-toggle="modal" data-target="#exampleModal">
						<?php echo $row["id"]; ?>
					</a>
				</td>

				<td>
				<?php echo
				  $row["nombre"]; ?>
				</td>


				<td>
				<?php echo
				  $row["nombre_archivo"]; ?>
				</td>

				<td data-sort="<?php echo strtotime($row["fecha_modificacion"]);?>" >
				<?php echo
				    date('d/m/Y h:i' , strtotime($row["fecha_modificacion"]) ); ?>
				</td>


				<td><?php echo $row["nombre_usuario"]; ?></td>

				<td><?php echo $estatusNuevo; ?></td>

				<td><a href="javascript:editar(<?php echo $row['id'];?>)" id="editar"><i class="fa fa-edit"></i></a>  <a href="javascript:eliminar(<?php echo $row['id'];?>)" id="borrar"><i class="fa fa-trash"></i></a> </td>



			</tr>



			<?php }?>


		</tbody>

	</table>
</div>
</div>
<br />
<br />


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="divPlantilla">
		Cargando ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php include ("../../php/Pie_Pagina.php"); ?>