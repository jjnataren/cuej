// JavaScript Document

function Boleta_Buscar()
	{	
		$.ajax({
			url: '../ajax/Alumno/Boleta_Buscar.php',
			type: 'POST',
			data: 'id_Ciclo_Escolar='+$('#id_Ciclo_Escolar').val(),
			beforeSend: function(objeto){
				$("#Boleta").html('<p align="center">Procesando...<br><img src="../imagenes/Procesando.gif" /></p>');
			},
			success: function(resultado) {
				$("#Boleta").html(resultado);
			}
		});
	}

function Evaluacion_Profesor_Buscar(id_horario, id_grupo, id_materia)
	{
		$.ajax({
			url: '../ajax/Alumno/Evaluacion_Profesor_Buscar.php',
			type: 'POST',
			//data: 'id_Horario='+id_horario,
			data: 'id_Horario='+id_horario+'&id_Grupo='+id_grupo+'&id_Materia='+id_materia,
			beforeSend: function(objeto){
				$("#Evaluacion").html('<p align="center">Procesando...<br><img src="../imagenes/Procesando.gif" /></p>');
			},
			success: function(resultado) {
				$("#Evaluacion").html(resultado);
			},
		});
	}

function Evaluacion_Profesor_Guardar()
	{
		datos=$('#Formulario').serialize();
		
		$.ajax({
			url: '../ajax/Alumno/Evaluacion_Profesor_Guardar.php',
			type: 'POST',
			data: datos,
			success: function(resultado) {
				if (resultado == "true") {
					alert ("Evaluaci\xF3n Registrada");
					//$("#Evaluacion").html('+<p align="center">&nbsp;</p>+');
					Actualizar();
				}else{
					alert(resultado);
				}
			},
		});
	}