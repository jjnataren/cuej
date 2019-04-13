<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Busqueda de Horarios para el grupo seleccionado
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//Verificamos que el acta esté o no cerrada
	
	$sql_horario = "SELECT * FROM horarios WHERE id_grupo='".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";
	$resultado_horario = mysqli_query($conexion, $sql_horario);
	$fila_horario = @mysqli_fetch_array($resultado_horario);
	
	$sql = "SELECT alumnos_evaluaciones.* FROM alumnos_evaluaciones JOIN alumnos_programas USING(id_alumno_programa) JOIN alumnos USING(id_alumno) WHERE alumnos_evaluaciones.id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."' AND id_periodo = 3 AND estatus = 1 ORDER BY apellido_paterno, apellido_materno, nombre; ";	
	$resultado = mysqli_query($conexion, $sql);	
	$registros = @mysqli_num_rows($resultado);
	
	if($registros > 0)
	{
	
?>
     <table class="cuej" width="70%">
     	<thead>
          	<tr>
               	<th class="cuej" >No.</th>
                    <th class="cuej" >Cuenta</th>
                    <th class="cuej" >Alumno</th>
                    <th class="cuej" >Calificaci&oacute;n</th>
                    <th class="cuej" >&nbsp;</th>
               </tr>
          </thead>
          <tbody>
<?php
			$i=0;
		
			while($fila = mysqli_fetch_array($resultado))
			{
				$i++;
				
				$sql_alumno = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN  alumnos_programas USING(id_alumno) WHERE id_alumno_programa = '".$fila["id_alumno_programa"]."';";
				$resultado_alumno = mysqli_query($conexion, $sql_alumno);
				$fila_alumno = mysqli_fetch_array($resultado_alumno);
			
?>
			<tr>
                    <td class="cuej cuej_actas" width="25px"><?php echo $i; ?></td>                    
                    <td class="cuej cuej_actas" align="center" width="80px"><?php echo $fila_alumno["cuenta"]; ?></td>
                    <td class="cuej cuej_actas" width="200px"><?php echo utf8_encode($fila_alumno["apellido_paterno"]." ".$fila_alumno["apellido_materno"]." ".$fila_alumno["nombre"]); ?></td>
                    <td class="cuej cuej_actas" align="center">
<?php
				if($fila_horario["acta_cerrada"] == 0)
				{
?>
                    	<select class="campo calificacion" name="Calificacion_<?php echo $fila["id_alumno_evaluacion"]; ?>" id="Calificacion_<?php echo $fila["id_alumno_evaluacion"]; ?>" onChange="Calificaciones_Actualizar('<?php echo $fila["id_alumno_evaluacion"];?>',$(this).val())">
                         	<option value="" <?php if($fila["calificacion"] == "") echo "selected"; ?>></option>
                              <option value="NP" <?php if($fila["calificacion"] == "NP") echo "selected"; ?>>NP</option>
                              <option value="NA" <?php if($fila["calificacion"] == "NA") echo "selected"; ?>>NA</option>
                              <option value="5" <?php if($fila["calificacion"] == "5") echo "selected"; ?>>5</option>
                              <option value="6" <?php if($fila["calificacion"] == "6") echo "selected"; ?>>6</option>
                              <option value="7" <?php if($fila["calificacion"] == "7") echo "selected"; ?>>7</option>
                              <option value="8" <?php if($fila["calificacion"] == "8") echo "selected"; ?>>8</option>
                              <option value="9" <?php if($fila["calificacion"] == "9") echo "selected"; ?>>9</option>
                              <option value="10" <?php if($fila["calificacion"] == "10") echo "selected"; ?>>10</option>
                         </select>
<?php
				}
				else
				{
?>
					<label><?php echo $fila["calificacion"]; ?></label>
<?php	
				}
?>
                    </td>
                    <td class="cuej cuej_actas" align="center">
                    	<span id="lbl_Calificacion_<?php echo $fila["id_alumno_evaluacion"]; ?>"></span>
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
     <p align="center">
     	<center>
     	<form name="Formulario" id="Formulario" action="../impresiones/Servicios_Escolares/Calificaciones_Acta_PDF.php" method="POST" target="_blank" >
          	<input type="hidden" name="id_Grupo" id="id_Grupo" value="<?php echo $_POST["id_Grupo"]; ?>" />
          	<input type="hidden" name="id_Materia" id="id_Materia" value="<?php echo $_POST["id_Materia"]; ?>" />
          
     		<input type="submit" value="Ver Acta" class="button"/>
          </form>
<?php
			if($fila_horario["acta_cerrada"] == 0)
			{
?>
			<input type="button" class="button" value="Cerrar Acta" name="Btn_Cerrar_Acta" id="Btn_Cerrar_Acta" />
               <h4>Nota: Al cerrar el Acta, las calificaciones pasarán al historial del alumno y serán consideradas como calificaciones oficiales</h4>
<?php	
			}
			else if($fila_horario["acta_cerrada"] == 1)
			{
?>
			<input type="button" class="button" value="Abrir Acta" name="Btn_Abrir_Acta" id="Btn_Abrir_Acta" />
<?php
			}
?>          
     	</center>
     </p>
<?php
	}
	else
	{
?>
	<p align="center">No existen alumnos inscritos activos en la materia seleccionada</p>
<?php
	}
?>
