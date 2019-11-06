<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Jesus Nataren
	-- Responsable: Jesus Nataren
	-- Fecha de Creación: [Abril, 14 2019]
	-- País: México
	-- Objetivo: Búsqueda de alumnos por nombre
	-- Última Modificación: [Abril, 14 2019]
	-- Realizó: Jesus Nataren
	-- Observaciones: Version inicial
	-- ===============================================================================
*/
	session_start();
	include ("../../php/Funciones.php");


	$id_usuario =  $_SESSION["id_Usuario"];

	$page = 1;	// Página inicial
	$qtype = '';	// Inicialización de la variable (Busqueda por Apellido Paterno o Cuenta)
	$query = '';	// Inicialización de la variable (Valor que se busca)

	//escape de caracteres especiales para mysql

	if (isset($_POST['page']))	$page = mysqli_real_escape_string($conexion, $_POST['page']);
	if (isset($_POST['sortname']))	$sortname = mysqli_real_escape_string($conexion,$_POST['sortname']);
	if (isset($_POST['sortorder']))	$sortorder = mysqli_real_escape_string($conexion,$_POST['sortorder']);
	if (isset($_POST['qtype'])) $qtype = mysqli_real_escape_string($conexion,$_POST['qtype']);
	if (isset($_POST['query']))	$query = mysqli_real_escape_string($conexion,$_POST['query']);
	if (isset($_POST['rp'])) $rp = mysqli_real_escape_string($conexion,$_POST['rp']);

	// Consulta para saber el número total de registros


		$sql_count = "SELECT COUNT(*) FROM captacion WHERE id_empleado = $id_usuario;";


	// Se obtienen el numero total de registros

	$result_count = mysqli_query($conexion,$sql_count);
	$row_count = mysqli_fetch_array($result_count);
	$total = $row_count[0];

	// Variables para Paginación
	$pageStart = ($page-1)*$rp; //$page es el numero de página, $rp el número de registros por pagina
	$limitSql = "LIMIT ".$pageStart.",".$rp; // se crea la clausula LIMIT para la consulta SQL


	$sql = "SELECT cap.*,
                    (Select car.carrera from carreras car
                            where car.id_carrera =  cap.id_topico_interes limit 1) as carrera
                                FROM captacion cap where id_empleado = $id_usuario  ".$limitSql.";";


	// Return JSON data  Se crea el arreglo de de resultados y se convierte en una cadena JSON

	$data = array();
	$data['page'] = $page; // numero de página
	$data['total'] = $total; //total de registros
	$data['rows'] = array(); // arreglo de registros de la consulta

	$results = mysqli_query($conexion,$sql);

	$i = 0;

	while ($row = @mysqli_fetch_assoc($results))
	{
		$i++;

		if($_SESSION["Delete"] == 1)
			$eliminar = "<a href='javascript: Alumnos_Eliminar(".$row['id'].")'>Eliminar</a> | <a href='javascript: Alumnos_Academico(".$row['id'].")'>Acad&eacute;mico</a>";
		else
			$eliminar = "-";






		$data['rows'][] = array('cell' =>
		    array($i,"<a href='javascript: Alumnos_Datos(".$row['id'].");' >". $row['id'] ."</a>",
		        $row["captacion_fecha_alta"],
		        $row["cliente_nombre"],
		        $row["cliente_correo_electronico"],
		        $row["cliente_telefono"],
		        $row["medio_contacto"],
		        $row["carrera"],
		        $row["pais"],
		        $row["estado"],
		        $row["carrera"],
		        $eliminar)  );

	}

	echo json_encode($data);

	mysqli_close($conexion);
?>