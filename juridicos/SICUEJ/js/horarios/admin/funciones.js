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
			url: '../ajax/captacion/eliminar.php',
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
	  url: '../ajax/captacion/enviar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		location.reload();
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
	  url: '../ajax/captacion/ver.php',
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
		  url: '../ajax/captacion/contactarView.php',
		  data: "clientes="+clientes,
		  type: "POST",
		  success: function(respuesta){
			$('#div_captacion').html(respuesta);


			CKEDITOR.replace('bodyText');



			//Sólo letras
			$('.Solo_Letras').keypress(function(tecla){
				  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
			});

			//Solo Números
			$('.Solo_Numeros').keypress(function(tecla){
				  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
			});

			$('#btnEnviar').click(function(){

			//	document.getElementById('editor').value = editor.getData();
				for ( instance in CKEDITOR.instances )
				    CKEDITOR.instances[instance].updateElement();

				console.log("Error we");
				enviar();
			});

			$('#btnRegresar').click(function(){
				 location.reload();
			});
		  }
		});


}


// ----------------------------------------------
// Función: Alumnos_Estado_Buscar
// Parámetros: codigo postal
// Return: Estado al que pertenece el coodigo postal
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 25 2016
// ----------------------------------------------


function Alumnos_Estado_Buscar(codigo_postal)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Estado_Buscar.php',
		type: 'POST',
		data: 'Codigo_Postal='+codigo_postal,
		success: function(respuesta) {
			$('#Estado').val(respuesta);
			Alumnos_Municipio_Buscar(codigo_postal);
		}
	});
}


// ----------------------------------------------
// Función: Alumnos_Municipio_Buscar
// Parámetros: codigo postal
// Return: Municipio al que pertenece el coodigo postal
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 25 2016
// ----------------------------------------------

function Alumnos_Municipio_Buscar(codigo_postal)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Municipio_Buscar.php',
		type: 'POST',
		data: 'Codigo_Postal='+codigo_postal,
		success: function(respuesta) {
			$('#Municipio').val(respuesta);
			Alumnos_Colonias_Buscar(codigo_postal);
		}
	});
}


// ----------------------------------------------
// Función: Alumnos_Colonias_Buscar
// Parámetros: codigo postal
// Return: Colonias que pertenecen al código postal indicado
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 25 2016
// ----------------------------------------------

function Alumnos_Colonias_Buscar(codigo_postal)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Colonias_Buscar.php',
		type: 'POST',
		data: 'Codigo_Postal='+codigo_postal,
		success: function(respuesta) {
			$('#id_Codigo_Postal').html(respuesta);
		}
	});
}


// ----------------------------------------------
// Función: Alumnos_Academico
// Parámetros: id_alumno
// Return: Registro de Programas Académicos del Alumno
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 25 2016
// ----------------------------------------------

function Alumnos_Academico(id_alumno)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico.php',
		type: 'POST',
		data: 'id_Alumno='+id_alumno,
		success: function(respuesta) {
			$('#div_Alumnos').html(respuesta);

			$('#Registrar_Programa').click(function(){
				Alumnos_Academico_Programa_Nuevo(id_alumno);
			})
		}
	});
}


// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Programas Académicos para el alumno
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 25 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Nuevo(id_alumno)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Nuevo.php',
		type: 'POST',
		data: 'id_Alumno='+id_alumno,
		success: function(respuesta) {
			$('#div_Alumnos').html(respuesta);

			$('#id_Carrera').change(function(){
				Alumnos_Academico_Planes_Estudio_Buscar($(this).val());
			});

			$('#id_Plan_Estudio').change(function(){
				Alumnos_Academico_Semestres_Buscar($(this).val());
			});

			$('#Semestre').change(function(){
				Alumnos_Academico_Grupos_Buscar($('#id_Plan_Estudio').val(), $('#id_Ciclo_Escolar').val(), $(this).val());
			});

			$('#id_Ciclo_Escolar').change(function(){
				Alumnos_Academico_Cuenta_Buscar($('#id_Carrera').val(), $(this).val());
			});

			$('#Btn_Cancelar').click(function(){
				Alumnos_Academico(id_alumno);
			});

			$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
				$(this).val($(this).val().toUpperCase());
			});

			$('#Btn_Nuevo_Registrar').click(function(){

				if($('#id_Grupo').val() != "")
				{
					if($('#Cuenta').val() != "")
					{
						Alumnos_Academico_Programa_Insertar(id_alumno);
					}
					else
					{
						alert("Debe indicar un N\u00FAmero de Cuenta");
						$('#Cuenta').focus();
					}
				}
				else
				{
					alert("Debe indicar un Grupo");
					$('#id_Grupo').focus();
				}
			});
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Planes_Estudio_Buscar
// Parámetros: id_carrera
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 26 2016
// ----------------------------------------------

