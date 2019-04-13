// JavaScript Document

// ----------------------------------------------
// Función: Carreras_Buscar
// Parámetros: -
// Return: Tabla de carreras
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 29 2016
// ----------------------------------------------

function Carreras_Buscar(){
	
	$("#div_Carreras").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Servicios_Escolares/Carreras_Buscar.php',
		dataType : 'json',
		colModel : [ {
				display : 'NO.',
				name : 'numero',
				width : 50,			
				align : 'center'			
			},{
				display : 'PROGRAMA ACADÉMICO',
				name : 'nombre',
				width : 500,
				align : 'left'
			},{
				display : 'NIVEL',
				name : 'carrera_tipo',
				width : 100,
				align : 'center'
			},{
				display : 'ESTATUS',
				name : 'estatus',
				width : 100,
				align : 'center'
			},{
				display : 'OPCIONES',
				name : 'estatus',
				width : 90,
				align : 'center'
			}],
		showToggleBtn: false,
		pagestat: 'Mostrando de {from} hasta {to} de {total} Registros',
		pagetext: 'Pagina',
		outof: 'de',
		colResize:false,
		resizable: false,
		usepager : true,
		title : 'CARRERAS',
		useRp : true,
		width : 900,
		rp : 10,
		query : $('#Carrera').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

// ----------------------------------------------
// Función: Carreras_Nueva
// Parámetros: -
// Return: Formulario de Registro de Nueva Carrera
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 29 2016
// ----------------------------------------------

function Carreras_Nueva()
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Carreras_Nueva.php',
	  success: function(respuesta) {
		$('#div_Carreras').html(respuesta);
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});		
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('#Btn_Cancelar').click(function(){
			Carreras_Buscar();
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			
			if(Sin_Espacios($('#Nombre_Carrera').val()) != "")
			{
				if(Sin_Espacios($('#id_Carrera_Tipo').val()) != "")
				{
					if(Sin_Espacios($('#Abreviatura').val()) != "")
					{
						Carreras_Insertar()
					}
					else
					{
						alert("Debe indicar una abreviatura para la carrera");
						$('#Abreviatura').focus();
					}
				}
				else
				{
					alert("Debe indicar el tipo de carrera");
					$('#id_Carrera_Tipo').focus();
				}
			}
			else
			{
				alert("Debe indicar el nombre de la carrera");
				$('#Nombre_Carrera').focus();
			}
			
		});
	  }	  
	});
}

// ----------------------------------------------
// Función: Carreras_Insertar
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 29 2016
// ----------------------------------------------

function Carreras_Insertar()
{
	var datos = $('#Frm_Registro').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Carreras_Insertar.php',
	  type: 'POST',
	  data: datos,
	  success: function(respuesta){
		alert(respuesta);
		Carreras_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Carreras_Datos
// Parámetros: id_carrera
// Return: Datos de la Carrera Seleccionada
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 29 2016
// ----------------------------------------------

function Carreras_Datos(id_carrera)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Carreras_Datos.php',
	  type: 'POST',
	  data: 'id_Carrera='+id_carrera,
	  success: function(respuesta) {
		$('#div_Carreras').html(respuesta);
		
		$('#Btn_Regresar').click(function(){
			Carreras_Buscar();
		});
		
		$('#Btn_Nuevo_Plan').click(function(){
			Planes_Estudio_Nuevo(id_carrera);
		});
	  }	  
	});
}

// ----------------------------------------------
// Función: Carreras_Actualizar
// Parámetros: id_carrera, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 28 2016
// ----------------------------------------------

function Carreras_Actualizar(id_carrera, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionado"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Carreras_Actualizar.php',
			 type: 'POST',
			 data: 'id_Carrera='+id_carrera+'&Campo='+campo+'&Valor='+valor,
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
// Función: Carreras_Eliminar
// Parámetros: id_Carrera
// Return: Eliminacion exitosa o no
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 04 2016
// ----------------------------------------------

function Carreras_Eliminar(id_carrera)
{
	if(confirm("Realmente desea eliminar el Programa Academico"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Carreras_Eliminar.php',
		  type: 'POST',
		  data: 'id_Carrera='+id_carrera,
		  success: function(respuesta) {
			alert(respuesta);
			Carreras_Buscar();
		  }	  
		});	
	}	
}

// ----------------------------------------------
// Función: Planes_Estudio_Datos
// Parámetros: id_plan_estudio
// Return: Datos del Plan de Estudios Seleccionado
// Archivo Origen: Carreras.php / Planes_Estudio.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 29 2016
// ----------------------------------------------

function Planes_Estudio_Datos(id_plan_estudio, id_carrera)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Planes_Estudio_Datos.php',
	  type: 'POST',
	  data: 'id_Plan_Estudio='+id_plan_estudio+"&id_Carrera="+id_carrera,
	  success: function(respuesta) {
		$('#div_Planes_Estudio').html(respuesta);
		
		$('#Btn_Regresar').click(function(){
			Carreras_Datos(id_carrera);
		});
		
		$('#Btn_Nueva_Materia').click(function(){
			Materias_Nueva(id_plan_estudio, id_carrera);
		});
	  }	  
	});
}

