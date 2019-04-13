<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 12 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Profesor
	-- Última Modificación: [Mayo, 12 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
?>
<form id="Frm_Profesores_Nuevo">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">NUEVO PROFESOR</th>
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
			<td class="cuej">
				<label>C&eacute;dula Profesional<span id="lbl_Cedula_Profesional"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<input type="text" class="campo" id="CURP" name="CURP"  value=""/>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="RFC" name="RFC"  value=""/>
			</td>
			<td class="cuej">
				<input type="text" class="campo Solo_Numeros" id="Cedula_Profesional" name="Cedula_Profesional"  value=""/>
			</td>
		 </tr>
         <tr>
			<td colspan="3">&nbsp;
				
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<label>Nivel de Estudios <span id="lbl_Nivel_Estudios"></span></label>                   
			</td>
			<td class="cuej">
				<label>Carrera<span id="lbl_Carrera"></span></label>                   
			</td>
			<td class="cuej">
				<label>T&iacute;tulo<span id="lbl_Titulo"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<select class="campo" id="Nivel_Estudios" name="Nivel_Estudios">
					<option value="">&nbsp;</option>
					<option value="1">LICENCIATURA</option>
					<option value="2">ESPECIALIDAD</option>
					<option value="3">MAESTR&Iacute;A</option>
					<option value="4">DOCTORADO</option>
				</select>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Estudios" name="Estudios"  value=""/>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Titulo" name="Titulo"  value=""/>
			</td>
		 </tr>
		 <tr>
			<td colspan="3">&nbsp;
				
			</td>
		 </tr>
           <tr>
			<td class="cuej">
				<label>Tel&eacute;fono Casa <span id="lbl_Telefono_Casa"></span></label>                   
			</td>
			<td class="cuej">
				<label>Tel&eacute;fono Celular<span id="lbl_Telefono_Celular"></span></label>                   
			</td>
			<td class="cuej">
				<label>Correo Electr&oacute;nico<span id="lbl_Correo_Electronico"></span></label>
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
			<td colspan="3">&nbsp;
				
			</td>
		 </tr>		 
	 </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
     </tfoot>
</table>
<p>&nbsp;</p>
<?php
	$sql_documentacion = "SELECT * FROM documentacion_profesores ORDER BY id_documentacion_profesor;";
	$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);	
?>
<table align="center" width="80%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="2">DOCUMENTACI&Oacute;N</th>
          </tr>
     </thead>
     <tbody>
<?php
	while($fila_documentacion = @mysqli_fetch_array($resultado_documentacion))
	{
?>
		<tr>
          	<td class="cuej"><?php echo utf8_encode($fila_documentacion["descripcion"]); ?></td>
               <td class="cuej">
				<input type="text" class="campo fecha_documento" value="" id="Fecha_Entrega_<?php echo $fila_documentacion["id_documentacion_profesor"]; ?>" name="Fecha_Entrega_<?php echo $fila_documentacion["id_documentacion_profesor"]; ?>" size="12" readonly />
	  	     </td>

          </tr>
<?php
	}
?>
     </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="2"></th>
        </tr>
     </tfoot>
</table>
<p>&nbsp;</p>
<table align="center" width="80%" class="cuej">
	<thead>
		<tr>
			<th class="cuej" colspan="2">PROGRAMAS ACAD&Eacute;MICOS</th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql_carreras = "SELECT * FROM carreras ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras = mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = @mysqli_fetch_array($resultado_carreras))
	{
?>
		<tr>
			<td class="cuej"><?php echo utf8_encode($fila_carreras["carrera"]); ?></td>
			<td class="cuej">
				<input type="checkbox" name="Carrera_<?php echo $fila_carreras["id_carrera"]; ?>" id="Carrera_<?php echo $fila_carreras["id_carrera"]; ?>" value="1" />
			</td>
		</tr>
<?php
	}
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="cuej" colspan="2"></th>
		</tr>
	</tfoot>
</table>

<p align="center">
	<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
	<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" /> 
</p>
</form>