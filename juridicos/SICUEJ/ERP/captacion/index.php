
<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 19 2019]
	-- País: México
	-- Objetivo: Administración de Alumnos
	-- Última Modificación: [Mayo, 19 2019]
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




<script type="text/javascript" src="/SICUEJ/js/captacion/funciones.js"></script>
<script src="/SICUEJ/js/ck/ckeditor.js"></script>
<script src="/SICUEJ/js/jquery-ui.js" ></script>
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


		$('#tbl_captacion tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');
	    } );


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

$sql = "SELECT cap.*,
                    (Select car.carrera from carreras car
                            where car.id_carrera =  cap.id_topico_interes limit 1) as carrera,
                                 (Select pa.paisnombre from pais pa where pa.id =  cap.pais limit 1) as paisdesc,
                                    (SELECT edo.estadonombre FROM estado edo where edo.id =  cap.estado limit 1) as estadodesc,
                                       (SELECT CONCAT(nombre,' ',apellido_paterno) FROM usuarios  WHERE  id_usuario = cap.id_empleado limit 1) as nombre_empleado
                                FROM captacion cap  ORDER BY cap.id desc LIMIT 100;";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);


$rowSelected = isset($_GET["rowSelected"]) ? $_GET["rowSelected"] : null;

?>




<table style="width: 100%;" align="center">
	<thead>
		<tr>
			<th  colspan="4"><i class="fa fa-envelope"></i> PROCESO DE CAPTACIÓN<div class="header_01"><hr /></div></th>
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
				<input class="button" type="button" id = "btnContactar" name = "Btn_Nuevo"  value = "Contactar" />
<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>

<div id="div_captacion">


<h4>
	Últimos procesos de captación
</h4>
<hr />
<div class="table-responsive small">

<?php if (isset($_SESSION["MAIL_ERRORS"])):?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error: </strong> <?php echo $_SESSION["MAIL_ERRORS"];?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php unset( $_SESSION["MAIL_ERRORS"]);?>

<?php elseif(isset($_SESSION["MAIL_OK"])):?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Correcto: </strong> <?php echo $_SESSION["MAIL_OK"];?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<?php unset( $_SESSION["MAIL_OK"]);?>

<?php endif;?>


	<table id="tbl_captacion" class="table  table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>ID</th>
			<th>Alta</th>
			<th>Empleado</th>

			<th>Estatus</th>
			<th>Cliente</th>

			<th>Correo</th>
			<th>Teléfono</th>
			<th>Interés</th>
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


			<tr <?php echo $rowSelected === $row['id'] ? "class='selected'" : ""  ?>>
				<td><a href="javascript: Captacion_Datos(<?php echo $row['id'];?>)"><?php echo $row["id"]; ?></a> </td>
				<td data-sort="<?php echo strtotime($row["captacion_fecha_alta"]);?>" ><?php echo

				date('d/m/Y h:i' , strtotime($row["captacion_fecha_alta"]) ); ?>
				</td>

				<td><?php echo
				  $row["nombre_empleado"]; ?>
				</td>


				<td>
					<?php echo  $estatusNuevo; ?>


				</td>
				<td><?php echo $row["cliente_nombre"]; ?></td>

				<td><?php echo $row["cliente_correo_electronico"]; ?></td>
				<td><?php echo $row["cliente_telefono"]; ?></td>

				<td><?php echo $row["carrera"]; ?></td>
				<td><?php echo $row["estadodesc"]; ?></td>



			</tr>



			<?php }?>


		</tbody>

	</table>
</div>
</div>
<br />
<form id="frmCaptacion">
	<table style="width: 100%; align-content: center;" class="table">
		<thead>
			<tr>
				<th colspan="4">Búsqueda por periodo</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<td>
				<div class="form-group col-md-8">
                                <label for="inicio">Inicio</label>
                                <input readonly="readonly" required="required" class="form-control" id="inicio" name="inicio" aria-describedby="inicioHelp" placeholder="Clic para Ingresar valor">
                                <small id="inicioHelp" class="form-text text-muted">Inicio del periodo deseado</small>
                    </div>

			</td>
			<td>
				<div class="form-group col-md-8">
                                <label for="fin">Fin</label>
                                <input readonly="readonly" required="required" class="form-control" id="fin" name="fin" aria-describedby="inicioHelp" placeholder="Clic para ingresar valor">
                                <small id="finHelp" class="form-text text-muted">Término del periodo deseado</small>
                    </div>

			</td>

			<td>
				<input type="button" id="btnBuscar" class="button" value="Buscar"/>
			</td>
			<td></td>
		</tr>
		</tbody>
	</table>
	</form>


<br />
<br />
<?php include ("../../php/Pie_Pagina.php"); ?>