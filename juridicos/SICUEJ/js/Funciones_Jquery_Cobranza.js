// JavaScript Document

//Caja

// ----------------------------------------------
// Función: Caja_Alumnos_Becas
// Parámetros: id_alumno_programa
// Return: Información del alumno y opción para buscar becar por ciclo escolar
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 30 2016
// ----------------------------------------------

function Caja_Alumnos_Becas(id_alumno_programa)
{	
	$.ajax({
	  url: '../ajax/Cobranza/Caja_Alumnos_Becas.php',
	  data: "id_Alumno_Programa="+id_alumno_programa,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Alumnos').html(respuesta);
		
		$('#id_Ciclo_Escolar').change(function(){
			Caja_Alumnos_Becas_Buscar(id_alumno_programa,$(this).val());			
		});
	  }
	});
}

// ----------------------------------------------
// Función: Caja_Alumnos_Becas_Buscar
// Parámetros: id_alumno_programa, id_ciclo_escolar
// Return: Datos de las Becas del Ciclo seleccionado con opción a modificacion
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 30 2016
// ----------------------------------------------

function Caja_Alumnos_Becas_Buscar(id_alumno_programa, id_ciclo_escolar)
{	
	$.ajax({
	  url: '../ajax/Cobranza/Caja_Alumnos_Becas_Buscar.php',
	  data: "id_Alumno_Programa="+id_alumno_programa+'&id_Ciclo_Escolar='+id_ciclo_escolar,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Becas').html(respuesta);
	  }
	});
}


// ----------------------------------------------
// Función: Caja_Alumnos_Becas_Actualizar
// Parámetros: id_alumno_beca, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Julio, 01 2016
// ----------------------------------------------

function Caja_Alumnos_Becas_Actualizar(id_alumno_beca, campo, valor, etiqueta)
{
    if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n?"))
    {
	    $('#'+etiqueta).html("&nbsp; &nbsp;<img src='../imagenes/Cargando.gif' width='15px' />");

	    if(Sin_Espacios(valor) != "" || campo == "observaciones")
	    {	
		    $.ajax({
			 url: '../ajax/Cobranza/Caja_Alumnos_Becas_Actualizar.php',
			 type: 'POST',
			 data: 'id_Alumno_Beca='+id_alumno_beca+'&Campo='+campo+'&Valor='+valor,
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
// Función: Caja_Alumnos_Buscar
// Parámetros: -
// Return: Tabla de alumnos
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 26 2016
// ----------------------------------------------

function Caja_Alumnos_Buscar(){
	
	$("#div_Alumnos").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Cobranza/Caja_Alumnos_Buscar.php',
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
				display : 'CLAVE',
				name : 'clave',
				width : 100,
				align : 'center'
			},{
				display : 'PROGRAMA ACADÉMICO',
				name : 'programas',
				width : 250,
				align : 'center'
			},{
				display : 'OPCIONES',
				name : 'opciones',
				width : 150,
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
		rp : 7,
		query : $('#Alumno').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

// ----------------------------------------------
// Función: Caja_Alumnos_Pagos
// Parámetros: id_alumno_programa
// Return: Datos del Alumno seleccionado con opciones de pago
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 26 2016
// ----------------------------------------------

function Caja_Alumnos_Pagos(id_alumno_programa)
{	
	$.ajax({
	  url: '../ajax/Cobranza/Caja_Alumnos_Pagos.php',
	  data: "id_Alumno_Programa="+id_alumno_programa,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Alumnos').html(respuesta);
		
		$('#Concepto').change(function(){
			if($('#id_Ciclo_Escolar').val() != "")
			{
				Caja_Alumnos_Pagos_Concepto_Buscar(id_alumno_programa, $('#id_Ciclo_Escolar').val() , $(this).val());
			}
			else
			{
				alert("Debe Seleccionar un Ciclo Escolar");
				Caja_Alumnos_Pagos(id_alumno_programa);
			}
		});
		
	  }
	});
}

// ----------------------------------------------
// Función: Caja_Alumnos_Pagos_Concepto_Buscar
// Parámetros: id_alumno_programa, id_ciclo_escolar, concepto
// Return: Busqueda del detalle del concepto seleccionado
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Junio, 28 2016
// ----------------------------------------------

function Caja_Alumnos_Pagos_Concepto_Buscar(id_alumno_programa, id_ciclo_escolar, concepto)
{	
	$.ajax({
	  url: '../ajax/Cobranza/Caja_Alumnos_Pagos_Concepto_Buscar.php',
	  data: "id_Alumno_Programa="+id_alumno_programa+'&id_Ciclo_Escolar='+id_ciclo_escolar+'&Concepto='+concepto,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Concepto').html(respuesta);
		
		$('#Btn_Pagar').click(function(){
			Caja_Alumnos_Pagos_Registrar(id_alumno_programa, id_ciclo_escolar, concepto);
		});
		
	  }
	});
}

// ----------------------------------------------
// Función: Caja_Alumnos_Pagos_Registrar
// Parámetros: id_alumno_programa, id_ciclo_escolar, concepto
// Return: Registro del Pago seleccionado
// Archivo Origen: Caja.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Julio, 07 2016
// ----------------------------------------------

function Caja_Alumnos_Pagos_Registrar(id_alumno_programa, id_ciclo_escolar, concepto)
{	
	datos = $('#Frm_Pago').serialize();
	
	$.ajax({
	  url: '../ajax/Cobranza/Caja_Alumnos_Pagos_Registrar.php',
	  data: datos+"&id_Alumno_Programa="+id_alumno_programa,
	  type: "POST",
	  success: function(respuesta){
		$('#div_Concepto').html(respuesta);		
	  }
	});
}