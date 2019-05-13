

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

	mysqli_query($conexion, "SET NAMES 'utf8'");

	$sql = "SELECT * FROM registro_actividad where id = $id;";

	$modelResult = mysqli_query($conexion,$sql);

	$model = @mysqli_fetch_assoc($modelResult);

	$id_usuario =  $model["id_usuario"];

	$nombre= $model["nombre"];
	$persona = $model["persona"];
	$estatus = $model["estatus"];
	$descripcion = $model["descripcion"];
	$avance = $model["avance"]? date( 'd/m/Y', strtotime($model["avance"]) ) : null ;
	$final = $model["final"]? date( 'd/m/Y', strtotime($model["final"]) ) : null ;


?>
<form id="frmRegistro">
	<table  class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="4">Ver registro de actividad</th>

			</tr>
		</thead>
		<tbody>

			<tr>
				<td class="cuej" colspan="2">
					<div class="form-group">
                                <label for="nombre">* Nombre de la actividad</label>
                                <input readonly="readonly" value="<?php echo $nombre;?>" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingrese valor">
                                <small id="nombreHelp" class="form-text text-muted">* Nombre de la actividad que se realizo</small>
                    </div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
                                <label for="persona">Persona que solicita</label>
                                <input readonly="readonly" value="<?php echo $persona;?>" class="form-control" id="persona" name="persona" aria-describedby="personaHelp" placeholder="Ingrese valor">
                                <small id="personaHelp" class="form-text text-muted">Persona que solicita la actividad</small>
                    </div>
				</td>



			</tr>

			<tr>
				<td class="cuej">
					<div class="form-group">
    					<label for="avance">* Fecha avance</label>
                        <input readonly="readonly" value="<?php echo $avance;?>" class="form-control" name="avance" id="avance" aria-describedby="avanceHelp" placeholder="Clic para ingresar valor">
                        <small id="avanceHelp" class="form-text text-muted">*Fecha avande de la actividad</small>
                      </div>
				</td>
				<td class="cuej">
					<div class="form-group">
    					<label for="final">* Fecha final</label>
                        <input readonly="readonly" value="<?php echo $final;?>" class="form-control" name="final" id="final" aria-describedby="finalHelp" placeholder="Clic pata ingresar valor">
                        <small id="finalHelp" class="form-text text-muted">*Fecha final de la actividad</small>
                      </div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
                      <label  for="estatus">Estatus</label>
                      <select disabled="disabled" class="form-control" id="estatus" name ="estatus" aria-describedby="estatusHelp">
                        <option value="1" <?php echo ($estatus === "1") ? 'selected': ''; ?> >Iniciada</option>
                        <option value="2" <?php echo ($estatus === "2") ? 'selected': ''; ?> >Finalizada</option>
                      </select>
                      <small id="estatusHelp" class="form-text text-muted">Estatus en que se encuentra la actividad</small>

                    </div>
				</td>
				<td></td>

			</tr>

			<tr>

				<td class="cuej" colspan="4">
					<div class="form-group">
    					<label for="descripcion">Descripción de la actividad</label>
                        <textarea readonly="readonly" class="form-control" name="descripcion" id="descripcion" aria-describedby="comentariosHelp" placeholder="Ingrese valor" > <?php echo $descripcion;?> </textarea>
                        <small id="descripcionHelp" class="form-text text-muted">Descripción de la actividad</small>
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
				<th class="cuej" colspan="4">
				<input type="hidden" name="id" value="<?php echo $model["id"]?>">
				</th>
			</tr>
		</tfoot>
	</table>

</form>