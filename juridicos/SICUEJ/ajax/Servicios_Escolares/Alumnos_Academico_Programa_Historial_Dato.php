<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 10 2016]	
	-- País: México
	-- Objetivo: Formulario para Modificación de Materia en Historial
	-- Última Modificación: [Junio, 10 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	
	$sql_programa = "SELECT id_plan_estudio, plan_estudios, id_carrera, carrera, id_carrera_tipo FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = @mysqli_fetch_array($resultado_programa);
	
	
	$sql_historial = "SELECT * FROM alumnos_historial JOIN materias USING(id_materia) WHERE id_alumno_historial = '".$_POST["id_Alumno_Historial"]."';";
	$resultado_historial = mysqli_query($conexion, $sql_historial);
	$fila_historial = mysqli_fetch_array($resultado_historial);
	
?>
<form id="Frm_Alumnos_Academico_Historial_Materia">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">HISTORIAL ACAD&Eacute;MICO <?php echo utf8_encode($fila_programa["carrera"]." PLAN DE ESTUDIOS ".$fila_programa["plan_estudios"]); ?></th>
        </tr>
        
     </thead>
	<tfoot>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
     </tfoot>
</table>
<p>&nbsp;</p>
<table align="center" width="50%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
        
     </thead>
     <tbody>		      
        <tr>
        		<th class="cuej" >Calificacion:</th>
                <td>
					<select class="campo" name="Calificacion" id="Calificacion" onChange="Alumnos_Academico_Historial_Actualizar(<?php echo $_POST["id_Alumno_Historial"] ?>, 'calificacion', $(this).val(), 'lbl_Calificacion')">
						<option value="" <?php if($fila_historial["calificacion"] == "") echo "selected"; ?> ></option>
						<option value="NP" <?php if($fila_historial["calificacion"] == "NP") echo "selected"; ?>>NP</option>
						<option value="5" <?php if($fila_historial["calificacion"] == "5") echo "selected"; ?>>5</option>
						<option value="6" <?php if($fila_historial["calificacion"] == "6") echo "selected"; ?>>6</option>
						<option value="7" <?php if($fila_historial["calificacion"] == "7") echo "selected"; ?>>7</option>
						<option value="8" <?php if($fila_historial["calificacion"] == "8") echo "selected"; ?>>8</option>
						<option value="9" <?php if($fila_historial["calificacion"] == "9") echo "selected"; ?>>9</option>
						<option value="10" <?php if($fila_historial["calificacion"] == "10") echo "selected"; ?>>10</option>
					</select>
				</td>
				<td>
					<span id="lbl_Calificacion"></span>
				</td>
        </tr>
        <tr>
        		 <th class="cuej" >Paso en:</th>
                 <td>
<?php
	$sql_ciclos = "SELECT * FROM ciclos_escolares WHERE id_carrera_tipo = '".$fila_programa["id_carrera_tipo"]."';";
	$resultado_ciclos = mysqli_query($conexion, $sql_ciclos);
?>
					<select class="campo" name="id_Ciclo_Escolar" id="id_Ciclo_Escolar" onChange="Alumnos_Academico_Historial_Actualizar(<?php echo $_POST["id_Alumno_Historial"] ?>, 'id_ciclo_escolar', $(this).val(), 'lbl_id_Ciclo_Escolar')">
						<option value="" <?php if($fila_historial["id_ciclo_escolar"] == "") echo "selected"; ?>></option>
<?php
	while($fila_ciclos = mysqli_fetch_array($resultado_ciclos))
	{
?>
						<option value="<?php echo $fila_ciclos["id_ciclo_escolar"]; ?>" <?php if($fila_historial["id_ciclo_escolar"] == $fila_ciclos["id_ciclo_escolar"]) echo "selected"; ?>><?php echo $fila_ciclos["ciclo_escolar"]; ?></option>
<?php
	}
?>
					</select>
				 
				 </td>
				 <td>
					<span id="lbl_id_Ciclo_Escolar"></span>
				</td>
        </tr>
        <tr>
        		 <th class="cuej" >Curso en:</th>
                <td>
					<select class="campo" name="Tipo" id="Tipo" onChange="Alumnos_Academico_Historial_Actualizar(<?php echo $_POST["id_Alumno_Historial"] ?>, 'tipo', $(this).val(), 'lbl_Tipo')">
						<option value="" <?php if($fila_historial["tipo"] == "") echo "selected"; ?>></option>
						<option value="1" <?php if($fila_historial["tipo"] == "1") echo "selected"; ?>>ORDINARIO</option>
						<option value="2" <?php if($fila_historial["tipo"] == "2") echo "selected"; ?>>EXTRAORDINARIO</option>
					</select>
				</td>
				<td>
					<span id="lbl_Tipo"></span>
				</td>
        </tr>
        <tr>
        		<th class="cuej" >Equivalencia:</th>
                <td>
					<select class="campo" name="Equivalencia" id="Equivalencia" onChange="Alumnos_Academico_Historial_Actualizar(<?php echo $_POST["id_Alumno_Historial"] ?>, 'equivalencia', $(this).val(), 'lbl_Equivalencia')">
						<option value="" <?php if($fila_historial["equivalencia"] == "") echo "selected"; ?>></option>
						<option value="1" <?php if($fila_historial["equivalencia"] == "1") echo "selected"; ?>>NO</option>
						<option value="2" <?php if($fila_historial["equivalencia"] == "2") echo "selected"; ?>>SI</option>
					</select>
				</td>
				<td>
					<span id="lbl_Equivalencia"></span>
				</td>
        </tr>
	</tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
     </tfoot>
</table>
</form>
<p align="center"><input type="button" value="Regresar" id="Btn_Regresar" name="Btn_Regresar" class="button" /></p>