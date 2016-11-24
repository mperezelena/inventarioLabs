<html >
  <head>
    <meta charset="UTF-8">
    <title> Eliminar incidentes </title>


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
     if($tiempo_transcurrido >= 1200) { 
     //si pasaron 20 minutos o más 
      session_destroy(); // destruyo la sesión 
      $error='expiro';
      header('Location: index.php?error='.$error); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
}*/

?>

  <link rel="stylesheet" href="css/central.css">
  <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
	
</head>

<?php 

 include('encabezado.php');
 include('menu.php');
 $link=Conection();
  $nivelUs=$_GET['nivelUs'];
 $tipo=$_GET["tipo"];
 $nro=$_GET["nro"];
 
?>

<body>
 
<?php
  $sql=selectIncidentes('todos',$tipo,$nro); 
  $result= mysql_query($sql,$link);
?>

<table class="table-fill">
<br>
<br>
<br>
    <caption><h3>Seleccionar los Incidentes que desee eliminar</h3></caption>
  <form action="confirmaElimIncid.php?nivelUs=<?php echo $nivelUs ?>" method="post">
   
   
    <?php  
     while($row = mysql_fetch_array($result)){ ?>
     <tr>
       <td> <input type="checkbox" name="idincid[]" value="<?php echo $row['id']; ?>"/><?php echo $row['nombre'].': '.$row['nombre_incid']; ?> </td>
       </tr>  
  <?php   }
    
    ?>
   
    <tr><td> <div align="center"> 
  			
       		<input name="submit" type="submit" value="Eliminar" class="boton">
     		
     		</div> </tr>
     		
     		</form>
</table>
   

   
</body>

</html>