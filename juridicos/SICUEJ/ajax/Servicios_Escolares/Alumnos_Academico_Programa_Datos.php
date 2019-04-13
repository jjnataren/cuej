<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 26 2016]	
	-- País: México
	-- Objetivo: Formulario de Registro de Nuevo Programa Académico para el alumno seleccionado
	-- Última Modificación: [Junio, 15 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_programa = " SELECT id_plan_estudio, plan_estudios, id_carrera, id_carrera_tipo, carrera, alumnos_programas.* FROM alumnos_programas JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = mysqli_fetch_array($resultado_programa);
?>

<table align="center" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="4">ACTUALIZACIÓN DE PROGRAMA ACAD&Eacute;MICO: <?php  echo utf8_encode($fila_programa["carrera"])." PLAN ".utf8_encode($fila_programa["plan_estudios"]); ?></th>
          </tr>
     </thead>
     <tbody>
		 <tr>
			<td class="cuej">
				<label>Estatus<span id="lbl_Estatus"></span></label>
			</td>
            <td class="cuej" colspan="3">
				<label>&nbsp;</label>                   
			</td>			
		 </tr>
		 <tr>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<select class="campo" name="Estatus" id="Estatus" onChange="Alumnos_Academico_Programa_Actualizar('<?php echo $fila_programa["id_alumno_programa"]; ?>','estatus',$(this).val(),'lbl_Estatus')">
					<option value="1" <?php if($fila_programa["estatus"] == 1) echo "selected"; ?>>ACTIVO</option>
					<option value="0" <?php if($fila_programa["estatus"] == 0) echo "selected"; ?>>INACTIVO</option>
				</select>
<?php
	}
	else
	{
?>
				<span class="dato"><?php if($fila_programa["estatus"] == 1) echo "ACTIVO"; else if($fila_programa["estatus"] == 0) echo "INACTIVO"; ?></span>
<?php
	}
?>
			</td>
            <td class="cuej" colspan="3">
				<label>&nbsp;</label>                   
			</td>			
		 </tr>		 
		 <tr>
			<td class="cuej">
				<label>Fecha Inicio<span id="lbl_Fecha_Inicio"></span></label>
			</td>
               <td class="cuej">
				<label>Fecha Concluido <span id="lbl_Fecha_Concluido"></span></label>                   
			</td>
			<td class="cuej">
				<label>Fecha Titulado<span id="lbl_Fecha_Titulado"></span></label>                   
			</td>
               <td class="cuej">
               	<label>Fecha Baja<span id="lbl_Fecha_Baja"></span></label>
               </td>			
		 </tr>
		 <tr>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" name="Fecha_Inicio" id="Fecha_Inicio" value="<?php echo $fila_programa["fecha_inicio"]; ?>" size="12" onChange="Alumnos_Academico_Programa_Actualizar('<?php echo $fila_programa["id_alumno_programa"]; ?>','fecha_inicio',$(this).val(),'lbl_Fecha_Inicio')"/>
<?php
	}
	else
	{
?>
				<span class="dato"><?php echo $fila_programa["fecha_inicio"]; ?></span>
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Fecha_Concluido" name="Fecha_Concluido"  value="<?php echo $fila_programa["fecha_concluido"]; ?>" size="12"  onChange="Alumnos_Academico_Programa_Actualizar('<?php echo $fila_programa["id_alumno_programa"]; ?>','fecha_concluido',$(this).val(),'lbl_Fecha_Concluido')"/>
<?php
	}
	else
	{
?>
				<span class="dato"><?php echo $fila_programa["fecha_concluido"]; ?></span>
<?php
	}
?>
			</td>
			<td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Fecha_Titulado" name="Fecha_Titulado"  value="<?php echo $fila_programa["fecha_titulado"]; ?>" size="12"  onChange="Alumnos_Academico_Programa_Actualizar('<?php echo $fila_programa["id_alumno_programa"]; ?>','fecha_titulado',$(this).val(),'lbl_Fecha_Titulado')"/>
<?php
	}
	else
	{
?>
				<span class="dato"><?php echo $fila_programa["fecha_titulado"]; ?></span>
<?php
	}
?>
			</td>
            <td class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
				<input type="text" class="campo" id="Fecha_Baja" name="Fecha_Baja"  value="<?php echo $fila_programa["fecha_baja"]; ?>" size="12"  onChange="Alumnos_Academico_Programa_Actualizar('<?php echo $fila_programa["id_alumno_programa"]; ?>','fecha_baja',$(this).val(),'lbl_Fecha_Baja')" />
<?php
	}
	else
	{
?>
				<span class="dato"><?php echo $fila_programa["fecha_baja"]; ?></span>
<?php
	}
?>			
			</td>
		 </tr>
           <tr>
			<td colspan="4" class="cuej">	
				<label>Observaciones<span id="lbl_Observaciones"></span></label>
			</td>
		 </tr>
		 <tr>
			<td colspan="4" class="cuej">
