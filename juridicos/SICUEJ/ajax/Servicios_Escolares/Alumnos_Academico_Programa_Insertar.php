<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 26 2016]	
	-- País: México
	-- Objetivo: Registro de Nuevo Programa Academico para alumno
	-- Última Modificación: [Mayo, 26 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	
	//Validación para no duplicar el programa académico y plan de etudios para un mismo alumno
	$sql_programa = "SELECT COUNT(*) AS registros FROM alumnos_programas WHERE id_alumno = '".$_POST["id_Alumno"]."' AND id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = mysqli_fetch_array($resultado_programa);
	
	if($fila_programa["registros"] > 0)
	{
		echo "El alumno ya tiene registrados el programa y plan de estudios seleccionados, no se puede duplicar ";			
	}
	else
	{	
		$sql = "INSERT INTO alumnos_programas (id_alumno, id_plan_estudio, id_grupo, cuenta, clave,  fecha_inicio, observaciones) VALUES ('".$_POST["id_Alumno"]."', '".$_POST["id_Plan_Estudio"]."', '".$_POST["id_Grupo"]."','".$_POST["Cuenta"]."','".$_POST["Cuenta"]."', '".date("Y-m-d")."','".$_POST["Observaciones"]."');";	
		
		$resultado = mysqli_query($conexion, $sql);
		
		if(!mysqli_error($conexion))
		{
			$id_alumno_programa = mysqli_insert_id($conexion);
			
			$sql_ciclo = "SELECT id_ciclo_escolar FROM grupos WHERE id_grupo = '".$_POST["id_Grupo"]."';";
			$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
			$fila_ciclo = mysqli_fetch_array($resultado_ciclo);
			
			
			$sql_carrera = "SELECT id_carrera_tipo FROM carreras JOIN planes_estudio USING(id_carrera) WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
			$resultado_carrera = mysqli_query($conexion, $sql_carrera);
			$fila_carrera = @mysqli_fetch_array($resultado_carrera);
			
			$sql_documentacion = "SELECT * FROM documentacion WHERE id_carrera_tipo = '".$fila_carrera["id_carrera_tipo"]."' OR id_carrera_tipo = 0";
			$resultado_documentacion = mysqli_query($conexion, $sql_documentacion);
			
			while($fila_documentacion = @mysqli_fetch_array($resultado_documentacion))
			{
				$sql_alumnos_documentacion = "INSERT INTO alumnos_documentacion (id_alumno_programa, id_documento) VALUES ('".$id_alumno_programa."','".$fila_documentacion["id_documento"]."')";
				$resultado_alumnos_documentacion = mysqli_query($conexion,$sql_alumnos_documentacion);
			}
			
			//Se insertan las materias que se tengan registradas en el plan de estudios
			
			$sql_materias = "SELECT id_materia, semestre FROM materias WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."' ORDER BY semestre, clave_materia ASC;";			
			$resultado_materias = mysqli_query($conexion,$sql_materias);
			
			while($fila_materias = mysqli_fetch_array($resultado_materias))
			{
				if($fila_materias["semestre"] == $_POST["Semestre"])
				{
					$sql_evaluaciones = "INSERT INTO alumnos_evaluaciones (id_alumno_programa, id_grupo, id_materia, id_periodo) VALUES ('".$id_alumno_programa."', '".$_POST["id_Grupo"]."','".$fila_materias["id_materia"]."','3');";
					
					$resultado_evaluaciones = mysqli_query($conexion, $sql_evaluaciones);					
				}
				//Se inserta el registro de las materias del plan de estudios para el alumno
				$sql_historial = "INSERT INTO alumnos_historial (id_alumno_programa, id_materia) VALUES ('".$id_alumno_programa."','".$fila_materias["id_materia"]."');";
					
				$resultado_historial = mysqli_query($conexion, $sql_historial);
				
			}
			
			// Se insertan los montos y becas necesarios para cobranza
			
			$sql_montos = "SELECT * FROM cuotas_generales WHERE id_carrera_tipo = '".$fila_carrera["id_carrera_tipo"]."';";
			$resultado_montos = mysqli_query($conexion, $sql_montos);
			$fila_montos = @mysqli_fetch_array($resultado_montos);
			
			$sql_becas = "INSERT INTO alumnos_becas (id_alumno_programa, id_ciclo_escolar, inscripcion, colegiatura) VALUES ('".$id_alumno_programa."','".$fila_ciclo["id_ciclo_escolar"]."','".$fila_montos["inscripcion"]."','".$fila_montos["colegiatura"]."');";
			
			$resultado_becas = mysqli_query($conexion, $sql_becas);			
			
			Logs_Errores('REGISTRO', $sql, $_SESSION["id_Usuario"]);
			echo "¡Registro Exitoso!";
		}
		else
		{
			Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
			echo "Error al Registrar...";
		}
	}
?>