// ----------------------------------------------
// Función: Planes_Estudio_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Nuevo Plan de Estudios
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Planes_Estudio_Nuevo(id_carrera)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Planes_Estudio_Nuevo.php',
	  type: "POST",
	  data: "id_Carrera="+id_carrera,	  
	  success: function(respuesta) {
		$('#div_Planes_Estudio').html(respuesta);
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});
		
		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('#Btn_Cancelar').click(function(){
			Carreras_Datos(id_carrera);
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			
			if(Sin_Espacios($('#Nombre_Plan_Estudio').val()) != "")
			{
				if(Sin_Espacios($('#Acuerdo_Sep').val()) != "")
				{
					if(Sin_Espacios($('#Clave_Sep').val()) != "")
					{
						if(Sin_Espacios($('#Antecedente').val()) != "")
						{
							if(Sin_Espacios($('#Duracion').val()) != "")
							{
								if(Sin_Espacios($('#Creditos').val()) != "")
								{
									if(Sin_Espacios($('#Fecha').val()) != "")
									{
										Planes_Estudio_Insertar(id_carrera);
									}
									else
									{
										alert("Debe indicar la Fecha del Plan de Estudios");
										$('#Fecha').focus();
									}
								}
								else
								{
									alert("Debe indicar el N\u00FAmero de cr\u00E9ditos");
									$('#Creditos').focus();
								}
							}
							else
							{
								alert("Debe indicar la duraci\u00F3n del Plan de Estudios");
								$('#Duracion').focus();
							}
						}
						else
						{
							alert("Debe seleccionar un antecedente para el Plan de Estudios");
							$('#Antecedente').focus();
						}
					}
					else
					{
						alert("Debe indicar la Clave SEP para el Plan de Estudios");
						$('#Clave_Sep').focus();
					}
				}
				else
				{
					alert("Debe indicar el Acuerdo SEP para el Plan de Estudios");
					$('#Acuerdo_Sep').focus();
				}
			}
			else
			{
				alert("Debe indicar el nombre del Plan de Estudios");
				$('#Nombre_Plan_Estudio').focus();
			}
			
		});
	  }	  
	});
}

// ----------------------------------------------
// Función: Planes_Estudio_Insertar
// Parámetros: id_carrera
// Return: Registro Exitoso o no
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Planes_Estudio_Insertar(id_carrera)
{
	var datos = $('#Frm_Registro_Plan').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Planes_Estudio_Insertar.php',
	  type: 'POST',
	  data: datos+"&id_Carrera="+id_carrera,
	  success: function(respuesta){
		alert(respuesta);
		Carreras_Datos(id_carrera);
	  }
	});
}

// ----------------------------------------------
// Función: Planes_Estudio_Eliminar
// Parámetros: id_Plan_Estudio
// Return: Eliminacion exitosa o no
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 04 2016
// ----------------------------------------------

function Planes_Estudio_Eliminar(id_plan_estudio, id_carrera)
{
	if(confirm("Realmente desea eliminar el Plan de Estudio"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Planes_Estudio_Eliminar.php',
		  type: 'POST',
		  data: 'id_Plan_Estudio='+id_plan_estudio,
		  success: function(respuesta) {
			alert(respuesta);
			Carreras_Datos(id_carrera);
		  }	  
		});	
	}	
}

// ----------------------------------------------
// Función: Planes_Estudio_Actualizar
// Parámetros: id_plan_estudio, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Planes_Estudio_Actualizar(id_plan_estudio, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionado"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");
		
	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Planes_Estudio_Actualizar.php',
			 type: 'POST',
			 data: 'id_Plan_Estudio='+id_plan_estudio+'&Campo='+campo+'&Valor='+valor,
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
// Función: Materias_Datos
// Parámetros: id_Materia, id_Plan_Estudio, id_Carrera
// Return: Información de la Materia Seleccionada
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Materias_Datos(id_materia,id_plan_estudio,id_carrera)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Materias_Datos.php',
		type: 'POST',
		data: 'id_Materia='+id_materia+"&id_Plan_Estudio="+id_plan_estudio+"&id_Carrera="+id_carrera,
		success: function(respuesta) {
			$('#div_Materias').html(respuesta);
			
			$('#Btn_Regresar').click(function(){
				Planes_Estudio_Datos(id_plan_estudio, id_carrera);
			});
		}	  
	});
}

// ----------------------------------------------
// Función: Materias_Nueva
// Parámetros: id_plan_estudio y id_carrera
// Return: Formulario de Registro de Nueva Asignatura
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Materias_Nueva(id_plan_estudio, id_carrera)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Materias_Nueva.php',
	  type: "POST",
	  data: "id_Carrera="+id_carrera+"&id_Plan_Estudio="+id_plan_estudio,	  
	  success: function(respuesta) {
		$('#div_Materias').html(respuesta);
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});
		
		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('#Btn_Cancelar').click(function(){
			Planes_Estudio_Datos(id_plan_estudio, id_carrera);
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			
			if(Sin_Espacios($('#Nombre_Materia').val()) != "")
			{
				if(Sin_Espacios($('#Clave_Materia').val()) != "")
				{
					if(Sin_Espacios($('#Creditos').val()) != "")
					{
						if(Sin_Espacios($('#Semestre').val()) != "")
						{
							Materias_Insertar(id_plan_estudio, id_carrera);
						}
						else
						{
							alert("Debe indicar el Semestre");
							$('#Semestre').focus();
						}
					}
					else
					{
						alert("Debe indicar el N\u00FAmero de Cr\u00E9ditos de la Asignatura");
						$('#Creditos').focus();
					}
				}
				else
				{
					alert("Debe indicar la Clave de la Asignatura");
					$('#Clave_Materia').focus();
				}
			}
			else
			{
				alert("Debe indicar el nombre de la Asignatura");
				$('#Nombre_Materia').focus();
			}
			
		});
	  }	  
	});
}

// ----------------------------------------------
// Función: Materias_Insertar
// Parámetros: id_plan_estudio, id_carrera
// Return: Registro Exitoso o no
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Materias_Insertar(id_plan_estudio,id_carrera)
{
	var datos = $('#Frm_Materia_Nueva').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Materias_Insertar.php',
	  type: 'POST',
	  data: datos+"&id_Carrera="+id_carrera+"&id_Plan_Estudio="+id_plan_estudio,
	  success: function(respuesta){
		alert(respuesta);
		Planes_Estudio_Datos(id_plan_estudio,id_carrera);
	  }
	});
}

