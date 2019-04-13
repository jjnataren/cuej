<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 29 2016]	
	-- País: México
	-- Objetivo: Datos del concepto seleccionado
	-- Última Modificación: [Junio, 29 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	$sql_becas = "SELECT alumnos_becas.*, clave FROM alumnos_becas JOIN alumnos_programas USING(id_alumno_programa) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_becas = mysqli_query($conexion, $sql_becas);
	$fila_becas = mysqli_fetch_array($resultado_becas);
	
	$sql_ciclo_escolar = "SELECT * FROM  ciclos_escolares WHERE id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_ciclo_escolar = mysqli_query($conexion, $sql_ciclo_escolar);
	$fila_ciclo_escolar = mysqli_fetch_array($resultado_ciclo_escolar);	
	
	//Verificamos qué concepto fue seleccionado
	
	switch($_POST["Concepto"])
	{
		case 1: //INSCRIPCIÓN
		
			$importe = $fila_becas["inscripcion"] - (($fila_becas["inscripcion"] * $fila_becas["beca_inscripcion"])/100);
		
?>
	<table width="90%" class="cuej">
     	<tr>
          	<th class="cuej">MONTO BASE</th>
               <th class="cuej">BECA</th>
               <th class="cuej" colspan="2">IMPORTE A PAGAR</th>
          </tr>
          <tr>
          	<td class="cuej" align="center"><h2><?php echo "$ ".number_format($fila_becas["inscripcion"],2); ?></h2></td>
               <td class="cuej" align="center"><h2><?php echo $fila_becas["beca_inscripcion"]." %"; ?></h2></td>
               <td class="cuej" colspan="2" align="center"><h2><?php echo "$ ".number_format($importe,2); ?></h2></td>
          </tr>
          <tr>
          	<th class="cuej" colspan="4">OBSERVACIONES</th>
          </tr>
          <tr>
          	<td class="cuej" colspan="4" align="center">
               	<input class="campo" type="text" name="Observaciones" id="Observaciones" value="" size="100"/>
               </td>
          </tr>
          <tfoot>
               <tr>
                    <th class="cuej" colspan="4"></th>
               </tr>
          </tfoot>
     </table>
	 <p align="center">
		<input class="button" type="button" name="Btn_Pagar" id="Btn_Pagar" value="Pagar" />
	 </p>
<?php
			break;
			
		case 2: //REINSCRIPCIÓN
			$importe = $fila_becas["inscripcion"] - (($fila_becas["inscripcion"] * $fila_becas["beca_inscripcion"])/100);
		
?>
	<table width="90%" class="cuej">
     	<tr>
          	<th class="cuej">MONTO BASE</th>
               <th class="cuej">BECA</th>
               <th class="cuej" colspan="2">IMPORTE A PAGAR</th>
          </tr>
          <tr>
          	<td class="cuej" align="center"><h2><?php echo "$ ".number_format($fila_becas["inscripcion"],2); ?></h2></td>
               <td class="cuej" align="center"><h2><?php echo $fila_becas["beca_inscripcion"]." %"; ?></h2></td>
               <td class="cuej" colspan="2" align="center"><h2><?php echo "$ ".number_format($importe,2); ?></h2></td>
          </tr>
          <tr>
          	<th class="cuej" colspan="4">OBSERVACIONES</th>
          </tr>
          <tr>
          	<td class="cuej" colspan="4" align="center">
               	<input class="campo" type="text" name="Observaciones" id="Observaciones" value="" size="100"/>
               </td>
          </tr>
          <tfoot>
               <tr>
                    <th class="cuej" colspan="4"></th>
               </tr>
          </tfoot>
     </table>
	 <p align="center">
		<input class="button" type="button" name="Btn_Pagar" id="Btn_Pagar" value="Pagar" />
	 </p>
<?php
			break;
			
		case 3: //COLEGIATURAS		
?>
	<table width="90%" class="cuej">
     	<tr>
          	<th class="cuej" width="10px"></th>
               <th class="cuej">MES</th>
               <th class="cuej">COLEGIATURA</th>
               <th class="cuej">BECA</th>
               <th class="cuej">MONTO </th>
               <th class="cuej">RECARGO</th>
               <th class="cuej">DESC. EXT.</th>
               <th class="cuej">IMPORTE A PAGAR</th>
               <th class="cuej">OBSERVACIONES</th>
          </tr>
<?php
	for($i = $fila_ciclo_escolar["mes_inicio"]; $i <= $fila_ciclo_escolar["mes_fin"]; $i++)
	{
		//Buscamos si el pago ya fue realizado
		$sql_pagos = "SELECT * FROM pagos WHERE clave = '".$fila_becas["clave"]."' AND id_referencia = '".$i."' AND periodo = '".$fila_ciclo_escolar["periodo"]."';";
		$resultado_pagos = mysqli_query($conexion, $sql_pagos);
		$registros_pagos = @mysqli_num_rows($resultado_pagos);
		
		$sql_referencia = "SELECT * FROM referencias WHERE id_referencia = '".$i."';";
		$resultado_referencia = mysqli_query($conexion, $sql_referencia);
		$fila_referencia = @mysqli_fetch_array($resultado_referencia);
		
		//Monto de colegiatura con beca aplicada
		
		$monto_colegiatura = $fila_becas["colegiatura"]-(($fila_becas["colegiatura"] * $fila_becas["beca_".$i])/100);		
		
		
		//Calculo de Recargo
		
		$sql_fecha = "SELECT * FROM fechas_limite_pago WHERE id_referencia = '".$i."' AND periodo = '".$fila_ciclo_escolar["periodo"]."';";
		$resultado_fecha = mysqli_query($conexion, $sql_fecha);
		$fila_fecha = @mysqli_fetch_array($resultado_fecha);
		
		$mes_actual = date("n");
		$mes_limite = date("n",strtotime($fila_fecha["fecha_limite"]));
		
		$meses_recargo = $mes_actual - $mes_limite;
		
		if($meses_recargo < 0)
			$meses_recargo = 0;
		else
		{
			if(strtotime(date("Y-m-d")) < strtotime($fila_fecha["fecha_limite"]))
			{
				$meses_recargo = $meses_recargo-1;
			}
		}
			
		$porcentaje_recargo = 2 * $meses_recargo;
		
		//Importe total a pagar
		
		$importe = $monto_colegiatura + (($monto_colegiatura * $porcentaje_recargo)/100);
		
		if($registros_pagos > 0)
		{
			$fila_pagos = @mysqli_fetch_array($resultado_pagos);
?>
		<tr>
          	<td class="cuej">a</td>
               <td class="cuej">a</td>
               <td class="cuej">a</td>
               <td class="cuej">a</td>
               <td class="cuej">a</td>
               <td class="cuej">a</td>
               <td class="cuej">a</td>
          </tr>
<?php	
		}
		else
		{
?>
		<tr>
          	<td class="cuej" align="center">
               	<input class="campo" type="checkbox" name="Colegiatura_<?php echo $i; ?>" id="Colegiatura_<?php echo $i; ?>" />
               </td>
               <td class="cuej">
               	<h3><?php echo $fila_referencia["concepto"]; ?></h3>
               </td>
               <td class="cuej" align="center">
               	<h3><?php echo "$ ".number_format($fila_becas["colegiatura"],2); ?></h3>
               </td>
               <td class="cuej" align="center">
               	<h3><?php echo $fila_becas["beca_".$i]." %"; ?></h3>
               </td>
               <td class="cuej" align="center">
               	<h3><?php echo "$ ".number_format($monto_colegiatura,2); ?></h3>
               </td>
               <td class="cuej" align="center">
               	<h3><?php echo $porcentaje_recargo." %"; ?></h3>
               </td>
               <td class="cuej"></td>
               <td class="cuej" align="center">
               	<h3><?php echo "$ ".number_format($importe,2); ?></h3>
               </td>
               <td class="cuej"></td>
          </tr>
<?php	
		}
	}
?>
          <tfoot>
               <tr>
                    <th class="cuej" colspan="9"></th>
               </tr>
          </tfoot>
     </table>
	 <p align="center">
		<input class="button" type="button" name="Btn_Pagar" id="Btn_Pagar" value="Pagar" />
	 </p>
<?php
			break;
		
		case 4: //EXTRAORDINARIOS
			
			break;			
	}
	
?>