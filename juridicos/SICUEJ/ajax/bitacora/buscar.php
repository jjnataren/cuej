<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 21 2019]
	-- País: México
	-- Objetivo: Buscar horarios de los trabajadores
	-- Última Modificación: [Mayo, 21 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];



	$inicio = date_create_from_format('d/m/Y', isset ($_POST["inicio"])?$_POST["inicio"]:null);

	$fin = date_create_from_format('d/m/Y',  isset($_POST["fin"])?$_POST["fin"]:null);

	if(!$inicio || $inicio > $fin  ){

	    $sql = "select bh.*, (select nombre from usuarios where id_usuario = bh.id_empleado LIMIT 1) as nombre from bitacora_horario bh order by horario desc LIMIT 100";


	}else{



	    $inicio = $inicio->format('Y-m-d');

	    $fin = $fin->format('Y-m-d');

    	$sql = "select bh.*, (select nombre from usuarios where id_usuario = bh.id_empleado LIMIT 1) as nombre from bitacora_horario bh  where  CAST(horario AS DATE) between CAST( '$inicio' AS DATE) AND CAST( '$fin' AS DATE) order by horario desc";
	}
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



<div class="table-responsive">

	<form id="frmBitacora">

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

				<?php if(!count( $board )):?>

					<tr>
						<td colspan="<?php echo 3 + count( $eventos);?>">
							No se encontraron registros con los valores indicados.
						</td>

					</tr>
				<?php endif;?>

		</tbody>

	</table>

	</form>
</div>