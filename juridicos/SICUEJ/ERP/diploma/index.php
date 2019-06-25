
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

<script type="text/javascript" src="/SICUEJ/js/diploma/funciones.js"></script>
<script src="/SICUEJ/js/jquery-ui.js" ></script>
<script src="/SICUEJ/js/download.js" ></script>

<script type="text/javascript" >

	$('Body').ready(function(){

		var table = 	 $('#tblAlumno').DataTable({
		    language: {
		        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
		    }
		});

			/*
		 $('#tblAlumno tbody').on( 'click', 'tr', function () {
		        if ( $(this).hasClass('selected') ) {
		            $(this).removeClass('selected');
		        }
		        else {
		            table.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		        }


		    } );*/


		    $('#tblAlumno tbody').on( 'click', 'tr', function () {
		        $(this).toggleClass('selected');
		    });



		 var tableDip = 	 $('#tblDiploma').DataTable({
			    language: {
			        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
			    }
    		});


		 $('#tblDiploma tbody').on( 'click', 'tr', function () {
		        if ( $(this).hasClass('selected') ) {
		            $(this).removeClass('selected');
		        }
		        else {
		        	tableDip.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		        }



		    } );






		$('#btnGenerar').click(function(){

		 if( table.rows('.selected').data().length > 0 ){


			 if( tableDip.rows('.selected').data().length > 0 ){

				 	var diploma = tableDip.row('tr.selected').data()[0];

				 	var ids = $.map(table.rows('.selected').data(), function (item) {
				        return item[0]
				    });

				 	var alumno = JSON.stringify(table.rows('.selected').data()) ;

					generar(diploma, JSON.stringify(ids));

				}else{


						alert("¡ Debe seleccionar un tipo de diploma !");

					}
			}else{
					alert("¡ Debe seleccionar un alumno !");
				}

			});


	});

</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT * FROM alumnos;";

mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);

$sql = "SELECT * FROM diploma;";

$resultsDiploma = mysqli_query($conexion,$sql);


?>

<table  style="width: 100%; align-content: center;">
	<thead>
		<tr>
			<th  colspan="3"><i class="fa fa-bookmark"></i> GENERAR DIPLOMA<div class="header_01"><hr /></div></th>
		</tr>
	</thead>
	<tbody>

			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><h4>Seleccione un tipo de diploma</h4></td>
			</tr>
			<tr>
				<td colspan="3">


                    <table id="tblDiploma" class="table table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Inicio</th>
			<th>Fin</th>


		</tr>
		</thead>

		<tbody>

			<?php
			while ($row = @mysqli_fetch_assoc($resultsDiploma)){



			    ?>
			<tr>
				<td><?php echo $row["id"]?> </td>
				<td><?php echo $row["nombre"]?> </td>
				<td><?php echo date('d/m/Y' ,strtotime( $row["inicio"])); ?></td>
				<td><?php echo date('d/m/Y' ,strtotime( $row["fin"])); ?></td>
			</tr>
			<?php }?>

		</tbody>

	</table>


			</td>
			</tr>



	</tbody>

	</table>
<p>&nbsp;</p>
<h4>Seleccione un alumno</h4>

<div id="divDiploma">
<div class="table-responsive small">
	<table id="tblAlumno" class="table table-sm table-hover" style="width:100%">
		<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>A. Paterno</th>
			<th>A. Materno</th>

		</tr>
		</thead>

		<tbody>

			<?php
			while ($row = @mysqli_fetch_assoc($results)){



			    ?>
			<tr>
				<td><?php echo $row["id_alumno"]?> </td>
				<td><?php echo $row["nombre"]; ?></td>
				<td><?php echo $row["apellido_paterno"]; ?></td>
				<td><?php echo $row["apellido_materno"]; ?></td>
			</tr>
			<?php }?>

		</tbody>

	</table>
</div>
</div>
<div align="right">
				<input class="button" type="button" id = "btnGenerar" name = "btnGenerar"  value = "Generar diploma" />
</div>

<br />
<br />






<?php include ("../../php/Pie_Pagina.php"); ?>


