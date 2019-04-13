<?php
include("php/Funciones.php");

if(trim($_POST["Login"]) != "" && trim($_POST["Password"]) != "")
	{
		$sql = "SELECT * FROM usuarios WHERE usuario = '".$_POST["Login"]."' AND usuario_estatus='1'";
	  	$resultado = mysqli_query($conexion, $sql);
		@$registros = mysqli_num_rows($resultado);
  
	  	if($registros > 0)
			{
				$fila = mysqli_fetch_array($resultado);
				
			  	if($fila["password"] == md5($_POST["Password"]))
				  	{
					  	//Creación de arrays de permisos del usuario
						
						$sql_permisos = "SELECT * FROM permisos WHERE id_usuario = '".$fila["id_usuario"]."';";
						$resultado_permisos = mysqli_query($conexion,$sql_permisos);
						$registros_permisos = @mysqli_num_rows($resultado_permisos);
						$permisos = "0,";
						
						$i = 0;
						while($fila_permisos = @mysqli_fetch_array($resultado_permisos))
						{
							$i++;							
							if($i>=$registros_permisos)
							{
								$permisos .= $fila_permisos["id_proceso"];
							}
							else
							{
								$permisos .= $fila_permisos["id_proceso"].",";
							}
						}					
						//Inicio de sesión y creación de variables globales de sesión
						
						session_start();
					  	$_SESSION["id_Usuario"] = $fila["id_usuario"];
					  	$_SESSION["Usuario"] = $fila["login"];
						$_SESSION["Nombre"] = $fila["nombre"];
						$_SESSION["Apellido_Paterno"] = $fila["apellido_paterno"];
						$_SESSION["Apellido_Materno"] = $fila["apellido_materno"];
						$_SESSION["Titulo"] = $fila["titulo"];
						$_SESSION["Area"] = $fila["area"];
						$_SESSION["Correo_Electronico"] = $fila["correo_electronico"];
						$_SESSION["Permisos"] = $permisos;
						
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