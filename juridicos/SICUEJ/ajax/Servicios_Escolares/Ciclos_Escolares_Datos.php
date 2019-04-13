<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Ciclo Escolar
	-- Última Modificación: [Mayo, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_ciclo = "SELECT * FROM ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."'";
	$resultado_ciclo = mysqli_query($conexion,$sql_ciclo);
	$fila_ciclo = mysqli_fetch_array($resultado_ciclo);
	
?>
<form id="Frm_Ciclos_Escolares_Nuevo">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4">CICLO ESCOLAR</th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej">
				<label>Tipo de Pograma <span id="lbl_id_Carrera_Tipo"></span></label>                   
			</td>
			<td class="cuej">
				<label>Ciclo Escolar<span id="lbl_Ciclo_Escolar"></span></label>                   
			</td>
			<td class="cuej">
				<label>Periodo<span id="lbl_Periodo"></span></label>                   
			</td>
			<td class="cuej">
				<label>A&ntilde;o<span id="lbl_Anio"></span></label>                   
			</td>
		</tr>
		<tr>
			<td class="cuej">
				<select class="campo" name = "Carrera_Tipo" id = "Carrera_Tipo" onChange="Ciclos_Escolares_Actualizar(<?php echo $_POST["id_Ciclo_Escolar"] ?>, 'id_carrera_tipo', $(this).val(), 'lbl_id_Carrera_Tipo')">
					<option value="">&nbsp;</option>
<?php
	$sql_carreras_tipo = "SELECT id_carrera_tipo, carrera_tipo FROM carreras_tipo;";
	$resultado_carreras_tipo =mysqli_query($conexion, $sql_carreras_tipo);
	
	while($fila_carreras_tipo = mysqli_fetch_array($resultado_carreras_tipo))
	{
?>
					<option value= "<?php echo $fila_carreras_tipo["id_carrera_tipo"]; ?>" <?php if($fila_carreras_tipo["id_carrera_tipo"] == $fila_ciclo["id_carrera_tipo"]) echo "selected"; ?>><?php echo utf8_encode($fila_carreras_tipo["carrera_tipo"]); ?></option>
<?php
	}
?>
				</select>
			</td>
			<td class="cuej">
				<input class="campo" type = "text" name = "Ciclo_Escolar" id = "Ciclo_Escolar" value = "<?php echo utf8_encode($fila_ciclo["ciclo_escolar"]); ?>" onBlur="Ciclos_Escolares_Actualizar(<?php echo $_POST["id_Ciclo_Escolar"] ?>, 'ciclo_escolar', $(this).val(), 'lbl_Ciclo_Escolar')" />
			</td>
			<td class="cuej">
				<select id="Periodo" name="Periodo" class="campo" onChange="Ciclos_Escolares_Actualizar(<?php echo $_POST["id_Ciclo_Escolar"] ?>, 'mes_inicio', $(this).val()+','+$('#Carrera_Tipo').val(), 'lbl_Periodo')">
<?php
	if($fila_ciclo["id_carrera_tipo"] == 1 || $fila_ciclo["id_carrera_tipo"] == 3 )
	{
?>
					<option value='1' <?php if($fila_ciclo["mes_inicio"] == 1) echo "selected"; ?>>ENE-JUN</option>
					<option value='2' <?php if($fila_ciclo["mes_inicio"] == 7) echo "selected"; ?>>JUL-DIC</option>
<?php
	}
	else if($fila_ciclo["id_carrera_tipo"] == 2)
	{
?>
					<option value='1' <?php if($fila_ciclo["mes_inicio"] == 1) echo "selected"; ?>>ENE-ABR</option>
					<option value='2' <?php if($fila_ciclo["mes_inicio"] == 5) echo "selected"; ?>>MAY-AGO</option>
					<option value='3' <?php if($fila_ciclo["mes_inicio"] == 9) echo "selected"; ?>>SEP-DIC</option>
<?php
	}
		
?>
				</select>
			</td>
			<td class="cuej">
				<select id="Anio" name="Anio" class="campo" onChange="Ciclos_Escolares_Actualizar(<?php echo $_POST["id_Ciclo_Escolar"] ?>, 'periodo', $(this).val(), 'lbl_Anio')" >
<?php
	$inicio = date("Y")-10;
	$fin = date("Y")+5;
	
	for($i = $inicio; $i <= $fin; $i++)
	{
?>
					<option value="<?php echo $i; ?>" <?php if($i == $fila_ciclo["periodo"]) echo "selected"; ?>><?php echo $i; ?></option>
<?php		
	}
?>
				</select>                 
			</td>
			
		 </tr>
		 <tr>
			<td class="cuej">
				<label>Fecha Inicio <span id="lbl_Fecha_Inicio"></span></label>                   
			</td>
			<td class="cuej">
				<label>Fecha Fin<span id="lbl_Fecha_Fin"></span></label>                   
			</td>
			<td class="cuej" colspan="2"></td>
		 </tr>
		 <tr>
			<td class="cuej">
				<input class="campo" type = "text" name = "Fecha_Inicio" id = "Fecha_Inicio" value = "<?php echo utf8_encode($fila_ciclo["fecha_inicio"]); ?>" onChange="Ciclos_Escolares_Actualizar(<?php echo $_POST["id_Ciclo_Escolar"] ?>, 'fecha_inicio', $(this).val(), 'lbl_Fecha_Inicio')" readonly />
			</td>
			<td class="cuej">
				<input class="campo" type = "text" name = "Fecha_Fin" id = "Fecha_Fin" value = "<?php echo utf8_encode($fila_ciclo["fecha_fin"]); ?>" onChange="Ciclos_Escolares_Actualizar(<?php echo $_POST["id_Ciclo_Escolar"] ?>, 'fecha_fin', $(this).val(), 'lbl_Fecha_Fin')" readonly />
			</td>
			<td class="cuej" colspan="2"></td>
		 </tr>
	 </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="4"></th>
        </tr>
     </tfoot>
</table>
<center>
	<input class="button" type="button" id = "Btn_Regresar" name = "Btn_Regresar"  value = "Regresar" /> 
</center>
</form>