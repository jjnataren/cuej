<?php
/*
	-- ==============================================================================
	-- Empresa: Centro Universitario de Estudios Jurídicos
	-- Proyecto: Sistema Integral - Administrativo
	-- Autor:  Nancy Flores Torrecilla
	-- Responsable: Nancy Flores Torrecilla
	-- Fecha de Creación: [Mayo, 08 2016]	
	-- País: México
	-- Objetivo: Búsqueda de grupos
	-- Última Modificación: [Mayo, 08 2016]
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
	
	$query_1 = explode(',',$query);
	
	$id_carrera = $query_1[0];
	$id_ciclo_escolar = $query_1[1];
	
	// Consulta para saber el número total de registros
	
	if($id_carrera != "" && $id_carrera != NULL)
		if($id_ciclo_escolar != "" && $id_ciclo_escolar != NULL)
			$sql_count = "SELECT COUNT(*) FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_ciclo_escolar = '".$id_ciclo_escolar."' AND planes_estudio.id_carrera = '".$id_carrera."';";
		else
			$sql_count = "SELECT COUNT(*) FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE planes_estudio.id_carrera = '".$id_carrera."';";
	else
		if($id_ciclo_escolar != "" && $id_ciclo_escolar != NULL)
			$sql_count = "SELECT COUNT(*) FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_ciclo_escolar = '".$id_ciclo_escolar."';";
		else
			$sql_count = "SELECT COUNT(*) FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera);";
	
	// Se obtienen el numero total de registros
	
	$result_count = mysqli_query($conexion,$sql_count);
	$row_count = mysqli_fetch_array($result_count);
	$total = $row_count[0];
	
	// Variables para Paginación
	$pageStart = ($page-1)*$rp; //$page es el numero de página, $rp el número de registros por pagina
	$limitSql = "LIMIT ".$pageStart.",".$rp; // se crea la clausula LIMIT para la consulta SQL
	
	
	if($id_carrera != "" && $id_carrera != NULL)
		if($id_ciclo_escolar != "" && $id_ciclo_escolar != NULL)
			$sql = "SELECT grupos.*, carrera, plan_estudios FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_ciclo_escolar = '".$id_ciclo_escolar."' AND planes_estudio.id_carrera = '".$id_carrera."' ORDER BY id_ciclo_escolar, carrera, semestre DESC;";
		else
			$sql = "SELECT grupos.*, carrera, plan_estudios FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE planes_estudio.id_carrera = '".$id_carrera."' ORDER BY id_ciclo_escolar, semestre DESC;";
	else
		if($id_ciclo_escolar != "" && $id_ciclo_escolar != NULL)
			$sql = "SELECT grupos.*, carrera, plan_estudios FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) WHERE id_ciclo_escolar = '".$id_ciclo_escolar."' ORDER BY id_ciclo_escolar, carrera, semestre DESC;";
		else
			$sql = "SELECT grupos.*, carrera, plan_estudios FROM grupos JOIN planes_estudio USING(id_plan_estudio) JOIN carreras USING(id_carrera) ORDER BY id_ciclo_escolar, carrera, semestre DESC;";
	
	// Return JSON data  Se crea el arreglo de de resultados y se convierte en una cadena JSON
	
	$data = array();
	$data['page'] = $page; // numero de página
	$data['total'] = $total; //total de registros
	$data['rows'] = array(); // arreglo de registros de la consulta
	
	$results = mysqli_query($conexion,$sql);
	
	$i = 0;
	
	//$data['rows'][] = array('cell' => array('','','',$sql,'','','',''));
	
	while ($row = @mysqli_fetch_assoc($results)) 
	{
	
		$sql_ciclo = "SELECT ciclo_escolar FROM ciclos_escolares WHERE id_ciclo_escolar = '".$row["id_ciclo_escolar"]."';";
		$resultado_ciclo = mysqli_query($conexion, $sql_ciclo);
		$fila_ciclo = @mysqli_fetch_array($resultado_ciclo);
	
		$i++;
		
		if($_SESSION["Delete"] == 1)
			$eliminar = "<a href='javascript:Grupos_Eliminar(".$row['id_grupo'].")'>Eliminar</a>";
		else
			$eliminar = "-";
		
		$data['rows'][] = array('cell' => array($i,$fila_ciclo["ciclo_escolar"],"<a href='javascript: Grupos_Datos(".$row['id_grupo'].");' >".utf8_encode($row['grupo'])."</a>",utf8_encode($row['carrera']),$row['plan_estudios'],$row['semestre'],$row['salon'],$eliminar));
		
	}
		
	echo json_encode($data);
	
	mysqli_close($conexion);
?>