<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 10 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Grupo
	-- Última Modificación: [Mayo, 10 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
?>
<form id="Frm_Grupos_Nuevo">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">NUEVO GRUPO</th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej" colspan="3">
				<label>* Programa Acad&eacute;mico <span id="lbl_id_Carrera"></span></label>                   
			</td>
		 </tr>
		 <tr>
			<td class="cuej" colspan="3">
				<select name="id_Carrera_Nuevo" id="id_Carrera_Nuevo" class="campo">
					<option value="">&nbsp;</option>
<?php 
	$sql_carreras = "SELECT * FROM carreras ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras = mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = mysqli_fetch_array($resultado_carreras))
	{
?>
					<option value="<?php echo $fila_carreras["id_carrera"]; ?>"><?php echo utf8_encode($fila_carreras["carrera"]); ?></option>
<?php
	}
?>
				</select>                   
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<label>* Plan de Estudio <span id="lbl_id_Plan_Estudio"></span></label>                   
			</td>			
			<td class="cuej">
				<label>* Ciclo Escolar<span id="lbl_Ciclo_Escolar"></span></label>                   
			</td>
			<td class="cuej">
				<label>* Semestre/Cuatrimestre <span id="lbl_Semestre"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<select id="id_Plan_Estudio" name="id_Plan_Estudio" class="campo">
				
				</select>                   
			</td>			
			<td class="cuej">
				<select id="id_Ciclo_Escolar_Nuevo" name="id_Ciclo_Escolar_Nuevo" class="campo">
				
				</select>                 
			</td>
			<td class="cuej">
				<select id="Semestre" name="Semestre" class="campo">
				
				</select>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<label>* Grupo <span id="lbl_Grupo"></span></label>                   
			</td>
			<td class="cuej">
				<label>* Tipo de Grupo<span id="lbl_Tipo_Grupo"></span></label>                   
			</td>
			<td class="cuej">
				<label>* Sal&oacute;n <span id="lbl_Salon"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<input type="text" class="campo" id="Grupo" name="Grupo"  value=""/>                   
			</td>
			<td class="cuej">
				<select name="Tipo_Grupo" id="Tipo_Grupo" class="campo">
					<option value="ORDINARIO">ORDINARIO</option>
					<option value="EXTRAORDINARIO">EXTRAORDINARIO</option>
				</select>                   
			</td>
			<td class="cuej">
				<input type="text" class="campo" id="Salon" name="Salon"  value=""/>
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
	<input class="button" type="button" id = "Btn_Nuevo_Registrar" name = "Btn_Nuevo_Registrar"  value = "Registrar" />
	<input class="button" type="button" id = "Btn_Cancelar" name = "Btn_Cancelar"  value = "Cancelar" /> 
</p>
</form>