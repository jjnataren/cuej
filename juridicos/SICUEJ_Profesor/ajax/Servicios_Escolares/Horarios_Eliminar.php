<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 17 2016]	
	-- País: México
	-- Objetivo: Eliminacion de Grupo
	-- Última Modificación: [Mayo, 17 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	

	
	 $sql = "DELETE FROM horarios WHERE id_horario = '".$_POST["id_Horario"]."';";
  
	 $resultado = mysqli_query($conexion, $sql);
	 
	 if(!mysqli_error($conexion))
	 {
		 Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
		 echo "¡El Horario se eliminó con Éxito!";
	 }
	 else
	 {
		 Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
		 echo "Error al Eliminar...";
	 }
?>