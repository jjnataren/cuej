<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 21 2016]	
	-- País: México
	-- Objetivo: Datos del Alumno con Opción a Modificación
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_alumno = "SELECT * FROM alumnos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
	$resultado_alumno = mysqli_query($conexion, $sql_alumno);
	$fila_alumno = mysqli_fetch_array($resultado_alumno);
	
	$sql_codigo_postal = "SELECT codigo_postal, colonia FROM codigos_postales WHERE id_codigo_postal = '".$fila_alumno["id_codigo_postal"]."';";
	$resultado_codigo_postal = mysqli_query($conexion, $sql_codigo_postal);
	$fila_codigo_postal = mysqli_fetch_array($resultado_codigo_postal);
	
	$sql_estado = "SELECT estado, municipio FROM codigos_postales JOIN municipios USING(id_municipio) JOIN estados USING(id_estado) WHERE id_codigo_postal = '".$fila_alumno["id_codigo_postal"]."';";
	$resultado_estado = mysqli_query($conexion, $sql_estado);
	$fila_estado = mysqli_fetch_array($resultado_estado);
		
	$sql_contactos = "SELECT * FROM alumnos_contactos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
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
			$id_telefono_casa = $fila_contactos["id_alumno_contacto"];
		}
		if($fila_contactos["tipo_contacto"] == 2)
		{
			$telefono_celular = $fila_contactos["contacto"];
			$id_telefono_celular = $fila_contactos["id_alumno_contacto"];
		}
		if($fila_contactos["tipo_contacto"] == 3)
		{
			$correo_electronico = $fila_contactos["contacto"];
			$id_correo_electronico = $fila_contactos["id_alumno_contacto"];
		}
	}	
?>
<form id="Frm_Alumnos_Nuevo">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">DATOS DEL ALUMNO</th>
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
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo Solo_Letras" id="Nombre" name="Nombre"  value="<?php echo utf8_encode($fila_alumno["nombre"]); ?>" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'nombre', $(this).val(), 'lbl_Nombre')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["nombre"]);
?>
				</span>	
<?php
	}
?>
			</td>			
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo Solo_Letras" id="Apellido_Paterno" name="Apellido_Paterno"  value="<?php echo utf8_encode($fila_alumno["apellido_paterno"]); ?>" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'apellido_paterno', $(this).val(), 'lbl_Apellido_Paterno')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["apellido_paterno"]);
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo Solo_Letras" id="Apellido_Materno" name="Apellido_Materno"  value="<?php echo utf8_encode($fila_alumno["apellido_materno"]); ?>" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'apellido_materno', $(this).val(), 'lbl_Apellido_Materno')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["apellido_materno"]);
?>
				</span>	
<?php
	}
?>
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
				
			</td>
		 </tr>           
		 <tr>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="CURP" name="CURP"  value="<?php echo utf8_encode($fila_alumno["curp"]); ?>" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'curp', $(this).val(), 'lbl_CURP')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["curp"]);
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="RFC" name="RFC"  value="<?php echo utf8_encode($fila_alumno["rfc"]); ?>"  onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'rfc', $(this).val(), 'lbl_RFC')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["rfc"]);
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
				
			</td>
		 </tr>
		 <tr>
			<td colspan="3" class="cuej">&nbsp;</td>
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
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Codigo_Postal" name="Codigo_Postal"  value="<?php echo $fila_codigo_postal["codigo_postal"]; ?>"/>
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo $fila_codigo_postal["codigo_postal"];
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Estado" name="Estado"  value="<?php echo utf8_encode($fila_estado["estado"]); ?>"/>
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_estado["estado"]);
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Municipio" name="Municipio"  value="<?php echo utf8_encode($fila_estado["municipio"]); ?>"/>
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_estado["municipio"]);
?>
				</span>	
<?php
	}
?>
			</td>
		 </tr>
           <tr>
			<td class="cuej">
				<label>Colonia <span id="lbl_id_Codigo_Postal"></span></label>                   
			</td>
			<td class="cuej" colspan="2">
				<label>Calle<span id="lbl_Calle"></span></label>                   
			</td>			
		 </tr>
		 <tr>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<select class="campo" name="id_Codigo_Postal" id="id_Codigo_Postal" onChange="Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'id_codigo_postal', $(this).val(), 'lbl_id_Codigo_Postal')" >
					<option value=""></option>
