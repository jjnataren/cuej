<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 29 Abril]	
	-- País: México
	-- Objetivo: Información del Plan de Estudio Seleccionado
	-- Última Modificación: [Abril, 29 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_plan_estudio = "SELECT planes_estudio.*, carreras_tipo.duracion AS tipo_duracion, carreras.carrera FROM planes_estudio JOIN carreras USING(id_carrera) JOIN carreras_tipo USING(id_carrera_tipo)  WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
	
	$resultado_plan_estudio = mysqli_query($conexion, $sql_plan_estudio);
	$fila_plan_estudio = @mysqli_fetch_array($resultado_plan_estudio);
		
?>
<div id="div_Materias">
<form id="Frm_Actualizar">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4"><?php echo utf8_encode($fila_plan_estudio["carrera"]); ?> PLAN DE ESTUDIO <?php echo utf8_encode($fila_plan_estudio["plan_estudios"]); ?></th>
          </tr>
     </thead>
     <tbody>
	 <tr>
		<td class="cuej" colspan="2">
          	<label>Plan de Estudio<span id="lbl_Plan_Estudio"></span></label>                   
		</td>
        <td>
			<label>Acuerdo SEP<span id="lbl_Acuerdo_SEP"></span></label>
		</td>
        <td>
          	<label>Clave SEP<span id="lbl_Clave_SEP"></span></label>
        </td>
	 </tr>
     <tr>
		<td class="cuej" colspan="2">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Nombre_Plan_Estudio" id = "Nombre_Plan_Estudio" value = "<?php echo utf8_encode($fila_plan_estudio["plan_estudios"]); ?>" onBlur="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'plan_estudios', $(this).val(), 'lbl_Plan_Estudio')"/>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_plan_estudio["plan_estudios"]);
?>
		</span>	
<?php
	}
?>		
		</td>
        <td>
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Acuerdo_Sep" id = "Acuerdo_Sep" value = "<?php echo utf8_encode($fila_plan_estudio["acuerdo_sep"]); ?>" onBlur="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'acuerdo_sep', $(this).val(), 'lbl_Acuerdo_SEP')"/>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_plan_estudio["acuerdo_sep"]);
?>
		</span>	
<?php
	}
?>
        </td>
        <td>
<?php
	if($_SESSION["Update"] == 1)
	{
?>
			<input class="campo" type = "text" name = "Clave_Sep" id = "Clave_Sep" value = "<?php echo $fila_plan_estudio["clave_sep"]; ?>" onBlur="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'clave_sep', $(this).val(), 'lbl_Clave_SEP')" />
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo $fila_plan_estudio["clave_sep"];
?>
		</span>	
<?php
	}
?>
        </td>
	 </tr>
	 <tr>
		<td class="cuej" colspan="2">
          	<label>Antecedente<span id="lbl_Antecedente"></span></label>
		</td>
        <td>
          	<label>Duraci&oacute;n<span id="lbl_Duracion"></span></label>
        </td>
        <td>
          	<label>Cr&eacute;ditos<span id="lbl_Creditos"></span></label>
        </td>
	 </tr>
     <tr>
		<td class="cuej" colspan="2">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<select name="Antecedente" id="Antecedente" class="campo" onChange="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'antecedente', $(this).val(), 'lbl_Antecedente')">
				<option value="">&nbsp;</option>
                <option value="BACHILLERATO" <?php if($fila_plan_estudio["antecedente"] == "BACHILLERATO") echo "selected"; ?> >BACHILLERATO</option>
                <option value="LICENCIATURA" <?php if($fila_plan_estudio["antecedente"] == "LICENCIATURA") echo "selected"; ?> >LICENCIATURA</option>
                <option value="MAESTRIA" <?php if($fila_plan_estudio["antecedente"] == "MAESTRIA") echo "selected"; ?>>MAESTR&Iacute;A</option>
            </select>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_plan_estudio["antecedente"]);
?>
		</span>	
<?php
	}
