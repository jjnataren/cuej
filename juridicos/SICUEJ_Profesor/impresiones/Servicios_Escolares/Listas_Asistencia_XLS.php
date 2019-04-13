<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Listas de Asistencia en Formato PDF
	-- Última Modificación: [Junio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: filename=\"Listas_Asistencia.xls\";");

$sql_programa = "SELECT id_carrera_tipo, carrera, plan_estudios, id_ciclo_escolar, semestre, grupo FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_grupo = '".$_POST["id_Grupo"]."';";
$resultado_programa = mysqli_query($conexion, $sql_programa);
$fila_programa = @mysqli_fetch_array($resultado_programa);

$sql_ciclo = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$fila_programa["id_ciclo_escolar"]."';";
$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
$fila_ciclo = @mysqli_fetch_array($resultado_ciclo);

$sql_materia = "SELECT * FROM materias WHERE id_materia = '".$_POST["id_Materia"]."';";
$resultado_materia = mysqli_query($conexion, $sql_materia);
$fila_materia = mysqli_fetch_array($resultado_materia);

$sql_profesor = "SELECT * FROM profesores JOIN horarios USING(id_profesor) WHERE id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."';";
$resultado_profesor = mysqli_query($conexion, $sql_profesor);
$fila_profesor = mysqli_fetch_array($resultado_profesor);


$sql = "SELECT alumnos_evaluaciones.id_alumno_programa FROM alumnos_evaluaciones JOIN alumnos_programas USING(id_alumno_programa) JOIN alumnos USING(id_alumno) WHERE alumnos_evaluaciones.id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."' AND alumnos_programas.estatus = 1 ORDER BY apellido_paterno, apellido_materno, nombre; ";
$resultado = mysqli_query($conexion, $sql);	
$registros = @mysqli_num_rows($resultado);

if($fila_programa["id_carrera_tipo"] == 1)
	$cuadros = 32;
else if($fila_programa["id_carrera_tipo"] == 2)
	$cuadros = 14;
else if($fila_programa["id_carrera_tipo"] == 3)
	$cuadros = 16;

?>
<table align="center" width="100%">
		<tr>
			<td align="left" width="30%"><img src="../../imagenes/logo_cuej_negro.png" /></td>
			<td align="left">
				<table>
					<tr>
						<td colspan="2" align="center"><h3>LISTAS DE ASISTENCIA</h3></td>
					</tr>
					<tr>
						<td>Programa Acad&eacute;mico: </td>
						<td><?php echo ($fila_programa["carrera"]).' PLAN '.$fila_programa["plan_estudios"]; ?></td>
					</tr>
					<tr>
						<td>Ciclo Escolar: </td>
						<td><?php echo ($fila_ciclo["ciclo_escolar"]); ?></td>
					</tr>
					<tr>
						<td>Grupo: </td>
						<td><?php echo ($fila_programa["grupo"]); ?></td>
					</tr>
					<tr>
						<td>Semestre: </td>
						<td><?php echo ($fila_programa["semestre"]); ?></td>
					</tr>
					<tr>
						<td>Asignatura: </td>
						<td><?php echo ($fila_materia["materia"]); ?></td>
					</tr>
					<tr>
						<td>Profesor: </td>
						<td><?php echo htmlentities($fila_profesor["titulo"]." ".$fila_profesor["nombre"]." ".$fila_profesor["apellido_paterno"]." ".$fila_profesor["apellido_materno"]); ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table  width="100%" class="cuej" border="1">
     	<thead>
          	<tr>
               	<th class="cuej"  rowspan="2" >No.</th>
                    <th class="cuej"  rowspan="2" width="250px" >Alumno</th>
                    <th class="cuej"  colspan="<?php echo $cuadros; ?>">SESIONES</th>
				<th class="cuej"  rowspan="2" colspan="2" >TRABAJOS</th>
				<th class="cuej"  rowspan="2" >EXAMEN</th>
				<th class="cuej"  rowspan="2" colspan="2" >E. FINAL</th>
               </tr>
               <tr>
<?php
for($i=1; $i<= $cuadros; $i++)
{
?>
				<th ><?php echo $i ?></th>
<?php
	}
?>
	
               </tr>
          </thead>
          <tbody>
<?php	
	$i=0;
		
	while($fila = mysqli_fetch_array($resultado))
	{
		$i++;
			
		$sql_alumno = "SELECT apellido_paterno, apellido_materno, nombre, cuenta FROM alumnos JOIN  alumnos_programas USING(id_alumno) WHERE id_alumno_programa = '".$fila["id_alumno_programa"]."' ORDER BY apellido_paterno, apellido_materno, nombre;";
		$resultado_alumno = mysqli_query($conexion, $sql_alumno);
		$fila_alumno = mysqli_fetch_array($resultado_alumno);
?>
			<tr>
				<td class="cuej" width="25px"><?php echo $i; ?> </td>
				<td class="cuej" width="250px"><?php echo($fila_alumno["apellido_paterno"]." ".$fila_alumno["apellido_materno"]." ".$fila_alumno["nombre"]); ?> </td>
<?php
		for($j=1; $j<= $cuadros; $j++)
		{
?>
				<td class="cuej" width="20px" align="center"></td>
<?php
		}
?>	
				<td class="cuej" align="center"></td>
				<td class="cuej" align="center"></td>
				<td class="cuej" align="center"></td>
				<td class="cuej" align="center"></td>
				<td class="cuej" align="center"></td>
			</tr>
<?php			
	}
?>
		</tbody>
          <tfoot>
          	<tr>
               	<th class="cuej" colspan="<?php echo $cuadros+7; ?>"></th>
               </tr>
          </tfoot>
     </table>

<table width="100%">
	<tr>
		<td align="center" colspan="<?php echo $cuadros+7; ?>"><h6>Centro Universitario de Estudios Jur&iacute;dicos</h6></td>
	</tr>
	<tr>
		<td align="center" colspan="<?php echo $cuadros+7; ?>"><h6>Municipio  Libre 103 Col. Portales. Benito Ju&aacute;rez. C.P. 03300 Ciudad de M&eacute;xico</h6></td>
	</tr>
	<tr>
		<td align="center" colspan="<?php echo $cuadros+7; ?>"><h6>Tel:55-75-98-40</h6></td>
	</tr>
</table>
