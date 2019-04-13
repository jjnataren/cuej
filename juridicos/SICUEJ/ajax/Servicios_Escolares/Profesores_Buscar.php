<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 11 2016]	
	-- País: México
	-- Objetivo: Búsqueda de profesores por nombre
	-- Última Modificación: [Mayo, 11 2016]
	-- Realizó: Nancy Flores Torrecilla
	-- Observaciones: Creación de Archivo
	-- ===============================================================================
*/
	session_start();
	include ("../../php/Funciones.php");
	
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
	
	if($query != "")
		$sql_count = "SELECT COUNT(*) FROM profesores WHERE CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre ) LIKE '%".$query."%';";
	else
		$sql_count = "SELECT COUNT(*) FROM profesores;";	
	
	// Se obtienen el numero total de registros
	
	$result_count = mysqli_query($conexion,$sql_count);
	$row_count = mysqli_fetch_array($result_count);
	$total = $row_count[0];
	
	// Variables para Paginación
	$pageStart = ($page-1)*$rp; //$page es el numero de página, $rp el número de registros por pagina
	$limitSql = "LIMIT ".$pageStart.",".$rp; // se crea la clausula LIMIT para la consulta SQL
	
	
	if ($query != "")
	{
		$sql = "SELECT * FROM profesores WHERE CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre )  LIKE '%".$query."%' ORDER BY apellido_paterno, apellido_materno, nombre ".$limitSql.";";
		
	}
	else
	{
		$sql = "SELECT * FROM profesores ORDER BY apellido_paterno, apellido_materno, nombre ".$limitSql.";";
		
	}
	
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
		
		if($row['estatus'] == 0)
			$estatus = "INACTIVO";
		else
			$estatus = "ACTIVO";
			
		if($_SESSION["Delete"] == 1)
			$eliminar = "<a href='javascript:Profesores_Eliminar(".$row['id_profesor'].")'>Eliminar</a>";
		else
			$eliminar = "-";
		
		$data['rows'][] = array('cell' => array($i,"<a href='javascript: Profesores_Datos(".$row['id_profesor'].");' >".utf8_encode($row['titulo']).' '.utf8_encode($row['nombre'].' '.$row["apellido_paterno"].' '.$row["apellido_materno"])."</a>",utf8_encode($row['usuario']),$estatus,$eliminar));
		
	}
		
	echo json_encode($data);
	
	mysqli_close($conexion);
?>