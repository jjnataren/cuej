<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2016]	
	-- País: México
	-- Objetivo: Formulario para registrar un nuevo plan de estudio
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	include ("../../php/Funciones.php");
	
	$sql_carrera = "SELECT carrera FROM carreras WHERE id_carrera = '".$_POST["id_Carrera"]."';";
	$resultado_carrera = mysqli_query($conexion, $sql_carrera);
	$fila_carrera = mysqli_fetch_array($resultado_carrera);
?>
<form class="form-style" id="Frm_Registro_Plan">
	<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4">NUEVO PLAN DE ESTUDIO PARA <?php echo utf8_encode($fila_carrera["carrera"]); ?></th>
          </tr>
     </thead>
     <tbody>
	 <tr>
		<td class="cuej" colspan="2">
          	<label>* Plan de Estudio<span id="lbl_Plan_Estudio"></span></label>                   
		</td>
        <td>
			<label>* Acuerdo SEP<span id="lbl_Acuerdo_SEP"></span></label>
		</td>
        <td>
          	<label>* Clave SEP<span id="lbl_Clave_SEP"></span></label>
        </td>
	 </tr>
     <tr>
		<td class="cuej" colspan="2">
          	<input class="campo" type = "text" name = "Nombre_Plan_Estudio" id = "Nombre_Plan_Estudio" value = "" />
		</td>
        <td>
          	<input class="campo" type = "text" name = "Acuerdo_Sep" id = "Acuerdo_Sep" value = "" />
        </td>
        <td>
			<input class="campo" type = "text" name = "Clave_Sep" id = "Clave_Sep" value = ""  />
        </td>
	 </tr>
	 <tr>
		<td class="cuej" colspan="2">
          	<label>* Antecedente<span id="lbl_Antecedente"></span></label>
		</td>
        <td>
          	<label>* Duraci&oacute;n<span id="lbl_Duracion"></span></label>
        </td>
        <td>
          	<label>* Cr&eacute;ditos<span id="lbl_Creditos"></span></label>
        </td>
	 </tr>
     <tr>
		<td class="cuej" colspan="2">
          	<select name="Antecedente" id="Antecedente" class="campo" >
				<option value="" selected >&nbsp;</option>
                <option value="BACHILLERATO" >BACHILLERATO</option>
                <option value="LICENCIATURA" >LICENCIATURA</option>
                <option value="MAESTRIA" >MAESTR&Iacute;A</option>
            </select>
		</td>
        <td>
          	<input class="campo Solo_Numeros" type = "text" name = "Duracion" id = "Duracion" value = "" />
        </td>
        <td>
          	<input class="campo Solo_Numeros" type = "text" name = "Creditos" id = "Creditos" value = ""/>
        </td>
	 </tr>
	 <tr>
		<td class="cuej" colspan="4">
          	<label>* Fecha<span id="lbl_Fecha"></span></label>
		</td>          
	 </tr>
     <tr>
		<td class="cuej" colspan="4">
          	<input class="campo" type = "text" name = "Fecha" id = "Fecha" value = "" size="40" />
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
	<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
	<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" />
</p>
</form>
