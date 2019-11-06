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
    if(confirm("Confirmar eliminar esta plantilla."))
	{
		$.ajax({
			url: '/SICUEJ/ajax/plantilla/eliminar.php',
			type: 'POST',
			data: 'id='+id,
			success: function(respuesta) {

				 window.location.replace("/SICUEJ/ERP/plantilla");
			}
		});
	}
}


/**
 * Editar plantilla
 * @param id
 * @returns
 */
function editar(id)
{

		$.ajax({
			url: '/SICUEJ/ajax/plantilla/editar.php',
			type: 'GET',
			data: 'id='+id,
			success: function(respuesta) {

				$('#div_body').html(respuesta);


				$('#btnCancel').click(function(){
					 window.location.replace("/SICUEJ/ERP/plantilla");
				});

				$('#btnPost').click(function(){
					if($('#nombre').val().trim() != "")
					{




								if($('#asunto').val().trim() != ""  )
								{

							        $("#frmPlantilla").submit();

								}else{
									alert("Debe indicar un asunto");
									$('#asunto').focus();
								}





					}
					else
					{
						alert("Debe introducir un alias");
						$('#nombre').focus();
					}


				});

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

function buscar(){


	var datos = $('#frmCaptacion').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/captacion/buscar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){


		  $('#div_captacion').html(respuesta);


		  var table = 	 $('#tbl_captacion').DataTable({
			    language: {
			        url: '/SICUEJ/js/DataTables/localisation/Spanish.json'
			    }
    		});


			$('#tbl_captacion tbody').on( 'click', 'tr', function () {
		        $(this).toggleClass('selected');
		    } );



	  }
	});
}



// ----------------------------------------------
// Función: Nuevo proceso de captacion
// Parámetros: -
// Return: Formulario de Registro de Nuevo Profesor
// Archivo Origen: Profesores.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function nuevo()
{
	$.ajax({
	  url: '/SICUEJ/ajax/plantilla/nuevo.php',
	  success: function(respuesta){


		  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		$('#div_body').html(respuesta);


		//$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
		//	$(this).val($(this).val().toUpperCase());
		//});

		$('#btnCancel').click(function(){
			 window.location.replace("/SICUEJ/ERP/plantilla");
		});

		//$('#Codigo_Postal').blur(function(){
			//Alumnos_Estado_Buscar($(this).val());
		//});

		$('#btnPost').click(function(){
			if($('#nombre').val().trim() != "")
			{




						if($('#asunto').val().trim() != ""  )
						{

					        $("#frmPlantilla").submit();

						}else{
							alert("Debe indicar un asunto");
							$('#asunto').focus();
						}





			}
			else
			{
				alert("Debe introducir un alias");
				$('#nombre').focus();
			}


		});
	  }
	});
}

// ----------------------------------------------
// Función: Insertar nueva plantilla
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: index.php
// Autor: Jesus Nataren
// Fecha de Actualización: Octubre, 19 2016
// ----------------------------------------------

function insertar()
{
	var datos = $('#frmPlantilla').serialize();


	//var formData = new FormData(document.getElementById("frmPlantilla"));

	var form = $('form')[0];

	var formData = new FormData(form);


	$.ajax({
	  url: '/SICUEJ/ajax/plantilla/insertar.php',
	  data: formData,
	  type: "POST",
	  success: function(respuesta){


		if(isNaN(respuesta)){

			 alert("Ocurrio un error al registrar la plantilla: " + respuesta);
				window.location.replace("/SICUEJ/ERP/plantilla");



			 }else{

				alert("Se ha registrado  una nueva plantilla ID :  " + respuesta);
				window.location.replace("/SICUEJ/ERP/plantilla");

		 }

	  }
	});
}

//----------------------------------------------
//Función: actualizar proceso de captacion
//Parámetros: -
//Return: Registro Exitoso o no
//Archivo Origen: captacion.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2016
//----------------------------------------------

function actualizar()
{
	var datos = $('#Frm_captacion').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/captacion/actualizar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		window.location.replace("/SICUEJ/ERP/captacion");
	  }
	});
}



//----------------------------------------------
//Función: enviar
//Parámetros:
//Return: Registro Exitoso o no
//Archivo Origen: contactarView.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2019
//----------------------------------------------

function enviar()
{


	var datos = $('#Frm_captacion').serialize();

	$.ajax({
	  url: '/SICUEJ/ajax/captacion/enviar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		window.location.replace("/SICUEJ/ERP/captacion");
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

		  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


		$('#div_captacion').html(respuesta);




		$('#btnActualizar').click(function(){


			if($('#nombre').val().trim() != "")
			{

				if($('#correo').val().trim() != "" && $('#correo').val().trim().match(mailformat))
				{

					actualizar();
				}
				else
				{
					alert("Debe introducir un correo electronico valido.");
					$('#correo').focus();
				}
			}
			else
			{
				alert("Debe introducir el nombre del cliente");
				$('#nombre').focus();
			}


		});

		$('#btnRegresar').click(function(){
			 window.location.replace("/SICUEJ/ERP/captacion");
		});
	  }
	});
}

//----------------------------------------------
//Función: Ver plantilla de correo
//Parámetros: id
//Return: Datos del proceso de captacion
//Archivo Origen: captacion.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo, 19 2016
//----------------------------------------------

function verPlantilla(id)
{
	$.ajax({
	  url: '/SICUEJ/ajax/plantilla/verPlantilla.php',
	  data: "id="+id,
	  type: "POST",
	  success: function(respuesta){

		$('#divPlantilla').html(respuesta);




	  }
	});
}



//----------------------------------------------
//Función: contactar clientes
//Parámetros: clientes
//Return: Datos del proceso de captacion
//Archivo Origen: Alumnos.php
//Autor: Jesus Nataren
//Fecha de Actualización: Mayo 2019
//----------------------------------------------


function contactar(clientes){

	$.ajax({
		  url: '/SICUEJ/ajax/captacion/contactarView.php',
		  data: "clientes="+clientes,
		  type: "POST",
		  success: function(respuesta){
			$('#div_captacion').html(respuesta);


			CKEDITOR.replace('bodyText');

			$('#plantilla').on('change', function() {

				var selectedValue =  this.value ;

					if(selectedValue > 0){



						$('#divPlantilla').html('Cargando ...');


						$('#divVer').html('<a href="javascript:verPlantilla('+selectedValue+')" taskid="'+selectedValue+'" class="btn" data-toggle="modal" data-target="#exampleModal"  >Ver</a>');


						verPlantilla(selectedValue );


					}else
						$('#divVer').html('');


				});



			$("form").submit(function(e){

				if(	$('select[name=plantilla]').val() > 0){

					//	document.getElementById('editor').value = editor.getData();
						for ( instance in CKEDITOR.instances )
						    CKEDITOR.instances[instance].updateElement();


						enviar();

				 	}else{

				 		e.preventDefault();

				 		alert("Debe seleccionar una plantilla.");

				 		$('#plantilla').focus();
				 	}


		    });




			$('#btnRegresar').click(function(){
				 window.location.replace("/SICUEJ/ERP/captacion");
			});
		  }
		});


}
