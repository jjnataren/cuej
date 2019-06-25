

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


	$sql = "select * from pais order by paisnombre;";

	$paises = mysqli_query($conexion,$sql);


	$sql = "select * from estado where  ubicacionpaisid = 42 order by estadonombre;";

	$estados = mysqli_query($conexion,$sql);


	$sql = "SELECT * FROM carreras order by carrera;";

	$resultsCarrera = mysqli_query($conexion,$sql);

	$sql = "SELECT * FROM captacion where id = $id LIMIT 1";

	$modelResult = mysqli_query($conexion,$sql);

	$model = @mysqli_fetch_assoc($modelResult);

	$id_usuario =  $_SESSION["id_Usuario"];


	$nombre=  $model["cliente_nombre"] ;
	$edad=  $model["cliente_fecha_nacimiento"];

	$birthDateBack = $edad ;

	if ($edad )
	    $birthDate = date_diff(date_create('1970-02-01'), date_create('today'))->y;
	    else
	        $birthDate = null;
    $telefono= $model["cliente_telefono"];
    $correo= $model["cliente_correo_electronico"];
    $medio= $model["tipo_medio_contacto"];
    $cuenta= $model["medio_contacto"];
    $pais= $model["pais"];
    $estado= $model["estado"];
    $localidad= $model["localidad"];
    $topico= $model["id_topico_interes"];
    $comentarios= $model["comentarios"];
    $grado= $model["grado_estudios"];
    $fechaCaptura = $model["captacion_fecha_alta"];
    $estatus = $model["estatus"];



