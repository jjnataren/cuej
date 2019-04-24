
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

$id_Proceso = 17;


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
<script src="../js/jquery-ui.js" ></script>

<script type="text/javascript" >

	$('Body').ready(function(){


		var table = 	 $('#tbl_horarios').DataTable();

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

	});

</script>

<?php include ("../php/Body.php"); ?>

<?php

$sql = "select bh.*, (select nombre from usuarios where id_usuario = bh.id_empleado LIMIT 1) as nombre from bitacora_horario bh order by horario desc LIMIT 100";
mysqli_query($conexion, "SET NAMES 'utf8'");

$results = mysqli_query($conexion,$sql);


$board = [];

while ($row = @mysqli_fetch_assoc($results))

{

    if ($date =  strtotime($row["horario"]) ){

        $date = date('d/m/Y',$date);
    }else $date  = isset ($row["horario"])?$row["horario"] : 'unknow' ;


    $empleado = isset ($row["id_empleado"])?$row["id_empleado"] : 'unknow' ;
    $evento = isset ($row["id_evento"])?$row["id_evento"] : 'unknow' ;


    $board[$date][$empleado][$evento] = ['nombre'=>$row["nombre"], 'horario'=>$row["horario"], 'comentario'=>$row["comentario"]];

}


$eventos = [];

?>

	<form id="frmBitacora">


<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">Historial de horarios <div class="header_01"><hr /></div></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>
				<div class="form-group col-md-8">
                                <label for="inicio">Inicio</label>
                                <input readonly="readonly" required="required" class="form-control" id="inicio" name="inicio" aria-describedby="inicioHelp" placeholder="Clic para Ingresar valor">
                                <small id="inicioHelp" class="form-text text-muted">Fecha inicio de busqueda</small>
                    </div>

			</td>
			<td>
				<div class="form-group col-md-8">
                                <label for="fin">Fin</label>
                                <input readonly="readonly" required="required" class="form-control" id="fin" name="fin" aria-describedby="inicioHelp" placeholder="Clic para ingresar valor">
                                <small id="finHelp" class="form-text text-muted">Fecha fin de busqueda</small>
                    </div>

			</td>

			<td>
				<input type="button" id="btnBuscar" class="btn btn-primary" value="Buscar"/>
			</td>
			<td></td>
		</tr>
	</tbody>
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

	</form>
<p>&nbsp;</p>
<div id="divBitacora">
<div class="table-responsive">


	<table id="tbl_horarios" class="table table-sm" style="width:100%">

	<thead>
		<tr>
			<th>Fecha</th>
			<th>Id</th>
			<th>Trabajador</th>
			<?php

			$sql = "SELECT * FROM evento_horario where estatus = 1 order by orden;";

			mysqli_query($conexion, "SET NAMES 'utf8'");

            $results = mysqli_query($conexion,$sql);

            while ($row = @mysqli_fetch_assoc($results)){

                $eventos [] = ["id"=>$row['id'], "nombre"=>$row["nombre"]];

            ?>



			<th><?php echo $row["nombre"];?> </th>

			<?php }?>

		</tr>
	</thead>


		<tbody>

			<?php foreach ($board as $fecha => $trabajadores):?>

				<?php foreach ($trabajadores as $id_trabajador => $eventosTrabajador ):?>

				<tr>
				<td><?php echo $fecha;?></td>
				<td><?php echo $id_trabajador;?></td>

						<?php  $i= 0;  foreach ($eventos as  $evento=>$detalle):?>

						<?php $found = 0;  foreach ($eventosTrabajador as $id_evento => $detalles): ?>

    						<?php if(!$i++):?>
    						<td><?php echo $detalles["nombre"];?></td>
    						<?php endif;?>

    							<?php if ($id_evento === $detalle["id"]*1): ?>

    								<td>
    								<?php

    								$found++;

    								if ($hora = strtotime($detalles["horario"])){

    								  echo  date("H:i",$hora);

    								}else echo $detalles["horario"];


    								?>
    								</td>
    							<?php endif;?>

							<?php endforeach;?>

									<?php if(!$found):?>
										<td>--</td>
									<?php endif;?>

						<?php endforeach;?>


				</tr>
				<?php endforeach;?>
			<?php endforeach; ?>



		</tbody>

	</table>

</div>
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>