// ----------------------------------------------
// Función: Materias_Eliminar
// Parámetros: id_Materia y id_Plan_Estudio, id_Carrera
// Return: Eliminacion exitosa o no
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Materias_Eliminar(id_materia,id_plan_estudio,id_carrera)
{
	if(confirm("Realmente desea eliminar la Asignatura"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Materias_Eliminar.php',
		  type: 'POST',
		  data: 'id_Materia='+id_materia,
		  success: function(respuesta) {
			alert(respuesta);
			Planes_Estudio_Datos(id_plan_estudio, id_carrera);
		  }	  
		});	
	}
}

// ----------------------------------------------
// Función: Materias_Actualizar
// Parámetros: id_materia, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Carreras.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Materias_Actualizar(id_materia, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Materias_Actualizar.php',
			 type: 'POST',
			 data: 'id_Materia='+id_materia+'&Campo='+campo+'&Valor='+valor,
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

//Ciclos Escolares

// ----------------------------------------------
// Función: Ciclos_Escolares_Buscar
// Parámetros: -
// Return: Tabla de ciclos escolares
// Archivo Origen: Ciclo_Escolares.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 07 2016
// ----------------------------------------------

function Ciclos_Escolares_Buscar()
{	
	$("#div_Ciclos_Escolares").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Servicios_Escolares/Ciclos_Escolares_Buscar.php',
		dataType : 'json',
		colModel : [ {
			display : 'NO.',
			name : 'numero',
			width : 50,			
			align : 'center'			
			},{
				display : 'CICLO ESCOLAR',
				name : 'nombre',
				width : 200,
				align : 'left'
			},{
				display : 'NIVEL',
				name : 'carrera_tipo',
				width : 200,
				align : 'center'
			},{
				display : 'PERIODO',
				name : 'estatus',
				width : 300,
				align : 'center'
			},{
				display : 'OPCIONES',
				name : 'estatus',
				width : 90,
				align : 'center'
			}],
		showToggleBtn: false,
		pagestat: 'Mostrando de {from} hasta {to} de {total} Registros',
		pagetext: 'Pagina',
		outof: 'de',
		colResize:false,
		resizable: false,
		usepager : true,
		title : 'CICLOS ESCOLARES',
		useRp : true,
		width : 900,
		rp : 10,
		query : $('#id_Carrera_Tipo').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

// ----------------------------------------------
// Función: Ciclos_Escolares_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Nuevo Ciclo Escolar
// Archivo Origen: Ciclos_Escolares.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 08 2016
// ----------------------------------------------

function Ciclos_Escolares_Nuevo()
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Ciclos_Escolares_Nuevo.php',
	  success: function(respuesta){
		$('#div_Ciclos_Escolares').html(respuesta);
				
		$('#Carrera_Tipo').change(function(){
			if($(this).val() == 1 || $(this).val() == 3)
			{
				$('#Periodo').html("<option value='1'>FEB-JUN</option><option value='2'>AGO-DIC</option>");
			}
			else
			{
				$('#Periodo').html("<option value='1'>ENE-ABR</option><option value='2'>MAY-AGO</option><option value='3'>SEP-DIC</option>");
			}				
		});
		
		$('#Fecha_Inicio').datepicker({
			changeMonth: true,
			changeYear: true,			
			onClose: function( selectedDate ) {
				$( "#Fecha_Fin" ).datepicker( "option", "minDate", selectedDate );
			}
		});		
		$('#Fecha_Fin').datepicker({
			changeMonth: true,
			changeYear: true
		});
		
		$('#Btn_Cancelar').click(function(){
			Ciclos_Escolares_Buscar();
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			if($('#Carrera_Tipo').val() != "")
			{
				if($('#Ciclo_Escolar').val() != "")
				{
					if($('#Fecha_Inicio').val() != "")
					{
						if($('#Fecha_Fin').val() != "")
						{
							Ciclos_Escolares_Insertar();
						}
						else
						{
							alert("Debe indicar una Fecha Final");
							$('#Fecha_Fin').focus();
						}
					}
					else
					{
						alert("Debe indicar una Fecha Inicial");
						$('#Fecha_Inicio').focus();
					}
				}
				else
				{
					alert("Debe indicar el Ciclo Escolar");
					$('#Ciclo_Escolar').focus();
				}
			}
			else
			{
				alert("Debe elegir un Tipo de Programa");
				$('#Carrera_Tipo').focus();
			}
		});
	  }
	});
}

// ----------------------------------------------
// Función: Ciclos_Escolares_Insertar
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: Ciclos_Escolares.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 08 2016
// ----------------------------------------------

