
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
<script src="/SICUEJ/js/download.js" ></script>


<script type="text/javascript" >

	$('Body').ready(function(){

		var table = 	 $('#tbl_registro').DataTable();


		$(function() {
		    var startDate;
		    var endDate;

		    var selectCurrentWeek = function() {
		        window.setTimeout(function () {
		            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
		        }, 1);
		    }

		    $('.week-picker').datepicker( {
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        firstDay: 1,
		        dateFormat: 'dd/mm/yy',
		        onSelect: function(dateText, inst) {
		            var date = $(this).datepicker('getDate');
		            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 1);
		            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
		            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
		            $('#inicio').val($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
		            $('#fin').val($.datepicker.formatDate( dateFormat, endDate, inst.settings ));

		            selectCurrentWeek();
		        },
		        beforeShowDay: function(date) {
		            var cssClass = '';
		            if(date >= startDate && date <= endDate)
		                cssClass = 'ui-datepicker-current-day';
		            return [true, cssClass];
		        },
		        onChangeMonthYear: function(year, month, inst) {
		            selectCurrentWeek();
		        }
		    });

		    $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
		    $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
		});


		$('#btnBuscar').click(function(){


			if($('#trabajador').val() != null){

			if(Sin_Espacios($('#inicio').val()) != ""){


				if(Sin_Espacios($('#fin').val()) != ""){

					//buscar();

					var dateInicio  = $( "#inicio" ).datepicker("getDate");

					var dateFin = $( "#fin" ).datepicker("getDate");



					if (dateInicio > dateFin){

						alert("La fecha de inicio debe ser menor o igual a la de fin.");
						$('#inicio').focus();

						}else{

							buscarUsuario();

							}

				}else{

					alert("Debe introducir una fecha de fin");
					//$('#fin').focus();
				}


			}else{

				alert("Debe introducir una fecha de inicio");
				//$('#inicio').focus();
			}

			}else{

				alert("Debe seleccionar un trabajador");
				$('#trabajador').focus();
			}

		});


		$( "#inicio" ).datepicker({dateFormat: "dd/mm/yy"});

		$( "#fin" ).datepicker({dateFormat: "dd/mm/yy"});




		$('a.btn').click(function(){

			$('#divRegistroModal').html("Cargando ...");
			verAdmin($(this).attr('taskid') );

		});


		$('#btnGenerar').click(function(){

			if($('#trabajador').val() != null){

				if(Sin_Espacios($('#inicio').val()) != ""){


					if(Sin_Espacios($('#fin').val()) != ""){

						//buscar();

						var dateInicio  = $( "#inicio" ).datepicker("getDate");

						var dateFin = $( "#fin" ).datepicker("getDate");



						if (dateInicio > dateFin){

							alert("La fecha de inicio debe ser menor o igual a la de fin.");
							$('#inicio').focus();

							}else{


								generar();

								}

					}else{

						alert("Debe introducir una fecha de fin");
						//$('#fin').focus();
					}


				}else{

					alert("Debe introducir una fecha de inicio");
					//$('#inicio').focus();
				}

				}else{

					alert("Debe seleccionar un trabajador");
					$('#trabajador').focus();
				}


			});


	});

</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT * FROM usuarios WHERE usuario_estatus = 1";

mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);



?>

	<form id="frmRegistro">




<table  style="width: 100%; align-content: center;">
	<thead>
		<tr>
			<th  colspan="3"><i class="fa fa-file-pdf-o"></i> Generar reporte de actividades semanales <div class="header_01"><hr /></div></th>
		</tr>
	</thead>
	<tbody>

			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="2">
					<div class="week-picker"></div>
				</td>

			<td>
				<div class="form-group">
                      <label  for="trabajador">* Trabajador</label>
                      <select  class="form-control" id="trabajador" name ="trabajador" aria-describedby="trabajadorHelp" >

						    <option value="" disabled selected>-- Selecione un trabajador --</option>

							<?php
							while ($row = @mysqli_fetch_assoc($results)){  ?>

							    <option value="<?php echo $row["id_usuario"]; ?>" ><?php echo $row["nombre"] . " " . $row["apellido_paterno"]. " " . $row["apellido_materno"]?></option>



							<?php } ?>


                      </select>
                      <small id="trabajadorHelp" class="form-text text-muted">Seleccione un trabajador</small>

                    </div>


			</td>

						<td>

			</td>



			</tr>
			<tr>



				<td>
				<div class="form-group">
                                <label for="jefe">Jefe inmediato</label>
                                <input required="required" class="form-control" id="jefe" name="jefe" aria-describedby="jefeHelp" placeholder="Ingrese valor">
                                <small id="jefeHelp" class="form-text text-muted">Jefe inmediato</small>
                    </div>

				</td>

				<td></td>

		</tr>

		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>

			<td>
			<div class="row">

					<div class="col-md-1">
						Del
					</div>
					<div class="col-md-4">
					 <input readonly required="required" class="form-control" id="inicio" name="inicio" placeholder="Inicio">
 					</div>
					<div class="col-md-1">
						al
					</div>
					<div class="col-md-4">
 					 <input readonly required="required" class="form-control" id="fin" name="fin"  placeholder="Fin">
					</div>
				</div>
			</td>
			<td>
				<input type="button" id="btnBuscar" class="button" value="Buscar"/>
				<input type="button" id="btnGenerar" class="button"  value="Generar" />

			</td>
			<td>

			</td>
		</tr>
	</tbody>

	</table>
	</form>
<p>&nbsp;</p>
<div id="divRegistro">
<div class="table-responsive small">
	<table id="tbl_registro" class="table table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>Id</th>
			<th>Fecha captura</th>
			<th>Tarea</th>
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
				<td><a href="javascript:verAdmin(<?php echo $row['id'];?>)"  class="btn" data-toggle="modal" data-target="#exampleModal" taskid  = "<?php echo $row['id'];?>" ><?php echo $row["id"]; ?></a> </td>
				<td><?php echo date ('d/m/Y H:i',strtotime($row['fecha_captura']) )?> </td>
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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalle de la tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="divRegistroModal">
		Cargando ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<?php include ("../../php/Pie_Pagina.php"); ?>


