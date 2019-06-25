
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

$id_Proceso = 15;


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



<script type="text/javascript" src="/SICUEJ/js/horarios/admin/funciones.js"></script>
<script type="text/javascript" src="/SICUEJ/js/timepicker/bootstrap-clockpicker.min.js"></script>



<script type="text/javascript" >

	$('Body').ready(function(){



		$('#btnActualizar').click(function(){


			actualizar();

		});




		//$('.clockpicker').clockpicker();
		$('[id^=horario_]').clockpicker({
			 donetext: 'Establecer',
			 placement: 'left',
			});



	});




</script>

<?php include ("../../php/BodyERP.php"); ?>

<?php

$sql = "SELECT * from evento_horario order by orden; ";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);

?>



<table width="100%" >
	<thead>
		<tr>
			<th  colspan="4"><i class="fa fa-clock"></i> ESTABLECER HORARIOS<div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
	<table style="width: 100%; align-content: center;">
		<tr>
			<td>
			</td>
			<td ></td>
			<td align="right" valign="top">
<?php
	if($_SESSION["Insert"] == 1)
	{
?>


				<input class="button" type="button" id = "btnActualizar" name = "btnActualizar"  value = "Actualizar" />

				<?php
	}
?>
			</td>
		</tr>
	</table>
<p>&nbsp;</p>
<div id="div_horarios">

<form id="frmHorarios">
<div class="table-responsive">
	<table id="tbl_captacion" class="table table-sm table-hover" style="width:100%">


		<tbody>

			<?php

			while ($row = @mysqli_fetch_assoc($results))

			{

			    ?>


			<tr>
    			<td colspan="4">
    				<strong><?php echo $row["orden"] .  ". ";  echo $row["nombre"]; ?></strong>
    				<input  value="<?php echo $row["id"]?>"  name="id[]" id="id" type="hidden" />

    			</td>
			</tr>

			<tr>


				<td>
					<div  class="form-group">
    					<label for="horario">* Horario</label>
                        <input readonly="readonly" data-format="hh:mm:ss" value="<?php echo $row["horario"]?>" class="form-control" name="horario[]" id="horario_<?php echo $row["id"]?>" aria-describedby="horarioHelp" placeholder="Ingrese valor" />
                        <small id="horarioHelp" class="form-text text-muted">*Establezca un horario en formato HH:MM</small>

                      </div>




				</td>
				<td>
					<div class="form-group">
    					<label for="tolerancia">* Tolerancia</label>
                        <input  value="<?php echo $row["tolerancia"]?>" class="form-control" name="tolerancia[]" id="tolerancia" aria-describedby="toleranciaHelp" placeholder="Ingrese valor" />
                        <small id="toleranciaHelp" class="form-text text-muted">*Establezca la tolerancia  en formato de minutos</small>
                      </div>

				</td>
				<td>
					<div class="form-group">
    					<label for="descripcion">Descripción</label>
                        <textarea  class="form-control" name="descripcion[]" id="descripcion" aria-describedby="descripcionHelp" ><?php echo $row["descripcion"]?></textarea>
                        <small id="descripcionHelp" class="form-text text-muted">*Descripción del evento</small>
                      </div>

				</td>
				<td>


					<div class="form-group">
                      <label  for="estatus">* Estatus</label>
                      <select class="form-control" id="estatus" name ="estatus[]" aria-describedby="estatusHelp">

                        <option value="1" <?php echo ($row["estatus"]=="1")?'selected':''; ?>>Activo</option>
                        <option value="2" <?php echo ($row["estatus"]=="2")?'selected':''; ?>>Inactivo</option>

                      </select>
                      <small id="estatusHelp" class="form-text text-muted">Estado actual del evento</small>

                    </div>

				</td>




			</tr>



			<?php }?>


		</tbody>

	</table>


</div>
</form>
</div>
<br />
<br />

<?php include ("../../php/Pie_Pagina.php"); ?>