function Ciclos_Escolares_Insertar()
{
	var datos = $('#Frm_Ciclos_Escolares_Nuevo').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Ciclos_Escolares_Insertar.php',
	  type: 'POST',
	  data: datos,
	  success: function(respuesta){
		alert(respuesta);
		Ciclos_Escolares_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Ciclos_Escolares_Datos
// Parámetros: id_Ciclo_Escolar
// Return: Información del Ciclo Escolar
// Archivo Origen: Ciclos_Escolares.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 08 2016
// ----------------------------------------------

function Ciclos_Escolares_Datos(id_ciclo_escolar)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Ciclos_Escolares_Datos.php',
		type: 'POST',
		data: 'id_Ciclo_Escolar='+id_ciclo_escolar,
		success: function(respuesta) {
			$('#div_Ciclos_Escolares').html(respuesta);
			
			$('#Btn_Regresar').click(function(){
				Ciclos_Escolares_Buscar();
			});
			
			$('#Fecha_Inicio').datepicker({
				changeMonth: true,
				changeYear: true,			
				onClose: function( selectedDate ) {
					$( "#Fecha_Fin" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$('#Fecha_Fin').datepicker({
				changeMonth: true,
				changeYear: true
			});
		}	  
	});
}

// ----------------------------------------------
// Función: Ciclos_Escolares_Actualizar
// Parámetros: id_ciclo_escolar, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Ciclos_Escolares.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 08 2016
// ----------------------------------------------

function Ciclos_Escolares_Actualizar(id_ciclo_escolar, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Ciclos_Escolares_Actualizar.php',
			 type: 'POST',
			 data: 'id_Ciclo_Escolar='+id_ciclo_escolar+'&Campo='+campo+'&Valor='+valor,
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
// Función: Ciclos_Escolares_Eliminar
// Parámetros: id_Ciclo_Escolar
// Return: Eliminacion exitosa o no
// Archivo Origen: Ciclos_Escolares.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 08 2016
// ----------------------------------------------

function Ciclos_Escolares_Eliminar(id_ciclo_escolar)
{
	if(confirm("Realmente desea eliminar el Ciclo Escolar"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Ciclos_Escolares_Eliminar.php',
		  type: 'POST',
		  data: 'id_Ciclo_Escolar='+id_ciclo_escolar,
		  success: function(respuesta) {
			alert(respuesta);
			Ciclos_Escolares_Buscar();
		  }	  
		});	
	}
}

//Grupos

// ----------------------------------------------
// Función: Grupos_Buscar
// Parámetros: -
// Return: Tabla de grupos
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 08 2016
// ----------------------------------------------

function Grupos_Buscar()
{	
	$("#div_Grupos").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Servicios_Escolares/Grupos_Buscar.php',
		dataType : 'json',
		colModel : [ {
			display : 'NO.',
			name : 'numero',
			width : 40,			
			align : 'center'			
			},{
				display : 'CICLO ESCOLAR',
				name : 'ciclo_escolar',
				width : 100,
				align : 'left'
			},{
				display : 'GRUPO',
				name : 'grupo',
				width : 100,
				align : 'center'
			},{
				display : 'PROGRAMA ACADÉMICO',
				name : 'carrera',
				width : 250,
				align : 'center'
			},{
				display : 'PLAN DE ESTUDIOS',
				name : 'plan_estudio',
				width : 100,
				align : 'center'
			},{
				display : 'SEMESTRE',
				name : 'semestre',
				width : 70,
				align : 'center'
			},{
				display : 'SALÓN',
				name : 'salon',
				width : 50,
				align : 'center'
			},{
				display : 'OPCIONES',
				name : 'opciones',
				width : 100,
				align : 'center'
			}],
		showToggleBtn: false,
		pagestat: 'Mostrando de {from} hasta {to} de {total} Registros',
		pagetext: 'Pagina',
		outof: 'de',
		colResize:false,
		resizable: false,
		usepager : true,
		title : 'GRUPOS',
		useRp : true,
		width : 900,
		rp : 10,
		query : $('#id_Carrera').val()+","+$('#id_Ciclo_Escolar').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

function Grupos_Ciclos_Escolares(id_carrera)
{
	$.ajax({
		url: '../ajax/Servicios_Escolares/Grupos_Ciclos_Escolares.php',
		 type: 'POST',
		 data: 'id_Carrera='+id_carrera,
		 success: function(respuesta) {
			$('#id_Ciclo_Escolar').html(respuesta);
		  }	  
	});
}

// ----------------------------------------------
// Función: Grupos_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Nuevo Grupo
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 10 2016
// ----------------------------------------------

function Grupos_Nuevo()
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Grupos_Nuevo.php',
	  success: function(respuesta){
		$('#div_Grupos').html(respuesta);		
		
		$('#id_Carrera_Nuevo').change(function(){
			Grupos_Nuevo_Planes_Estudio($(this).val());
		});
		
		$('#id_Plan_Estudio').change(function(){
			Grupos_Nuevo_Semestres($(this).val());
		});
		
		$('#Grupo, #Salon').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('#Btn_Cancelar').click(function(){
			Grupos_Buscar();
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			if($('#id_Carrera_Nuevo').val() != "")
			{
				if($('#id_Plan_Estudio').val() != "")
				{
					if($('#id_Ciclo_Escolar_Nuevo').val() != "")
					{
						if($('#Semestre').val() != "")
						{
							if($('#Grupo').val() != "")
							{
								if($('#Salon').val() != "")
								{
									Grupos_Insertar();
								}
								else
								{
									alert("Debe indicar el Sal\u00F3n");
									$('#Salon').focus();
								}
							}
							else
							{
								alert("Debe indicar el Grupo");
								$('#Grupo').focus();
							}
						}
						else
						{
							alert("Debe seleccionar un Semestre");
							$('#Semestre').focus();
						}
					}
					else
					{
						alert("Debe seleccionar un Ciclo Escolar");
						$('#id_Ciclo_Escolar_Nuevo').focus();
					}
				}
				else
				{
					alert("Debe seleccionar un Plan de Estudio");
					$('#id_Plan_Estudio').focus();
				}
			}
			else
			{
				alert("Debe seleccionar un Programa Acad\u00E9mico");
				$('#id_Carrera_Nuevo').focus();
			}
		});
		
	  }
	});
}

// ----------------------------------------------
// Función: Grupos_Nuevo_Planes_Estudio
// Parámetros: id_Carrera
// Return: Planes de Estudio de la Carrera Seleccionada
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 10 2016
// ----------------------------------------------

function Grupos_Nuevo_Planes_Estudio(id_carrera)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Grupos_Nuevo_Planes_Estudio.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Plan_Estudio').html(respuesta);
		
		Grupos_Nuevo_Ciclos_Escolares(id_carrera);
		
	  }
	});
}

// ----------------------------------------------
// Función: Grupos_Nuevo_Ciclos_Escolares
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 10 2016
// ----------------------------------------------

