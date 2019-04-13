<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Univeristario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 26 2016]	
	-- País: México
	-- Objetivo: Administración de Usuarios y Contraseñas
	-- Última Modificación: [Abril, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: 
	-- ===============================================================================
*/
session_start();
include("../php/Funciones.php");

$id_Proceso = 1;

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
<script language="javascript" src="../js/Funciones_Jquery_Administracion.js"></script>
<script language="javascript">

	$('Body').ready(function(){
		Usuarios_Buscar();
		
		$('#Btn_Buscar').click(function(){
			Usuarios_Buscar();
		});
		
		$('#Btn_Nuevo_Usuario').click(function(){
			Usuarios_Nuevo();
		});
		
	});

</script>

<?php include ("../php/Body.php"); ?>

<table  width="80%" align="center">
    <thead>
        <tr>
            <th  colspan="4"><span class="Letra_16_Negrita">ADMINISTRACI&Oacute;N DE USUARIOS DEL SISTEMA</span></th>
        </tr>
    </thead>
</table>
<form class="form-style">
     <table width="90%" align="center">
          <tr>
               <td>
					<div class="frm_element">                    	
						<label>Nombre</label>
                        <input type = "text" name = "Nombre" id = "Nombre" value = "" />
                        <span></span>
                    </div>                    
               </td>
               <td align="left" valign="top">
               	<input class="button" type="button" id="Btn_Buscar" name="Btn_Buscar" value="Buscar" />
               </td>
               <td align="right" valign="top">
               	<input class="button" type="button" id = "Btn_Nuevo_Usuario" name = "Btn_Nuevo_Usuario"  value = "Nuevo Usuario" /> 
               </td>
          </tr>
     </table>   
</form>
<div id="div_Usuarios" style="padding-left: 50px">
     
</div>
<br />
<br />
<?php include ("../php/Pie_Pagina.php"); ?>