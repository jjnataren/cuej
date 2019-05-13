

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
    					<table class="table table-hover">

    						<thead>
    							<tr>
    								<th>
    									Id proceso
    								</th>
    								<th>
    									Cliente
    								</th>
    								<th>
    									Interes
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
    								<?php echo $value[3];?>
    								<input value="<?php echo $value[3];?>" name="nombre[]" type="hidden" />
								</td>

								<td>
    								<?php echo $value[7];?>
    								<input value="<?php echo $value[7];?>" name="topico[]" type="hidden" />
								</td>

								<td>
									<?php echo $value[4];?>
									<input value="<?php echo $value[4];?>" name="correo[]" type="hidden" />
								</td>

								</tr>


    							<?php }
    							}?>
    						</tbody>

    					</table>
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
		<input class="button" type="submit" value = "Enviar correo"/>
		<input class="button" type="button" id = "btnRegresar" name = "btnRegresar"  value = "Regresar" />
	</p>
</form>