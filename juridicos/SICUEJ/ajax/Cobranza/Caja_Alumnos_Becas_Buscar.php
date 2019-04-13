<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 30 2016]	
	-- País: México
	-- Objetivo: Datos de Becas y Montos del alumno
	-- Última Modificación: [Junio, 30 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_becas = "SELECT alumnos_becas.*, clave FROM alumnos_becas JOIN alumnos_programas USING(id_alumno_programa) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_becas = mysqli_query($conexion, $sql_becas);
	$fila_becas = @mysqli_fetch_array($resultado_becas);
	
	$sql_ciclo_escolar = "SELECT * FROM  ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
	$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);
	
	$meses = $fila_ciclo_escolar["mes_fin"]-$fila_ciclo_escolar["mes_inicio"];
	
	if(mysqli_num_rows($resultado_becas) > 0)
	{		
?>
<table width="90%" class="cuej">
    <tr>
        <th class="cuej" rowspan="2">INSCRIPCI&Oacute;N</th>
        <th class="cuej" rowspan="2">COLEGIATURA</th>
        <th class="cuej" rowspan="2">BECA INSCRIPCI&Oacute;N</th>
        <th class="cuej" colspan="<?php echo $meses+1; ?>">BECAS DE COLEGIATURA</th>
    </tr>
    <tr>
<?php
		for($mes = $fila_ciclo_escolar["mes_inicio"]; $mes <= $fila_ciclo_escolar["mes_fin"]; $mes++)
		{
			$sql_referencia = "SELECT concepto FROM referencias WHERE id_referencia = '".$mes."';";
			$resultado_referecnia = mysqli_query($conexion, $sql_referencia);
			$fila_referencia = @mysqli_fetch_array($resultado_referecnia);
?>
		<th class="cuej"><?php echo substr($fila_referencia["concepto"],0,3); ?></th>
<?php
		}
?>
	</tr>
     <tr>
     	<td class="cuej" align="center"><span id="lbl_Inscripcion"></span></td>
          <td class="cuej" align="center"><span id="lbl_Colegiatura"></span></td>
          <td class="cuej" align="center"><span id="lbl_Beca_Inscripcion"></span></td>
<?php
		for($mes = $fila_ciclo_escolar["mes_inicio"]; $mes <= $fila_ciclo_escolar["mes_fin"]; $mes++)
		{
?>
		<td class="cuej" align="center"><span id="lbl_Beca_<?php echo $mes; ?>"></span></td>
<?php
		}
?>          
     </tr>
	<tr>
		<td class="cuej" align="center" >
<?php
		if($_SESSION["Update"] == 1)
			{
?>
			<input class="campo" type="text" name="Inscripcion" id="Inscripcion" value="<?php echo $fila_becas["inscripcion"]; ?>" size="10" onBlur="Caja_Alumnos_Becas_Actualizar('<?php echo $fila_becas["id_alumno_beca"]; ?>', 'inscripcion', $(this).val(), 'lbl_Inscripcion')" />
<?php
			}
			else
			{
				echo $fila_becas["inscripcion"];
			}
?>
          </td>
		<td class="cuej" align="center">
<?php
		if($_SESSION["Update"] == 1)
			{
?>
			<input class="campo" type="text" name="Colegiatura" id="Colegiatura" value="<?php echo $fila_becas["colegiatura"]; ?>" size="10" onBlur="Caja_Alumnos_Becas_Actualizar('<?php echo $fila_becas["id_alumno_beca"]; ?>', 'colegiatura', $(this).val(), 'lbl_Colegiatura')"/>
<?php
			}
			else
			{
				echo $fila_becas["colegiatura"];
			}
?>
          </td>
		<td class="cuej" align="center">
<?php
		if($_SESSION["Update"] == 1)
			{
?>
			<select class="campo" name="Beca_Inscripcion" id="Beca_Inscripcion" onChange="Caja_Alumnos_Becas_Actualizar('<?php echo $fila_becas["id_alumno_beca"]; ?>', 'beca_inscripcion', $(this).val(), 'lbl_Beca_Inscripcion')" >
<?php
				for($beca_inscripcion = 0; $beca_inscripcion <= 100; $beca_inscripcion+=5)
				{
?>
				<option value="<?php echo $beca_inscripcion; ?>" <?php if($fila_becas["beca_inscripcion"] == $beca_inscripcion) echo "selected"; ?> ><?php echo $beca_inscripcion; ?></option>
<?php
				}
?>
               </select>
<?php
			}
			else
			{
				echo $fila_becas["beca_inscripcion"];
			}
?>
          </td>
<?php
		for($mes = $fila_ciclo_escolar["mes_inicio"]; $mes <= $fila_ciclo_escolar["mes_fin"]; $mes++)
		{
			if($_SESSION["Update"] == 1)
			{
?>
		<td class="cuej" align="center">
			<select class="campo" name="Beca_<?php echo $mes; ?>" id="Beca_<?php echo $mes; ?>" onChange="Caja_Alumnos_Becas_Actualizar('<?php echo $fila_becas["id_alumno_beca"]; ?>', 'beca_<?php echo $mes; ?>', $(this).val(), 'lbl_Beca_<?php echo $mes; ?>')" >
<?php
				for($beca = 0; $beca <= 100; $beca+=5)
				{
?>
				<option value="<?php echo $beca; ?>" <?php if($fila_becas["beca_".$mes] == $beca) echo "selected"; ?> ><?php echo $beca; ?></option>
<?php
				}
?>
               </select>
		</td>
<?php
			}
			else
			{
?>
		<td class="cuej" align="center"><?php echo $fila_becas["beca_".$mes]; ?></td>
<?php
			}
		}
?>
    </tr>
    <tr>
    		<th class="cuej" colspan="<?php echo $meses+4; ?>">OBSERVACIONES<span id="lbl_Observaciones"></span></th>
    </tr>
    <tr>
    		<td class="cuej" colspan="<?php echo $meses+4; ?>" align="center">
<?php
	if($_SESSION["Update"] == 1)
	{
?>
			<input class="campo" type="text" name="Observaciones" id="Observaciones" value="<?php echo utf8_encode($fila_becas["observaciones"]); ?>" onBlur="Caja_Alumnos_Becas_Actualizar('<?php echo $fila_becas["id_alumno_beca"]; ?>', 'observaciones', $(this).val(), 'lbl_Observaciones')" size="100" />
<?php	
	}
	else
	{
		echo utf8_encode($fila_becas["observaciones"]);	
	}
?>
          </td>
    </tr>
    <tfoot>
    <tr>
        <th class="cuej" colspan="<?php echo $meses+4; ?>"></th>
    </tr>
    </tfoot>
</table>
<form name="Frm_Formato" id="Frm_Formato" action="../impresiones/Cobranza/Formato_Beca_PDF.php" method="post" target="_blank" >
	<p align="center">		
		<input name="id_Alumno_Programa" id="id_Alumno_Programa" type="hidden" value="<?php echo $_POST["id_Alumno_Programa"]; ?>" />
		<input name="id_Ciclo_Escolar" id="id_Ciclo_Escolar" type="hidden" value="<?php echo $_POST["id_Ciclo_Escolar"]; ?>" />		
		<input class="button" type="submit" name="Btn_Formato" id="Btn_Formato" value="Comprobante de Beca" >		
	</p>
</form>
<?php
	}
?>