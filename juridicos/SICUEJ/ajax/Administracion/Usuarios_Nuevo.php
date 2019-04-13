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
<form class="form-style" id="Frm_Registro">
<table align="left" width="800px" class="siup">
	<thead>
     	<tr>
          	<th class="siup" colspan="4">NUEVO USUARIO</th>
          </tr>
     </thead>
     <tbody>
     <tr>
		<td class="siup">
			<div class="frm_element">                    	
				<input type = "text" name = "Titulo" id = "Titulo" value = "" />
                    <span>Titulo</span>
               </div>
		</td>
		<td class="siup">
			<div class="frm_element">                    	
				<input type = "text" name = "Nombre_Usuario" id = "Nombre_Usuario" value = ""  />
                    <span>Nombre</span>
              </div>
		</td>
		<td class="siup">
			<div class="frm_element">
                <input type = "text" name = "Apellido_Paterno" id = "Apellido_Paterno" value = "" />
                <span>Apellido Paterno</span>
            </div>
		</td>
		<td class="siup">
			<div class="frm_element">
                <input type = "text" name = "Apellido_Materno" id = "Apellido_Materno" value = "" />
                <span>Apellido Materno</span>
            </div>
		</td>		
	</tr>
     <tr>
     	<td colspan="2" class="siup">
          	<div class="frm_element">
                    <input type = "text" name = "Area" id = "Area" value = "" />
                    <span>&Aacute;rea</span>
               </div>
          </td>
          <td colspan="2" class="siup">
          	<div class="frm_element">
                    <input type = "text" name = "Correo_Electronico" id = "Correo_Electronico" value = "" />
                    <span>Correo Electr&oacute;nico</span>
               </div>
          </td>
     </tr>
     <tr>
     	<td class="siup"></td>
          <td class="siup">
          	<div class="frm_element">
                    <input type = "text" name = "Usuario" id = "Usuario" value = "" />
                    <span>Nombre de Usuario</span>
               </div>
          </td>
          <td class="siup">
          	<div class="frm_element">
                    <input type = "password" name = "Password" id = "Password" value = "" />
                    <span>Contrase&ntilde;a</span>
               </div>
          </td>
          <td class="siup"></td>
     </tr>
     <tr>
     	<td colspan="4" align="center" class="siup">
          	<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
               <input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" /> 
          </td>
     </tr>
     </tbody>
     <tfoot>
     	<tr>
          	<th class="siup" colspan="4"></th>
          </tr>
     </tfoot>
</table>