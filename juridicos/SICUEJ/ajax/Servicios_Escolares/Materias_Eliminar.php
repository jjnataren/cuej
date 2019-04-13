<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 07 2016]	
	-- País: México
	-- Objetivo: Eliminación de una Materia
	-- Última Modificación: [Mayo, 07 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//La materia no debe estar relacionada con ningun horario
	
	$sql_horarios = "SELECT COUNT(*) AS horarios FROM horarios WHERE id_materia = '".$_POST["id_Materia"]."';";
	$resultado_horarios = mysqli_query($conexion, $sql_horarios);
	$fila_horarios = mysqli_fetch_array($resultado_horarios);
	
	if($fila_horarios["horarios"] == 0)
	{
		//La materia no debe estar relacionada con ninguna evaluación
		
		$sql_evaluaciones = "SELECT COUNT(*) AS evaluaciones FROM evaluaciones WHERE id_materia = '".$_POST["id_Materia"]."';";
		$resultado_evaluaciones = mysqli_query($conexion, $sql_evaluaciones);
		$fila_evaluaciones = @mysqli_fetch_array($resultado_evaluaciones);
		
		if($fila_evaluaciones["evaluaciones"] == 0)
		{
			//La materia no debe estar relacionada con ningun registro de historial
			$sql_historial = "SELECT COUNT(*) AS historial FROM historial WHERE id_materia = '".$_POST["id_Materia"]."';";
			$resultado_historial = mysqli_query($conexion, $sql_historial);
			$fila_historial = @mysqli_fetch_array($resultado_historial);
			
			if($fila_historial["historial"] == 0)
			{
				$sql = "DELETE FROM materias WHERE id_materia = '".$_POST["id_Materia"]."';";	
				$resultado = mysqli_query($conexion, $sql);
				
				if(!mysqli_error($conexion))
				{
					Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
					echo "¡La Asignatura se eliminó con Éxito!";
				}
				else
				{
					Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
					echo "Error al Eliminar...";
				}
			}
		}
	}	
?>