<!DOCTYPE html>
<html>
<title> Modificar contraseña</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="css/central.css">

 <style type="text/css"> 

  input{
    display: inline;
   
    width: auto;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
}​

</style> 

<?php
	session_cache_limiter('private_no_expire');
//Inicio la sesión 
session_start(); 

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] != "SI") { 
   	//si no existe, envio a la página de autentificacion 
   	header("Location: index.php"); 
   	//ademas salgo de este script 
   	exit(); 
}	
/* else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >=1200) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      $error='expiro';
      header('Location: index.php?error='.$error ); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
}*/

?>


 
 <?php
 include('encabezado.php');
 include('btncerrar.php');
 include('menu.php');
 
  $link=Conection();
  $nivelUs=$_GET['nivelUs'];
  ?>
  <body>
   <form name="form" action="confirmaModifClave.php?nivelUs=<?php echo $nivelUs ?>" method="post">
    <table class="table-fill">
    <br>
    <br>
    <br>
    <br>
    <caption><h3>Cambiar contraseña</h3></caption>
    <tr>
     <td> <h4> Ingrese la contraseña actual: </h4></td>
     
     <td>
      <input type="password" name="actual" id="actual" size="20">
      </td>
 
    </tr>
    
 
    <tr>
     <td> <h4> Ingrese la nueva contraseña: </h4></td>
    <td>
     <input type="password" name="clave1" id="clave1" size="20">
    </td>
   </tr>
   
  <tr>
     <td> <h4> Repita la nueva contraseña: </h4></td>
    <td>
     <input type="password" name="clave2" id="clave2" size="20" >
    </td>
   </tr>
        </table>
   <br>
   <br>
 	     <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Confirmar nueva contraseña" class="boton">
     		
     		</div>
 </form>
 </body>
</html>
 