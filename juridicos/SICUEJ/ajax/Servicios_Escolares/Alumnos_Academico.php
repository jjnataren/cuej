<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 21 2016]	
	-- País: México
	-- Objetivo: Datos del Alumno con Opción a Modificación
	-- Última Modificación: [Mayo, 21 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_alumno = "SELECT * FROM alumnos WHERE id_alumno = '".$_POST["id_Alumno"]."';";
	$resultado_alumno = mysqli_query($conexion, $sql_alumno);
	$fila_alumno = mysqli_fetch_array($resultado_alumno);
	
	$sql_programas = "SELECT id_alumno_programa, id_alumno, plan_estudios, cuenta, carrera, fecha_baja, fecha_concluido, fecha_titulado, alumnos_programas.estatus  FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno = '".$_POST["id_Alumno"]."';";
	$resultado_programas = mysqli_query($conexion, $sql_programas);
	
	
?>
<form id="Frm_Alumnos_Academico">
<table align="left" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4">DATOS GENERALES DEL ALUMNO</th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej">
				<label>Nombre <span id="lbl_Nombre"></span></label>                   
			</td>			
			<td class="cuej">
				<label>Apellido Paterno<span id="lbl_Apellido_Paterno"></span></label>                   
			</td>
			<td class="cuej">
				<label>Apellido Materno <span id="lbl_Apellido_Materno"></span></label>
			</td>
			<td class="cuej">
				<label>Usuario <span id="lbl_Usuario"></span></label>
			</td>
		 </tr>
		 <tr>
			<td class="cuej">
				<span class="dato"><?php echo utf8_encode($fila_alumno["nombre"]); ?></span>
			</td>			
			<td class="cuej">
				<span class="dato"><?php echo utf8_encode($fila_alumno["apellido_paterno"]); ?></span>
			</td>
			<td class="cuej">
				<span class="dato"><?php echo utf8_encode($fila_alumno["apellido_materno"]); ?></span>
			</td>
			<td class="cuej">
				<span class="dato"><?php echo utf8_encode($fila_alumno["usuario"]); ?></span>
			</td>
		 </tr>
	 </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="4"></th>
        </tr>
     </tfoot>
</table>
</form>
<p>&nbsp;</p>
<div id="div_Programa_Academico">
<table class="cuej" width="100%">
	<thead>
		<tr>
			<th class="cuej">PROGRAMA ACAD&Eacute;MICO</th>
			<th class="cuej">PLAN DE ESTUDIOS</th>
			<th class="cuej">CUENTA</th>
			<th class="cuej">ESTATUS</th>
			<th class="cuej">OPCIONES</th>
		</tr>
	</thead>
	<tbody>
<?php
	while($fila_programas = mysqli_fetch_array($resultado_programas))
	{
		if($fila_programas["estatus"] == 0)
			$estatus = "INACTIVO";
		else
		{		
			if($fila_programas["fecha_baja"] != "0000-00-00")
				$estatus = "BAJA";
			else if($fila_programas["fecha_titulado"] != "0000-00-00")
				$estatus = "TITULADO";
			else if($fila_programas["fecha_concluido"] != "0000-00-00")
				$estatus = "CONCLUIDO";
			else
				$estatus = "EN CURSO";
		}
		
?>
		<tr>
			<td class="cuej">
				<a href="javascript: Alumnos_Academico_Programa_Datos('<?php echo $fila_programas["id_alumno_programa"]; ?>','<?php echo $fila_programas["id_alumno"]; ?>')"><?php echo utf8_encode($fila_programas["carrera"]); ?></a>
			</td>
			<td class="cuej" align="center"><?php echo utf8_encode($fila_programas["plan_estudios"]); ?></td>
			<td class="cuej" align="center"><?php echo utf8_encode($fila_programas["cuenta"]); ?></td>
			<td class="cuej" align="center"><?php echo utf8_encode($estatus); ?></td>
			<td class="cuej" align="center">
               	<a href="javascript: Alumnos_Academico_Programa_Eliminar('<?php echo $fila_programas["id_alumno_programa"]; ?>','<?php echo $fila_programas["id_alumno"]; ?>')">Eliminar</a> | <a href="javascript: Alumnos_Academico_Programa_Historial('<?php echo $fila_programas["id_alumno_programa"]; ?>','<?php echo $fila_programas["id_alumno"]; ?>');">Historial</a>|<a href="javascript: Alumnos_Academico_Programa_Boleta('<?php echo $fila_programas["id_alumno_programa"]; ?>','<?php echo $fila_programas["id_alumno"]; ?>');" >Boleta</a></td>
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
<p>&nbsp;</p>
<p align="center">
	<input type="button" class="button" value="Inscribir Programa" name="Registrar_Programa" id="Registrar_Programa"  />
</p>
</div>
