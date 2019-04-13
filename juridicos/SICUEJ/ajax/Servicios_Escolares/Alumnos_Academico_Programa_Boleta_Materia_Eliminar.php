<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 10 2016]	
	-- País: México
	-- Objetivo: Eliminar Materia de Evaluacion
	-- Última Modificación: [Junio, 10 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	
	include ("../../php/Funciones.php");
	
    $sql = "DELETE FROM alumnos_evaluaciones WHERE id_alumno_evaluacion = '".$_POST["id_Alumno_Evaluacion"]."';";

    $resultado = mysqli_query($conexion, $sql);
    
    if(!mysqli_error($conexion))
    {
	    Logs_Errores('ELIMINACION', $sql, $_SESSION["id_Usuario"]);
	    echo "¡Se eliminó la Materia con  Éxito!";
    }
    else
    {
	    Logs_Errores(mysqli_error($conexion), $sql, $_SESSION["id_Usuario"]);
	    echo "Error al Eliminar...";
    }
?>