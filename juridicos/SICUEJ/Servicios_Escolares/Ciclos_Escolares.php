<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2016]	
	-- País: México
	-- Objetivo: Administración de Ciclos Escolares
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Administración de Ciclos Escolares
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

$id_Proceso = 3;

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
		Ciclos_Escolares_Buscar();

		$('#Btn_Buscar').click(function(){
			Ciclos_Escolares_Buscar();
		});	
		
		$('#Btn_Nuevo_Ciclo_Escolar').click(function(){
			Ciclos_Escolares_Nuevo();
		});		
	});
	
	
</script>

<?php include ("../php/Body.php"); ?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">ADMINISTRACIÓN DE CICLOS ESCOLARES<div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
<p>&nbsp;</p>
<form>
	<table width="100%" align="center">
		<tr>
			<td>
				<label>Nivel Escolar: </label>
				<select class="campo" name = "id_Carrera_Tipo" id = "id_Carrera_Tipo">
					<option value="">&nbsp;</option>
<?php
	$sql_carreras_tipo = "SELECT id_carrera_tipo, carrera_tipo FROM carreras_tipo;";
	$resultado_carreras_tipo =mysqli_query($conexion, $sql_carreras_tipo);
	
	while($fila_carreras_tipo = mysqli_fetch_array($resultado_carreras_tipo))
	{
?>
					<option value= "<?php echo $fila_carreras_tipo["id_carrera_tipo"]; ?>"><?php echo utf8_encode($fila_carreras_tipo["carrera_tipo"]); ?></option>
<?php
	}
?>
				</select>
				<input class="button" type="button" id="Btn_Buscar" name="Btn_Buscar" value="Buscar" />
			</td>
			<td ></td>
			<td align="right" valign="top">
<?php 
	if($_SESSION["Insert"] == 1)
	{
?>
				<input class="button" type="button" id = "Btn_Nuevo_Ciclo_Escolar" name = "Btn_Nuevo_Ciclo_Escolar"  value = "Nuevo Ciclo Escolar" />
<?php
	}
?>
			</td>
		</tr>
	</table>   
</form>
<p>&nbsp;</p>
<div id="div_Ciclos_Escolares">
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>