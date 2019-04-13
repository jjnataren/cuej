<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 16 2016]	
	-- País: México
	-- Objetivo: Busqueda de Materias y Profesores para el grupo seleccionado
	-- Última Modificación: [Junio, 16 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql = "SELECT * FROM horarios JOIN profesores USING(id_profesor) WHERE id_grupo = '".$_POST["id_Grupo"]."'; ";	
	$resultado = mysqli_query($conexion, $sql);
	
	$registros = @mysqli_num_rows($resultado);	
	
?>
     <table class="cuej" width="80%" align="center">
     	<thead>
          	<tr>
               	<th class="cuej">Materia</th>
                    <th class="cuej">Profesor</th>
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
                      <td class="cuej"><a href="javascript: Evaluacion_Docente_Datos(<?php echo $fila["id_horario"]; ?>)"><?php echo utf8_encode($fila_materia["materia"]); ?></a></td>
                    <td class="cuej"><?php echo utf8_encode($fila["titulo"]." ".$fila["nombre"]." ".$fila["apellido_paterno"]." ".$fila["apellido_materno"]); ?></td>
               </tr>
<?php	
		}
?>
          </tbody>
          <tfoot>
          	<tr>
               	<th class="cuej" colspan="2"></th>
               </tr>
          </tfoot>
     </table>