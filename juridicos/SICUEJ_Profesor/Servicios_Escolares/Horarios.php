<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 15 2017]	
	-- País: México
	-- Objetivo: Horarios de Asignaturas
	-- Última Modificación: [Octubre, 15 2017]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");
if(!(isset($_SESSION["Autenticado"])))
{
	header("Location: ../index.php");
}
include ("../php/HTML.php"); 
?>
<script type="text/javascript" src="../js/flexigrid.pack.js"></script>
<script language="javascript" src="../js/Funciones_Jquery_Servicios_Escolares.js"></script>
<script language="javascript">

	$('Body').ready(function(){
		$('#id_Carrera').change(function(){
			Horarios_Planes_Estudio_Buscar($(this).val())
		});
		
		$('#id_Plan_Estudio').change(function(){
		    Horarios_Semestres_Buscar($(this).val())
	     });
		
		$('#Semestre').change(function(){
		    Horarios_Grupos_Buscar($('#id_Plan_Estudio').val(), $('#id_Ciclo_Escolar').val(), $(this).val());
	     });
		
		$('#Btn_Buscar').click(function(){
		    Horarios_Buscar();
	     });
	});

</script>

<?php include ("../php/Body.php"); ?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4"> HORARIOS <div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
<p>&nbsp;</p>

<?php
 
	$sql = "SELECT * FROM  ciclos_escolares JOIN grupos USING(id_ciclo_escolar) JOIN horarios USING(id_grupo) WHERE '".date("Y-m-d")."' >= fecha_inicio AND '".date("Y-m-d")."' <= fecha_fin AND id_profesor = '".$_SESSION["id_Profesor"]."' ORDER BY id_carrera_tipo, semestre;";
	
	$resultado = mysqli_query($conexion, $sql);
	$registros = @mysqli_num_rows($resultado);
	
	if($registros > 0)
	{
?>
<table align="center" class="cuej" width="90%">
	<thead>
		<tr>
			<th class="cuej" colspan="2">Asignatura</th>
			<th class="cuej">Semestre</th>
			<th class="cuej">Grupo</th>
			<th class="cuej">Sal&oacute;n</th>
			<th class="cuej">LUN</th>
			<th class="cuej">MAR</th>
			<th class="cuej">MIE</th>
			<th class="cuej">JUE</th>
			<th class="cuej">VIE</th>
			<th class="cuej">SAB</th>
		<tr>
	</thead>
	<tbody>
<?php
		while($fila = mysqli_fetch_array($resultado))
		{
			$sql_carrera = "SELECT abreviatura FROM carreras JOIN planes_estudio USING(id_carrera) WHERE id_plan_estudio = '".$fila["id_plan_estudio"]."';";
			$resultado_carrera = mysqli_query($conexion, $sql_carrera);
			$fila_carrera = mysqli_fetch_array($resultado_carrera);
			
			$sql_materia = "SELECT materia FROM materias WHERE id_materia = '".$fila["id_materia"]."';";
			$resultado_materia = mysqli_query($conexion, $sql_materia);
			$fila_materia = mysqli_fetch_array($resultado_materia);
			
?>
		<tr>
			<td class="cuej" align="center"><?php echo $fila_carrera["abreviatura"]; ?></td>
			<td class="cuej" align="center"><?php echo utf8_encode($fila_materia["materia"]); ?></td>
			<td class="cuej" align="center"><?php echo $fila["semestre"]; ?></td>
			<td class="cuej" align="center"><?php echo $fila["grupo"]; ?></td>
			<td class="cuej" align="center"><?php echo $fila["salon"]; ?></td>
			<td class="cuej" align="center"><?php if($fila["hora_inicio_1"] != '00:00:00') echo substr($fila["hora_inicio_1"],0,5)." - ".substr($fila["hora_fin_1"],0,5); else echo "-"; ?></td>
			<td class="cuej" align="center"><?php if($fila["hora_inicio_2"] != '00:00:00') echo substr($fila["hora_inicio_2"],0,5)." - ".substr($fila["hora_fin_2"],0,5); else echo "-"; ?></td>
			<td class="cuej" align="center"><?php if($fila["hora_inicio_3"] != '00:00:00') echo substr($fila["hora_inicio_3"],0,5)." - ".substr($fila["hora_fin_3"],0,5); else echo "-"; ?></td>
			<td class="cuej" align="center"><?php if($fila["hora_inicio_4"] != '00:00:00') echo substr($fila["hora_inicio_4"],0,5)." - ".substr($fila["hora_fin_4"],0,5); else echo "-"; ?></td>
			<td class="cuej" align="center"><?php if($fila["hora_inicio_5"] != '00:00:00') echo substr($fila["hora_inicio_5"],0,5)." - ".substr($fila["hora_fin_5"],0,5); else echo "-"; ?></td>
			<td class="cuej" align="center"><?php if($fila["hora_inicio_6"] != '00:00:00') echo substr($fila["hora_inicio_6"],0,5)." - ".substr($fila["hora_fin_6"],0,5); else echo "-"; ?></td>
		</tr>
<?php			
		}
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="cuej" colspan="12"></th>
		</tr>
	</tfoot>
</table>
<?php
	}
	else
	{
		echo "No tiene horarios definidos para &eacute;ste periodo";
	}
?>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>
