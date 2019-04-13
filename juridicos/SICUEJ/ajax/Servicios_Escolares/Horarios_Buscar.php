<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 16 2016]	
	-- País: México
	-- Objetivo: Busqueda de Horarios para el grupo seleccionado
	-- Última Modificación: [Julio, 28 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Se agrega impresión de Horario en PDF
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT * FROM horarios JOIN profesores USING(id_profesor) WHERE id_grupo = '".$_POST["id_Grupo"]."'; ";	
	$resultado = mysqli_query($conexion, $sql);
	
	$registros = @mysqli_num_rows($resultado);	
	
?>
	<p align="right" >
     	<input type="button" class="button" name="Btn_Nuevo_Horario" id="Btn_Nuevo_Horario" value="Nuevo Horario" />
     </p>
     <form id="Frm_Impresion_Horario" name="Frm_Impresion_Horario" action="../impresiones/Servicios_Escolares/Horario_PDF.php" method="post" target="_blank" >
     <table class="cuej" width="100%">
     	<thead>
          	<tr>
               	<th class="cuej">Materia</th>
                    <th class="cuej">Profesor</th>
                    <th class="cuej">Lun</th>
                    <th class="cuej">Mar</th>
                    <th class="cuej">Mi&eacute;r</th>
                    <th class="cuej">Jue</th>
                    <th class="cuej">Vie</th>
                    <th class="cuej">S&aacute;b</th>
                    <th class="cuej">Opciones</th>
               </tr>
          </thead>
          <tbody>
<?php
		while($fila = mysqli_fetch_array($resultado))
		{
			$sql_materia = "SELECT materia FROM materias WHERE id_materia = '".$fila["id_materia"]."';";
			$resultado_materia = mysqli_query($conexion, $sql_materia);
			$fila_materia = @mysqli_fetch_array($resultado_materia);
?>
			<tr>
                      <td class="cuej"><a href="javascript: Horarios_Datos(<?php echo $fila["id_horario"]; ?>)"><?php echo utf8_encode($fila_materia["materia"]); ?></a></td>
                    <td class="cuej"><?php echo utf8_encode($fila["titulo"]." ".$fila["nombre"]." ".$fila["apellido_paterno"]." ".$fila["apellido_materno"]); ?></td>
                    <td class="cuej" align="center">
						<?php if($fila["hora_inicio_1"] != "00:00:00") echo utf8_encode(substr($fila["hora_inicio_1"],0,5)." <br />a<br /> ".substr($fila["hora_fin_1"],0,5)); else echo "-"; ?>
					</td>
                    <td class="cuej" align="center">
						<?php if($fila["hora_inicio_2"] != "00:00:00") echo utf8_encode(substr($fila["hora_inicio_2"],0,5)." <br />a<br /> ".substr($fila["hora_fin_2"],0,5)); else echo "-"; ?>
					</td>
                    <td class="cuej" align="center">
						<?php if($fila["hora_inicio_3"] != "00:00:00") echo utf8_encode(substr($fila["hora_inicio_3"],0,5)." <br />a<br /> ".substr($fila["hora_fin_3"],0,5)); else echo "-"; ?>
					</td>
                    <td class="cuej" align="center">
						<?php if($fila["hora_inicio_4"] != "00:00:00") echo utf8_encode(substr($fila["hora_inicio_4"],0,5)." <br />a<br /> ".substr($fila["hora_fin_4"],0,5)); else echo "-"; ?>
					</td>
                    <td class="cuej" align="center">
						<?php if($fila["hora_inicio_5"] != "00:00:00") echo utf8_encode(substr($fila["hora_inicio_5"],0,5)." <br />a<br /> ".substr($fila["hora_fin_5"],0,5)); else echo "-"; ?>
					</td>
                    <td class="cuej" align="center">
						<?php if($fila["hora_inicio_6"] != "00:00:00") echo utf8_encode(substr($fila["hora_inicio_6"],0,5)." <br />a<br /> ".substr($fila["hora_fin_6"],0,5)); else echo "-"; ?>
					</td>
                    <td>
                    	<a href="javascript: Horarios_Eliminar(<?php echo $fila["id_horario"]; ?>)">Eliminar</a>
                    </td>
               </tr>
               <tr>
				   <td class="cuej" colspan="9">&nbsp;</td>
               </tr>
<?php	
		}
?>
          </tbody>
          <tfoot>
          	<tr>
               	<th class="cuej" colspan="9"></th>
               </tr>
          </tfoot>
     </table>
     <br />
     <p align="center">
       <input  type="hidden" name="id_Grupo" id="id_Grupo" value="<?php echo $_POST["id_Grupo"]; ?>" />
       <input type="submit" name="Imprimir" id="Imprimir" value="Imprimir" class="button" />
     </p>
     </form>