function Grupos_Nuevo_Ciclos_Escolares(id_carrera)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Grupos_Nuevo_Ciclos_Escolares.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Ciclo_Escolar_Nuevo').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Grupos_Nuevo_Semestres
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 10 2016
// ----------------------------------------------

function Grupos_Nuevo_Semestres(id_plan_estudio)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Grupos_Nuevo_Semestres.php',
	  data: "id_Plan_Estudio="+id_plan_estudio,
	  type: "POST",
	  success: function(respuesta){		  
		$('#Semestre').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Grupos_Insertar
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 10 2016
// ----------------------------------------------

function Grupos_Insertar()
{	
	var datos = $('#Frm_Grupos_Nuevo').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Grupos_Insertar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		Grupos_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Grupos_Datos
// Parámetros: id_grupo
// Return: Datos del Grupo seleccionado
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 11 2016
// ----------------------------------------------

function Grupos_Datos(id_grupo)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Grupos_Datos.php',
	  data: "id_Grupo="+id_grupo,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Grupos').html(respuesta);
		
		$('#Btn_Regresar').click(function(){
			Grupos_Buscar();
		});
		
		$('#id_Carrera_Nuevo').change(function(){
			Grupos_Nuevo_Planes_Estudio($(this).val());
		});
		
		$('#id_Plan_Estudio').change(function(){
			Grupos_Nuevo_Semestres($(this).val());
		});
		
		$('#Grupo, #Salon').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
	  }
	});
}

// ----------------------------------------------
// Función: Grupos_Actualizar
// Parámetros: id_grupo, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 11 2016
// ----------------------------------------------

function Grupos_Actualizar(id_grupo, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Grupos_Actualizar.php',
			 type: 'POST',
			 data: 'id_Grupo='+id_grupo+'&Campo='+campo+'&Valor='+valor,
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
// Función: Grupos_Eliminar
// Parámetros: id_Grupo
// Return: Eliminacion exitosa o no
// Archivo Origen: Grupos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 11 2016
// ----------------------------------------------

function Grupos_Eliminar(id_grupo)
{
	if(confirm("Realmente desea eliminar el Grupo"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Grupos_Eliminar.php',
		  type: 'POST',
		  data: 'id_Grupo='+id_grupo,
		  success: function(respuesta) {
			alert(respuesta);
			Grupos_Buscar();
		  }	  
		});	
	}	
}

//Profesores

// ----------------------------------------------
// Función: Profesores_Buscar
// Parámetros: -
// Return: Tabla de profesores
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 11 2016
// ----------------------------------------------

function Profesores_Buscar(){
	
	$("#div_Profesores").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Servicios_Escolares/Profesores_Buscar.php',
		dataType : 'json',
		colModel : [ {
			display : 'NO.',
			name : 'numero',
			width : 50,			
			align : 'center'			
			},{
				display : 'PROFESOR',
				name : 'nombre',
				width : 500,
				align : 'left'
			},{
				display : 'USUARIO',
				name : 'carrera_tipo',
				width : 100,
				align : 'center'
			},{
				display : 'ESTATUS',
				name : 'estatus',
				width : 100,
				align : 'center'
			},{
				display : 'OPCIONES',
				name : 'estatus',
				width : 90,
				align : 'center'
			}],
		showToggleBtn: false,
		pagestat: 'Mostrando de {from} hasta {to} de {total} Registros',
		pagetext: 'Pagina',
		outof: 'de',
		colResize:false,
		resizable: false,
		usepager : true,
		title : 'PROFESORES',
		useRp : true,
		width : 900,
		rp : 10,
		query : $('#Profesor').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

// ----------------------------------------------
// Función: Profesores_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Nuevo Profesor
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 12 2016
// ----------------------------------------------

function Profesores_Nuevo()
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Profesores_Nuevo.php',
	  success: function(respuesta){
		$('#div_Profesores').html(respuesta);		
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});
		
		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('.fecha_documento').datepicker({
		    changeMonth: true,
		    changeYear: true,			
	     });		
		
		$('#Btn_Cancelar').click(function(){
			Profesores_Buscar();
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			if(Sin_Espacios($('#Nombre').val()) != "")
			{
				if(Sin_Espacios($('#Apellido_Paterno').val()) != "")
				{
					if(Sin_Espacios($('#Apellido_Materno').val()) != "")
					{				
						Profesores_Insertar();
					}
					else
					{
						alert("Debe introducir apellido materno");
						$('#Apellido_Materno').focus();
					}
				}
				else
				{
					alert("Debe introducir un Apellido Paterno");
					$('#Apellido_Paterno').focus();
				}
			}
			else
			{
				alert("Debe introducir un Nombre");
				$('#Nombre').focus();
			}
		});		
	  }
	});
}

// ----------------------------------------------
// Función: Profesores_Insertar
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 14 2016
// ----------------------------------------------

function Profesores_Insertar()
{	
	var datos = $('#Frm_Profesores_Nuevo').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Profesores_Insertar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		Profesores_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Profesores_Datos
// Parámetros: id_profesor
// Return: Datos del Profesor seleccionado
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 14 2016
// ----------------------------------------------

function Profesores_Datos(id_profesor)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Profesores_Datos.php',
	  data: "id_Profesor="+id_profesor,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Profesores').html(respuesta);
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});
		
		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('.fecha_documento').datepicker({
		    changeMonth: true,
		    changeYear: true,			
	     });
		
		$('#Btn_Regresar').click(function(){
			Profesores_Buscar();
		});
	  }
	});
}

// ----------------------------------------------
// Función: Profesores_Actualizar
// Parámetros: id_profesor, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 14 2016
// ----------------------------------------------

