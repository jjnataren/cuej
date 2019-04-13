<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 14 2016]	
	-- País: México
	-- Objetivo: Listas de Asistencia por Materia
	-- Última Modificación: [JUnio, 14 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

$id_Proceso = 9;

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
		$('#id_Carrera').change(function(){
			Listas_Asistencia_Planes_Estudio_Buscar($(this).val())
		});
		
		$('#id_Plan_Estudio').change(function(){
		    Listas_Asistencia_Semestres_Buscar($(this).val())
	     });
		
		$('#Semestre').change(function(){
		    Listas_Asistencia_Grupos_Buscar($('#id_Plan_Estudio').val(), $('#id_Ciclo_Escolar').val(), $(this).val());
	     });
		
		$('#Btn_Buscar').click(function(){
		    Listas_Asistencia_Buscar();
	     });
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
<form id="Frm_Listas_Asistencia">
	<table width="100%" align="center">
		<tr>
			<td>
				<label>Programa Acad&eacute;mico: </label>
			</td>
			<td>
				<select class="campo" name = "id_Carrera" id = "id_Carrera" >
					<option value="">&nbsp;</option>
<?php
	$sql_carreras = "SELECT * FROM carreras WHERE id_carrera_estatus = '1' ORDER BY id_carrera_tipo, carrera;";
	$resultado_carreras = mysqli_query($conexion, $sql_carreras);
	
	while($fila_carreras = mysqli_fetch_array($resultado_carreras))
	{
?>
					<option value="<?php echo $fila_carreras["id_carrera"]; ?>"><?php echo utf8_encode($fila_carreras["carrera"]); ?></option>
<?php
	}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Plan de Estudio: </label>
			</td>
			<td>
				<select class="campo" name = "id_Plan_Estudio" id = "id_Plan_Estudio" >
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Ciclo Escolar: </label>
			</td>
			<td>
				<select class="campo" name = "id_Ciclo_Escolar" id = "id_Ciclo_Escolar" >
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Semestre/Cuatrimestre: </label>
			</td>
			<td>
				<select class="campo" name = "Semestre" id = "Semestre" >
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Grupo: </label>
			</td>
			<td>
				<select class="campo" name = "id_Grupo" id = "id_Grupo" >
                    	<option value="">&nbsp;</option>
				</select>
			</td>
		</tr>
          <tr>
			<td>
				<label>Asignatura: </label>
			</td>
			<td>
				<select class="campo" name = "id_Materia" id = "id_Materia" >
                    	<option value="">&nbsp;</option>
				</select>
			</td>
		</tr>
          <tr>
			<td colspan="2" align="center">
				<input type="button" class="button" value="Buscar" name="Btn_Buscar" id="Btn_Buscar" />
			</td>
		</tr>
	</table>
     <br />     
</form>
<p>&nbsp;</p>
<div id="div_Listas_Asistencia">
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>