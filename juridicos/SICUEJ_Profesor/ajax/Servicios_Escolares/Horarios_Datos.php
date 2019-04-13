<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 18 2016]	
	-- País: México
	-- Objetivo: Datos del Horario Seleccionado con opción a modificación dependiendo de permisos
	-- Última Modificación: [Mayo, 18 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT * FROM horarios JOIN materias USING(id_materia) WHERE id_horario = '".$_POST["id_Horario"]."'";
	$resultado = mysqli_query($conexion, $sql);
	$fila = mysqli_fetch_array($resultado);
	
	$sql_carrera = "SELECT id_carrera FROM planes_estudio JOIN materias USING(id_plan_estudio) WHERE id_materia = '".$fila["id_materia"]."';";
	$resultado_carrera = mysqli_query($conexion,$sql_carrera);
	$fila_carrera = @mysqli_fetch_array($resultado_carrera);

?>
<form id="Frm_Horarios_Nuevo">
<table width="100%">
     	<tr>
          	<td>
				<label>Materia: </label>
			</td>
          	<td colspan="5">
               	
<?php
echo utf8_encode($fila["materia"]);
?>                    
                    <input type="hidden" value="<?php echo $_POST["id_Grupo"]; ?>" name="id_Grupo" id="id_Grupo" />
               </td>
          </tr>
          <tr>
          	<td>
				<label>Profesor: </label>
			</td>
          	<td colspan="5">
               	<select class="campo" name="id_Profesor" id="id_Profesor" onChange="Horarios_Actualizar(<?php echo $_POST["id_Horario"] ?>, 'id_profesor', $(this).val(), 'lbl_id_Profesor')">
<?php
	$sql_profesor = "SELECT * FROM profesores JOIN profesores_carreras USING(id_profesor) WHERE estatus = 1 AND id_carrera = '".$fila_carrera["id_carrera"]."' ORDER BY apellido_paterno, apellido_materno, nombre;";	
	$resultado_profesor = mysqli_query($conexion, $sql_profesor);
?>
					<option value="" selected >&nbsp;</option>
<?php	
	while($fila_profesor = mysqli_fetch_array($resultado_profesor))
	{
?>
					<option value="<?php echo $fila_profesor["id_profesor"]; ?>" <?php if($fila["id_profesor"] == $fila_profesor["id_profesor"]) echo "selected"; ?>><?php echo utf8_encode($fila_profesor["titulo"]." ".$fila_profesor["nombre"]." ".$fila_profesor["apellido_paterno"]." ".$fila_profesor["apellido_materno"]); ?></option>
<?php	
	}
?>                    </select>
				  <span id="lbl_id_Profesor"></span>
               </td>
          </tr>
          <tr>
          	<th>Lun<span id="lbl_Horario_1"></span></th>
               <th>Mar<span id="lbl_Horario_2"></span></th>
               <th>Mi&eacute;<span id="lbl_Horario_3"></span></th>
               <th>Jue<span id="lbl_Horario_4"></span></th>
               <th>Vie<span id="lbl_Horario_5"></span></th>
               <th>S&aacute;b<span id="lbl_Horario_6"></span></th>
          </tr>
          <tr>
<?php
	for($dia = 1; $dia <= 6; $dia++)
	{
?>          
          	<td align="center">
               	<select class="campo" id="Hora_Inicio_<?php echo $dia; ?>" name="Hora_Inicio_<?php echo $dia; ?>" onChange="Horarios_Actualizar(<?php echo $_POST["id_Horario"] ?>, 'hora_inicio_<?php echo $dia; ?>', $(this).val(), 'lbl_Horario_<?php echo $dia; ?>')" >
                    	<option value="" selected></option>
<?php
		for($i = 7; $i <= 22; $i++)
		{
			for($j = 0; $j <= 1; $j++)
			{
				if($i < 10)
				{
					if($j == 0)
						$hora = "0".$i.":00";
					else if($j == 1)
						$hora = "0".$i.":30";
				}
				else
				{
					if($j == 0)
						$hora = $i.":00";
					else if($j == 1)
						$hora = $i.":30";
				}
?>
					<option value="<?php echo $hora; ?>" <?php if($fila["hora_inicio_".$dia] == ($hora.":00")) echo "selected"; ?>><?php echo $hora; ?></option>
<?php					
			}
		}
?>
                    	
                    </select><br />a<br />
                    <select class="campo" id="Hora_Fin_<?php echo $dia; ?>" name="Hora_Fin_<?php echo $dia; ?>" onChange="Horarios_Actualizar(<?php echo $_POST["id_Horario"] ?>, 'hora_fin_<?php echo $dia; ?>', $(this).val(), 'lbl_Horario_<?php echo $dia; ?>')">
                    	<option value="" selected></option>
<?php
		for($i = 7; $i <= 22; $i++)
		{
			for($j = 0; $j <= 1; $j++)
			{
				if($i < 10)
				{
					if($j == 0)
						$hora = "0".$i.":00";
					else if($j == 1)
						$hora = "0".$i.":30";
				}
				else
				{
					if($j == 0)
						$hora = $i.":00";
					else if($j == 1)
						$hora = $i.":30";
				}
?>
					<option value="<?php echo $hora; ?>" <?php if($fila["hora_fin_".$dia] == ($hora.":00")) echo "selected"; ?> ><?php echo $hora; ?></option>
<?php					
			}
		}
?>
                    </select>
               </td> 
<?php
	}
?>              
          </tr>
          <tr>
			<td colspan="6" align="center">
				<br /><input type="button" class="button" value="Regresar" name="Btn_Regresar" id="Btn_Regresar" />
			</td>
		</tr>
     </table>
</form>