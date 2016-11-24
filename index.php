<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta name="keywords" content="" />
<meta name="description" content="" /> -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Inventario UOSI - FICH</title>
<link href="css/autenticacion.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<?php

$error=$_GET['error'];

?>
<script type="text/javascript">
document.getElementById('form_login').autocomplete = 'off'; 
</script>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">Inventario UOSI - FICH</a></h1>			
		</div>
	</div>

	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			
		<div style="clear: both;">&nbsp;</div>
		<div style="clear: both;">&nbsp;</div>
		<div style="clear: both;">&nbsp;</div>
		
		<!-- end #content -->

			<ul>
				
					<div id="search" >
					<form id="form_login" method="post" action="autenticacion.php" >
						<div>
					      <table>
				
							<tr><td>Nombre de usuario:</td><td><input type="text" name="usuario" /></td>
							<?php if($error=='usuario') { ?> <td> <font color='red'> Nombre de usuario incorrecto </font> </td> <?php } ?> </tr>
                     <tr><td>Contraseña:</td><td><input type="password" name="clave" /></td>
                     <?php if($error=='clave') { ?> <td> <font color='red'> Clave incorrecta  </font> </td> <?php } ?> </tr>
                     <tr></tr> <tr></tr> 
							<tr><td/><td><input type="submit" id="search-submit" value="Iniciar sesión"/></td></tr>
                  </table>
						</div>
					</form>
					</div>
					
		  </ul>
  
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
			<?php if($error=='expiro') {
                ?>   <div align='right'> <font color='red'>  <?php echo 'La sesión ha expirado. Por favor ingrese nuevamente';	}				
						?> </font> </div>
	</div>
	</div>
	</div>
	<!-- end #page -->
</div>
</div>
</body>
</html>