function Alumnos_Academico_Planes_Estudio_Buscar(id_carrera)
{
    $.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Planes_Estudio_Buscar.php',
		type: 'POST',
		data: 'id_Carrera='+id_carrera,
		success: function(respuesta) {
			$('#id_Plan_Estudio').html(respuesta);
			Alumnos_Academico_Ciclos_Escolares_Buscar(id_carrera);
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Ciclos_Escolares_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 30 2016
// ----------------------------------------------

function Alumnos_Academico_Ciclos_Escolares_Buscar(id_carrera)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Ciclos_Escolares_Buscar.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Ciclo_Escolar').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Cuenta_Buscar
// Parámetros: id_Carrera, id_Ciclo_Escolar
// Return: Numero de Cuenta
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 25 2016
// ----------------------------------------------

function Alumnos_Academico_Cuenta_Buscar(id_carrera, id_ciclo_escolar)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Cuenta_Buscar.php',
	  data: "id_Carrera="+id_carrera+'&id_Ciclo_Escolar='+id_ciclo_escolar,
	  type: "POST",
	  success: function(respuesta){
		$('#Cuenta').val(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Semestres_Buscar
// Parámetros: id_Carrera
// Return: Semestres para la Carrera Seleccionada
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 30 2016
// ----------------------------------------------

function Alumnos_Academico_Semestres_Buscar(id_plan_estudio)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Semestres_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio,
	  type: "POST",
	  success: function(respuesta){
		$('#Semestre').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Grupos_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Grupos registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 30 2016
// ----------------------------------------------

function Alumnos_Academico_Grupos_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Grupos_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Grupo').html(respuesta);
	  }
	});
}


// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Insertar
// Parámetros: id_alumno
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 26 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Insertar(id_alumno)
{
    datos = $('#Frm_Programa_Nuevo').serialize();

    $.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Insertar.php',
		type: 'POST',
		data: datos+"&id_Alumno="+id_alumno,
		success: function(respuesta) {
			alert(respuesta);
			Alumnos_Academico(id_alumno);
		}
	});
}


// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Eliminar
// Parámetros: id_alumno_programa
// Return: eliminación exitosa o no
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 26 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Eliminar(id_alumno_programa, id_alumno)
{
    if(confirm("Realmente desea eliminar el Programa Acad\u00E9mico para el alumno"))
	{
		$.ajax({
			url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Eliminar.php',
			type: 'POST',
			data: 'id_Alumno_Programa='+id_alumno_programa,
			success: function(respuesta) {
				alert(respuesta);
				Alumnos_Academico(id_alumno);
			}
		});
	}
}


// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Datos
// Parámetros: id_alumno_programa
// Return: Formulario de datos del programa registrado
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 27 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Datos(id_alumno_programa, id_alumno)
{
    $.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Datos.php',
		type: 'POST',
		data: 'id_Alumno_Programa='+id_alumno_programa+'&id_Alumno='+id_alumno,
		success: function(respuesta) {
			$('#div_Programa_Academico').html(respuesta);

			$('#Btn_Regresar').click(function(){
				Alumnos_Academico(id_alumno);
			});

			$('#Btn_Reinscripcion').click(function(){
				Alumnos_Academico_Programa_Reinscripcion(id_alumno_programa, id_alumno);
			});

			$('#Fecha_Inicio').datepicker({
				changeMonth: true,
				changeYear: true,
			});

			$('#Fecha_Concluido').datepicker({
				changeMonth: true,
				changeYear: true,
			});

			$('#Fecha_Titulado').datepicker({
				changeMonth: true,
				changeYear: true,
			});

			$('#Fecha_Baja').datepicker({
				changeMonth: true,
				changeYear: true,
			});

			$('.fecha_documento').datepicker({
				changeMonth: true,
				changeYear: true,
			});

		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Reinscripcion
// Parámetros: -
// Return: Formulario de Reinscripcion para el alumno
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 12 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Reinscripcion(id_alumno_programa, id_alumno)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Reinscripcion.php',
		type: 'POST',
		data: 'id_Alumno_Programa='+id_alumno_programa+'&id_Alumno='+id_alumno,
		success: function(respuesta) {
			$('#div_Programa_Academico').html(respuesta);

			$('#Btn_Regresar').click(function(){
				Alumnos_Academico_Programa_Datos(id_alumno_programa, id_alumno);
			});

			$('#Semestre').change(function(){
				Alumnos_Academico_Grupos_Buscar($('#id_Plan_Estudio').val(), $('#id_Ciclo_Escolar').val(), $(this).val());
			});

			$('#Btn_Reinscribir').click(function(){

				if($('#id_Ciclo_Escolar').val() != "")
				{
					if($('#Semestre').val() != "")
					{
						if($('#id_Grupo').val() != "")
						{
							Alumnos_Academico_Programa_Reinscripcion_Insertar(id_alumno_programa, id_alumno);
						}
						else
						{
							alert("Debe indicar el Grupo");
							$('#id_Grupo').focus();
						}
					}
					else
					{
						alert("Debe indicar el semestre");
						$('#Semestre').focus();
					}
				}
				else
				{
					alert("Debe indicar el ciclo escolar");
					$('#id_Ciclo_Escolar').focus();
				}
			});
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Reinscripcion_Insertar
// Parámetros: id_alumno_programa, id_alumno
// Return: Reinscripcion del alumno para el ciclo y semestre indicados
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 13 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Reinscripcion_Insertar(id_alumno_programa, id_alumno)
{
	var datos = $('#Frm_Reinscripcion').serialize();

	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Reinscripcion_Insertar.php',
		type: 'POST',
		data: datos+'&id_Alumno_Programa='+id_alumno_programa+'&id_Alumno='+id_alumno,
		success: function(respuesta) {
			alert(respuesta);
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Actualizar
// Parámetros: id_alumno_programa, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 27 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Actualizar(id_alumno_programa, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Actualizar.php',
			 type: 'POST',
			 data: 'id_Alumno_Programa='+id_alumno_programa+'&Campo='+campo+'&Valor='+valor,
			 success: function(respuesta) {
				 if(respuesta != 'false')
				 {
				    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Ok.png' width='15px' />");
				 }
			 }
		    });
	    }
	    else
	    {
		    alert("El campo no puede ir vac\u00EDo");
	    }
    }
}



// ----------------------------------------------
// Función: Alumnos_Academico_Documentacion_Actualizar
// Parámetros: id_alumno_documnetacion, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 27 2016
// ----------------------------------------------

