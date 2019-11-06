

<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Mayo, 20 2019]
	-- País: México
	-- Objetivo: Envio de informacion de email
	-- Última Modificación: [Mayo, 20 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();

	include ("../../php/Funciones.php");



	$clientes = $_POST["clientes"];

	$clientes = json_decode($clientes, true);


	$sql = "SELECT * FROM tbl_plantilla WHERE estatus = 1;";

    mysqli_query($conexion, "SET NAMES 'utf8'");

	$results = mysqli_query($conexion, $sql);


?>
<form id="Frm_captacion" enctype="multipart/form-data" method="POST" action="/SICUEJ/ajax/captacion/enviar.php" >
	<table  class="cuej" style="width:100%" >
		<thead>
			<tr>
				<th class="cuej" colspan="4">Contactar clientes  proceso de captación</th>
			</tr>
		</thead>
		<tbody>

			<tr>
					<td class="cuej" colspan="4">
    					<table class="table table-hover table-bordered">

    						<thead>
    							<tr>
    								<th>
    									ID proceso
    								</th>
    								<th>
    									Cliente
    								</th>
    								<th>
    									Interés
    								</th>
    								<th>
    									correo
    								</th>
    							</tr>
    						</thead>

    						<tbody>
    							<?php
    							foreach ($clientes as $key => $value){

    							    if ( is_numeric($key) ) {


    							        $idProceso =  $value[0];

    							        preg_match("/[0-9]+/", $idProceso,$matches,PREG_OFFSET_CAPTURE,0);

    							        $idProceso = $matches[0][0];


    							 ?>



								<tr>

								<td>
    								<?php echo $idProceso;?>
    								<input value="<?php echo $idProceso;?>" name="id[]" type="hidden" />
								</td>

								<td>
    								<?php echo $value[4];?>
    								<input value="<?php echo $value[4];?>" name="nombre[]" type="hidden" />
								</td>

								<td>
    								<?php echo $value[7];?>
    								<input value="<?php echo $value[7];?>" name="topico[]" type="hidden" />
								</td>

								<td>
									<?php echo $value[5];?>
									<input value="<?php echo $value[5];?>" name="correo[]" type="hidden" />
								</td>

								</tr>


    							<?php }
    							}?>
    						</tbody>

    					</table>
					</td>
			</tr>




			<tr>

				<td class="cuej">

					<h4>Plantilla</h4>

			    </td>

                <td class="cuej" colspan="2" align="right">

					<select class="form-control" id="plantilla"  name ="plantilla" aria-describedby="plantillaHelp">

						<option selected>Seleccione</option>

						<?php

            			while ($row = @mysqli_fetch_assoc($results))
            			{?>


						  <option value="<?php echo $row["id"];?>"> <?php echo $row['nombre'];?></option>

						<?php }?>



					</select>


                </td>

                <td>
					<div id="divVer">
					<!-- 	<a href="javascript:verAdmin(<?php echo $row['id'];?>)"  class="btn" data-toggle="modal" data-target="#exampleModal" taskid  = "<?php echo $row['id'];?>" ><?php echo $row["id"]; ?></a>  -->
					</div>
                </td>


			</tr>


		<tr>
				<td class="cuej" colspan="4">

					<h4>Mensaje personalizado</h4>

				</td>
		</tr>

			<tr>
				<td class="cuej" colspan="4">
					 <textarea name="bodyText" style="visibility: hidden; display: none;"></textarea>
                </td>

			</tr>

		<tr>
				<td class="cuej" colspan="4">

					<h4>Archivos adjuntos</h4>

				</td>

		</tr>

		<tr>
			<td class="cuej" colspan="2">


                        <input type="file" class="form-control" name="file1" />

			</td>

			<td class="cuej" colspan="2" >

						 <input type="file" class="form-control"   name="file2" />

				</td>
		</tr>
		<tr>
			<td class="cuej" colspan="2">


                        <input type="file" class="form-control"   name="file3" />

			</td>

			<td class="cuej" colspan="2" >

						 <input type="file" class="form-control"  name="file4" >

				</td>
		</tr>

		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="4"></th>
			</tr>
		</tfoot>
	</table>
	<p align="center">
		<input class="button" type="submit" id="btnEnviar" value = "Enviar correo"/>
		<input class="button" type="button" id = "btnRegresar" name = "btnRegresar"  value = "Regresar" />
	</p>
</form>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="divPlantilla">
		Cargando ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>