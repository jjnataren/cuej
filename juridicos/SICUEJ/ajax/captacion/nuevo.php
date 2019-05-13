

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

	mysqli_query($conexion, "SET NAMES 'utf8'");


	$sql = "select * from pais order by paisnombre;";

	$results = mysqli_query($conexion,$sql);


	$sql = "select * from estado where  ubicacionpaisid = 42 order by estadonombre;";

	$resultsEstado = mysqli_query($conexion,$sql);


	$sql = "SELECT * FROM sicuej.carreras order by carrera;";

	$resultsCarrera = mysqli_query($conexion,$sql);

?>
<form id="Frm_captacion">
	<table  class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="4">Nuevo proceso de captación</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td class="cuej">
					<div class="form-group">
                                <label for="nombre">* Nombre cliente</label>
                                <input  class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingrese valor">
                                <small id="nombreHelp" class="form-text text-muted">* Nombre completo del cliente</small>
                    </div>
				</td>
				<td class="cuej">
					<div class="form-group col-md-8">
                                <label for="edad">Edad</label>
                                <input  class="form-control" id="edad" name="edad" aria-describedby="edadHelp" placeholder="Ingrese valor">
                                <small id="edadHelp" class="form-text text-muted">Edad del cliente</small>
                    </div>
				</td>
				<td class="cuej">
					<div class="form-group">
                      <label  for="grado">Grado de estudios</label>
                      <select class="form-control" id="grado" name ="grado" aria-describedby="gradoHelp">
                        <option selected>Seleccione</option>
                        <option value="1">Preparatoria</option>
                        <option value="2">Licenciatura</option>
                        <option value="3">Posgrado</option>
                        <option value="4">Maestria</option>
                        <option value="5">Doctorado</option>
                      </select>
                      <small id="gradoHelp" class="form-text text-muted">Último grado</small>

                    </div>
				</td>
				<td class="cuej">
				<div class="form-group">
                                <label for="telefono">Teléfono de contacto</label>
                                <input  class="form-control" name="telefono" id="telefono" aria-describedby="telefonoHelp" placeholder="Ingrese valor">
                                <small id="telefonoHelp" class="form-text text-muted">* Telefono del cliente para contacto</small>
                    </div>
                </td>

			</tr>

			<tr>
				<td class="cuej">
					<div class="form-group">
    					<label for="correo">* Correo Electronico</label>
                        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="correoHelp" placeholder="Ingrese valor">
                        <small id="correoHelp" class="form-text text-muted">*Ingrese un correo electronico valido</small>
                      </div>
				</td>
				<td class="cuej">
					<div class="form-group">
                      <label  for="medio">Tipo de medio social</label>
                      <select class="form-control" id="medio" name ="medio" aria-describedby="medioHelp">
                        <option selected>Seleccione</option>
                        <option value="1">Face book</option>
                        <option value="2">Twiterr</option>
                        <option value="3">Instagram</option>
                      </select>
                      <small id="medioHelp" class="form-text text-muted">Tipo de red social preferida del cliente</small>

                    </div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
    					<label for="cuenta">Cuenta</label>
                        <input  class="form-control" name="cuenta" id="cuenta" aria-describedby="cuentaHelp" placeholder="Ingrese valor">
                        <small id="cuentaHelp" class="form-text text-muted">Cuenta de red social ej. @usuario</small>
                      </div>
				</td>


			</tr>
			<tr>
				<td colspan="4" class="cuej"></td>
			</tr>
			<tr>
				<td colspan="4" class="cuej"><hr /></td>
			</tr>

			<tr>
				<td class="cuej">
					<div class="form-group">
                      <label  for="pais">País</label>
                      <select class="form-control" id="pais"  name ="pais" aria-describedby="paisHelp">


						<?php

            			while ($row = @mysqli_fetch_assoc($results))
            			{?>

						  <option value="<?php echo $row["id"];?>"  <?php echo ($row["id"] == 42)?  'selected="selected"':  ''?>> <?php echo $row['paisnombre'];?></option>

					<?php }?>
					</select>
					<small id="paisHelp" class="form-text text-muted">País de origen del cliente.</small>

					</div>
				</td>
				<td class="cuej">
				<div class="form-group">
                      <label  for="estado">Estado</label>
                      <select class="form-control" id="estado"  name ="estado" aria-describedby="estadoHelp">


					<?php

            			while ($row = @mysqli_fetch_assoc($resultsEstado))
            			{?>

						  <option value="<?php echo $row["id"];?>"  <?php echo ($row["id"] == 1741)?  'selected="selected"':  ''?>> <?php echo $row['estadonombre'];?></option>

					<?php }?>

				</select>
						<small id="estadoHelp" class="form-text text-muted">Estado de origen del cliente.</small>
				</div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
    					<label for="localidad">Localidad</label>
                        <input  class="form-control" name="localidad" id="localidad" aria-describedby="localidadHelp" placeholder="Ingrese valor">
                        <small id="localidadHelp" class="form-text text-muted">Localidad de origen del cliente</small>
                      </div>
				</td>

			</tr>

			<tr>
				<td colspan="4" class="cuej"></td>
			</tr>
			<tr>
				<td colspan="4" class="cuej"><hr /></td>
			</tr>

			<tr>

				<td class="cuej" colspan="2">
					<div class="form-group">
    					<label for="comentarios">Comentarios adicionales</label>
                        <textarea  class="form-control" name="comentarios" id="comentarios" aria-describedby="comentariosHelp" placeholder="Ingrese valor" ></textarea>
                        <small id="comentariosHelp" class="form-text text-muted">Comentarios adicionales que puedan dar ayuda al proceso</small>
                      </div>
				</td>

				<td class="cuej" colspan="2">

				<div class="form-group">
                      <label  for="topico">* Topico de interes</label>
                      <select class="form-control" id="topico"  name ="topico" aria-describedby="topicoHelp">



					<?php

            			while ($row = @mysqli_fetch_assoc($resultsCarrera))
            			{?>

						  <option value="<?php echo $row["id_carrera"];?>" > <?php echo $row['carrera'];?></option>

					<?php }?>

				</select>
				     <small id="topicoHelp" class="form-text text-muted">Curso de inters del cliente</small>

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
		<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
		<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" />
	</p>
</form>