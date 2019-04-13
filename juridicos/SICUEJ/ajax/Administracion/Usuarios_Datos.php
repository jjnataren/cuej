<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 27 Abril]	
	-- País: México
	-- Objetivo: Formulario para registrar un nuevo usuario
	-- Última Modificación: [Abril, 27 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario = '".$_POST["id_Usuario"]."';";
	$resultado_usuario = mysqli_query($conexion, $sql_usuario);
	$fila_usuario = @mysqli_fetch_array($resultado_usuario);
		
?>
<form class="form-style" id="Frm_Actualizar">
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
				<input type = "text" name = "Titulo" id = "Titulo" value = "<?php echo $fila_usuario["titulo"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'titulo', $(this).val(), 'lbl_Titulo');" />
                    <span>Titulo<span id="lbl_Titulo"></span></span>
               </div>
		</td>
		<td class="siup">
			<div class="frm_element">                    	
				<input type = "text" name = "Nombre_Usuario" id = "Nombre_Usuario" value = "<?php echo $fila_usuario["nombre"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'nombre', $(this).val(), 'lbl_Nombre');" />
                    <span>Nombre<span id="lbl_Nombre"></span></span>
              </div>
		</td>
		<td class="siup">
			<div class="frm_element">
                <input type = "text" name = "Apellido_Paterno" id = "Apellido_Paterno" value = "<?php echo $fila_usuario["apellido_paterno"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'apellido_paterno', $(this).val(), 'lbl_Apellido_Paterno');" />
                <span>Apellido Paterno<span id="lbl_Apellido_Paterno"></span></span>
            </div>
		</td>
		<td class="siup">
			<div class="frm_element">
                <input type = "text" name = "Apellido_Materno" id = "Apellido_Materno" value = "<?php echo $fila_usuario["apellido_materno"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'apellido_materno', $(this).val(), 'lbl_Apellido_Materno');" />
                <span>Apellido Materno<span id="lbl_Apellido_Materno"></span></span>
            </div>
		</td>		
	</tr>
     <tr>
     	<td colspan="2" class="siup">
          	<div class="frm_element">
                    <input type = "text" name = "Area" id = "Area" value = "<?php echo $fila_usuario["area"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'area', $(this).val(), 'lbl_Area');" />
                    <span>&Aacute;rea <span id="lbl_Area"></span></span>
               </div>
          </td>
          <td colspan="2" class="siup">
          	<div class="frm_element">
                    <input type = "text" name = "Correo_Electronico" id = "Correo_Electronico" value = "<?php echo $fila_usuario["correo_electronico"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'correo_electronico', $(this).val(), 'lbl_Correo_Electronico');" />
                    <span>Correo Electr&oacute;nico <span id="lbl_Correo_Electronico"></span></span>
               </div>
          </td>
     </tr>
     <tr>
     	<td class="siup"></td>
          <td class="siup">
          	<div class="frm_element">
                    <input type = "text" name = "Usuario" id = "Usuario" value = "<?php echo $fila_usuario["usuario"]; ?>" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'usuario', $(this).val(), 'lbl_Usuario');" />
                    <span>Nombre de Usuario<span id="lbl_Usuario"></span></span>
               </div>
          </td>
          <td class="siup">
          	<div class="frm_element">
                    <input type = "password" name = "Password" id = "Password" value = "" onBlur="Usuarios_Actualizar('<?php echo $_POST["id_Usuario"]; ?>', 'password', $(this).val(), 'lbl_Password');"/>
                    <span>Contrase&ntilde;a<span id="lbl_Password"></span></span>
               </div>
          </td>
          <td class="siup"></td>
     </tr>     
     </tbody>
     <tfoot>
     	<tr>
          	<th class="siup" colspan="4"></th>
          </tr>
     </tfoot>
</table>
</form>
<form class="form-style">
    <table align="left">
         <tr>
              <td>
                   <div class="frm_element">
