<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 26 Abril]	
	-- País: México
	-- Objetivo: Formulario para registrar un nuevo usuario
	-- Última Modificación: [Abril, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	include ("../../php/Funciones.php");	
?>
<p>&nbsp;</p>
<form class="form-style" id="Frm_Registro">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4">NUEVO PROGRAMA ACAD&Eacute;MICO</th>
        </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej" colspan="3">
				<label> *Nombre del Programa</label>
			</td>
			<td class="cuej">
				<label>*Abreviatura</label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej" colspan="3">
				<input type = "text" name = "Nombre_Carrera" id = "Nombre_Carrera" value = "" class="campo Solo_Letras" size="80"/>
			</td>
			<td class="cuej">
				<input type = "text" name = "Abreviatura" id = "Abreviatura" value = "" class="campo Solo_Letras" maxlength="25"/>
			</td>		
		 </tr>
		 <tr>
			<td colspan="2" class="cuej">
				<label>*Tipo de Carrera</label>
			</td>
			<td colspan="2" class="cuej"></td>
		 </tr>
		 <tr>
			<td colspan="2" class="cuej">
				<select id="id_Carrera_Tipo" name="id_Carrera_Tipo" class="campo">
					<option value="">&nbsp;</option>
					<option value="1">LICENCIATURA</option>
					<option value="2">MAESTR&Iacute;A</option>
					<option value="3">DOCTORADO</option>
				</select>
			</td>
			<td colspan="2" class="cuej"></td>
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