<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Octubre, 15 2017]	
	-- País: México
	-- Objetivo: Listas de Asistencia por Materia
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
		
	});

</script>

<?php include ("../php/Body.php"); ?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4"> LISTAS DE ASISTENCIA <div class="header_01"><hr /></div></th>
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
			<th class="cuej">Programa Acad&eacute;mico</th>
			<th class="cuej">Asignatura</th>
			<th class="cuej">Semestre</th>
			<th class="cuej">Grupo</th>
			<th class="cuej">Opciones</th>			
		<tr>
	</thead>
	<tbody>
<?php
		while($fila = mysqli_fetch_array($resultado))
		{
			$sql_carrera = "SELECT carrera FROM carreras JOIN planes_estudio USING(id_carrera) WHERE id_plan_estudio = '".$fila["id_plan_estudio"]."';";
			$resultado_carrera = mysqli_query($conexion, $sql_carrera);
			$fila_carrera = mysqli_fetch_array($resultado_carrera);
			
			$sql_materia = "SELECT materia FROM materias WHERE id_materia = '".$fila["id_materia"]."';";
			$resultado_materia = mysqli_query($conexion, $sql_materia);
			$fila_materia = mysqli_fetch_array($resultado_materia);
			
?>
		<tr>
			<td class="cuej" align="center"><?php echo utf8_encode($fila_carrera["carrera"]); ?></td>
			<td class="cuej" align="center"><?php echo utf8_encode($fila_materia["materia"]); ?></td>
			<td class="cuej" align="center"><?php echo $fila["semestre"]; ?></td>
			<td class="cuej" align="center"><?php echo $fila["grupo"]; ?></td>
			<td class="cuej" align="center"><input type="button" value="Ver" class="button" onclick="Listas_Asistencia_Buscar(<?php echo $fila["id_grupo"];?>,<?php echo $fila["id_materia"]; ?>)"/></td>
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
		echo "Sin registros de asignaturas";
	}	
	
?>
<p>&nbsp;</p>
<div id="div_Listas_Asistencia">
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>
