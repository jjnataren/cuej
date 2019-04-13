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
	
	$sql_carrera = "SELECT * FROM carreras JOIN carreras_tipo USING(id_carrera_tipo) WHERE id_carrera = '".$_POST["id_Carrera"]."';";
	$resultado_carrera = mysqli_query($conexion, $sql_carrera);
	$fila_carrera = @mysqli_fetch_array($resultado_carrera);
		
?>
<div id="div_Planes_Estudio">
<form id="Frm_Actualizar">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4"><?php echo utf8_encode($fila_carrera["carrera"]); ?></th>
          </tr>
     </thead>
     <tbody>
     <tr>
		<td class="cuej" colspan="4">
			<label>Nombre de la Carrera<span id="lbl_Nombre_Carrera"></span></label>
		</td>				
	</tr>     
    <tr>
		<td class="cuej" colspan="4">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
			<input type = "text" name = "Nombre_Carrera" id = "Nombre_Carrera" value = "<?php echo utf8_encode($fila_carrera["carrera"]); ?>" class="campo Solo_Letras" onBlur="Carreras_Actualizar(<?php echo $_POST["id_Carrera"] ?>, 'carrera', $(this).val(), 'lbl_Nombre_Carrera')" size="50" />
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_carrera["carrera"]);
?>
		</span>	
<?php
	}
?>
		</td>
	</tr>
     <tr>
     	<td colspan="2" class="cuej">          	    
          	<label>Tipo de Carrera<span id="lbl_Carrera_Tipo"></span></label>
          </td>
          <td class="cuej">
          	<label>Abreviatura<span id="lbl_Abreviatura"></span></label>
          </td>
          <td class="cuej">
          	<label>Estatus Actual<span id="lbl_Carrera_Estatus"></span></label>
          </td>
     </tr>
     <tr>
     	<td colspan="2" class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
                <select class="campo" id="id_Carrera_Tipo" name="id_Carrera_Tipo" onChange="Carreras_Actualizar(<?php echo $_POST["id_Carrera"] ?>, 'id_carrera_tipo', $(this).val(), 'lbl_Carrera_Tipo')">
                     <option value="">&nbsp;</option>
                     <option value="1" <?php if($fila_carrera["id_carrera_tipo"] == 1) echo "selected"; ?>>LICENCIATURA</option>
                     <option value="2" <?php if($fila_carrera["id_carrera_tipo"] == 2) echo "selected"; ?>>MAESTR&Iacute;A</option>
                     <option value="3" <?php if($fila_carrera["id_carrera_tipo"] == 3) echo "selected"; ?>>DOCTORADO</option>
                </select>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		if($fila_carrera["id_carrera_tipo"] == 1) echo "LICENCIATURA";
		if($fila_carrera["id_carrera_tipo"] == 2) echo "MAESTRÍA";
		if($fila_carrera["id_carrera_tipo"] == 3) echo "DOCTORADO";
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
          	<input type = "text" name = "Abreviatura" id = "Abreviatura" value = "<?php echo utf8_encode($fila_carrera["abreviatura"]); ?>" class="campo Solo_Letras" maxlength="25" onBlur="Carreras_Actualizar(<?php echo $_POST["id_Carrera"] ?>, 'abreviatura', $(this).val(), 'lbl_Abreviatura')"/>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_carrera["abreviatura"]);
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
              <select class="campo" id="id_Carrera_Estatus" name="id_Carrera_Estatus" onChange="Carreras_Actualizar(<?php echo $_POST["id_Carrera"] ?>, 'id_carrera_estatus', $(this).val(), 'lbl_Carrera_Estatus')">
                   <option value="">&nbsp;</option>
                   <option value="0" <?php if($fila_carrera["id_carrera_estatus"] == 0) echo "selected"; ?>>INACTIVA</option>
                   <option value="1" <?php if($fila_carrera["id_carrera_estatus"] == 1) echo "selected"; ?>>ACTIVA</option>                         
              </select>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		if($fila_carrera["id_carrera_estatus"] == 0) echo "INACTIVA";
		if($fila_carrera["id_carrera_estatus"] == 1) echo "ACTIVA";
?>
		</span>	
<?php
	}
?>
          </td>
     </tr>
     </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="4"></th>
          </tr>
     </tfoot>
</table>
</form>
<p>&nbsp;</p>
<?php
	$sql_planes = "SELECT * FROM planes_estudio WHERE id_carrera='".$_POST["id_Carrera"]."';";
	$resultado_planes = mysqli_query($conexion, $sql_planes);
?>

<table width="100%" align="center">
	<tr>
		<td align="right" valign="top">
<?php 
	if($_SESSION["Insert"] == 1)
	{
?>
			<input class="button" type="button" id = "Btn_Nuevo_Plan" name = "Btn_Nuevo_Plan"  value = "Nuevo Plan" />
<?php
	}
?>
		</td>
	</tr>
</table>
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
     		<th class="cuej" colspan="5">PLANES DE ESTUDIO</th>
          </tr>
     </thead>
     <tbody>
     	<tr>
          	<th class="cuej" >NO.</th>
               <th class="cuej" >PLAN DES ESTUDIOS</th>
               <th class="cuej" >ACUERDO SEP</th>
               <th class="cuej" >ANTECEDENTE</th>
               <th class="cuej" >OPCIONES</th>
        </tr>          
<?php
	$i=0;

	while($fila_planes = @mysqli_fetch_array($resultado_planes))
	{
		$i++;
?>
		<tr>
          	<td class="cuej" align="center"><?php echo $i; ?></td>
               <td class="cuej" align="center"><a href="javascript:Planes_Estudio_Datos('<?php echo $fila_planes["id_plan_estudio"]; ?>','<?php echo $_POST["id_Carrera"]; ?>')"><?php echo utf8_encode($fila_planes["plan_estudios"]); ?></a></td>
               <td class="cuej" align="center"><?php echo utf8_encode($fila_planes["acuerdo_sep"]); ?></td>
               <td class="cuej" align="center"><?php echo utf8_encode($fila_planes["antecedente"]); ?></td>
               <td class="cuej" align="center">
<?php
	if($_SESSION["Delete"] == 1)
	{
?>
					<a href="javascript:Planes_Estudio_Eliminar('<?php echo $fila_planes["id_plan_estudio"]; ?>','<?php echo $_POST["id_Carrera"]; ?>')">Eliminar</a>
<?php
	}
	else
	{
		echo "-";
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
     		<th class="cuej" colspan="5"></th>
          </tr>
     </tfoot>
</table>
<p>&nbsp;</p>
<center>
	<input class="button" type="button" id = "Btn_Regresar" name = "Btn_Regresar"  value = "Regresar" /> 
</center>
</div>