<?php
	if($_SESSION["Update"] == 1)
	{
?>			
				<textarea class="campo" name="Observaciones" id="Observaciones" cols="100" rows="3" onBlur="Alumnos_Academico_Programa_Actualizar('<?php echo $fila_programa["id_alumno_programa"]; ?>','observaciones',$(this).val(),'lbl_Observaciones')" ><?php echo utf8_encode($fila_programa["observaciones"]); ?></textarea>
<?php
	}
	else
	{
?>
				<span class="dato"><?php echo utf8_encode($fila_programa["observaciones"]); ?></span>
<?php
	}
?>
			</td>
		 </tr>           		 
	 </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="4"></th>
        </tr>
     </tfoot>
</table>
<p>&nbsp;</p>
<?php
	$sql_documentacion = "SELECT * FROM alumnos_documentacion JOIN documentacion USING(id_documento) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);	
?>
<table align="center" width="100%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="2">DOCUMENTACI&Oacute;N</th>
          </tr>
     </thead>
     <tbody>
<?php
	while($fila_documentacion = @mysqli_fetch_array($resultado_documentacion))
	{
?>
		<tr>
          	<td class="cuej"><?php echo utf8_encode($fila_documentacion["documento_largo"]); ?></td>
               <td class="cuej">
<?php
		if($_SESSION["Update"] == 1)
		{
?>
					<input type="text" class="campo fecha_documento" value="<?php echo $fila_documentacion["fecha_entrega"]; ?>" name="Fecha_Entrega_<?php echo $fila_documentacion["id_alumno_documentacion"]; ?>"  id="Fecha_Entrega_<?php echo $fila_documentacion["id_alumno_documentacion"]; ?>" size="12" onchange="Alumnos_Academico_Documentacion_Actualizar('<?php echo $fila_documentacion["id_alumno_documentacion"]; ?>','fecha_entrega',$(this).val(),'lbl_Documento_<?php echo $fila_documentacion["id_alumno_documentacion"]; ?>')"/><span id="lbl_Documento_<?php echo $fila_documentacion["id_alumno_documentacion"]; ?>"></span>
<?php
		}
		else
		{
?>
					<span class="dato"><?php echo $fila_documentacion["fecha_entrega"]; ?></span>
<?php
		}
?>
			  </td>

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
<p>&nbsp;</p>
<?php
	$sql_inscripciones = "SELECT DISTINCT(id_ciclo_escolar), ciclo_escolar, grupo, grupos.id_grupo FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) JOIN ciclos_escolares USING(id_ciclo_escolar) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."';";
	$resultado_inscripciones = mysqli_query($conexion, $sql_inscripciones);
	
?>
<table align="center" width="50%" class="cuej">
	<thead>
     	<tr>
          	<th class="cuej" colspan="3">INSCRIPCIONES</th>
          </tr>
     </thead>
     <tbody>
     	<tr>
            <th class="cuej">Ciclo Escolar</th>
			<th class="cuej">Grupo</th>
            <th class="cuej">Opciones</th>
        	</tr>
<?php
	while($fila_inscripciones = @mysqli_fetch_array($resultado_inscripciones))
	{
?>
		<tr>
          	<td class="cuej" align="center"><?php echo $fila_inscripciones["ciclo_escolar"];  ?></td>
			<td class="cuej" align="center"><?php echo $fila_inscripciones["grupo"];  ?></td>
            <td class="cuej" align="center">
            	<form id="Frm_Programa_Datos_<?php echo $fila_inscripciones["id_ciclo_escolar"];?>" action="../impresiones/Servicios_Escolares/Comprobante_Inscripcion_PDF.php" target="_blank" method="post">
					<input type="hidden" name="id_Alumno" id="id_Alumno" value="<?php echo $_POST["id_Alumno"]; ?>" >
                    <input type="hidden" name="id_Alumno_Programa" id="id_Alumno_Programa" value="<?php echo $_POST["id_Alumno_Programa"]; ?>" >
					<input type="hidden" name="Ciclo_Escolar" id="Ciclo_Escolar" value="<?php echo $fila_inscripciones["ciclo_escolar"]; ?>" >
					<input type="hidden" name="id_Ciclo_Escolar" id="id_Ciclo_Escolar" value="<?php echo $fila_inscripciones["id_ciclo_escolar"]; ?>" >
            		<input type="submit" value="PDF" />
                    </form>
            </td>
        </tr>
<?php
	}
?>
     </tbody>
     <tfoot>
     	<tr>
          	<th class="cuej" colspan="3"></th>
        </tr>
     </tfoot>
</table>
<p align="center">
	<input type="button" class="button" name="Btn_Reinscripcion" id="Btn_Reinscripcion" value="Reinscripci&oacute;n" />
	<input type="button" class="button" name="Btn_Regresar" id="Btn_Regresar" value="Regresar" />
</p>