<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 20 2019]
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Alumno
	-- Última Modificación: [Mayo, 20 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");

	$id= $_POST["id"];

	$sql = "SELECT * FROM files WHERE id_carrera = $id";

	mysqli_query($conexion, "SET NAMES 'utf8'");


	$results = mysqli_query($conexion,$sql);



	$sql = "SELECT * FROM carreras WHERE id_carrera = $id;";

    $resultCarrera = mysqli_query($conexion,$sql);


    $carrera =  @mysqli_fetch_assoc($resultCarrera);

?>

		<table  class="cuej" style="width: 100%;">
		<thead>
			<tr>
				<th class="cuej" colspan="4">Subir contenido a  <?php echo $carrera["carrera"]; ?> </th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="cuej" colspan="2">
					<input id="fileupload" type="file" class="form-control" name="files[]" data-url="/SICUEJ/lib/jfu/server/php/CustomUploadHandler.php" multiple>
				</td>
				<td>* Seleccione un archivo</td>
        </tr>

        </tbody>
        </table>


	<br />

	<table class="table table-sm table-hover" id="tblMediaFile">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>Tamaño</th>
				<th />
			</tr>
		</thead>
		<tbody>

		<?php


			while ($row = @mysqli_fetch_assoc($results))

			{
			    ?>

			<tr>

				<td>
					<?php if (strpos( strtolower($row["type"]), 'pdf') !== false):?>

					<i class="fa fa-file-pdf-o"></i>

					<?php elseif(strpos( strtolower( $row["type"] ), 'jpg') || strpos( strtolower( $row["type"]), 'jpeg')
					    || strpos( strtolower( $row["type"]), 'png') || strpos( strtolower( $row["type"]), 'gif')
					    ):?>


						<img alt="" src="/SICUEJ/lib/jfu/server/php/files/thumbnail/<?php echo $row["name"];?>" />

					<?php elseif (strpos( strtolower( $row["type"] ), 'word')):?>

						<i class="fa fa-file-word-o"></i>

						<?php elseif (strpos( strtolower( $row["type"] ), 'excel')):?>

						<i class="fa fa-file-excel-o"></i>

					<?php else:?>
						<i class="fa fa-file-o"></i>

					<?php endif;?>
					<a target="_blank" href="/SICUEJ/lib/jfu/server/php/files/<?php echo $row["name"];?>"><small> <?php echo $row["name"];?> </small></a>
				</td>
				<td><small> <?php echo $row["type"];?> </small></td>
				<td><small><?php echo $row["size"];?></small></td>
				<td><a class="btn btn-danger btn-sm" href="javascript:del(<?php echo $row["id"]?>)"><i class="fa fa-trash"></i></a></td>
			</tr>

			<?php }?>
		</tbody>
	 </table>

	 <p align="center">
		<input class="button" type="button" id = "btnRegresar" name = "btnRegresar"  value = "Regresar" />
	</p>