?>
		</td>
        <td>
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Duracion" id = "Duracion" value = "<?php echo $fila_plan_estudio["duracion"]; ?>" onBlur="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'duracion', $(this).val(), 'lbl_Duracion')" />
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo $fila_plan_estudio["duracion"];
?>
		</span>	
<?php
	}
?>
        </td>
        <td>
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Creditos" id = "Creditos" value = "<?php echo $fila_plan_estudio["creditos"]; ?>" onBlur="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'creditos', $(this).val(), 'lbl_Creditos')" />
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo $fila_plan_estudio["creditos"];
?>
		</span>	
<?php
	}
?>
        </td>
	 </tr>
	 <tr>
		<td class="cuej" colspan="4">
          	<label>Fecha<span id="lbl_Fecha"></span></label>
		</td>          
	 </tr>
     <tr>
		<td class="cuej" colspan="4">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
          	<input class="campo" type = "text" name = "Fecha" id = "Fecha" value = "<?php echo utf8_encode($fila_plan_estudio["fecha"]); ?>" size="40" onBlur="Planes_Estudio_Actualizar(<?php echo $_POST["id_Plan_Estudio"] ?>, 'fecha', $(this).val(), 'lbl_Fecha')"/>
<?php
	}
	else
	{
?>
		<span class="dato">	
<?php
		echo utf8_encode($fila_plan_estudio["fecha"]);
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
<br />
<p>&nbsp;</p>
<table width="100%" align="center">
	<tr>
		<td align="right" valign="top">
<?php 
	if($_SESSION["Insert"] == 1)
	{
?>
			<input class="button" type="button" id = "Btn_Nueva_Materia" name = "Btn_Nueva_Materia"  value = "Nueva Asignatura" />
<?php
	}
?>
		</td>
	</tr>
</table>
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="5">ASIGNATURAS DEL PLAN DE ESTUDIOS</th>
          </tr>
     </thead>
     <tbody>
     	<tr>
          	<th class="cuej">NO.</th>
               <th class="cuej">ASIGNATURAS</th>
               <th class="cuej">CLAVE</th>
               <th class="cuej">CR&Eacute;DITOS</th>
			   <th class="cuej">OPCIONES</th>
          </tr>
<?php
	$i = 0;
	
	for($semestre = 1; $semestre <= $fila_plan_estudio["duracion"]; $semestre++)
	{
		$sql_materias = "SELECT * FROM materias WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' AND semestre = '".$semestre."';";
		$resultado_materias = mysqli_query($conexion, $sql_materias);
		
		$registros_materias = @mysqli_num_rows($resultado_materias);
		
		if($registros_materias > 0)
		{
?>
		<tr>
          	<th class="cuej" colspan = "5"><?php echo $fila_plan_estudio["tipo_duracion"]." ".$semestre; ?></th>
        </tr>
<?php
		
			while($fila_materias = mysqli_fetch_array($resultado_materias))
			{
				$i++;
?>
		<tr>
          	<td class="cuej"><?php echo $i; ?></td>
            <td class="cuej"><a href="javascript: Materias_Datos('<?php echo $fila_materias["id_materia"]; ?>','<?php echo $_POST["id_Plan_Estudio"]; ?>','<?php echo $_POST["id_Carrera"]; ?>')" ><?php echo utf8_encode($fila_materias["materia"]); ?></a></td>
            <td class="cuej" align="center"><?php echo utf8_encode($fila_materias["clave_materia"]);?></td>
            <td class="cuej" align="center"><?php echo utf8_encode($fila_materias["creditos"]); ?></td>
			<td class="cuej" align="center">
<?php
	if($_SESSION["Delete"] == 1)
	{
?>
				<a href="javascript: Materias_Eliminar('<?php echo $fila_materias["id_materia"]; ?>','<?php echo $_POST["id_Plan_Estudio"]; ?>','<?php echo $_POST["id_Carrera"]; ?>')" >Eliminar</a>
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
		}
	}
?>
	</tbody>     
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="5"></th>
          </tr>
     </tfoot>
</table>
<center>
	<input class="button" type="button" id = "Btn_Regresar" name = "Btn_Regresar"  value = "Regresar" /> 
</center>
</div>