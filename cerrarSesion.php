<!DOCTYPE html>

<html >
  <head>

	
	<?php
session_cache_limiter('private_no_expire');
//Inicio la sesión 
session_start(); 

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] == "SI") { 
   	//si no existe, envio a la página de autentificacion 
   	session_unset();

   	session_destroy();
   	header("Location: index.php"); 
   	//ademas salgo de este script 
   	exit(); 
}	
?>
</head>

</html>