function Alumnos_Academico_Documentacion_Actualizar(id_alumno_documentacion, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Alumnos_Academico_Documentacion_Actualizar.php',
			 type: 'POST',
			 data: 'id_Alumno_Documentacion='+id_alumno_documentacion+'&Campo='+campo+'&Valor='+valor,
			 success: function(respuesta) {
				 if(respuesta != 'false')
				 {
				    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Ok.png' width='15px' />");
				 }
			 }
		    });
	    }
	    else
	    {
		    alert("El campo no puede ir vac\u00EDo");
	    }
    }
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Historial
// Parámetros: id_alumno_programa
// Return: Historial del Programa Académico seleccionado del Alumno
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 31 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Historial(id_alumno_programa, id_alumno)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Historial.php',
		type: 'POST',
		data: 'id_Alumno_Programa='+id_alumno_programa+'&id_Alumno='+id_alumno,
		success: function(respuesta) {
			$('#div_Programa_Academico').html(respuesta);

			$('#Btn_Regresar').click(function(){
				Alumnos_Academico(id_alumno);
			});
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Historial_Dato
// Parámetros: id_alumno_programa, id_alumno, id_alumno_historial
// Return: Datos de la materia para actualizacion en historial
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 10 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Historial_Dato(id_alumno_programa, id_alumno, id_alumno_historial)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Historial_Dato.php',
		type: 'POST',
		data: 'id_Alumno_Programa='+id_alumno_programa+'&id_Alumno='+id_alumno+'&id_Alumno_Historial='+id_alumno_historial,
		success: function(respuesta) {
			$('#div_Programa_Academico').html(respuesta);

			$('#Btn_Regresar').click(function(){
				Alumnos_Academico_Programa_Historial(id_alumno_programa, id_alumno);
			});
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Historial_Actualizar
// Parámetros: id_alumno_historial, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 10 2016
// ----------------------------------------------

function Alumnos_Academico_Historial_Actualizar(id_alumno_historial, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n?"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    $.ajax({
			 url: '../ajax/Servicios_Escolares/Alumnos_Academico_Historial_Actualizar.php',
			 type: 'POST',
			 data: 'id_Alumno_Historial='+id_alumno_historial+'&Campo='+campo+'&Valor='+valor,
			 success: function(respuesta) {
				 if(respuesta != 'false')
				 {
				    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Ok.png' width='15px' />");
				 }
			 }
		});
    }
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta
// Parámetros: id_alumno_programa, id_alumno
// Return: Historial del Programa Académico seleccionado del Alumno
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Mayo, 31 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta(id_alumno_programa, id_alumno)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta.php',
		type: 'POST',
		data: 'id_Alumno_Programa='+id_alumno_programa+'&id_Alumno='+id_alumno,
		success: function(respuesta) {
			$('#div_Programa_Academico').html(respuesta);

			$('#Btn_Regresar').click(function(){
				Alumnos_Academico(id_alumno);
			});

			$('#Btn_Materia').click(function(){
				Alumnos_Academico_Programa_Boleta_Materia(id_alumno_programa, id_alumno, $('#id_Ciclo_Escolar').val());
			});

			$('#id_Ciclo_Escolar').change(function(){
				Alumnos_Academico_Programa_Boleta_Buscar(id_alumno_programa, id_alumno, $(this).val());
			});
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta_Buscar
// Parámetros: id_alumno_programa, id_ciclo_escolar
// Return: Historial del Programa Académico seleccionado del Alumno dependiendo del ciclo escolar
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 05 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta_Buscar(id_alumno_programa, id_alumno, id_ciclo_escolar)
{
	if(id_ciclo_escolar != "")
	{
		$.ajax({
			url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta_Buscar.php',
			type: 'POST',
			data: 'id_Alumno_Programa='+id_alumno_programa+"&id_Ciclo_Escolar="+id_ciclo_escolar+'&id_Alumno='+id_alumno,
			success: function(respuesta) {
				$('#div_Boleta').html(respuesta);

				$('#Btn_Regresar').click(function(){
					Alumnos_Academico(id_alumno);
				});

				$('#Btn_Materia').click(function(){
					Alumnos_Academico_Programa_Boleta_Materia(id_alumno_programa, id_alumno, $('#id_Ciclo_Escolar').val());
				});
			}
		});
	}
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta_Materia
// Parámetros: id_alumno_programa
// Return: Formulario para registrar nueva materia para evaluación
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 06 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta_Materia(id_alumno_programa, id_alumno, id_ciclo_escolar)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta_Materia.php',
		type: 'POST',
		data: 'id_Alumno_Programa='+id_alumno_programa+'&id_Ciclo_Escolar='+id_ciclo_escolar,
		success: function(respuesta) {
			$('#div_Boleta').html(respuesta);

			$('#Semestre').change(function(){
				Alumnos_Academico_Programa_Boleta_Grupos(id_alumno_programa, id_ciclo_escolar, $(this).val());
			});

			$('#Btn_Regresar').click(function(){
				Alumnos_Academico_Programa_Boleta_Buscar(id_alumno_programa, id_alumno, id_ciclo_escolar);
			});

			$('#Btn_Registro_Materia').click(function(){
				if($('#id_Grupo').val() != "")
				{
					if($('#id_Materia').val() != "")
					{
						Alumnos_Academico_Programa_Boleta_Materia_Insertar(id_alumno_programa, id_alumno, id_ciclo_escolar, $('#id_Grupo').val(), $('#id_Materia').val());
					}
				}
			});
		}
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta_Grupos
// Parámetros: id_alumno_programa, id_ciclo_escolar semestre
// Return: Grupos para el semestre selccionado
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 06 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta_Grupos(id_alumno_programa, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta_Grupos.php',
	  data: "id_Alumno_Programa="+id_alumno_programa+'&id_Ciclo_Escolar='+id_ciclo_escolar+'&Semestre='+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Grupo').html(respuesta);

		Alumnos_Academico_Programa_Boleta_Materias(id_alumno_programa, id_ciclo_escolar, semestre);
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta_Materias
// Parámetros: id_alumno_programa, id_ciclo_escolar, semestre
// Return: Grupos para el semestre selccionado
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 08 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta_Materias(id_alumno_programa, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta_Materias.php',
	  data: "id_Alumno_Programa="+id_alumno_programa+'&id_Ciclo_Escolar='+id_ciclo_escolar+'&Semestre='+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Materia').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta_Materias_Insertar
// Parámetros: id_alumno_programa, id_grupo, id_materia
// Return: Grupos para el semestre selccionado
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 08 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta_Materia_Insertar(id_alumno_programa, id_alumno, id_ciclo_escolar, id_grupo, id_materia)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta_Materias_Insertar.php',
	  data: "id_Alumno_Programa="+id_alumno_programa+'&id_Grupo='+id_grupo+'&id_Materia='+id_materia,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		Alumnos_Academico_Programa_Boleta_Buscar(id_alumno_programa, id_alumno, id_ciclo_escolar);
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Academico_Programa_Boleta_Materia_Eliminar
// Parámetros: id_alumno_evaluacion
// Return: Eliminación exitosa o no
// Archivo Origen: Alumnos.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 10 2016
// ----------------------------------------------

function Alumnos_Academico_Programa_Boleta_Materia_Eliminar(id_alumno_evaluacion,id_alumno_programa, id_alumno, id_ciclo_escolar)
{
	if(confirm("Realmente desea eliminar la asignaci\u00F3n de la materia"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Alumnos_Academico_Programa_Boleta_Materia_Eliminar.php',
		  data: "id_Alumno_Evaluacion="+id_alumno_evaluacion,
		  type: "POST",
		  success: function(respuesta){
			alert(respuesta);
			Alumnos_Academico_Programa_Boleta_Buscar(id_alumno_programa, id_alumno, id_ciclo_escolar)
		  }
		});
	}
}

// Listas de Asistencia

// ----------------------------------------------
// Función: Listas_Asistencia_Planes_Estudio_Buscar
// Parámetros: id_carrera
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Listas_Asistencia.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Planes_Estudio_Buscar(id_carrera)
{
    $.ajax({
		url: '../ajax/Servicios_Escolares/Listas_Asistencia_Planes_Estudio_Buscar.php',
		type: 'POST',
		data: 'id_Carrera='+id_carrera,
		success: function(respuesta) {
			$('#id_Plan_Estudio').html(respuesta);
			Listas_Asistencia_Ciclos_Escolares_Buscar(id_carrera);
		}
	});
}

// ----------------------------------------------
// Función: Listas_Asistencia_Ciclos_Escolares_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Listas_Asistencia.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Ciclos_Escolares_Buscar(id_carrera)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Listas_Asistencia_Ciclos_Escolares_Buscar.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Ciclo_Escolar').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Listas_Asistencia_Semestres_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Listas_Asistencia.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Semestres_Buscar(id_plan_estudio)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Listas_Asistencia_Semestres_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio,
	  type: "POST",
	  success: function(respuesta){
		$('#Semestre').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Listas_Asistencia_Grupos_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Grupos registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Listas_Asistencia.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Grupos_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Listas_Asistencia_Grupos_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Grupo').html(respuesta);
		Listas_Asistencia_Materias_Buscar(id_plan_estudio, id_ciclo_escolar, semestre);
	  }
	});
}


