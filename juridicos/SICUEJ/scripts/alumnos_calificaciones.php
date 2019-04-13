<?php	
	include ("../php/Funciones.php");
	
	$sql = "SELECT * FROM temporal_calificaciones;";
	$resultado = mysqli_query($conexion, $sql);
	
	while($fila = mysqli_fetch_array($resultado))
	{
		$sql_programa = "SELECT id_alumno_programa FROM alumnos_programas WHERE cuenta = '".$fila["cuenta"]."';";
		$resultado_programa = mysqli_query($conexion, $sql_programa);
		
		if($fila_programa = @mysqli_fetch_array($resultado_programa))
		{
			$sql_materia_1 = "UPDATE alumnos_historial SET calificacion = '".$fila["materia_1"]."', tipo = '1', equivalencia = '1' WHERE id_materia = '37' AND id_alumno_programa = '".$fila_programa["id_alumno_programa"]."';";
			$resultado_materia_1 = mysqli_query($conexion, $sql_materia_1);
			
			$sql_materia_2 = "UPDATE alumnos_historial SET calificacion = '".$fila["materia_2"]."', tipo = '1', equivalencia = '1' WHERE id_materia = '38' AND id_alumno_programa = '".$fila_programa["id_alumno_programa"]."';";
			$resultado_materia_2 = mysqli_query($conexion, $sql_materia_2);
			
			$sql_materia_3 = "UPDATE alumnos_historial SET calificacion = '".$fila["materia_3"]."', tipo = '1', equivalencia = '1' WHERE id_materia = '39' AND id_alumno_programa = '".$fila_programa["id_alumno_programa"]."';";
			$resultado_materia_3 = mysqli_query($conexion, $sql_materia_3);
			
			$sql_materia_4 = "UPDATE alumnos_historial SET calificacion = '".$fila["materia_4"]."', tipo = '1', equivalencia = '1' WHERE id_materia = '40' AND id_alumno_programa = '".$fila_programa["id_alumno_programa"]."';";
			$resultado_materia_4 = mysqli_query($conexion, $sql_materia_4);
			
			$sql_materia_5 = "UPDATE alumnos_historial SET calificacion = '".$fila["materia_5"]."', tipo = '1', equivalencia = '1' WHERE id_materia = '41' AND id_alumno_programa = '".$fila_programa["id_alumno_programa"]."';";
			$resultado_materia_5 = mysqli_query($conexion, $sql_materia_5);
			
			$sql_materia_6 = "UPDATE alumnos_historial SET calificacion = '".$fila["materia_6"]."', tipo = '1', equivalencia = '1' WHERE id_materia = '42' AND id_alumno_programa = '".$fila_programa["id_alumno_programa"]."';";
			$resultado_materia_6 = mysqli_query($conexion, $sql_materia_6);			 	
		}
	}
	
?>