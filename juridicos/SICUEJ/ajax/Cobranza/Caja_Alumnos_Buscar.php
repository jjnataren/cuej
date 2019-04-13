<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Junio, 26 2016]	
	-- País: México
	-- Objetivo: Búsqueda de alumnos por nombre
	-- Última Modificación: [Junio, 26 2016]
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
		$sql_count = "SELECT COUNT(*) FROM alumnos JOIN alumnos_programas USING(id_alumno) WHERE CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre ) LIKE '%".$query."%';";
	else
		$sql_count = "SELECT COUNT(*) FROM alumnos JOIN alumnos_programas USING(id_alumno);";	
	
	// Se obtienen el numero total de registros
	
	$result_count = mysqli_query($conexion,$sql_count);
	$row_count = mysqli_fetch_array($result_count);
	$total = $row_count[0];
	
	// Variables para Paginación
	$pageStart = ($page-1)*$rp; //$page es el numero de página, $rp el número de registros por pagina
	$limitSql = "LIMIT ".$pageStart.",".$rp; // se crea la clausula LIMIT para la consulta SQL
	
	
	if ($query != "")
	{
		$sql = "SELECT * FROM alumnos JOIN alumnos_programas USING(id_alumno) WHERE CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre )  LIKE '%".$query."%' ORDER BY apellido_paterno, apellido_materno, nombre ".$limitSql.";";
		
	}
	else
	{
		$sql = "SELECT * FROM alumnos JOIN alumnos_programas USING(id_alumno) ORDER BY apellido_paterno, apellido_materno, nombre ".$limitSql.";";
		
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
		$sql_carrera = "SELECT carrera FROM carreras JOIN planes_estudio USING(id_carrera) WHERE id_plan_estudio = '".$row["id_plan_estudio"]."';";
		$resultado_carrera = mysqli_query($conexion, $sql_carrera);
		$fila_carrera =mysqli_fetch_array($resultado_carrera);
	
		$i++;
		
		if($_SESSION["Update"] == 1)
			$opciones = "<a href='javascript: Caja_Alumnos_Becas(".$row['id_alumno_programa'].")'>Becas</a>";
		else
			$opciones = "-";
		
		$data['rows'][] = array('cell' => array($i,"<a href='javascript: Caja_Alumnos_Pagos(".$row['id_alumno_programa'].");' >".utf8_encode($row['nombre'].' '.$row["apellido_paterno"].' '.$row["apellido_materno"])."</a>",$row["clave"],utf8_encode($fila_carrera["carrera"]),$opciones));
		
	}
		
	echo json_encode($data);
	
	mysqli_close($conexion);
?>