


function del(id)
{

	$.ajax({
	  url: '/SICUEJ/ajax/media/delete.php',
	  data: "id="+id,
	  type: "POST",
	  success: function(respuesta){

		  alert(respuesta);

	  }});

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
//Función: generar
//Parámetros:
//Return: Registro Exitoso o no
//Archivo Origen: reporte.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2019
//----------------------------------------------

function generar()
{


	var datos = $('#frmRegistro').serialize();

	window.open('/SICUEJ/impresiones/registro/generar.php?' + datos, "_blank");

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
	  url: '/SICUEJ/ajax/media/ver.php',
	  data: "id="+id,
	  type: "POST",
	  success: function(respuesta){






		  $('#divMedia').html(respuesta);

			$('#btnRegresar').click(function(){
				 location.reload();
			});


		  var t = $('#tblMediaFile').DataTable({
			    language: {
			        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
			    }
    		});

		  $('#tblMediaFile tbody').on( 'click', 'a.btn', function () {
			    t
			    	.row( $(this).parents('tr') )
			        .remove()
			        .draw();


			});

		  $('#fileupload').fileupload({
		        dataType: 'json',
		        formData: {id_carrera:id },
		        done: function (e, data) {
		            $.each(data.result.files, function (index, file) {

		            	var nameMediaType = "";
		            	var tMed  = file.type.toLowerCase();


		            	if(tMed.indexOf("pdf")!== -1){

		            		nameMediaType = '<i class="fa fa-file-pdf-o"></i>';

		            	}else if(tMed.indexOf("jpg")!== -1 || tMed.indexOf("jpeg")!== -1 || tMed.indexOf("png")!== -1 || tMed.indexOf("gif")!== -1 ){

		            		nameMediaType = '<img alt="" src="/SICUEJ/lib/jfu/server/php/files/thumbnail/'+file.name+'"  />';

		            	}else if(tMed.indexOf("word")!== -1){

		            		nameMediaType = '<i class="fa fa-file-word-o"></i>';

		            	}else if(tMed.indexOf("excel")!== -1){

		            		nameMediaType = '<i class="fa fa-file-excel-o"></i>';

		            	}else{

		            		nameMediaType = '<i class="fa fa-file-o"></i>';

		            	}



		                t.row.add( [
		                	nameMediaType + ' ' + '<a target="_blank" href="/SICUEJ/lib/jfu/server/php/files/'+file.name+'"> '+file.name+'</a>' ,
		                   file.type,
		                    file.size,
		                    '<a class="btn btn-danger btn-sm" href="javascript:del('+file.id+')"><i class="fa fa-trash"></i></a>'
		                ] ).draw( false );

		            });
		        }
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




