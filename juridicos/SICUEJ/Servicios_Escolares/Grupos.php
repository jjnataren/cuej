<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 2016]	
	-- País: México
	-- Objetivo: Administración de Grupos
	-- Última Modificación: [Mayo, 08 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Administración de Grupos
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

$id_Proceso = 4;

if(!(isset($_SESSION["Permisos"])))
{
	header("Location: ../index.php");
}
else
{
	$permisos = explode(",",$_SESSION["Permisos"]);
	
	if(!(@in_array($id_Proceso,$permisos)))
	{
		header("Location: ../GENERAL/Permisos.php");
	}
	else
	{			
		$sql_permisos_proceso = "SELECT * FROM permisos WHERE id_usuario = '".$_SESSION["id_Usuario"]."' AND id_proceso = '".$id_Proceso."';";
		$resultado_permiso_proceso = mysqli_query($conexion, $sql_permisos_proceso);
		$fila_permiso_proceso = @mysqli_fetch_array($resultado_permiso_proceso);
		
		$_SESSION["Insert"] = $fila_permiso_proceso["insertar"];
		$_SESSION["Delete"] = $fila_permiso_proceso["eliminar"];
		$_SESSION["Update"] = $fila_permiso_proceso["actualizar"];
	}
}

include ("../php/HTML.php"); 
?>
<script type="text/javascript" src="../js/flexigrid.pack.js"></script>
<script language="javascript" src="../js/Funciones_Jquery_Servicios_Escolares.js"></script>
<script language="javascript">
	$('Body').ready(function(){
		Grupos_Buscar();

		$('#Btn_Buscar').click(function(){
			Grupos_Buscar();
		});	
		
		$('#Btn_Nuevo_Grupo').click(function(){
			Grupos_Nuevo();
		});		
	});
	
</script>

<?php include ("../php/Body.php"); ?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">ADMINISTRACIÓN DE GRUPOS<div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
<p>&nbsp;</p>
<form>
	<table width="100%" align="center">
		<tr>
			<td>
				<label>Programa Acad&eacute;mico: </label>
				<select class="campo" name = "id_Carrera" id = "id_Carrera" onChange="Grupos_Ciclos_Escolares($(this).val())">
					<option value="">&nbsp;</option>
<?php
	$sql_carreras = "SELECT id_carrera, carrera FROM carreras JOIN carreras_tipo USING(id_carrera_tipo) ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras =mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = mysqli_fetch_array($resultado_carreras))
	{
?>
					<option value= "<?php echo $fila_carreras["id_carrera"]; ?>"><?php echo utf8_encode($fila_carreras["carrera"]); ?></option>
<?php
	}
?>
				</select>
				
			</td>
			<td align="right" valign="top" rowspan="2">
				<input class="button" type="button" id="Btn_Buscar" name="Btn_Buscar" value="Buscar" />
<?php 
	if($_SESSION["Insert"] == 1)
	{
?>
				<input class="button" type="button" id = "Btn_Nuevo_Grupo" name = "Btn_Nuevo_Grupo"  value = "Nuevo Grupo" />
<?php
	}
?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Ciclo Escolar: </label>
				<select class="campo" name = "id_Ciclo_Escolar" id = "id_Ciclo_Escolar">
					<option value="">&nbsp;</option>
				</select>			
			</td>
		</tr>
	</table>   
</form>
<p>&nbsp;</p>
<div id="div_Grupos">
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>