<?php
	$sql_codigos = "SELECT id_codigo_postal, colonia FROM codigos_postales WHERE codigo_postal = '".$fila_codigo_postal["codigo_postal"]."';";
	$resultado_codigos = mysqli_query($conexion, $sql_codigos);
	
		while($fila_codigos = mysqli_fetch_array($resultado_codigos))
		{
?>
					<option value="<?php echo $fila_codigos["id_codigo_postal"]; ?>" <?php if($fila_codigos["id_codigo_postal"] == $fila_alumno["id_codigo_postal"]) echo "selected"; ?>><?php echo utf8_encode($fila_codigos["colonia"]); ?></option>
<?php
		}

?>
                </select>
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_codigo_postal["colonia"]);
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej" colspan="2">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Calle" name="Calle"  value="<?php echo utf8_encode($fila_alumno["calle"]); ?>" size="61" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'calle', $(this).val(), 'lbl_Calle')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["calle"]);
?>
				</span>	
<?php
	}
?>
			</td>			
		 </tr>
		 <tr>
			<td colspan="3" class="cuej">&nbsp;</td>
		 </tr>
		 <tr>
           	<td colspan="3" class="cuej"><hr /></td>
         </tr>
		 <tr>
			<td class="cuej">
				<label>Tel&eacute;fono Casa <span id="lbl_Telefono_Casa"></span></label>                   
			</td>
			<td class="cuej">
				<label>Tel&eacute;fono Celular <span id="lbl_Telefono_Celular"></span></label>                   
			</td>
			<td class="cuej">
				<label>Correo Electr&oacute;nico <span id="lbl_Correo_Electronico"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Telefono_Casa" name="Telefono_Casa"  value="<?php echo $telefono_casa; ?>" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Contacto_Actualizar(<?php echo $id_telefono_casa; ?>, <?php echo $_POST["id_Alumno"]; ?>, 'contacto', $(this).val(), 'lbl_Telefono_Casa','1')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo $telefono_casa;
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Telefono_Celular" name="Telefono_Celular"  value="<?php echo $telefono_celular; ?>" onBlur="$(this).val($(this).val().toUpperCase()); Alumnos_Contacto_Actualizar(<?php echo $id_telefono_celular; ?>, <?php echo $_POST["id_Alumno"]; ?>, 'contacto', $(this).val(), 'lbl_Telefono_Celular','2')"/>
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo $telefono_celular;
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Correo_Electronico" name="Correo_Electronico"  value="<?php echo $correo_electronico; ?>" onBlur="Alumnos_Contacto_Actualizar(<?php echo $id_correo_electronico; ?>, <?php echo $_POST["id_Alumno"]; ?>, 'contacto', $(this).val(), 'lbl_Correo_Electronico','3')"/>
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo $correo_electronico;
?>
				</span>	
<?php
	}
?>
			</td>
		 </tr>
		 <tr>
			<td colspan="3" class="cuej">&nbsp;</td>
		 </tr>
		 <tr>
           	<td colspan="3" class="cuej"><hr /></td>
         </tr>
		 <tr>
			<td class="cuej">
				<label>Usuario <span id="lbl_Usuario"></span></label>                   
			</td>
			<td class="cuej">
				<label>Contrase&ntilde;a<span id="lbl_Password"></span></label>                   
			</td>
			<td class="cuej">
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["usuario"]);
?>
				</span>	
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Password" name="Password"  value="<?php echo utf8_encode($fila_alumno["password"]); ?>" onBlur="Alumnos_Actualizar(<?php echo $_POST["id_Alumno"]; ?>, 'password', $(this).val(), 'lbl_Password')" />
<?php
	}
	else
	{
?>
				<span class="dato">	
<?php
		echo utf8_encode($fila_alumno["password"]);
?>
				</span>	
<?php
	}
?>
			</td>
			<td class="cuej">
			</td>
		 </tr>
	 </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
     </tfoot>
</table>
<p align="center">
	<input class="button" type="button" id = "Btn_Regresar" name = "Btn_Regresar"  value = "Regresar" />
</p>
</form>