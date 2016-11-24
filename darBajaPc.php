

<html>
  <head>
    <meta charset="UTF-8">

    
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
 include('btncerrar.php');
 include('menu.php');
 
  $idPc=$_POST['lista_pc'];
  $link=Conection();
  $nivelUs=$_GET['nivelUs'];
  $sql=nombrePc($idPc);
  $result= mysql_query($sql,$link);
  $nombrePc=mysql_result($result,0); //obtengo el nombre de la PC para mostrarlo en el título
  ?>

<title> Dar de baja PC <?php echo $nombrePc ?>  </title>
<body>

 

 <br>
<!--  /********   Componentes *********/ --> 
         
    <form action="confirmaBajaPc.php?idPc=<?php echo $idPc ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
    <table class="table-fill">
      <br>
    <br>
    <br>
    <caption><h3> Dar de baja PC <i><?php echo $nombrePc ?> </i> </h3>
     <br>
         <h5> Seleccione los componentes que desee dar de baja (opcional)</h5>
    </caption>
  
    <?php  
     $componentes = array("Disco", "Fuente", "Monitor", "Microprocesador", "Placa madre");
     $count = count($componentes);
     for ($i = 0; $i < $count; $i++) {
  
     ?>
       <tr>
     <td>
        <input type="checkbox"  name="lista_componentes[]" value="<?php echo $componentes[$i]; ?>"  /><?php echo $componentes[$i]; ?> 
       </td>
       </tr>  
     

  <?php  
   }
    ?>
    
          <!-- *****************    RAM  **************** -->

   <?php
    $sql=ramPc($idPc); //Obtener los módulos ram de esa pc
    $result= mysql_query($sql,$link);
  ?>
 
   <?php  
    
     while($row = mysql_fetch_array($result)){ 
      $cant=$row['cantidad'];
      while($cant>0) {     
     ?>
      <tr>
     <td>

        <input type="checkbox"  name="lista_ram[]" value="<?php echo $row['id']; ?>"  /><?php echo "RAM: 1x ".$row['tamanio_mb']; ?> 
       </td>  
       </tr>
  <?php  
   $cant--;
     }   
    }
      mysql_free_result($result);
        mysql_close($link);
    ?>
    
   
   </table>
   
        <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Confirmar" class="boton">
     		
     		</div>
     		</form>
     		
 	</body>
 </html>