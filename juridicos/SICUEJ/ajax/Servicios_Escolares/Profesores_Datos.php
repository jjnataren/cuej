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
	
	$sql_profesor = "SELECT * FROM profesores WHERE id_profesor = '".$_POST["id_Profesor"]."';";
	$resultado_profesor = mysqli_query($conexion, $sql_profesor);
	
	$fila_profesor = mysqli_fetch_array($resultado_profesor);
	
	
	$sql_contactos = "SELECT * FROM profesores_contactos WHERE id_profesor = '".$_POST["id_Profesor"]."';";
	$resultado_contactos = mysqli_query($conexion, $sql_contactos);
		
	$telefono_casa = "";
	$telefono_celular = "";
	$correo_electronico = "";
	
	$id_telefono_casa = 0;
	$id_telefono_celular = 0;
	$id_correo_electronico = 0;
	
	while($fila_contactos = mysqli_fetch_array($resultado_contactos))
	{
		if($fila_contactos["tipo_contacto"] == 1)
		{
			$telefono_casa = $fila_contactos["contacto"];
			$id_telefono_casa = $fila_contactos["id_profesor_contacto"];
		}
		if($fila_contactos["tipo_contacto"] == 2)
		{
			$telefono_celular = $fila_contactos["contacto"];
			$id_telefono_celular = $fila_contactos["id_profesor_contacto"];
		}
		if($fila_contactos["tipo_contacto"] == 3)
		{
			$correo_electronico = $fila_contactos["contacto"];
			$id_correo_electronico = $fila_contactos["id_profesor_contacto"];
		}
	}
	
	
