

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

?>
<form id="frmRegistro">
	<table  class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="4">Nuevo registro de actividad</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td class="cuej" colspan="2">
					<div class="form-group">
                                <label for="nombre">* Nombre de la actividad</label>
                                <input  class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingrese valor">
                                <small id="nombreHelp" class="form-text text-muted">* Nombre de la actividad que se realizo</small>
                    </div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
                                <label for="persona">Persona que solicita</label>
                                <input  class="form-control" id="persona" name="persona" aria-describedby="personaHelp" placeholder="Ingrese valor">
                                <small id="personaHelp" class="form-text text-muted">Persona que solicita la actividad</small>
                    </div>
				</td>



			</tr>

			<tr>
				<td class="cuej">
					<div class="form-group">
    					<label for="avance">* Fecha avance</label>
                        <input  class="form-control" name="avance" id="avance" aria-describedby="avanceHelp" placeholder="Clic para ingresar valor">
                        <small id="avanceHelp" class="form-text text-muted">*Fecha avande de la actividad</small>
                      </div>
				</td>
				<td class="cuej">
					<div class="form-group">
    					<label for="final">* Fecha final</label>
                        <input class="form-control" name="final" id="final" aria-describedby="finalHelp" placeholder="Clic pata ingresar valor">
                        <small id="finalHelp" class="form-text text-muted">*Fecha final de la actividad</small>
                      </div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
                      <label  for="estatus">Estatus</label>
                      <select class="form-control" id="estatus" name ="estatus" aria-describedby="estatusHelp">
                        <option value="1" selected="selected">Iniciada</option>
                        <option value="2">Finalizada</option>
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
                        <textarea  class="form-control" name="descripcion" id="descripcion" aria-describedby="comentariosHelp" placeholder="Ingrese valor" ></textarea>
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
				<th class="cuej" colspan="4"></th>
			</tr>
		</tfoot>
	</table>
	<p align="center">
		<input class="button" type="button" id = "btnInsertar" name = "btnInsertar"  value = "Registrar" />
		<input class="button" type="button" id = "btnCancelar" name = "btnCancelar"  value = "Cancelar" />
	</p>
</form>