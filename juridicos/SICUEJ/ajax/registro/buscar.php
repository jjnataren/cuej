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

	    $sql = "SELECT ra.* , (SELECT concat(nombre, ' ' , apellido_paterno,' ' ,apellido_materno)
                    FROM usuarios where id_usuario = ra.id_usuario) AS nombre_usuario FROM registro_actividad ra ORDER BY fecha_captura  LIMIT 100";


	}else{

	    $inicio = $inicio->format('Y-m-d');

	    $fin = $fin->format('Y-m-d');

    	$sql = "SELECT ra.* , (SELECT concat(nombre, ' ' , apellido_paterno,' ' ,apellido_materno) FROM usuarios where id_usuario = ra.id_usuario) AS nombre_usuario from  registro_actividad ra  where  CAST(fecha_captura AS DATE) between CAST( '$inicio' AS DATE) AND CAST( '$fin' AS DATE) order by fecha_captura desc";
	}
	mysqli_query($conexion, "SET NAMES 'utf8'");

	$results = mysqli_query($conexion,$sql);


?>



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