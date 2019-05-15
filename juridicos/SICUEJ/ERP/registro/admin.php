
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

		var table = 	 $('#tbl_registro').DataTable();



		$('#btnBuscar').click(function(){

			if(Sin_Espacios($('#inicio').val()) != ""){


				if(Sin_Espacios($('#fin').val()) != ""){

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


		$( "#inicio" ).datepicker({dateFormat: "dd/mm/yy"});

		$( "#fin" ).datepicker({dateFormat: "dd/mm/yy"});




		$('a.btn').click(function(){

			$('#divRegistroModal').html("Cargando ...");
			verAdmin($(this).attr('taskid') );

		});


	});

</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT ra.* , (SELECT concat(nombre, ' ' , apellido_paterno,' ' ,apellido_materno)
FROM usuarios where id_usuario = ra.id_usuario) AS nombre_usuario FROM registro_actividad ra ORDER BY fecha_captura  LIMIT 100";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);

?>




<table  style="width: 100%; align-content: center;">
	<thead>
		<tr>
			<th  colspan="4"><i class="fa fa-eye"></i> Revisar actividades empleados <div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
<form id="frmRegistro">
	<table style="width: 100%; align-content: center;">

			<tr>
			<td>
				<div class="form-group col-md-8">
                                <label for="inicio">Inicio</label>
                                <input readonly="readonly" required="required" class="form-control" id="inicio" name="inicio" aria-describedby="inicioHelp" placeholder="Clic para Ingresar valor">
                                <small id="inicioHelp" class="form-text text-muted">Fecha inicio de búsqueda</small>
                    </div>

			</td>
			<td>
				<div class="form-group col-md-8">
                                <label for="fin">Fin</label>
                                <input readonly="readonly" required="required" class="form-control" id="fin" name="fin" aria-describedby="inicioHelp" placeholder="Clic para ingresar valor">
                                <small id="finHelp" class="form-text text-muted">Fecha fin de búsqueda</small>
                    </div>

			</td>

			<td>
				<input type="button" id="btnBuscar" class="button" value="Buscar"/>
			</td>
			<td></td>
		</tr>
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
			<th>Empleado</th>
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
				<td><?php echo $row['nombre_usuario'];?> </td>
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


