// JavaScript Document

// ----------------------------------------------
// Función: Usuarios_Buscar
// Parámetros: -
// Return: Tabla de usuarios
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 26 2016
// ----------------------------------------------

function Usuarios_Buscar(){	
	
	$("#div_Usuarios").html('<table class="Paginador" style="display: none; " align="center"></table>');
	
	$(".Paginador").flexigrid({		
		url : '../ajax/Administracion/Usuarios_Buscar.php',
		dataType : 'json',
		colModel : [ {
			display : 'NO.',
			name : 'numero',
			width : 50,			
			align : 'center'			
			},{
				display : 'NOMBRE',
				name : 'nombre',
				width : 400,
				align : 'left'
			},{
				display : 'USUARIO',
				name : 'usuario',
				width : 150,
				align : 'center'
			},{
				display : 'ESTATUS',
				name : 'estatus',
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
		title : 'USUARIOS DEL SISTEMA',
		useRp : true,
		rp : 25,
		width : 800,
		query : $('#Nombre').val(), //Valores para la busqueda
		qtype : '', // Campo por el cual se hará la búsqueda
		height : 250
	});	  
}

// ----------------------------------------------
// Función: Usuarios_Nuevo
// Parámetros: -
// Return: Formulario de Registro de Nuevo Usuario
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Nuevo()
{
	$.ajax({
	  url: '../ajax/Administracion/Usuarios_Nuevo.php',
	  success: function(respuesta) {
		$('#div_Usuarios').html(respuesta);
		
		$('input:text').not('#Correo_Electronico, #Usuario, #Password').blur(function(){
			$(this).val($(this).val().toUpperCase());
		});
		
		$('#Btn_Cancelar').click(function(){
			Usuarios_Buscar();
		});
		
		$('#Btn_Nuevo_Registrar').click(function(){
			
			if(Sin_Espacios($('#Titulo').val()) != "")
			{
				if(Sin_Espacios($('#Nombre_Usuario').val()) != "")
				{
					if(Sin_Espacios($('#Apellido_Paterno').val()) != "")
					{
						if(Sin_Espacios($('#Apellido_Materno').val()) != "")
						{
							if(Sin_Espacios($('#Area').val()) != "")
							{
								if(Sin_Espacios($('#Correo_Electronico').val()) != "")
								{
									if(Sin_Espacios($('#Usuario').val()) != "")
									{
										if(Sin_Espacios($('#Password').val()) != "")
										{
											Usuarios_Insertar();
										}
										else
										{
											alert("Debe introducir un Password");
											$('#Password').focus();
										}
									}
									else
									{
										alert("Debe introducir un Nombre de Usuario");
										$('#Usuario').focus();
									}
								}
								else
								{
									alert("Debe introducir un Correo Electr\u00D3nico");
									$('#Correo_Electronico').focus();
								}
							}
							else
							{
								alert("Debe introducir el Area a la que pertenece");
								$('#Area').focus();
							}
						}
						else
						{
							alert("Debe introducir el Apellido Materno");
							$('#Apellido_Materno').focus();
						}
					}
					else
					{
						alert("Debe introducir el Apellido Paterno");
						$('#Apellido_Paterno').focus();
					}
				}
				else
				{
					alert("Debe introducir un Nombre");
					$('#Nombre_Usuario').focus();
				}
			}
			else
			{
				alert("Debe introducir un T\u00EDtulo");
				$('#Titulo').focus();
			}
		});
	  }	  
	});
}


// ----------------------------------------------
// Función: Usuarios_Insertar
// Parámetros: -
// Return: Registro Exitoso o no
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Insertar()
{
	var datos = $('#Frm_Registro').serialize();
	
	$.ajax({
	  url: '../ajax/Administracion/Usuarios_Insertar.php',
	  type: 'POST',
	  data: datos,
	  success: function(respuesta) {
		alert(respuesta);
		Usuarios_Buscar();
	  }	  
	});
}

// ----------------------------------------------
// Función: Usuarios_Datos
// Parámetros: id_usuario
// Return: Datos del Usuario Seleccionado
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Datos(id_usuario)
{
	$.ajax({
	  url: '../ajax/Administracion/Usuarios_Datos.php',
	  type: 'POST',
	  data: 'id_Usuario='+id_usuario,
	  success: function(respuesta) {
		$('#div_Usuarios').html(respuesta);
		
		$('#Btn_Regresar').click(function(){
			Usuarios_Buscar();
		});
		
		$('#Btn_Agregar').click(function(){
			Usuarios_Procesos_Insertar(id_usuario);
		});
		
		$('#id_Area').change(function(){
			Usuarios_Procesos_Buscar($(this).val());	
		})
	  }	  
	});
}

// ----------------------------------------------
// Función: Usuarios_Actualizar
// Parámetros: id_usuario, nombre del campo a actualizar, valor del campo y nombre de la etiqueta donde se mostrará la respuesta
// Return: true o false
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Actualizar(id_usuario, campo, valor, etiqueta)
{
	if(campo == "password" || campo == "usuario")
	{
		if(confirm("Realmente desea actualizar \u00E9sta informaci\u00F3n?"))
		{
			$('#'+etiqueta).html("&nbsp;");
	
			if(Sin_Espacios(valor) != "")
			{	
				$.ajax({
				  url: '../ajax/Administracion/Usuarios_Actualizar.php',
				  type: 'POST',
				  data: 'id_Usuario='+id_usuario+'&Campo='+campo+'&Valor='+valor,
				  success: function(respuesta) {
					  if(respuesta != 'false')
					  {
						$('#'+etiqueta).html("<img src='../imagenes/Ok.png' width='15px' />");			
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
	else
	{
		$('#'+etiqueta).html("&nbsp;");
	
		if(Sin_Espacios(valor) != "")
		{	
			$.ajax({
			  url: '../ajax/Administracion/Usuarios_Actualizar.php',
			  type: 'POST',
			  data: 'id_Usuario='+id_usuario+'&Campo='+campo+'&Valor='+valor,
			  success: function(respuesta) {
				  if(respuesta != 'false')
				  {
					$('#'+etiqueta).html("<img src='../imagenes/Ok.png' width='15px' />");			
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
// Función: Usuarios_Procesos_Buscar
// Parámetros: id_area_sicuej
// Return: Procesos relacionados al area seleccionada
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Procesos_Buscar(id_area)
{
	$.ajax({
	  url: '../ajax/Administracion/Usuarios_Procesos_Buscar.php',
	  type: 'POST',
	  data: 'id_Area='+id_area,
	  success: function(respuesta) {
		$('#id_Proceso').html(respuesta);
	  }	  
	});
}

// ----------------------------------------------
// Función: Usuarios_Procesos_Insertar
// Parámetros: id_area_sicuej
// Return: Procesos relacionados al area seleccionada
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Procesos_Insertar(id_usuario)
{
	if(Sin_Espacios($('#id_Proceso').val()) != "")
	{
		$.ajax({
		  url: '../ajax/Administracion/Usuarios_Procesos_Insertar.php',
		  type: 'POST',
		  data: 'id_Proceso='+$('#id_Proceso').val()+'&id_Usuario='+id_usuario,
		  success: function(respuesta) {
			alert(respuesta);
			Usuarios_Datos(id_usuario);
		  }	  
		});
	}
	else
	{
		alert("Debe seleccionar un proceso");
		$('#id_Proceso').focus();
	}
}

// ----------------------------------------------
// Función: Usuarios_Procesos_Eliminar
// Parámetros: id_permiso y id_usuario
// Return: Mensaje
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Procesos_Eliminar(id_permiso, id_usuario)
{
	if(confirm("Realmente desea eliminar el proceso para el usuario?"))
	{
		$.ajax({
		  url: '../ajax/Administracion/Usuarios_Procesos_Eliminar.php',
		  type: 'POST',
		  data: 'id_Permiso='+id_permiso,
		  success: function(respuesta) {
			alert(respuesta);
			Usuarios_Datos(id_usuario);
		  }	  
		});
	}	
}

// ----------------------------------------------
// Función: Usuarios_Permisos_Actualizar
// Parámetros: id_permiso, campo
// Return: imagen de OK
// Archivo Origen: Usuarios.php
// Autor: Ing. Nancy Flores Torrecilla
// Fecha de Actualización: Abril, 27 2016
// ----------------------------------------------

function Usuarios_Permisos_Actualizar(id_permiso, campo)
{
	if ($("#"+campo+"_"+id_permiso).is(":checked"))
	{
	   var valor = 1;
	}
	else
	{
	   var valor = 0;	
	}
	
	alert(campo+'_'+id_permiso+'='+valor);
	
	$.ajax({
	 url: '../ajax/Administracion/Usuarios_Permisos_Actualizar.php',
	 type: 'POST',
	 data: 'id_Permiso='+id_permiso+'&Campo='+campo+'&Valor='+valor,
	 success: function(respuesta) {
	    if(respuesta != 'false')
		{
		  alert("Actualizado!");
		}
		else
		{
		  alert("No se pudo actualizar el permiso del proceso");
		}
	 }	  
    });
	
}
