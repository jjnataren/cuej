<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 20 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Alumno
	-- Última Modificación: [Mayo, 20 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
?>
<form id="Frm_Alumnos_Nuevo">
	<table align="left" width="100%" class="cuej">
		<thead>
			<tr>
				<th class="cuej" colspan="3">NUEVO ALUMNO</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="cuej">
					<label>* Nombre <span id="lbl_Nombre"></span></label>                   
				</td>			
				<td class="cuej">
					<label>* Apellido Paterno<span id="lbl_Apellido_Paterno"></span></label>                   
				</td>
				<td class="cuej">
					<label>* Apellido Materno <span id="lbl_Apellido_Materno"></span></label>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<input type="text" class="campo Solo_Letras" id="Nombre" name="Nombre"  value=""/>
				</td>			
				<td class="cuej">
					<input type="text" class="campo Solo_Letras" id="Apellido_Paterno" name="Apellido_Paterno"  value=""/>
				</td>
				<td class="cuej">
					<input type="text" class="campo Solo_Letras" id="Apellido_Materno" name="Apellido_Materno"  value=""/>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>CURP <span id="lbl_CURP"></span></label>                   
				</td>
				<td class="cuej">
					<label>RFC<span id="lbl_RFC"></span></label>                   
				</td>
				<td class="cuej"></td>
			</tr>
			<tr>
				<td class="cuej">
					<input type="text" class="campo" id="CURP" name="CURP"  value=""/>
				</td>
				<td class="cuej">
					<input type="text" class="campo" id="RFC" name="RFC"  value=""/>
				</td>
				<td class="cuej"></td>
			</tr>
			<tr>
				<td colspan="3" class="cuej"></td>
			</tr>
			<tr>
				<td colspan="3" class="cuej"><hr /></td>
			</tr>
			<tr>
				<td class="cuej">
					<label>Codigo Postal <span id="lbl_Codigo_Postal"></span></label>                   
				</td>
				<td class="cuej">
					<label>Estado<span id="lbl_Estado"></span></label>                   
				</td>
				<td class="cuej">
					<label>Municipio<span id="lbl_Municipio"></span></label>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<input type="text" class="campo" id="Codigo_Postal" name="Codigo_Postal"  value=""/>
				</td>
				<td class="cuej">
					<input type="text" class="campo" id="Estado" name="Estado"  value="" readonly />
				</td>
				<td class="cuej">
					<input type="text" class="campo" id="Municipio" name="Municipio"  value="" readonly />
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<label>* Colonia <span id="lbl_id_Codigo_Postal"></span></label>                   
				</td>
				<td class="cuej" colspan="2">
					<label>* Calle<span id="lbl_Calle"></span></label>                   
				</td>			
			</tr>
			<tr>
				<td class="cuej">
					<select class="campo" name="id_Codigo_Postal" id="id_Codigo_Postal">
					</select>                   
				</td>
				<td class="cuej" colspan="2">
					<input type="text" class="campo" id="Calle" name="Calle"  value="" size="61"/>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="cuej"></td>
			</tr>
			<tr>
				<td colspan="3" class="cuej"><hr /></td>
			</tr>
			<tr>
				<td class="cuej">
					<label>* Tel&eacute;fono Casa <span id="lbl_Telefono_Casa"></span></label>                   
				</td>
				<td class="cuej">
					<label>Tel&eacute;fono Celular <span id="lbl_Telefono_Celular"></span></label>                   
				</td>
				<td class="cuej">
					<label>* Correo Electr&oacute;nico <span id="lbl_Correo_Electronico"></span></label>
				</td>
			</tr>
			<tr>
				<td class="cuej">
					<input type="text" class="campo" id="Telefono_Casa" name="Telefono_Casa"  value=""/>
				</td>
				<td class="cuej">
					<input type="text" class="campo" id="Telefono_Celular" name="Telefono_Celular"  value=""/>
				</td>
				<td class="cuej">
					<input type="text" class="campo" id="Correo_Electronico" name="Correo_Electronico"  value=""/>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="cuej">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" class="cuej"><hr /></td>
			</tr>
			<tr>
				<td colspan="3" class="cuej"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th class="cuej" colspan="3"></th>
			</tr>
		</tfoot>
	</table>
	<p align="center">
		<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
		<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" />
	</p>
</form>