?>
<form id="Frm_captacion">
	<table  class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="4">Actualizar proceso de captación ID [<?php echo $id;?>]</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td class="cuej">
					<div class="form-group">
								<input name="id" value ="<?php echo $id;?>" type="hidden"/>
                                <label for="nombre">* Nombre cliente</label>
                                <input value ="<?php echo $nombre;?>" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingrese valor">
                              <!--   <small id="nombreHelp" class="form-text text-muted">* Nombre completo del cliente</small>  -->
                    </div>
				</td>
				<td class="cuej">
					<div class="form-group col-md-8">
                                <input name="edadBack" value ="<?php echo $birthDate;?>" type="hidden"/>
                                <input name="birthDateBack" value ="<?php echo $birthDateBack;?>" type="hidden"/>

                                <label for="edad">Edad</label>
                                <input value ="<?php echo $birthDate;?>"  class="form-control" id="edad" name="edad" aria-describedby="edadHelp" placeholder="Ingrese valor">
                             <!--    <small id="edadHelp" class="form-text text-muted">Edad del cliente</small> -->
                    </div>
				</td>
				<td class="cuej">
					<div class="form-group">
                      <label  for="grado">Grado de estudios</label>
                      <select class="form-control" id="grado" name ="grado" aria-describedby="gradoHelp">
                        <option <?php echo ($grado)?'':'selected'; ?>>Seleccione</option>
                        <option value="1" <?php echo ($grado=="1")?'selected':''; ?>>Preparatoria</option>
                        <option value="2" <?php echo ($grado=="2")?'selected':''; ?>>Licenciatura</option>
                        <option value="3" <?php echo ($grado=="3")?'selected':''; ?>>Especialidad</option>
                        <option value="4" <?php echo ($grado=="4")?'selected':''; ?>>Maestria</option>
                        <option value="5" <?php echo ($grado=="5")?'selected':''; ?>>Doctorado</option>
                      </select>
                    <!--   <small id="gradoHelp" class="form-text text-muted">Último grado</small> -->

                    </div>
				</td>
				<td class="cuej">
				<div class="form-group">
                                <label for="telefono">Teléfono de contacto</label>
                                <input  value ="<?php echo $telefono;?>" class="form-control" name="telefono" id="telefono" aria-describedby="telefonoHelp" placeholder="Ingrese valor">
                               <!--  <small id="telefonoHelp" class="form-text text-muted">* Telefono del cliente para contacto</small> -->
                    </div>
                </td>

			</tr>

			<tr>
				<td class="cuej">
					<div class="form-group">
    					<label for="correo">* Correo Electronico</label>
                        <input value ="<?php echo $correo;?>" type="email" class="form-control" name="correo" id="correo" aria-describedby="correoHelp" placeholder="Ingrese valor">
                    <!--     <small id="correoHelp" class="form-text text-muted">*Ingrese un correo electronico valido</small> -->
                      </div>
				</td>
				<td class="cuej">
					<div class="form-group">
                      <label  for="medio">Red social más frecuentada</label>
                      <select class="form-control" id="medio" name ="medio" aria-describedby="medioHelp">
                        <option <?php echo ($medio)?'':'selected'; ?>>Seleccione</option>
                        <option value="1"  <?php echo ($medio=="1")?'selected':'';?>>Facebook</option>
                        <option value="2" <?php echo ($medio=="2")?'selected':'';?>>Twiterr</option>
                        <option value="3" <?php echo ($medio=="3")?'selected':'';?>>Página WEB</option>
                        <option value="4" <?php echo ($medio=="4")?'selected':'';?>>Folleto</option>
                         <option value="5" <?php echo ($medio=="5")?'selected':'';?>>Otros</option>
                      </select>
                  <!--     <small id="medioHelp" class="form-text text-muted">Tipo de red social preferida del cliente</small> -->

                    </div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
    					<label for="cuenta">Cuenta</label>
                        <input value="<?php echo $cuenta;?>"  class="form-control" name="cuenta" id="cuenta" aria-describedby="cuentaHelp" placeholder="Ingrese valor">
                     <!--    <small id="cuentaHelp" class="form-text text-muted">Cuenta de red social ej. @usuario</small> -->
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
                      <label  for="pais">País de recidencia</label>
                      <select class="form-control" id="pais"  name ="pais" aria-describedby="paisHelp">


						<?php

            			while ($row = @mysqli_fetch_assoc($paises))
            			{?>

						  <option value="<?php echo $row["id"];?>"  <?php echo ($row["id"] == $pais)?  'selected="selected"':  ''?>> <?php echo $row['paisnombre'];?></option>

					<?php }?>
					</select>
				<!-- 	<small id="paisHelp" class="form-text text-muted">País de origen del cliente.</small> -->

					</div>
				</td>
				<td class="cuej">
				<div class="form-group">
                      <label  for="estado">Estado</label>
                      <select class="form-control" id="estado"  name ="estado" aria-describedby="estadoHelp">


					<?php

            			while ($row = @mysqli_fetch_assoc($estados))
            			{?>

						  <option value="<?php echo $row["id"];?>"  <?php echo ($row["id"] == $estado)?  'selected="selected"':  ''?>> <?php echo $row['estadonombre'];?></option>

					<?php }?>

				</select>
						<!-- <small id="estadoHelp" class="form-text text-muted">Estado de origen del cliente.</small> -->
				</div>
				</td>
				<td class="cuej" colspan="2">
					<div class="form-group">
    					<label for="localidad">Localidad</label>
                        <input value="<?php echo $localidad; ?>"  class="form-control" name="localidad" id="localidad" aria-describedby="localidadHelp" placeholder="Ingrese valor">
                       <!--  <small id="localidadHelp" class="form-text text-muted">Localidad de origen del cliente</small> -->
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
                        <textarea   class="form-control" name="comentarios" id="comentarios" aria-describedby="comentariosHelp" placeholder="Ingrese valor" >

                        	 <?php echo trim($comentarios);?>
                        </textarea>
                     <!--    <small id="comentariosHelp" class="form-text text-muted">Comentarios adicionales que puedan dar ayuda al proceso</small> -->
                      </div>
				</td>

				<td class="cuej" colspan="2">

				<div class="form-group">
                      <label  for="topico">* Topico de interés</label>
                      <select class="form-control" id="topico"  name ="topico" aria-describedby="topicoHelp">



					<?php

            			while ($row = @mysqli_fetch_assoc($resultsCarrera))
            			{?>

						  <option value="<?php echo $row["id_carrera"];?>" <?php echo ($row["id_carrera"] == $topico)?  'selected="selected"':  ''?> > <?php echo $row['carrera'];?></option>

					<?php }?>

					 <option value="99>" >Ecex</option>

				</select>
				   <!--   <small id="topicoHelp" class="form-text text-muted">Curso de inters del cliente</small> -->

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
		<input class="button" type="button" id = "btnActualizar" name = "Btn_Nuevo_Registrar"  value = "Actualizar" />
		<input class="button" type="button" id = "btnRegresar" name = "Btn_Cancelar"  value = "Regresar" />
	</p>
</form>