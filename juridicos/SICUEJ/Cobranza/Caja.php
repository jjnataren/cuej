<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 26 2016]	
	-- País: México
	-- Objetivo: Caja y Opciones de Administración d Cuotas y Becas
	-- Última Modificación: [Junio, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

$id_Proceso = 11;

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
<script language="javascript" src="../js/Funciones_Jquery_Cobranza.js"></script>
<script language="javascript">

	$('Body').ready(function(){
		Caja_Alumnos_Buscar();
		
		$('#Btn_Buscar').click(function(){
			Caja_Alumnos_Buscar();
		});	
	});

</script>

<?php include ("../php/Body.php"); ?>

<table  width="100%" align="center">
	<thead>
		<tr>
			<th  colspan="4">C A J A<div class="header_01"><hr /></div></th>
		</tr>
	</thead>
</table>
<form>
	<table width="100%" align="center">
		<tr>
			<td>
				<label>Alumno: </label>
				<input class="campo" type = "text" name = "Alumno" id = "Alumno" value = "" size="35"/>
				<input class="button" type="button" id="Btn_Buscar" name="Btn_Buscar" value="Buscar" />
			</td>
			<td ></td>
			<td align="right" valign="top">&nbsp;</td>
		</tr>
	</table>
</form>
<p>&nbsp;</p>
<div id="div_Alumnos">
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>