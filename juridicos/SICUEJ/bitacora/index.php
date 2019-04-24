
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
include("../php/Funciones.php");

$id_Proceso = 16;


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




<script type="text/javascript" src="../js/bitacora/funciones.js"></script>
<script type="text/javascript" >

	$('Body').ready(function(){




		$('#btnInsertar').click(function(){

			insertar();

		});


	});

</script>

<?php include ("../php/Body.php"); ?>

<?php

$sql = "SELECT * FROM evento_horario order by orden;";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);




?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">Registro de horas <div class="header_01"><hr /></div></th>
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



<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>
<div id="div_captacion">
<div class="table-responsive">

	<form id="frmBitacora">
	<table id="tbl_horarios" class="table" style="width:100%">

		<tbody>

			<tr>
				<td colspan="3">
				<small  class="form-text text-muted">Se deben registrar los horarios en el orden indicado</small>

				</td>
			</tr>

			<tr>
				<td colspan="3" align="right"">
				<h3> Fecha actual: <?php echo date('d/m/Y H:i');?></h3>

				</td>
			</tr>

			<?php

			$flagCurrent = 0;

			while ($row = @mysqli_fetch_assoc($results))

			{


			    $id  = $row["id"];

			    $sql = "SELECT * FROM bitacora_horario WHERE id_empleado =$id_usuario and horario >= CURDATE() and id_evento = $id LIMIT 1;   ";


			    $resultsEmpleado = mysqli_query($conexion,$sql);


			     $rowEmpleado = @mysqli_fetch_assoc($resultsEmpleado);



			    ?>



			<tr>

				<td><?php echo $row["orden"] .". ".  $row["nombre"] . " (" .$row["horario"] ." )";?></td>
				<td>

					<?php if (!$rowEmpleado && !$flagCurrent): ?>

								<input type="button"  class="btn btn-primary" id="btnInsertar" value="Registrar" />

								<input type="hidden" value="<?php echo  $row["id"];?>" name="id_evento" />

					<?php elseif($rowEmpleado):?>

								<input type="button" disabled="disabled" class="btn"  value="Registrado" />
					<?php elseif($flagCurrent):?>

								<input type="button" disabled="disabled" class="btn btn-info"  value="Por registrar" />

					<?php endif;?>
				</td>

				<td>

					<?php if (!$rowEmpleado && !$flagCurrent):  $flagCurrent ++; ?>
					<div class="form-group col-md-8">

                                <input  class="form-control" id="comentario" name="comentario" aria-describedby="comentarioHelp" placeholder="Ingrese comentario">
                                <small id="comentarioHelp" class="form-text text-muted">Un comentario para el supervisor.</small>
                    </div>

					<?php elseif($rowEmpleado):?>

						<?php if($date =  strtotime($rowEmpleado['horario'])){

						    $date = date('d/m/Y H:i');

						}else $date =$rowEmpleado['horario'];  ?>

						<?php echo $date .' - ' .$rowEmpleado['comentario'];?>

					<?php endif;?>
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
<?php include ("../php/Pie_Pagina.php"); ?>