function Profesores_Actualizar(id_profesor, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Profesores_Actualizar.php',
			 type: 'POST',
			 data: 'id_Profesor='+id_profesor+'&Campo='+campo+'&Valor='+valor,
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
// Función: Profesores_Carrera_Actualizar
// Parámetros: id_profesor, id_carrera, etiqueta
// Return: true o false
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 24 2016
// ----------------------------------------------

function Profesores_Carrera_Actualizar(id_profesor, id_carrera, etiqueta)
{   
	$('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	if($('#Carrera_'+id_carrera).is(":checked"))
		var activo = 1;
	else
		var activo = 0;
	
	
	$.ajax({
		url: '../ajax/Servicios_Escolares/Profesores_Carrera_Actualizar.php',
		type: 'POST',
		data: 'id_Profesor='+id_profesor+'&id_Carrera='+id_carrera+'&Activo='+activo,
		success: function(respuesta) {
			if(respuesta != 'false')
			{
				$('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Ok.png' width='15px' />");			
			}
		}
	});
	
}


// ----------------------------------------------
// Función: Profesores_Documentacion_Actualizar
// Parámetros: id_profesor_documentacion, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 22 2016
// ----------------------------------------------

function Profesores_Documentacion_Actualizar(id_profesor_documentacion, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n?"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Profesores_Documentacion_Actualizar.php',
			 type: 'POST',
			 data: 'id_Profesor_Documentacion='+id_profesor_documentacion+'&Campo='+campo+'&Valor='+valor,
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
// Función: Profesores_Contacto_Actualizar
// Parámetros: id_profesor_contacto, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Julio, 19 2016
// ----------------------------------------------

function Profesores_Contacto_Actualizar(id_profesor_contacto, id_profesor, campo, valor, etiqueta, tipo_contacto)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n?"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Profesores_Contacto_Actualizar.php',
			 type: 'POST',
			 data: 'id_Profesor_Contacto='+id_profesor_contacto+'&Campo='+campo+'&Valor='+valor+'&id_Profesor='+id_profesor+'&Tipo_Contacto='+tipo_contacto,
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
// Función: Profesores_Eliminar
// Parámetros: id_Profesor
// Return: Eliminacion exitosa o no
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 20 2016
// ----------------------------------------------

function Profesores_Eliminar(id_profesor)
{
	if(confirm("Realmente desea eliminar al Profesor"))
	{
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Profesores_Eliminar.php',
		  type: 'POST',
		  data: 'id_Profesor='+id_profesor,
		  success: function(respuesta) {
			alert(respuesta);
			Profesores_Buscar();
		  }	  
		});	
	}	
}


//Horarios

// ----------------------------------------------
// Función: Horarios_Planes_Estudio_Buscar
// Parámetros: id_carrera
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 14 2016
// ----------------------------------------------

function Horarios_Planes_Estudio_Buscar(id_carrera)
{
    $.ajax({
		url: '../ajax/Servicios_Escolares/Horarios_Planes_Estudio_Buscar.php',
		type: 'POST',
		data: 'id_Carrera='+id_carrera,
		success: function(respuesta) {
			$('#id_Plan_Estudio').html(respuesta);			
			Horarios_Ciclos_Escolares_Buscar(id_carrera);
		}
	});
}

// ----------------------------------------------
// Función: Horarios_Ciclos_Escolares_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 16 2016
// ----------------------------------------------

function Horarios_Ciclos_Escolares_Buscar(id_carrera)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Ciclos_Escolares_Buscar.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Ciclo_Escolar').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Horarios_Semestres_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 16 2016
// ----------------------------------------------

function Horarios_Semestres_Buscar(id_plan_estudio)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Semestres_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio,
	  type: "POST",
	  success: function(respuesta){
		$('#Semestre').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Horarios_Grupos_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Grupos registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 16 2016
// ----------------------------------------------

function Horarios_Grupos_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Grupos_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Grupo').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Horarios_Buscar
// Parámetros: -
// Return: Horarios registrados para el grupo seleccionado
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 16 2016
// ----------------------------------------------

function Horarios_Buscar()
{
	datos = $('#Frm_Horario').serialize();	
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Buscar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		  	$('#div_Horarios').html(respuesta);
			
			//Validaciones
			
			
			$('#Btn_Nuevo_Horario').click(function(){
			    	 Horarios_Nuevo($('#id_Plan_Estudio').val(), $('#id_Grupo').val(), $('#Semestre').val());   
			});
		  }
	});
}

// ----------------------------------------------
// Función: Horarios_Nuevo
// Parámetros: id_Grupo
// Return: Mensaje de registrio exitoso o no
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 17 2016
// ----------------------------------------------

function Horarios_Nuevo(id_plan_estudio, id_grupo, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Nuevo.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Grupo="+id_grupo+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		 $('#div_Horarios').html(respuesta);
		 
		 $('#Btn_Registrar').click(function()
		 {
			 if($('#id_Materia').val() != "")
			 {
				 if($('#id_Profesor').val() != "")
				 {
					 Horarios_Insertar();
				 }
				 else
				 {
					alert("Debe Seleccionar un profesor");
					$('#id_Profesor').focus(); 
				 }
			 }
			 else
			 {
				alert("Debe Seleccionar una materia");
				$('#id_Materia').focus(); 
			 }
		 });
		 
	  }
	});
}

// ----------------------------------------------
// Función: Horarios_Insertar
// Parámetros: -
// Return: Mensaje de registrio exitoso o no
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 17 2016
// ----------------------------------------------

function Horarios_Insertar()
{
	datos = $('#Frm_Horarios_Nuevo').serialize();	
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Insertar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		  alert(respuesta);
		  Horarios_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Horarios_Eliminar
// Parámetros: id_horario
// Return: Eliminación correcta o erronea
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 17 2016
// ----------------------------------------------

function Horarios_Eliminar(id_horario)
{
	if(confirm("Realmente desea eliminar el horario?"))
	{
	
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Horarios_Eliminar.php',
		  data: "id_Horario="+id_horario,
		  type: "POST",
		  success: function(respuesta){
				alert(respuesta);
				Horarios_Buscar();
		  }
		});
	}
}

