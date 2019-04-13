<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 13 2016]	
	-- País: México
	-- Objetivo: Registro de reinscripción
	-- Última Modificación: [Junio, 13 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	
	//Validación para no duplicar el programa académico y plan de etudios para un mismo alumno
	
	$sql_programa = "SELECT COUNT(*) AS registros FROM alumnos_evaluaciones JOIN grupos USING(id_grupo) WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
	$resultado_programa = mysqli_query($conexion, $sql_programa);
	$fila_programa = mysqli_fetch_array($resultado_programa);
	
	if($fila_programa["registros"] > 0)
	{
		echo "El alumno ya se encuentra inscrito al ciclo escolar seleccionado, agregue o modifique asignaturas de ser necesario";			
	}
	else
	{		
		//agregar materias a evaluacion... sólo las que no tengan calificación en historial
		$sql_grupo = "SELECT * FROM grupos WHERE id_grupo = '".$_POST["id_Grupo"]."';";
		$resultado_grupo = mysqli_query($conexion, $sql_grupo);
		$fila_grupo = @mysqli_fetch_array($resultado_grupo);		
		
		$sql_materias = "SELECT id_materia, id_carrera_tipo FROM materias JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) JOIN carreras_tipo USING(id_carrera_tipo) WHERE id_plan_estudio = '".$fila_grupo["id_plan_estudio"]."' AND semestre = '".$fila_grupo["semestre"]."';";
		$resultado_materias = mysqli_query($conexion, $sql_materias);
		
		while($fila_materias = mysqli_fetch_array($resultado_materias))
		{
			if($fila_materias["id_carrera_tipo"] == 1)
				$calificacion_aprobatoria = 7;
			else if($fila_materias["id_carrera_tipo"] == 2 || $fila_materias["id_carrera_tipo"] == 3)
				$calificacion_aprobatoria = 8;
			
			$sql_historial = "SELECT COUNT(*) AS registros FROM  alumnos_historial WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_materia = '".$fila_materias["id_materia"]."' AND calificacion <> '' AND calificacion <> 'NP' AND calificacion <> 'NA' AND calificacion >= '".$calificacion_aprobatoria."';";
			$resultado_historial = mysqli_query($conexion, $sql_historial);
			$fila_historial = @mysqli_fetch_array($resultado_historial);
			
			if($fila_historial["registros"] == 0)
			{
				$sql_evaluacion = "INSERT INTO alumnos_evaluaciones (id_alumno_programa, id_grupo, id_materia, id_periodo) VALUES('".$_POST["id_Alumno_Programa"]."','".$_POST["id_Grupo"]."','".$fila_materias["id_materia"]."', '3');";
				$resultado_evaluacion = @mysqli_query($conexion, $sql_evaluacion);
				
				if(!mysqli_error($conexion))
				{
					Logs_Errores('REGISTRO', $sql_evaluacion, $_SESSION["id_Usuario"]);
				}
				else
				{
					Logs_Errores(mysqli_error($conexion), $sql_evaluacion, $_SESSION["id_Usuario"]);
				}

			}
		}

		// Se insertan los montos y becas necesarios para cobranza
			
		$sql_carrera_tipo = "SELECT id_carrera_tipo FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) JOIN carreras_tipo USING(id_carrera_tipo) WHERE id_grupo = '".$_POST["id_Grupo"]."';";
		$resultado_carrera_tipo = mysqli_query($conexion, $sql_carrera_tipo);
		$fila_carrera_tipo = mysqli_fetch_array($resultado_carrera_tipo);
		
		
		$sql_montos = "SELECT * FROM cuotas_generales WHERE id_carrera_tipo = '".$fila_carrera_tipo["id_carrera_tipo"]."';";
		$resultado_montos = mysqli_query($conexion, $sql_montos);
		$fila_montos = @mysqli_fetch_array($resultado_montos);
			
		
		$sql_verifica = "SELECT COUNT(*) AS registro FROM alumnos_becas WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
		$resultado_verifica = mysqli_query($conexion, $sql_verifica);
		$fila_verifica = mysqli_fetch_array($resultado_verifica);
		
		if($fila_verifica["registro"] > 0)
		{
			$sql_becas = "UPDATE alumnos_becas SET inscripcion = '".$fila_montos["inscripcion"]."', colegiatura = '".$fila_montos["colegiatura"]."' WHERE id_alumno_programa = '".$_POST["id_Alumno_Programa"]."' AND id_ciclo_escolar = '".$_POST["id_Ciclo_Escolar"]."';";
		}
		else
		{
			$sql_becas = "INSERT INTO alumnos_becas (id_alumno_programa, id_ciclo_escolar, inscripcion, colegiatura) VALUES ('".$_POST["id_Alumno_Programa"]."','".$_POST["id_Ciclo_Escolar"]."','".$fila_montos["inscripcion"]."','".$fila_montos["colegiatura"]."');";
		}	
			
		$resultado_becas = mysqli_query($conexion, $sql_becas);	
		
		echo "Reinscripción realizada, revise la asignación de materias";
	}
?>