?>
<form id="Frm_Profesores_Actualizar" action = "../impresiones/Servicios_Escolares/Informacion_Profesor_PDF.php" method="post" target="_blank">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">DATOS DEL PROFESOR</th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej">
				<label>Nombre <span id="lbl_Nombre"></span></label>                   
			</td>			
			<td class="cuej">
				<label>Apellido Paterno<span id="lbl_Apellido_Paterno"></span></label>                   
			</td>
			<td class="cuej">
				<label>Apellido Materno <span id="lbl_Apellido_Materno"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<input type="text" class="campo Solo_Letras" id="Nombre" name="Nombre"  value="<?php echo utf8_encode($fila_profesor["nombre"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'nombre', $(this).val(), 'lbl_Nombre')"/>
			</td>			
			<td class="cuej">
				<input type="text" class="campo Solo_Letras" id="Apellido_Paterno" name="Apellido_Paterno"  value="<?php echo utf8_encode($fila_profesor["apellido_paterno"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'apellido_paterno', $(this).val(), 'lbl_Apellido_Paterno')" />
			</td>
			<td class="cuej">
				<input type="text" class="campo Solo_Letras" id="Apellido_Materno" name="Apellido_Materno"  value="<?php echo utf8_encode($fila_profesor["apellido_materno"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'apellido_materno', $(this).val(), 'lbl_Apellido_Materno')"/>
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
				<input type="text" class="campo" id="CURP" name="CURP"  value="<?php echo utf8_encode($fila_profesor["curp"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'curp', $(this).val(), 'lbl_CURP')" />
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="RFC" name="RFC"  value="<?php echo utf8_encode($fila_profesor["rfc"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'rfc', $(this).val(), 'lbl_RFC')" />
			</td>
			<td class="cuej">
				<input type="text" class="campo Solo_Numeros" id="Cedula_Profesional" name="Cedula_Profesional"  value="<?php echo utf8_encode($fila_profesor["cedula_profesional"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'cedula_profesional', $(this).val(), 'lbl_Cedula_Profesional')" />
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
				<label>Carrera<span id="lbl_Estudios"></span></label>                   
			</td>
			<td class="cuej">
				<label>T&iacute;tulo<span id="lbl_Titulo"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<select class="campo" id="Nivel_Estudios" name="Nivel_Estudios" onChange="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'nivel_estudios', $(this).val(), 'lbl_Nivel_Estudios')">
					<option value="">&nbsp;</option>
					<option value="1" <?php if($fila_profesor["nivel_estudios"] == 1) echo "selected"; ?>>LICENCIATURA</option>
					<option value="2" <?php if($fila_profesor["nivel_estudios"] == 2) echo "selected"; ?>>ESPECIALIDAD</option>
					<option value="3" <?php if($fila_profesor["nivel_estudios"] == 3) echo "selected"; ?>>MAESTR&Iacute;A</option>
					<option value="4" <?php if($fila_profesor["nivel_estudios"] == 4) echo "selected"; ?>>DOCTORADO</option>
				</select>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Estudios" name="Estudios"  value="<?php echo utf8_encode($fila_profesor["estudios"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'estudios', $(this).val(), 'lbl_Estudios')" />
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Titulo" name="Titulo"  value="<?php echo utf8_encode($fila_profesor["titulo"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'titulo', $(this).val(), 'lbl_Titulo')" />
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
				<input type="text" class="campo" id="Telefono_Casa" name="Telefono_Casa"  value="<?php echo $telefono_casa; ?>" onBlur="$(this).val($(this).val().toUpperCase()); Profesores_Contacto_Actualizar(<?php echo $id_telefono_casa; ?>,'<?php echo $_POST["id_Profesor"]; ?>', 'contacto', $(this).val(), 'lbl_Telefono_Casa','1')" />
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Telefono_Celular" name="Telefono_Celular"  value="<?php echo $telefono_celular; ?>" onBlur="$(this).val($(this).val().toUpperCase()); Profesores_Contacto_Actualizar(<?php echo $id_telefono_celular; ?>, '<?php echo $_POST["id_Profesor"]; ?>', 'contacto', $(this).val(), 'lbl_Telefono_Celular','2')"/>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Correo_Electronico" name="Correo_Electronico"  value="<?php echo $correo_electronico; ?>" onBlur="Profesores_Contacto_Actualizar(<?php echo $id_correo_electronico; ?>, '<?php echo $_POST["id_Profesor"]; ?>', 'contacto', $(this).val(), 'lbl_Correo_Electronico','3')"/>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<label>Usuario <span id="lbl_Usuario"></span></label>                   
			</td>
			<td class="cuej">
				<label>Contrase&ntilde;a<span id="lbl_Password"></span></label>                   
			</td>
			<td class="cuej">
				<label>Estatus<span id="lbl_Estatus"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<input type="text" class="campo" id="Usuario" name="Usuario"  value="<?php echo utf8_encode($fila_profesor["usuario"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'usuario', $(this).val(), 'lbl_Usuario')"/>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Password" name="Password"  value="<?php echo utf8_encode($fila_profesor["password"]); ?>" onBlur="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'password', $(this).val(), 'lbl_Password')"/>
			</td>
			<td class="cuej">
				<select class="campo" id="Estatus" name="Estatus" onChange="Profesores_Actualizar(<?php echo $_POST["id_Profesor"] ?>, 'estatus', $(this).val(), 'lbl_Estatus')">
					<option value="1" <?php if($fila_profesor["estatus"] == 1) echo "selected"; ?>>ACTIVO</option>
					<option value="0" <?php if($fila_profesor["estatus"] == 0) echo "selected"; ?>>INACTIVO</option>
				</select>
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
	$sql_documentacion = "SELECT * FROM profesores_documentacion JOIN documentacion_profesores USING(id_documentacion_profesor) WHERE id_profesor = '".$_POST["id_Profesor"]."';";
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
<?php
		if($_SESSION["Update"] == 1)
		{
?>
					<input type="text" class="campo fecha_documento" value="<?php echo $fila_documentacion["fecha_entrega"]; ?>" name="Fecha_Entrega_<?php echo $fila_documentacion["id_profesor_documentacion"]; ?>"  id="Fecha_Entrega_<?php echo $fila_documentacion["id_profesor_documentacion"]; ?>" size="12"  onchange="Profesores_Documentacion_Actualizar('<?php echo $fila_documentacion["id_profesor_documentacion"]; ?>','fecha_entrega',$(this).val(),'lbl_Documento_<?php echo $fila_documentacion["id_profesor_documentacion"]; ?>')"/><span id="lbl_Documento_<?php echo $fila_documentacion["id_profesor_documentacion"]; ?>"></span>
<?php
		}
		else
		{
?>
					<span class="dato"><?php echo $fila_documentacion["fecha_entrega"]; ?></span>
<?php
		}
?>
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
			<th class="cuej" colspan="3">PROGRAMAS ACAD&Eacute;MICOS</th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql_carreras = "SELECT * FROM carreras ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras = mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = @mysqli_fetch_array($resultado_carreras))
	{
		$sql_carrera = "SELECT COUNT(*) AS registro FROM profesores_carreras WHERE id_carrera='".$fila_carreras["id_carrera"]."' AND id_profesor = '".$_POST["id_Profesor"]."';";
		
		$resultado_carrera = mysqli_query($conexion, $sql_carrera);
		$fila_carrera = @mysqli_fetch_array($resultado_carrera);
?>
		<tr>
			<td class="cuej"><?php echo utf8_encode($fila_carreras["carrera"]); ?></td>
			<td class="cuej">
				<input type="checkbox" name="Carrera_<?php echo $fila_carreras["id_carrera"]; ?>" id="Carrera_<?php echo $fila_carreras["id_carrera"]; ?>" value="1" <?php if($fila_carrera["registro"] > 0) echo "checked";  ?> onchange="Profesores_Carrera_Actualizar('<?php echo $_POST["id_Profesor"] ?>','<?php echo $fila_carreras["id_carrera"]; ?>','lbl_Carrera_<?php echo $fila_carreras["id_carrera"]; ?>')"  />
				
			</td>
			<td>
				<span id="lbl_Carrera_<?php echo $fila_carreras["id_carrera"]; ?>"></span>
			</td>
		</tr>
<?php
	}
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="cuej" colspan="3"></th>
		</tr>
	</tfoot>
</table>
<p>&nbsp;</p>
<center>
	<input type="hidden" id = "id_Profesor" name = "id_Profesor"  value = "<?php echo $_POST["id_Profesor"] ?>" />
	<input class="button" type="submit" id = "Btn_Imprimir" name = "Btn_Imprimir"  value = "Informaci&oacute;n PDF" />&nbsp;<input class="button" type="button" id = "Btn_Regresar" name = "Btn_Regresar"  value = "Regresar" /> 
</center>
</form>