// ----------------------------------------------
// Función: Horarios_Datos
// Parámetros: id_horario
// Return: Formulario con datos del horario con opcion a modsificacion
// Archivo Origen: Horarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 17 2016
// ----------------------------------------------

function Horarios_Datos(id_horario)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Horarios_Datos.php',
	  data: "id_Horario="+id_horario,
	  type: "POST",
	  success: function(respuesta){
		  $('#div_Horarios').html(respuesta);
		  
		  $('#Btn_Regresar').click(function(){
			Horarios_Buscar();  
	       });
	  }
	});
}

// ----------------------------------------------
// Función: Horarios_Actualizar
// Parámetros: id_horario, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Horartios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 18 2016
// ----------------------------------------------

function Horarios_Actualizar(id_horario, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Horarios_Actualizar.php',
			 type: 'POST',
			 data: 'id_Horario='+id_horario+'&Campo='+campo+'&Valor='+valor,
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

//Alumnos

// ----------------------------------------------
// Función: Alumnos_Buscar
// Parámetros: -
// Return: Tabla de alumnos
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function Alumnos_Buscar(){
	
	$("#div_Alumnos").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Servicios_Escolares/Alumnos_Buscar.php',
		dataType : 'json',
		colModel : [ {
			display : 'NO.',
			name : 'numero',
			width : 50,			
			align : 'center'			
			},{
				display : 'ALUMNO',
				name : 'nombre',
				width : 300,
				align : 'left'
			},{
				display : 'USUARIO',
				name : 'usuario',
				width : 100,
				align : 'center'
			},{
				display : 'PROGRAMAS ACADÉMICOS',
				name : 'programas',
				width : 150,
				align : 'center'
			},{
				display : 'OPCIONES',
				name : 'opciones',
				width : 250,
				align : 'center'
			}],
		showToggleBtn: false,
		pagestat: 'Mostrando de {from} hasta {to} de {total} Registros',
		pagetext: 'Pagina',
		outof: 'de',
		colResize:false,
		resizable: false,
		usepager : true,
		title : 'ALUMNOS',
		useRp : true,
		width : 900,
		rp : 10,
		query : $('#Alumno').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

// ----------------------------------------------
// Función: Alumnos_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Nuevo Profesor
// Archivo Origen: Profesores.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function Alumnos_Nuevo()
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Nuevo.php',
	  success: function(respuesta){
		$('#div_Alumnos').html(respuesta);		
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});
		
		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});

		$('#Btn_Cancelar').click(function(){
			Alumnos_Buscar();
		});
		
		$('#Codigo_Postal').blur(function(){
			Alumnos_Estado_Buscar($(this).val());
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			if(Sin_Espacios($('#Apellido_Paterno').val()) != "")
			{
				if(Sin_Espacios($('#Apellido_Materno').val()) != "")
				{
					if(Sin_Espacios($('#Nombre').val()) != "")
					{
						if(Sin_Espacios($('#id_Codigo_Postal').val()) != "")
						{
							if(Sin_Espacios($('#Calle').val()) != "")
							{
								if(Sin_Espacios($('#Telefono_Casa').val()) != "" || Sin_Espacios($('#Telefono_Celular').val()) != "")
								{
									if(Sin_Espacios($('#Correo_Electronico').val()) != "")
									{
										Alumnos_Insertar();
									}
									else
									{
										alert("Debe introducir un correo electronico");
										$('#Correo_Electronico').focus();
									}
								}
								else
								{
									alert("Debe introducir al menos un telefono");
									$('#Telefono_Casa').focus();
								}
							}
							else
							{
								alert("Debe indicar una Calle");
								$('#Calle').focus();
							}
						}
						else
						{
							alert("Debe seleccionar una Colonia");
							$('#id_Codigo_Postal').focus();
						}
					}
					else
					{
						alert("Debe introducir un Nombre");
						$('#Nombre').focus();
					}
				}
				else
				{
					alert("Debe introducir un Apellido Materno");
					$('#Apellido_Materno').focus();
				}
			}
			else
			{
				alert("Debe introducir un Apellido Paterno");
				$('#Apellido_Paterno').focus();
			}
		});		
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Insertar
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function Alumnos_Insertar()
{	
	var datos = $('#Frm_Alumnos_Nuevo').serialize();
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Insertar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		alert(respuesta);
		Alumnos_Buscar();
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Eliminar
// Parámetros: id_alumno
// Return: Eliminación correcta o erronea
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 21 2016
// ----------------------------------------------

function Alumnos_Eliminar(id_alumno)
{
	if(confirm("Realmente desea eliminar al alumno?"))
	{	
		$.ajax({
		  url: '../ajax/Servicios_Escolares/Alumnos_Eliminar.php',
		  data: "id_Alumno="+id_alumno,
		  type: "POST",
		  success: function(respuesta){
				alert(respuesta);
				Alumnos_Buscar();
		  }
		});
	}
}

// ----------------------------------------------
// Función: Alumnos_Datos
// Parámetros: id_alumno
// Return: Datos del Alumno seleccionado
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function Alumnos_Datos(id_alumno)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Alumnos_Datos.php',
	  data: "id_Alumno="+id_alumno,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Alumnos').html(respuesta);
		
		$('#Codigo_Postal').blur(function(){
			Alumnos_Estado_Buscar($(this).val());
		});
		
		//Sólo letras		
		$('.Solo_Letras').keypress(function(tecla){
			  if(tecla.charCode >= 48 && tecla.charCode <= 57) return false;
		});
		
		//Solo Números
		$('.Solo_Numeros').keypress(function(tecla){
			  if(tecla.charCode < 48 || tecla.charCode > 57) return false;
		});
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('#Btn_Regresar').click(function(){
			Alumnos_Buscar();
		});		
	  }
	});
}

