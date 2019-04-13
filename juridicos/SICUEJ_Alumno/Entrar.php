<?php
include("php/Funciones.php");

if(trim($_POST["Login"]) != "" && trim($_POST["Password"]) != "")
	{
		$sql = "SELECT * FROM alumnos WHERE usuario = '".$_POST["Login"]."' AND fecha_baja < '".date("Y-m-d")."';";
		
	  	$resultado = mysqli_query($conexion, $sql);
		@$registros = mysqli_num_rows($resultado);
  
	  	if($registros > 0)
			{
				$fila = mysqli_fetch_array($resultado);
				
				$sql_grupo = "SELECT id_alumno_programa, id_grupo FROM alumnos_programas WHERE id_alumno = '".$fila["id_alumno"]."';";
			  	$resultado_grupo = mysqli_query($conexion,$sql_grupo);
				$fila_grupo = mysqli_fetch_array($resultado_grupo);
				
			  	if($fila["password"] == $_POST["Password"])
				  	{
					  	//Inicio de sesión y creación de variables globales de sesión
						
						session_start();
					  	$_SESSION["id_Alumno_Programa"] = $fila_grupo["id_alumno_programa"];
						$_SESSION["id_Grupo"] = $fila_grupo["id_grupo"];
						$_SESSION["id_Alumno"] = $fila["id_alumno"];
					  	$_SESSION["Usuario"] = $fila["usuario"];
						$_SESSION["Nombre"] = $fila["nombre"];
						$_SESSION["Apellido_Paterno"] = $fila["apellido_paterno"];
						$_SESSION["Apellido_Materno"] = $fila["apellido_materno"];
						$_SESSION["Autenticado"] = 1;
						
						header("Location: GENERAL/index.php");
				  	}
			  	else
				  	{
?>
						<?php include ("Etiquetas.php"); ?>
    
                        <p align="center"><center><h4>Contrase&ntilde;a incorrecta</h4></center></p>
                        <p align="center"><a href="index.php">Regresar</a></p>
                        
                        <?php include ("php/Pie_Pagina.php"); ?>
<?php
					}
			}
		else
			{
?>
				<?php include ("Etiquetas.php"); ?>
                
                <p align="center"><center><h4>Usuario no v&aacute;lido</h4></center></p>
                <p align="center"><a href="index.php">Regresar</a></p>
        
                <?php include ("Pie_Pagina.php"); ?>        
<?php				
			}							
		mysqli_close($conexion);
	}
else
	{
?>
		<?php include ("Etiquetas.php"); ?>
        
		<p align="center"><center><h4>Debes introducir tu usuario y contrase&ntilde;a</h4></center></p>
		<p align="center"><a href="index.php">Regresar</a></p>

		<?php include ("Pie_Pagina.php"); ?>        
<?php
	}
?>