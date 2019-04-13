</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<img src="../imagenes/logo_cuej.png" alt="CUEJ" width="200px" />
		</div>
        <div id="user">
        	<table border="0" width="100%">
            	<tr>
                	<td><img src="../imagenes/usuario.png" alt="SIUP" width="120px"/></td>
					<td><?php echo htmlentities($_SESSION["Titulo"].' '.$_SESSION["Nombre"].' '.$_SESSION["Apellido_Paterno"].' '.$_SESSION["Apellido_Materno"]); ?><br /><a href="../php/Salir.php">Salir</a></td>

                </tr>
            </table>
        </div>
	</div>
	<div id="page">
    	<?php
	$sql_menus = "SELECT DISTINCT(procesos.id_menu) FROM permisos JOIN procesos USING(id_proceso) WHERE id_usuario = '".$_SESSION["id_Usuario"]."';";

	$resultado_menus = mysqli_query($conexion,$sql_menus);
	$registros_menus = @mysqli_num_rows($resultado_menus);
?>
        							<ul id="navmenu">

        							<li>
        								         	<a href="#">Captiación</a>
        								<ul>
            								<li>
                                        			<a href="#">Nuevo</a>
    										</li>
    										<li>
                                        			<a href="#">Consultar</a>
    										</li>
                                    	</ul>
                                    </li>

<?php
	while($fila_menus = mysqli_fetch_array($resultado_menus))
	{
		if($fila_menus["id_menu"] == 0)
		{
			$sql_procesos = "SELECT procesos.*, carpeta FROM permisos JOIN procesos USING(id_proceso) JOIN areas_sicuej USING(id_area_sicuej) WHERE id_usuario = '".$_SESSION["id_Usuario"]."' AND id_menu = 0;";

			$resultado_procesos = mysqli_query($conexion, $sql_procesos);
			while($fila_procesos = mysqli_fetch_array($resultado_procesos))
			{
?>
									<li>
                                             	<a href="../<?php echo $fila_procesos["carpeta"];?>/<?php echo $fila_procesos["proceso_archivo"] ?>"><?php echo $fila_procesos["proceso_nombre"] ?></a>
                                             </li>
<?php
			}
		}
		else
		{
			$sql_menu = "SELECT id_menu, menu FROM menus WHERE id_menu='".$fila_menus["id_menu"]."';";
			$resultado_menu = mysqli_query($conexion, $sql_menu);
			$fila_menu = mysqli_fetch_array($resultado_menu);
?>
									<li>
                                             	<a href="#"><?php echo utf8_encode($fila_menu["menu"]); ?></a>
            								<ul>
<?php
			$sql_submenus = "SELECT DISTINCT(procesos.id_submenu) FROM permisos JOIN procesos USING(id_proceso) WHERE id_usuario = '".$_SESSION["id_Usuario"]."' AND id_menu = '".$fila_menu["id_menu"]."';";
			$resultado_submenus = mysqli_query($conexion, $sql_submenus);

			while($fila_submenus = @mysqli_fetch_array($resultado_submenus))
			{
				if($fila_submenus["id_submenu"] == 0)
				{
					$sql_procesos_menu = "SELECT procesos.*, carpeta FROM permisos JOIN procesos USING(id_proceso) JOIN areas_sicuej USING(id_area_sicuej) WHERE id_usuario = '".$_SESSION["id_Usuario"]."' AND id_menu = '".$fila_menus["id_menu"]."' AND id_submenu='0';";

					$resultado_procesos_menu = mysqli_query($conexion, $sql_procesos_menu);
					while($fila_procesos_menu = mysqli_fetch_array($resultado_procesos_menu))
					{
?>
											<li>
                                                       	<a href="../<?php echo $fila_procesos_menu["carpeta"];?>/<?php echo $fila_procesos_menu["proceso_archivo"] ?>"><?php echo utf8_encode($fila_procesos_menu["proceso_nombre"]); ?></a>
                                                       </li>
<?php
					}

				}
				else
				{
					$sql_submenu = "SELECT id_submenu, submenu FROM submenus WHERE id_submenu='".$fila_submenus["id_submenu"]."';";
					$resultado_submenu = mysqli_query($conexion, $sql_submenu);
					$fila_submenu = mysqli_fetch_array($resultado_submenu);
?>
											<li>
                                                       	<a href="#"><?php echo $fila_submenu["submenu"]; ?>...</a>
                        								<ul>
 <?php
 					$sql_procesos_submenu = "SELECT procesos.*, carpeta FROM permisos JOIN procesos USING(id_proceso) JOIN areas_sicuej USING(id_area_sicuej) WHERE id_usuario = '".$_SESSION["id_Usuario"]."' AND id_menu = '".$fila_menus["id_menu"]."' AND id_submenu='".$fila_submenu["id_submenu"]."';";

					$resultado_procesos_submenu = mysqli_query($conexion,$sql_procesos_submenu);
					while($fila_procesos_submenu = mysqli_fetch_array($resultado_procesos_submenu))
					{
?>
						<li><a href="../<?php echo $fila_procesos_submenu["carpeta"];?>/<?php echo $fila_procesos_submenu["proceso_archivo"] ?>"><?php echo $fila_procesos_submenu["proceso_nombre"] ?></a></li>
<?php
					}
 ?>
                        								</ul>
                    							</li>
<?php
				}
			}
?>
            								</ul>
            							</li>
<?php
		}

	}

?>
        							</ul>
		<div id="content">
			<p>&nbsp;</p>
			<div id="Contenido">