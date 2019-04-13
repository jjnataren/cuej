<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>:::... SICUEJ ...:::</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/Funciones.js"></script>
    <script language="javascript">
		
		// Funcion javascript para validar para que no se dejen campos sin llenar
		function validar() 
		{        
			if (Sin_Espacios($('#Login').val())=="")
				{
					alert("Debes introducir un Usuario");
					$('#Login').focus();
					return false;
				}
			else
				{
					$('#Login').val(Sin_Espacios($('#Login').val()));
				}
	 
			if (Sin_Espacios($('#Password').val())=="")
				{
					alert("Debes introducir una Contraseña");
					$('#Password').focus();
					return false;
				}
			else
				{
					$('#Password').val(Sin_Espacios($('#Password').val()));
				}
		}

</script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<img src="imagenes/logo_cuej.png" alt="CUEJ" width="200px" />
		</div>
        <div id="user">
        	
        </div>		
	</div>
	<div id="page">    	
      <div id="content">
        	<h2>&nbsp;</h2>
       		<p>&nbsp;</p>
        	<p>
   				<form name="Formulario" action="Entrar.php" method="post" onSubmit="return validar();">
                    <table width="350" border="0" align="center">
                        <tr align="center">
                        	<td colspan="2"><p><h3>¡Bienvenido!</h3></p>
                       	    <p>Para ingresar introduce los siguientes datos:</p></td>
                        </tr>
                        <tr align="center">
                        	<td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><label>Usuario:</label></td>
                            <td><input type="text" name="Login" id="Login" class="campo"/></td>
                        </tr>
                        <tr>
                            <td><label>Contraseña:</label></td>
                            <td><input type="password" name="Password" id="Password" class="campo"/></td>
                        </tr>
                        <tr>
                        	<td colspan="2" align="center">&nbsp;</td>
                      	</tr>
                        <tr>
                        	<td colspan="2" align="center"><input type="submit" name="Enviar" id="Enviar" value="Ingresar" class="button" /></td>
                      	</tr>
                    </table>
        		</form>
        	</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
	</div>
	<div id="footer">
		<p>Sistema Integral del Centro Universitario de Estudios Jur&iacute;dicos. 2016</p>
	</div>
</div>
</body>
</html>
