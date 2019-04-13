<?php	
	include ("../php/Funciones.php");
	
	$sql = "SELECT * FROM temporal_mdadce;";
	$resultado = mysqli_query($conexion, $sql);
	
	while($fila = mysqli_fetch_array($resultado))
	{	
		if($fila["estatus"] == "BAJA")
		{
			$estatus = 0;
			$fecha_baja = date("Y-m-d");
		}
		else
		{
			$estatus = 1;
			$fecha_baja = "0000-00-00";
		}
		
		$sql_verifica = "SELECT COUNT(*) AS registros FROM alumnos WHERE apellido_paterno = '".$fila["apellido_paterno"]."' AND apellido_materno = '".$fila["apellido_materno"]."' AND nombre = '".$fila["nombre"]."';";
		
		$resultado_verifica = mysqli_query($conexion, $sql_verifica);
		$fila_verifica = @mysqli_fetch_array($resultado_verifica);
		
		if($fila_verifica["registros"] > 0)
		{
			$sql_alumno_x = "SELECT id_alumno FROM alumnos WHERE apellido_paterno = '".$fila["apellido_paterno"]."' AND apellido_materno = '".$fila["apellido_materno"]."' AND nombre = '".$fila["nombre"]."';";
			$resultado_alumno_x = mysqli_query($conexion, $sql_alumno_x);
			$fila_alumno_x = mysqli_fetch_array($resultado_alumno_x);
			
			$id_alumno = $fila_alumno_x["id_alumno"];
		}
		else
		{
			$sql_maximo = "SELECT MAX(usuario) AS maximo FROM alumnos;";
			$resultado_maximo = mysqli_query($conexion, $sql_maximo);
			$fila_maximo = @mysqli_fetch_array($resultado_maximo);
			
			$siguiente = $fila_maximo["maximo"] + 1;
			
			$nombre = explode(" ", $fila["nombre"]);	
			$password = strtolower(substr($fila["apellido_paterno"],0,1).substr($fila["apellido_materno"],0,1).$nombre[0]);
			$password = strtr($password,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');	
			$password = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $password));
			
			$pass = Genera_Password($password);
			
			//TABLA ALUMNOS
			
			$sql_alumnos = "INSERT INTO alumnos (usuario, password, apellido_paterno, apellido_materno, nombre, fecha_hora, fecha_baja) VALUES ('".$siguiente."','".$pass."','".$fila["apellido_paterno"]."', '".$fila["apellido_materno"]."','".$fila["nombre"]."','".date("Y-m-d h:i:s")."','".$fecha_baja."');";			
			$resultado_alumnos = mysqli_query($conexion, $sql_alumnos);
			
			$id_alumno = mysqli_insert_id($conexion);
			
			//TABLA ALUMNOS CONTACTOS
			
			if(trim($fila["telefono_1"]) != "")
			{		
				$sql_telefono_casa = "INSERT INTO alumnos_contactos (id_alumno, tipo_contacto, contacto) VALUES ('".$id_alumno."','1','".$fila["telefono_1"]."');";
				$fila_telefono_casa = mysqli_query($conexion, $sql_telefono_casa);
			}
		
			if(trim($fila["telefono_2"]) != "")
			{
				$sql_telefono_celular = "INSERT INTO alumnos_contactos (id_alumno, tipo_contacto, contacto) VALUES ('".$id_alumno."','2','".$fila["telefono_2"]."');";
				$fila_telefono_celular = mysqli_query($conexion, $sql_telefono_celular);
			}
			
			if(trim($fila["correo"]) != "")
			{
				$sql_correo = "INSERT INTO alumnos_contactos (id_alumno, tipo_contacto, contacto) VALUES ('".$id_alumno."','3','".$fila["correo"]."');";
				$fila_correo = mysqli_query($conexion, $sql_correo);
			}			
		}
		
		//TABLA ALUMNOS_PROGRAMAS
		
		$sql_alumno_programa = "SELECT COUNT(*) AS registros FROM alumnos_programas WHERE cuenta = '".$fila["cuenta"]."' AND id_alumno = '".$id_alumno."' AND id_plan_estudio = '2';";
		$resultado_alumno_programa = mysqli_query($conexion, $sql_alumno_programa);
		$fila_alumno_programa = mysqli_fetch_array($resultado_alumno_programa);
		
		if($fila_alumno_programa["registros"] == 0)
		{		
			$sql_programa = "INSERT INTO alumnos_programas (id_alumno, id_plan_estudio, cuenta, clave, estatus) VALUES ('".$id_alumno."', '2', '".$fila["cuenta"]."', '".$fila["cuenta"]."', '".$estatus."');";		
			$resultado_programa = mysqli_query($conexion, $sql_programa);
						
			if(!mysqli_error($conexion))
			{
				$id_alumno_programa = mysqli_insert_id($conexion);
				
				$sql_documentacion = "SELECT * FROM documentacion WHERE id_carrera_tipo = '2' OR id_carrera_tipo = 0";
				$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);
				
				while($fila_documentacion = @mysqli_fetch_array($resultado_documentacion))
				{
					$sql_alumnos_documentacion = "INSERT INTO alumnos_documentacion (id_alumno_programa, id_documento) VALUES ('".$id_alumno_programa."','".$fila_documentacion["id_documento"]."')";
					
					$resultado_alumnos_documentacion = mysqli_query($conexion, $sql_alumnos_documentacion);

				}
				
				$sql_materias = "SELECT id_materia, semestre, clave_materia FROM materias WHERE id_plan_estudio = '2' ORDER BY semestre, clave_materia ASC;";			
				$resultado_materias = mysqli_query($conexion,$sql_materias);
				
				while($fila_materias = mysqli_fetch_array($resultado_materias))
				{
					if(trim($fila[$fila_materias["clave_materia"]]) != "")
					{
						$tipo = 1;
						$equivalencia = 1;
						$calificacion = $fila[$fila_materias["clave_materia"]];
					}
					else
					{
						$tipo = 0;
						$equivalencia = 0;
						$calificacion = "";
					}
				
					//Se inserta el registro de las materias del plan de estudios para el alumno
					$sql_historial = "INSERT INTO alumnos_historial (id_alumno_programa, id_materia, tipo, equivalencia, calificacion) VALUES ('".$id_alumno_programa."','".$fila_materias["id_materia"]."','".$tipo."','".$equivalencia."','".$calificacion."');";					
					$resultado_historial = mysqli_query($conexion, $sql_historial);
					
				}			
			}
		}
	}	
?>