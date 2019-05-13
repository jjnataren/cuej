// JavaScript Document



// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Eliminar
// Parámetros: id_alumno_programa
// Return: eliminación exitosa o no
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 26 2016
// ----------------------------------------------

function eliminar(id)
{
    if(confirm("Confirmar eliminar este proceso de captación"))
	{
		$.ajax({
			url: '/SICUEJ/ajax/captacion/eliminar.php',
			type: 'POST',
			data: 'id='+id,
			success: function(respuesta) {
				alert(respuesta);
				Alumnos_Academico(id_alumno);
			}
		});
	}
}



//----------------------------------------------
//Función: actualizar horarios
//Parámetros: -
//Return: Registro Exitoso o no
//Archivo Origen: Alumnos.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2016
//----------------------------------------------

function actualizar()
{



	var datos = $('#frmHorarios').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/horarios/admin/actualizar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		location.reload();
	  }
	});
}



//----------------------------------------------
//Función: insertar
//Parámetros:
//Return: Registro Exitoso o no
//Archivo Origen: contactarView.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2019
//----------------------------------------------

function insertar()
{


	var datos = $('#frmBitacora').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/bitacora/insertar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		location.reload();
	  }
	});
}


//----------------------------------------------
//Función: insertar
//Parámetros:
//Return: Registro Exitoso o no
//Archivo Origen: contactarView.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2019
//----------------------------------------------

function buscar()
{


	var datos = $('#frmBitacora').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/bitacora/buscar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){


		  $('#divBitacora').html(respuesta);


		var table = 	 $('#tbl_horarios').DataTable();



	  }
	});
}



// ----------------------------------------------
// Función: Captacion datos
// Parámetros: id
// Return: Datos del proceso de captacion
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function Captacion_Datos(id)
{
	$.ajax({
	  url: '/SICUEJ/ajax/captacion/ver.php',
	  data: "id="+id,
	  type: "POST",
	  success: function(respuesta){
		$('#div_captacion').html(respuesta);



		//Sólo letras
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});

		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});

		$('#btnActualizar').click(function(){
			actualizar();
		});

		$('#btnRegresar').click(function(){
			 location.reload();
		});
	  }
	});
}



