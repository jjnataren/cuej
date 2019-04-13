<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 17 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Horario
	-- Última Modificación: [Mayo, 17 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_carrera = "SELECT id_carrera FROM planes_estudio WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
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
               	<select class="campo" name="id_Materia" id="id_Materia">
<?php
$sql = "SELECT * FROM materias WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' AND semestre = '".$_POST["Semestre"]."'";	
$resultado = mysqli_query($conexion, $sql);
?>
					<option value="" selected >&nbsp;</option>
<?php	
	while($fila = mysqli_fetch_array($resultado))
	{
		$sql_materias = "SELECT COUNT(*) AS registros FROM horarios WHERE id_materia = '".$fila["id_materia"]."' AND id_grupo = '".$_POST["id_Grupo"]."';";
		
		$resultado_materias = mysqli_query($conexion, $sql_materias);
		$fila_materias = mysqli_fetch_array($resultado_materias);
		
		if($fila_materias["registros"] == 0)
		{
?>
					<option value="<?php echo $fila["id_materia"]; ?>"><?php echo utf8_encode($fila["materia"]); ?></option>
<?php	
		}
	}
?>
                    </select>
                    <input type="hidden" value="<?php echo $_POST["id_Grupo"]; ?>" name="id_Grupo" id="id_Grupo" />
               </td>
          </tr>
          <tr>
          	<td>
				<label>Profesor: </label>
			</td>
          	<td colspan="5">
               	<select class="campo" name="id_Profesor" id="id_Profesor">
<?php
	$sql = "SELECT * FROM profesores JOIN profesores_carreras USING(id_profesor) WHERE estatus = 1 AND id_carrera = '".$fila_carrera["id_carrera"]."' ORDER BY apellido_paterno, apellido_materno, nombre;";
	$resultado = mysqli_query($conexion, $sql);
?>
					<option value="" selected >&nbsp;</option>
<?php	
	while($fila = @mysqli_fetch_array($resultado))
	{
?>
					<option value="<?php echo $fila["id_profesor"]; ?>"><?php echo utf8_encode($fila["titulo"]." ".$fila["nombre"]." ".$fila["apellido_paterno"]." ".$fila["apellido_materno"]); ?></option>
<?php	
	}
?>                    </select>
               </td>
          </tr>
<?php
	$sql_grupo = "SELECT tipo_grupo FROM grupos WHERE id_grupo = '".$_POST["id_Grupo"]."';";
	$resultado_grupo = mysqli_query($conexion, $sql_grupo);
	$fila_grupo = @mysqli_fetch_array($resultado_grupo);
	
	if($fila_grupo["tipo_grupo"] == "ORDINARIO")
	{
?>
          <tr>
          	   <th>Lunes</th>
               <th>Martes</th>
               <th>Mi&eacute;rcoles</th>
               <th>Jueves</th>
               <th>Viernes</th>
               <th>S&aacute;bado</th>
          </tr>
          <tr>
<?php
	for($dia = 1; $dia <= 6; $dia++)
	{
?>          
          	<td align="center">
               	<select class="campo" id="Hora_Inicio_<?php echo $dia; ?>" name="Hora_Inicio_<?php echo $dia; ?>">
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
					<option value="<?php echo $hora; ?>"><?php echo $hora; ?></option>
<?php					
			}
		}
?>
                    	
                    </select><br />a<br />
                    <select class="campo" id="Hora_Fin_<?php echo $dia; ?>" name="Hora_Fin_<?php echo $dia; ?>">
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
					<option value="<?php echo $hora; ?>"><?php echo $hora; ?></option>
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
<?php
	}
	else if($fila_grupo["tipo_grupo"] == "EXTRAORDINARIO")
	{
?>
		  <tr>
				<td>
					<label>Fecha: </label>
				</td>
				<td colspan="5">
					
				</td>
		  </tr>
		  <tr>
				<td>
					<label>Hora: </label>
				</td>
				<td colspan="5">
					
				</td>
		  </tr>
<?php	
	}		
?>
          <tr>
			<td colspan="6" align="center">
				<br /><input type="button" class="button" value="Registrar" name="Btn_Registrar" id="Btn_Registrar" />
			</td>
		</tr>
     </table>
</form>