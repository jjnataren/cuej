<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 11 2016]	
	-- País: México
	-- Objetivo: Datos del Grupo Seleccionado
	-- Última Modificación: [Mayo, 11 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_grupo = "SELECT grupos.*, planes_estudio.id_carrera, planes_estudio.duracion, id_carrera_tipo FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_grupo = '".$_POST["id_Grupo"]."';";
	$resultado_grupo = mysqli_query($conexion, $sql_grupo);
	$fila_grupo = @mysqli_fetch_array($resultado_grupo);
?>
<form id="Frm_Grupos_Nuevo">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">DATOS DEL GRUPO</th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej" colspan="3">
				<label>Programa Acad&eacute;mico <span id="lbl_id_Carrera"></span></label>                   
			</td>
		 </tr>
		 <tr>
			<td class="cuej" colspan="3">
				<select name="id_Carrera_Nuevo" id="id_Carrera_Nuevo" class="campo" >
					<option value="">&nbsp;</option>
<?php 
	$sql_carreras = "SELECT * FROM carreras ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras = mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = mysqli_fetch_array($resultado_carreras))
	{
?>
					<option value="<?php echo $fila_carreras["id_carrera"]; ?>" <?php if($fila_carreras["id_carrera"] == $fila_grupo["id_carrera"]) echo "selected"; ?>><?php echo utf8_encode($fila_carreras["carrera"]); ?></option>
<?php
	}
?>
				</select>                   
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<label>Plan de Estudio <span id="lbl_id_Plan_Estudio"></span></label>                   
			</td>			
			<td class="cuej">
				<label>Ciclo Escolar<span id="lbl_Ciclo_Escolar"></span></label>                   
			</td>
			<td class="cuej">
				<label>Semestre/Cuatrimestre <span id="lbl_Semestre"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<select id="id_Plan_Estudio" name="id_Plan_Estudio" class="campo" onChange="Grupos_Actualizar(<?php echo $_POST["id_Grupo"] ?>, 'id_plan_estudio', $(this).val(), 'lbl_id_Plan_Estudio')">
					<option value=""></option>
<?php
	$sql_planes = "SELECT * FROM planes_estudio WHERE id_carrera = '".$fila_grupo["id_carrera"]."';";
	$resultado_planes = mysqli_query($conexion, $sql_planes);
	
	while($fila_planes = mysqli_fetch_array($resultado_planes))
	{
?>
					<option value="<?php echo $fila_planes["id_plan_estudio"]; ?>" <?php if($fila_grupo["id_plan_estudio"] ==  $fila_planes["id_plan_estudio"]) echo "selected" ?>><?php echo $fila_planes["plan_estudios"]; ?></option>
<?php	
	}
?>                         
				</select>                   
			</td>			
			<td class="cuej">
				<select id="id_Ciclo_Escolar_Nuevo" name="id_Ciclo_Escolar_Nuevo" class="campo" onChange="Grupos_Actualizar(<?php echo $_POST["id_Grupo"] ?>, 'id_ciclo_escolar', $(this).val(), 'lbl_Ciclo_Escolar')">
                    	<option value=""></option>
<?php
	$sql_ciclos = "SELECT * FROM ciclos_escolares WHERE id_carrera_tipo = '".$fila_grupo["id_carrera_tipo"]."';";
	$resultado_ciclos = mysqli_query($conexion, $sql_ciclos);
		
	while($fila_ciclos = mysqli_fetch_array($resultado_ciclos))
	{
?>
					<option value="<?php echo $fila_ciclos["id_ciclo_escolar"]; ?>" <?php if ($fila_grupo["id_ciclo_escolar"] == $fila_ciclos["id_ciclo_escolar"]) echo "selected"; ?>><?php echo $fila_ciclos["ciclo_escolar"]; ?></option>
<?php	
	}
?>				
				</select>
              
			</td>
			<td class="cuej">
				<select id="Semestre" name="Semestre" class="campo" onChange="Grupos_Actualizar(<?php echo $_POST["id_Grupo"] ?>, 'semestre', $(this).val(), 'lbl_Semestre')">
                    	<option value=""></option>
<?php
	for($i=1; $i<= $fila_grupo["duracion"]; $i++)
	{
?>
					<option value="<?php echo $i; ?>" <?php if($i == $fila_grupo["semestre"]) echo "selected"; ?>><?php echo $i; ?></option>
<?php
	}	
?>
				</select>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<label>Grupo <span id="lbl_Grupo"></span></label>                   
			</td>
			<td class="cuej">
				<label>Tipo de Grupo<span id="lbl_Tipo_Grupo"></span></label>                   
			</td>
			<td class="cuej">
				<label>Sal&oacute;n <span id="lbl_Salon"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<input type="text" class="campo" id="Grupo" name="Grupo"  value="<?php echo $fila_grupo["grupo"]; ?>" onBlur="Grupos_Actualizar(<?php echo $_POST["id_Grupo"] ?>, 'grupo', $(this).val(), 'lbl_Grupo')" />                   
			</td>
			<td class="cuej">
				<select name="Tipo_Grupo" id="Tipo_Grupo" class="campo" onChange="Grupos_Actualizar(<?php echo $_POST["id_Grupo"] ?>, 'tipo_grupo', $(this).val(), 'lbl_Tipo_Grupo')" >
					<option value="ORDINARIO" <?php if($fila_grupo["tipo_grupo"] == "ORDINARIO") echo "selected"; ?>>ORDINARIO</option>
					<option value="EXTRAORDINARIO" <?php if($fila_grupo["tipo_grupo"] == "EXTRAORDINARIO") echo "selected"; ?>>EXTRAORDINARIO</option>
				</select>
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Salon" name="Salon"  value="<?php echo $fila_grupo["salon"]; ?>" onBlur="Grupos_Actualizar(<?php echo $_POST["id_Grupo"] ?>, 'salon', $(this).val(), 'lbl_Salon')"/>
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