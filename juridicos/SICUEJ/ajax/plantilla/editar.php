

<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Octubre, 20 2019]
	-- País: México
	-- Objetivo: Formulario de Registro de nueva plantilla
	-- Última Modificación: [Octubre, 20 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/


	include ("../../php/Funciones.php");

    $id  = $_REQUEST['id'];

	$sql = "SELECT * FROM tbl_plantilla WHERE ID = $id; ";

	mysqli_query($conexion, "SET NAMES 'utf8'");

	$results = mysqli_query($conexion,$sql);

	$row = @mysqli_fetch_assoc($results);


	if (!$row){

	    $_SESSION["PLANTILLA_ERROR"]  = "No se encuentra la plantilla solicitada";

	   header( "Location: /SICUEJ/ERP/plantilla" );

	}

?>
<form id="frmPlantilla"  enctype="multipart/form-data" method="POST" action="/SICUEJ/ajax/plantilla/guardar.php">
	<table  class="cuej"  style="width: 100%;">
		<thead>
			<tr>
				<th class="cuej" colspan="4">Editar plantilla de correo ID []</th>
			</tr>

		</thead>
		<tbody>

			<tr  style="padding-top: 100px;">
				<td class="cuej" colspan="3">
					<div class="form-group ">
                                <label for="nombre">* Alias</label>
                                <input  value="<?= $row['nombre']; ?>" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingrese valor">
                                <!-- <small id="nombreHelp" class="form-text text-muted">* Nombre completo del cliente</small>  -->

                    			<input name ="id" type="hidden" value="<?= $row['id']; ?>" />
                    </div>
				</td>


				<td class="cuej" colspan="1">
					<div class="form-group">
                                <label for="edad">Documento: <?= $row['nombre_archivo']; ?></label>
                                <input  class="form-control" type="file"  name="documento" >

                              <!--   <small id="edadHelp" class="form-text text-muted">Edad del cliente</small>  -->
                    </div>
				</td>

			</tr>
			<tr>
				<td class="cuej" colspan="3">
					<div class="form-group">
    					<label for="cuenta">Asunto correo</label>
                        <input value="<?= $row['asunto']; ?>" class="form-control" name="asunto" id="asunto" aria-describedby="cuentaHelp" placeholder="Ingrese valor">
                     <!--    <small id="cuentaHelp" class="form-text text-muted">Cuenta de red social ej. @usuario</small> -->
                      </div>
				</td>


				<td class="cuej" colspan="1">
					<div class="form-group">
                      <label  for="medio">Disponible</label>
                      <select class="form-control" id="estatus" name ="estatus" aria-describedby="medioHelp">
                        <option value="1"  <?= $row['estatus'] == "1"  ? "selected":"" ; ?>>SI</option>
                        <option value="2" <?= $row['estatus'] == "2"  ? "selected":"" ; ?>>NO</option>

                      </select>
                   <!--   <small id="medioHelp" class="form-text text-muted">Tipo de red social preferida del cliente</small> -->

                    </div>
				</td>



			</tr>

			<tr>
				<td colspan="4" class="cuej"><hr /></td>
			</tr>





				<tr>

				<td class="cuej" colspan="4">
					<div class="form-group">
    					<label for="comentarios">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="comentarios" aria-describedby="comentariosHelp" placeholder="Ingrese valor" >

                        	<?= $row['descripcion']; ?>
                        </textarea>
                      <!--   <small id="comentariosHelp" class="form-text text-muted">Comentarios adicionales que puedan dar ayuda al proceso</small> -->
                      </div>
				</td>



			</tr>
			<tr>
				<td colspan="4" class="cuej">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4" class="cuej"><hr /></td>
			</tr>
			<tr>
				<td colspan="4" class="cuej"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="4"></th>
			</tr>
		</tfoot>
	</table>
	<p align="center">
		<input class="button" type="button" id = "btnPost" name = "btnPost"  value = "Guardar" />
		<input class="button" type="button" id = "btnCancel" name = "btnCancel"  value = "Cancelar" />
	</p>
</form>