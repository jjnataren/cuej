</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<img src="../imagenes/logo_cuej.png" alt="CUEJ" width="200px" />
		</div>
        <div id="user">
        	<table border="0" width="100%">
            	<tr>
                	<td><img src="../imagenes/usuario.png" alt="SIUP" width="120px"/></td>
					<td><?php echo htmlentities($_SESSION["Nombre"].' '.$_SESSION["Apellido_Paterno"].' '.$_SESSION["Apellido_Materno"]); ?><br /><a href="../php/Salir.php">Salir</a></td>
                    
                </tr>
            </table>       	
        </div>		
	</div>
	<div id="page">
    	<ul id="navmenu">
			<li>
				<a href="../impresiones/Alumno/Horario_Ordinario_PDF.php" target="_blank">Horario</a>
            </li>
			<li>
				<a href="../Alumno/Boleta.php">Boleta</a>
            </li>
			<li>
				<a href="../Alumno/Historial_Academico.php">Historial Acad&eacute;mico</a>
            </li>
			<li>
				<a href="../Alumno/Evaluacion_Profesor.php">Evaluaci&oacute;n de Profesores</a>
            </li>
			
		</ul>
		<div id="content">
			<p>&nbsp;</p>
			<div id="Contenido">