// ----------------------------------------------
// Función: Alumnos_Actualizar
// Parámetros: id_alumno, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 19 2016
// ----------------------------------------------

function Alumnos_Actualizar(id_alumno, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n? Afectar\u00E1 a todos los registros en donde est\u00E9 relacionada"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Alumnos_Actualizar.php',
			 type: 'POST',
			 data: 'id_Alumno='+id_alumno+'&Campo='+campo+'&Valor='+valor,
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
// Función: Alumnos_Contacto_Actualizar
// Parámetros: id_alumno, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Mayo, 22 2016
// ----------------------------------------------

function Alumnos_Contacto_Actualizar(id_alumno_contacto, id_alumno, campo, valor, etiqueta, tipo_contacto)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n?"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "")
	    {	
		    $.ajax({
			 url: '../ajax/Servicios_Escolares/Alumnos_Contacto_Actualizar.php',
			 type: 'POST',
			 data: 'id_Alumno_Contacto='+id_alumno_contacto+'&Campo='+campo+'&Valor='+valor+'&id_Alumno='+id_alumno+'&Tipo_Contacto='+tipo_contacto,
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
// Función: Alumnos_Estado_Buscar
// Parámetros: codigo postal
// Return: Estado al que pertenece el coodigo postal
// Archivo Origen: Alumnos.php
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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
// Autor: Ing. Nancy Flores Torrecilla
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


//Evaluacion_Docente

// ----------------------------------------------
// Función: Evaluacion_Docente_Planes_Estudio_Buscar
// Parámetros: id_carrera
// Return: planes de estudios registrados para la carrera
// Archivo Origen: Evaluacion_Docente.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 16 2016
// ----------------------------------------------

function Evaluacion_Docente_Planes_Estudio_Buscar(id_carrera)
{
    $.ajax({
		url: '../ajax/Servicios_Escolares/Evaluacion_Docente_Planes_Estudio_Buscar.php',
		type: 'POST',
		data: 'id_Carrera='+id_carrera,
		success: function(respuesta) {
			$('#id_Plan_Estudio').html(respuesta);			
			Evaluacion_Docente_Ciclos_Escolares_Buscar(id_carrera);
		}
	});
}

// ----------------------------------------------
// Función: Evaluacion_Docente_Ciclos_Escolares_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Evaluacion_Docente.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 16 2016
// ----------------------------------------------

function Evaluacion_Docente_Ciclos_Escolares_Buscar(id_carrera)
{	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Evaluacion_Docente_Ciclos_Escolares_Buscar.php',
	  data: "id_Carrera="+id_carrera,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Ciclo_Escolar').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Evaluacion_Docente_Semestres_Buscar
// Parámetros: id_Carrera
// Return: Ciclos Escolares para la Carrera Seleccionada
// Archivo Origen: Evaluacion_Docente.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 16 2016
// ----------------------------------------------

function Evaluacion_Docente_Semestres_Buscar(id_plan_estudio)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Evaluacion_Docente_Semestres_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio,
	  type: "POST",
	  success: function(respuesta){
		$('#Semestre').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Evaluacion_Docente_Grupos_Buscar
// Parámetros: id_Plan_Estudio, id_Ciclo_Escolar, Semestre
// Return: Grupos registrados para el plan, ciclo y semestre seleccionado
// Archivo Origen: Evaluacion_Docente.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 16 2016
// ----------------------------------------------

function Evaluacion_Docente_Grupos_Buscar(id_plan_estudio, id_ciclo_escolar, semestre)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Evaluacion_Docente_Grupos_Buscar.php',
	  data: "id_Plan_Estudio="+id_plan_estudio+"&id_Ciclo_Escolar="+id_ciclo_escolar+"&Semestre="+semestre,
	  type: "POST",
	  success: function(respuesta){
		$('#id_Grupo').html(respuesta);
	  }
	});
}

// ----------------------------------------------
// Función: Evaluacion_Docente_Buscar
// Parámetros: -
// Return: Asignaturas y Profesores para el Grupo seleccionado
// Archivo Origen: Evaluacion_Docente.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 16 2016
// ----------------------------------------------

function Evaluacion_Docente_Buscar()
{
	datos = $('#Frm_Evaluacion_Docente').serialize();	
	
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Evaluacion_Docente_Buscar.php',
	  data: datos,
	  type: "POST",
	  success: function(respuesta){
		  	$('#div_Evaluacion_Docente').html(respuesta);
		  }
	});
}

// ----------------------------------------------
// Función: Evaluacion_Docente_Datos
// Parámetros: id_Horario
// Return: Evaluacion_Docente para el grupo seleccionado
// Archivo Origen: Evaluacion_Docente.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 16 2016
// ----------------------------------------------

function Evaluacion_Docente_Datos(id_horario)
{
	$.ajax({
	  url: '../ajax/Servicios_Escolares/Evaluacion_Docente_Datos.php',
	  data: 'id_Horario='+id_horario,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Evaluacion_Docente').html(respuesta);
			
		$('#Btn_Regresar').click(function(){
			Evaluacion_Docente_Buscar();			
		})	
			
	  }
	});
}

// ----------------------------------------------
// Función: Listas_Egresados_Buscar
// Parámetros: -
// Return: Egresados por carrera en formato de excel
// Archivo Origen: Listas_Egresados.php
// Autor: Ing. Julio César Morales Cripín
// Fecha de Actualización: Octubre, 19 2017
// ----------------------------------------------

function Listas_Egresados_Buscar()
{
	datos = $('#Frm_Listas_Egresados').serialize();
	
	$.ajax({
		url: '../ajax/Servicios_Escolares/Listas_Egresados_Buscar.php',
		data: datos,
		type: "POST",
		success: function(respuesta){
			$('#div_Listas_Egresados').html(respuesta);
		}
	});
}
