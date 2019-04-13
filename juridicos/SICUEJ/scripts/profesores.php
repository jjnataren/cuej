<?php	
	include ("../php/Funciones.php");
	
	$sql = "SELECT * FROM temporal_profesores;";
	$resultado = mysqli_query($conexion, $sql);
	
	while($fila = mysqli_fetch_array($resultado))
	{
		$nombre = explode(" ", $fila["nombre"]);
	
		$usuario = strtolower(substr($fila["apellido_paterno"],0,1).substr($fila["apellido_materno"],0,1).$nombre[0]);
		
		$usuario = iconv('UTF-8', 'ASCII//TRANSLIT', $usuario);	
		$usuario = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $usuario));
		
		$sql_usuario = "SELECT COUNT(*) AS coincidencias FROM profesores WHERE usuario LIKE '".$usuario."%';";
		$resultado_usuario = mysqli_query($conexion, $sql_usuario);
		$fila_usuario = mysqli_fetch_array($resultado_usuario);
		
		if($fila_usuario["coincidencias"] > 0)
			$usuario .= $fila_usuario["coincidencias"];
			
		$password = strtolower($nombre[0].substr($fila["apellido_paterno"],0,1).substr($fila["apellido_paterno"],0,1));
		//$password = iconv('UTF-8', 'ASCII//TRANSLIT', $password);	
		$password = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $password));
		
		$pass = Genera_Password($password);
		
		
		$sql_profesor = "INSERT INTO profesores (apellido_paterno, apellido_materno, nombre, titulo, usuario, password, estatus) VALUES ('".$fila["apellido_paterno"]."', '".$fila["apellido_materno"]."','".$fila["nombre"]."','".$fila["titulo"]."','".$usuario."','".$pass."','1');";	
	
		$resultado_profesor = mysqli_query($conexion, $sql_profesor);
		
		if(!mysqli_error($conexion))
		{
			$id_profesor = mysqli_insert_id($conexion);
			
			$sql_documentacion = "SELECT * FROM documentacion_profesores ORDER BY id_documentacion_profesor;";
			$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);
			
			while($fila_documentacion = mysqli_fetch_array($resultado_documentacion))
			{
				$sql_documentos = "INSERT INTO profesores_documentacion (id_profesor, id_documentacion_profesor) VALUES ('".$id_profesor."','".$fila_documentacion["id_documentacion_profesor"]."');";
				
				$resultado_documentos = mysqli_query($conexion, $sql_documentos);
					
			}
		}
		
		if($fila["correo_1"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','3','".$fila["correo_1"]."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}
		
		if($fila["correo_2"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','4','".$fila["correo_2"]."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}
		
		if($fila["telefono_1"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','1','".$fila["telefono_1"]."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}
		
		if($fila["telefono_2"] != "")
		{
			$sql_contacto = "INSERT INTO profesores_contactos (id_profesor, tipo_contacto, contacto) VALUES ('".$id_profesor."','2','".$fila["telefono_2"]."');";
			$resultado_contacto = mysqli_query($conexion, $sql_contacto);
		}
	}
	
?>