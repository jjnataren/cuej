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
	
	$sql = "SELECT alumnos_evaluaciones.id_alumno_programa FROM alumnos_evaluaciones JOIN alumnos_programas USING(id_alumno_programa) JOIN alumnos USING(id_alumno) WHERE alumnos_evaluaciones.id_grupo = '".$_POST["id_Grupo"]."' AND id_materia = '".$_POST["id_Materia"]."' AND alumnos_programas.estatus = 1 ORDER BY apellido_paterno, apellido_materno, nombre; ";
	
	$resultado = mysqli_query($conexion, $sql);	
	$registros = @mysqli_num_rows($resultado);
	
	if($registros > 0)
	{
?>
     <table class="cuej" width="100%">
     	<thead>
          	<tr>
               	<th class="cuej" rowspan="2">No.</th>
                    <th class="cuej" rowspan="2">Cuenta</th>
                    <th class="cuej" rowspan="2">Alumno</th>
                    <th class="cuej" colspan="5">Fechas</th>
               </tr>
               <tr>
               	<th class="cuej" ></th>
                    <th class="cuej" ></th>
                    <th class="cuej" ></th>
                    <th class="cuej" ></th>
                    <th class="cuej" ></th>
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
                    <td class="cuej" width="25px"><?php echo $i; ?></td>                    
                    <td class="cuej" align="center" width="80px"><?php echo $fila_alumno["cuenta"]; ?></td>
                    <td class="cuej" width="200px"><?php echo utf8_encode($fila_alumno["apellido_paterno"]." ".$fila_alumno["apellido_materno"]." ".$fila_alumno["nombre"]); ?></td>
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
               	<th class="cuej" colspan="8"></th>
               </tr>
          </tfoot>
     </table>
     <p align="center">
     	<form name="Formulario" id="Formulario" action="../impresiones/Servicios_Escolares/Listas_Asistencia_PDF.php" method="POST" target="_blank" >
          	<input type="hidden" name="id_Grupo" name="id_Grupo" value="<?php echo $_POST["id_Grupo"]; ?>" />
          	<input type="hidden" name="id_Materia" name="id_Materia" value="<?php echo $_POST["id_Materia"]; ?>" />
          
     		<center><input type="submit" value="Descargar PDF" class="button"/></center>
          </form>
		  <form name="Formulario" id="Formulario" action="../impresiones/Servicios_Escolares/Listas_Asistencia_XLS.php" method="POST" target="_blank" >
          	<input type="hidden" name="id_Grupo" name="id_Grupo" value="<?php echo $_POST["id_Grupo"]; ?>" />
          	<input type="hidden" name="id_Materia" name="id_Materia" value="<?php echo $_POST["id_Materia"]; ?>" />
          
     		<center><input type="submit" value="Descargar XLS" class="button"/></center>
          </form>
     </p>
<?php
	}
	else
	{
?>
	<p align="center">
     	No existen alumnos inscritos o activos para &eacute;sta materia
    </p>
<?php
	}
?>