// ----------------------------------------------
// Función: Listas_Asistencia_Materias_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Materias registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Listas_Asistencia.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Materias_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Listas_Asistencia_Materias_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Materia').html(respuesta);
	  }
	});
}


// ----------------------------------------------
// Función: Listas_Asistencia_Buscar
// Parámetros: -
// Return: Horarios registrados para el grupo seleccionado
// Archivo Origen: Listas_Asistencia.php
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Listas_Asistencia_Buscar()
{
	datos = $('#Frm_Listas_Asistencia').serialize();

	$.ajax({
	  url: '../ajax/Servicios_Escolares/Listas_Asistencia_Buscar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
			$('#div_Listas_Asistencia').html(respuesta);

			//Validaciones

		  }
	});
}


//Calificaciones

// ----------------------------------------------
// Función: Calificaciones_Planes_Estudio_Buscar
// Parámetros: id_carrera
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Calificaciones.php
// Autor: Jesus Nataren
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
// Autor: Jesus Nataren
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
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Semestres_Buscar(id_plan_estudio)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Semestres_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio,
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
// Autor: Jesus Nataren
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
// Autor: Jesus Nataren
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
// Autor: Jesus Nataren
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
// Autor: Jesus Nataren
// Fecha de Actualización: Junio, 14 2016
// ----------------------------------------------

function Calificaciones_Buscar()
{
	datos = $('#Frm_Calificaciones').serialize();

	$.ajax({
	  url: '../ajax/Servicios_Escolares/Calificaciones_Buscar.php',
	  data: datos,
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
// Autor: Jesus Nataren
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



