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



	    $inicio = $inicio->format('Y-m-d');

	    $fin = $fin->format('Y-m-d');


	$sql = "SELECT cap.*,
                    (Select car.carrera from carreras car
                            where car.id_carrera =  cap.id_topico_interes limit 1) as carrera,
                                 (Select pa.paisnombre from pais pa where pa.id =  cap.pais limit 1) as paisdesc,
                                    (SELECT edo.estadonombre FROM estado edo where edo.id =  cap.estado limit 1) as estadodesc
                                FROM captacion cap where id_empleado = $id_usuario AND  CAST(captacion_fecha_alta AS DATE) between CAST( '$inicio' AS DATE) AND CAST( '$fin' AS DATE) ; ";
	mysqli_query($conexion, "SET NAMES 'utf8'");

	$results = mysqli_query($conexion,$sql);


?>


<h4>
	 Resultados de la busqueda.
</h4>
<hr />
<div class="table-responsive">
	<table id="tbl_captacion" class="table  table-sm table-hover" style="width:100%">
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
				<td><?php echo


				date('d/m/Y h:i' , strtotime($row["captacion_fecha_alta"]) ); ?></td>


				<td>
					<?php echo  $estatusNuevo; ?>


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
