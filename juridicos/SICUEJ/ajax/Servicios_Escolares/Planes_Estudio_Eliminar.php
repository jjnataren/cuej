<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Abril, 29 2016]	
	-- País: México
	-- Objetivo: Eliminación de un Plan de Estudios
	-- Última Modificación: [Abril, 29 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
	//El plan de estudios no debe tener ninguna materia asociada
	
	$sql_materias = "SELECT COUNT(*) AS materias FROM materias WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
	$resultado_materias = mysqli_query($conexion, $sql_materias);
	$fila_materias = mysqli_fetch_array($resultado_materias);
	
	if($fila_materias["materias"] == 0)
	{
		//No deben existir grupos asociados al plan de estudios
		
		$sql_grupos = "SELECT COUNT(*) AS grupos FROM grupos WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
		$resultado_grupos = mysqli_query($conexion, $sql_grupos);
		$fila_grupos = mysqli_fetch_array($resultado_grupos);
		
		if($fila_grupos["grupos"] == 0)
		{
			$sql = "DELETE FROM planes_estudio WHERE id_plan_estudio = '".$_POST["id_Plan_Estudio"]."';";
	
			$resultado = mysqli_query($conexion, $sql);
			
			if(!mysqli_error($conexion))
			{
				Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
				echo "¡El Plan de Estudios se eliminó con Éxito!";
			}
			else
			{
				Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
				echo "Error al Eliminar...";
			}
		}
		else
		{
			echo "No se puede eleiminar un plan de estudio con grupos asociados!";
		}
	}
	else
	{
		echo "No se puede eleiminar un plan de estudio con materias registradas!";
	}	
?>