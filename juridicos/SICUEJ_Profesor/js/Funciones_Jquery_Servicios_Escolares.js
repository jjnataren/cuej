// JavaScript Document

// Listas de Asistencia

// ----------------------------------------------
// Función: Listas_Asistencia_Buscar
// Parámetros: -
// Return: Horarios registrados para el grupo seleccionado
// Archivo Origen: Listas_Asistencia.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Buscar(id_grupo,id_materia)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Listas_Asistencia_Buscar.php',
	  data: 'id_Grupo='+id_grupo+'&id_Materia='+id_materia,
	  type: "POST",
	  success: function(respuesta){			
			$('#div_Listas_Asistencia').html(respuesta);			
		  }
	});
}


//Calificaciones

// ----------------------------------------------
// Función: Calificaciones_Planes_Estudio_Buscar
// Parámetros: id_carrera
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Planes_Estudio_Buscar(id_carrera)
{
    $.ajax({
		url: '../ajax/Servicios_Escolares/Calificaciones_Planes_Estudio_Buscar.php',
		type: 'POST',
		data: 'id_Carrera='+id_carrera,
		success: function(respuesta) {
			$('#id_Plan_Estudio').html(respuesta);			
			Calificaciones_Ciclos_Escolares_Buscar(id_carrera);
		}
	});
}

// ----------------------------------------------
// Función: Calificaciones_Ciclos_Escolares_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Ciclos_Escolares_Buscar(id_carrera)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Ciclos_Escolares_Buscar.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Ciclo_Escolar').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Calificaciones_Semestres_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Semestres_Buscar(id_plan_estudio, id_ciclo_escolar)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Semestres_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+'&id_Ciclo_Escolar='+id_ciclo_escolar,
	  type: "POST",
	  success: function(respuesta){
		$('#Semestre').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Calificaciones_Grupos_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Grupos registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Grupos_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Grupos_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Grupo').html(respuesta);
		Calificaciones_Materias_Buscar(id_plan_estudio, id_ciclo_escolar, semestre);
	  }
	});
}


// ----------------------------------------------
// Función: Calificaciones_Materias_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Materias registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Materias_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Materias_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Materia').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Calificaciones_Profesor_Buscar
// Parámetros: id_Grupo, id_Materia
// Return: Profesor del grupo y materia seleccionados
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Profesor_Buscar(id_grupo, id_materia)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Profesor_Buscar.php',
	  data: "id_Grupo="+id_grupo+"&id_Materia="+id_materia,
	  type: "POST",
	  success: function(respuesta){
		$('#Profesor').val(respuesta);
	  }
	});
}


// ----------------------------------------------
// Función: Calificaciones_Buscar
// Parámetros: id_Grupo, id_Materia
// Return: Listado de Alumnos a Calificar
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Buscar(id_grupo, id_materia)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Buscar.php',
	  data: 'id_Grupo='+id_grupo+'&id_Materia='+id_materia,
	  type: "POST",
	  success: function(respuesta){			
			$('#div_Calificaciones').html(respuesta);
			
			$('#Btn_Cerrar_Acta').click(function(){
				
				var calificacion_vacia = 0;
				
				$('.calificacion').each(function (index, value) { 
				  	if($(this).val() == "")
				  	{
						calificacion_vacia++;	
					}
				});
				
				if(calificacion_vacia == 0)
				{
					Calificaciones_Cerrar_Acta($('#id_Grupo').val(), $('#id_Materia').val());
				}
				else
				{
					alert("No se puede cerrar acta con calificaciones vac\u00EDas");
				}
			});
			
			$('#Btn_Abrir_Acta').click(function(){
				Calificaciones_Abrir_Acta($('#id_Grupo').val(), $('#id_Materia').val());		
			});
			
		  }
	});
}


// ----------------------------------------------
// Función: Calificaciones_Actualizar
// Parámetros: id_alumno_evaluacion, calificacion
// Return: Actualización correcta o incorrecta
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Actualizar(id_alumno_evaluacion, calificacion)
{
	$('#lbl_Calificacion_'+id_alumno_evaluacion).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Actualizar.php',
	  data: 'id_Alumno_Evaluacion='+id_alumno_evaluacion+'&Calificacion='+calificacion,
	  type: "POST",
	  success: function(respuesta){			
		$('#lbl_Calificacion_'+id_alumno_evaluacion).html("&nbsp; &nbsp;<img src='../imagenes/Ok.png' width='15px' />");	
	  }
	});
}


// ----------------------------------------------
// Función: Calificaciones_Cerrar_Acta
// Parámetros: id_grupo, id_materia
// Return: Cierre de Acta Correcto o Incorrecto
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Cerrar_Acta(id_grupo, id_materia)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Cerrar_Acta.php',
	  data: 'id_Grupo='+id_grupo+'&id_Materia='+id_materia,
	  type: "POST",
	  success: function(respuesta){			
		alert(respuesta);
		Calificaciones_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Calificaciones_Abrir_Acta
// Parámetros: id_grupo, id_materia
// Return: apertura de Acta Correcto o Incorrecto
// Archivo Origen: Calificaciones.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 22 2016
// ----------------------------------------------

function Calificaciones_Abrir_Acta(id_grupo, id_materia)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Abrir_Acta.php',
	  data: 'id_Grupo='+id_grupo+'&id_Materia='+id_materia,
	  type: "POST",
	  success: function(respuesta){			
		alert(respuesta);
		Calificaciones_Buscar();
	  }
	});
}