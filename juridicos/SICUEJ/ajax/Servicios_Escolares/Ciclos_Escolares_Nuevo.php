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
?>
<form id="Frm_Ciclos_Escolares_Nuevo">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4">NUEVO CICLO ESCOLAR</th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej">
				<label>* Tipo de Pograma <span id="lbl_id_Carrera_Tipo"></span></label>                   
			</td>
			<td class="cuej">
				<label>* Ciclo Escolar<span id="lbl_Ciclo_Escolar"></span></label>                   
			</td>
			<td class="cuej">
				<label>* Periodo<span id="lbl_Fecha_Fin"></span></label>                   
			</td>
			<td class="cuej">
				<label>* A&ntilde;o<span id="lbl_Fecha_Fin"></span></label>                   
			</td>
		</tr>		
		 <tr>
			<td class="cuej">
				<select class="campo" name = "Carrera_Tipo" id = "Carrera_Tipo">
					<option value="">&nbsp;</option>
<?php
	$sql_carreras_tipo = "SELECT id_carrera_tipo, carrera_tipo FROM carreras_tipo;";
	$resultado_carreras_tipo =mysqli_query($conexion, $sql_carreras_tipo);
	
	while($fila_carreras_tipo = mysqli_fetch_array($resultado_carreras_tipo))
	{
?>
					<option value= "<?php echo $fila_carreras_tipo["id_carrera_tipo"]; ?>"><?php echo utf8_encode($fila_carreras_tipo["carrera_tipo"]); ?></option>
<?php
	}
?>
				</select>
			</td>
			<td class="cuej">
				<input class="campo" type = "text" name = "Ciclo_Escolar" id = "Ciclo_Escolar" value = ""/>
			</td>
			<td class="cuej">
				<select id="Periodo" name="Periodo" class="campo">
				</select>
			</td>
			<td class="cuej">
				<select id="Anio" name="Anio" class="campo">
<?php
	$inicio = date("Y")-10;
	$fin = date("Y")+5;
	
	for($i = $inicio; $i <= $fin; $i++)
	{
?>
					<option value="<?php echo $i; ?>" <?php if($i == date("Y")) echo "selected"; ?>><?php echo $i; ?></option>
<?php		
	}
?>
				</select>
			</td>
		</tr>
		 <tr>
			<td class="cuej" >
				<label>* Fecha Inicio <span id="lbl_Fecha_Inicio"></span></label>                   
			</td>
			<td class="cuej" >
				<label>* Fecha Fin<span id="lbl_Fecha_Fin"></span></label>                   
			</td>
			<td class="cuej" colspan="2"></td>
		 </tr>
		 </tr>
			<td class="cuej">
				<input class="campo" type = "text" name = "Fecha_Inicio" id = "Fecha_Inicio" value = "" readonly />
			</td>
			<td class="cuej">
				<input class="campo" type = "text" name = "Fecha_Fin" id = "Fecha_Fin" value = "" readonly />
			</td>
			<td class="cuej" colspan="2"></td>
		 </tr>
		 <tr>
			<td colspan="4" align="center" class="cuej">
				 
			</td>
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