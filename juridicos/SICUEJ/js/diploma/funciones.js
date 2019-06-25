


//----------------------------------------------
//Función: nuevo registro de actividades
//Parámetros:
//Return: Registro Exitoso o no
//Autor: Jesus Nataren
//Fecha de Actualización: Abril, 19 2019
//----------------------------------------------

function generar(diploma,alumno)
{



	window.open('/SICUEJ/impresiones/diploma/generar.php?diploma=' + diploma +"&alumno="+alumno, "_blank");


}


//----------------------------------------------
//Función: actualizar registro de actividades
//Parámetros: -
//Return: Registro Exitoso o no
//Archivo Origen: Alumnos.php
//Autor: Jesus Nataren
//Fecha de Actualización: Abril, 19 2019
//----------------------------------------------

function actualizar()
{



	var datos = $('#frmRegistro').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/registro/actualizar.php',
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


	var datos = $('#frmRegistro').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/registro/insertar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		location.reload();
	  }
	});
}


//----------------------------------------------
//Función: Buscar
//Parámetros:
//Return: Registro Exitoso o no
//Archivo Origen: contactarView.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2019
//----------------------------------------------

function buscar()
{


	var datos = $('#frmRegistro').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/registro/buscar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){


		  $('#divRegistro').html(respuesta);


		var table = 	 $('#tbl_registro').DataTable({
		    language: {
		        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
		    }
		});

		$('a.btn').click(function(){

			$('#divRegistroModal').html("Cargando ...");
			verAdmin($(this).attr('taskid') );

		});



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

function buscarUsuario()
{


	var datos = $('#frmRegistro').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/registro/buscarUsuario.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){


		  $('#divRegistro').html(respuesta);


		var table = 	 $('#tbl_registro').DataTable({
		    language: {
		        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
		    }
		});

		$('a.btn').click(function(){

			$('#divRegistroModal').html("Cargando ...");
			verAdmin($(this).attr('taskid') );

		});



	  }
	});
}



// ----------------------------------------------
// Función: Captacion datos
// Parámetros: id
// Return: Datos del proceso de captacion
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Abril, 19 2019
// ----------------------------------------------

function ver(id)
{
	$.ajax({
	  url: '/SICUEJ/ajax/registro/ver.php',
	  data: "id="+id,
	  type: "POST",
	  success: function(respuesta){
		$('#divRegistro').html(respuesta);

		 $( "#avance" ).datepicker({dateFormat: "dd/mm/yy"});

		  $( "#final" ).datepicker({dateFormat: "dd/mm/yy"});

		$('#btnActualizar').click(function(){


			if ($('#avance').val().trim() != ""){

				if ($('#final').val().trim() != ""){

					if ($('#nombre').val().trim() != ""){

						if ($('#final').val() >= $('#avance').val() ){

							actualizar();

						}else {

							alert("La fecha final debe ser mayor o igual a la fecha de avance");
							$('#final').focus();
						}



					}else {

						alert("Debe ingresar un nombre para la actividad");
						$('#nombre').focus();
					}

				}else {

					alert("Debe ingresar una fecha de final");
					$('#final').focus();
				}

			}else {

				alert("Debe igresar una fecha de avance");
				$('#avance').focus();
			}


		});

		$('#btnRegresar').click(function(){
			 location.reload();
		});
	  }
	});
}



//----------------------------------------------
//Función: Captacion datos
//Parámetros: id
//Return: Datos del proceso de captacion
//Archivo Origen: Alumnos.php
//Autor: Jesus Nataren
//Fecha de Actualización: Abril, 19 2019
//----------------------------------------------

function verAdmin(id)
{

	$.ajax({
	  url: '/SICUEJ/ajax/registro/verAdmin.php',
	  data: "id="+id,
	  type: "POST",
	  success: function(respuesta){
		$('#divRegistroModal').html(respuesta);

	  }
	});
}




