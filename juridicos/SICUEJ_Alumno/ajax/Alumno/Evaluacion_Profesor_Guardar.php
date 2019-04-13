<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jur�dicos
	-- Proyecto: Sistema Integral de la Centro Universitario de Estudios Jur�dicos - Alumno
	-- Autor: Ing. Julio C�sar Morales Crisp�n
	-- Responsable: Ing. Nancy Flores Torrecilla
	-- Fecha de Creaci�n: [Octubre, 18 2017]
	-- Pa�s: M�xico
	-- Objetivo: Guarda las respuestas de la Evaluaci�n
	-- �ltima Modificaci�n: [Octubre, 18 2017]
	-- Realiz�: Ing. Julio C�sar Morales Crisp�n
	-- Observaciones: Creaci�n de archivo
	-- ===============================================================================
*/

include ("../../php/Funciones.php");

$inserts = 0;

$sql_preguntas = "SELECT id_evaluacion_pregunta FROM evaluaciones_preguntas ORDER BY id_evaluacion_pregunta;";
$resultado_preguntas = mysqli_query($conexion,$sql_preguntas);
$registros_preguntas = mysqli_num_rows($resultado_preguntas);

while($fila_preguntas = mysqli_fetch_array($resultado_preguntas))
	{
		$respuesta = $_POST["Respuesta_".$fila_preguntas["id_evaluacion_pregunta"].""];
				
		$sql_evaluaciones_docentes = "INSERT INTO evaluaciones_docentes (id_horario, id_evaluacion_pregunta, respuesta) VALUES ('".$_POST["id_Horario"]."', '".$fila_preguntas["id_evaluacion_pregunta"]."', '".$respuesta."');";
		$resultado_evaluaciones_docentes = mysqli_query($conexion,$sql_evaluaciones_docentes);
		
		if (!$resultado_evaluaciones_docentes)
			{
				$error = mysqli_error($conexion);
				echo "Error al insertar la evaluaci�n\n";
				exit();
			}
		else
			{
				++$inserts;
			}
	}

if ($_POST["Observaciones"] != "")
	{
		$sql_evaluaciones_observaciones = "INSERT INTO evaluaciones_observaciones (id_horario, observaciones) VALUES ('".$_POST["id_Horario"]."', '".$_POST["Observaciones"]."');";
		$resultado_evaluaciones_observaciones = mysqli_query($conexion,$sql_evaluaciones_observaciones);
		
		if (!$resultado_evaluaciones_observaciones)
			{
				$error = mysqli_error($conexion);
				echo "Error al insertar las observaciones";
				exit();
			}
	}

$sql_evaluacion_profesor = "UPDATE alumnos_evaluaciones SET evaluacion_profesor = '".date("Y-m-d")."' WHERE id_alumno_evaluacion = '".$_POST["id_Alumno_Evaluacion"]."' LIMIT 1;";

if (!mysqli_query($conexion,$sql_evaluacion_profesor)) {
	echo "Error en la query: , sql_evaluacion_profesor ".$sql_evaluacion_profesor."\n";
	exit();
}

if ($registros_preguntas == $inserts)
	echo "true";
?>