<?php
	$sql_areas = "SELECT id_area_sicuej, area_sicuej FROM areas_sicuej ORDER BY area_sicuej;";
	$resultado_areas = mysqli_query($conexion, $sql_areas);
?>
                     <label>&Aacute;reas</label>
                     <select id="id_Area" name="id_Area">
                       <option value="" selected></option>
<?php
	while($fila_areas = @mysqli_fetch_array($resultado_areas))
	{
?>
				   <option value="<?php echo $fila_areas["id_area_sicuej"]; ?>"><?php echo htmlentities($fila_areas["area_sicuej"]); ?></option>
<?php	
	}
?>
                     </select>
                     <span></span>
                 	</div>
                         
              </td>
              <td>
                   <div class="frm_element">
                       <label>Procesos</label>
                       <select id="id_Proceso" name="id_Proceso">
                       	<option value=" " selected></option>
                       </select>
                       <span></span>
                   </div>
                   
              </td>
              <td align="left" valign="top">
                   <input class="button" type="button" id = "Btn_Agregar" name = "Btn_Agregar"  value = "Agregar" />
              </td>
         </tr>
    </table>
</form>
<?php
	$sql_permisos = "SELECT * FROM permisos JOIN procesos USING(id_proceso) JOIN areas_sicuej USING(id_area_sicuej) WHERE id_usuario='".$_POST["id_Usuario"]."';";
	$resultado_permisos = mysqli_query($conexion, $sql_permisos);
?>
<table align="left" width="800px" class="siup">
	<thead>
     	<tr>
     		<th class="siup" colspan="7">PERMISOS</th>
          </tr>
     </thead>
     <tbody>
     	<tr>
          	<th class="siup" rowspan="2">NO.</th>
               <th class="siup" rowspan="2">PROCESO</th>
               <th class="siup" rowspan="2">&Aacute;REA</th>
               <th class="siup" colspan="3">PERMISOS</th>
               <th class="siup" rowspan="2">OPCIONES</th>
          </tr>
          <tr>
          	<th class="siup">INSERTAR</th>
               <th class="siup">ACTUALIZAR</th>
               <th class="siup">ELIMINAR</th>
          </tr>
<?php
	$i=0;

	while($fila_permisos = @mysqli_fetch_array($resultado_permisos))
	{
		$i++;
?>
		<tr>
          	<td class="siup"><?php echo $i; ?></td>
               <td class="siup"><?php echo $fila_permisos["proceso_nombre"]; ?></td>
               <td class="siup"><?php echo $fila_permisos["area_sicuej"]; ?></td>
               <td class="siup" align="center">
               	<input type="checkbox" name="Insertar_<?php echo $fila_permisos["id_permiso"];?>" <?php if($fila_permisos["insertar"] == 1) echo "checked"; ?> onClick="Usuarios_Permisos_Actualizar(<?php echo $fila_permisos["id_permiso"];?>,'Insertar')"/>
               </td>
               <td class="siup" align="center">
               	<input type="checkbox" name="Actualizar_<?php echo $fila_permisos["id_permiso"];?>" <?php if($fila_permisos["actualizar"] == 1) echo "checked"; ?> />
               </td>
               <td class="siup" align="center">
               	<input type="checkbox" name="Eliminar_<?php echo $fila_permisos["id_permiso"];?>" <?php if($fila_permisos["eliminar"] == 1) echo "checked"; ?> />
               </td>
               <td class="siup" align="center">
               	<a href="javascript: Usuarios_Procesos_Eliminar(<?php echo $fila_permisos["id_permiso"]; ?>,<?php echo $_POST["id_Usuario"]; ?>)">Eliminar Proceso</a>
               </td>
          </tr>
<?php	
	}
?>
     </tbody>
     <tfoot>
     	<tr>
     		<th class="siup" colspan="7"></th>
          </tr>
     </tfoot>
</table>
<br />