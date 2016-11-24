<!DOCTYPE html>

<html >
  <head>
    <meta charset="UTF-8">
    <title>Baja</title>
  
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
 //else { 
    //sino, calculamos el tiempo transcurrido 
 //   $fechaGuardada = $_SESSION["ultimoAcceso"]; 
   // $ahora = date("Y-n-j H:i:s"); 
   // $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
    // if($tiempo_transcurrido >= 1200) { 
     //si pasaron 10 minutos o más 
    //  session_destroy(); // destruyo la sesión 
     // $error='expiro';
    //  header('Location: index.php?error='.$error); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
   // }else { 
   // $_SESSION["ultimoAcceso"] = $ahora; 
   //} 
//}

?>
      <link rel="stylesheet" href="css/tabla.css">
    <html lang="en">

	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">




<?php

 include('encabezado.php');
 include('btncerrar.php');
 include('menu.php');
 
 $link=Conection();
 
 $tipo=$_GET["tipo"];
 $nivelUs=$_GET['nivelUs'];  


  if($tipo=='pcs') {
    $sql=listarPcBaja(); //listas PCs para baja
    $result= mysql_query($sql,$link);
 }
  else {
    $sql=listarCompBaja($tipo); //listar componentes para baja
    $result= mysql_query($sql,$link);
  }
    
   $filas=mysql_num_rows($result); 
  ?>

  <body >

  <!-- Boton Eliminar PC o Componente -->
   <?php
   if($filas!=0) {
   		
 		if($nivelUs==1) { ?>
 		   <div align="center"> 
  			<form action="eliminar.php?tipo=<?php echo $tipo;?>&nivelUs=<?php echo $nivelUs ?>" method="post" style="display:inline"  >
  			  <?php if($tipo=='pcs') {?>
  		
       		 <input name="boton1" type="submit" value="Eliminar PC" class="boton1" title="Confirmar baja definitiva de PC"  > 

       		<?php } 
       		 else {?>
       		  <input name="boton1" type="submit" value="Eliminar componentes" class="boton1" title="Confirmar baja definitiva de componente">
       		<?php } ?>
     		</form>
 		</div>
   <?php }  }?>
   


 <table class="table-fill2">


<?php 
 if($tipo=='pcs') {
 	
?>
<caption><h3> PCs para baja </h3></caption>
 <thead>
 <tr>
  <th>Nombre PC</th>
  <th>Nro. inventario</th>
 </tr>
 </thead>
 
<tbody class="table-hover">

  <?php
 /* Inserto en la tabla todas las filas de la consulta SELECT */
  while($row = mysql_fetch_array($result)){
  	echo  "<tr><td>" .$row["nombre"]  . "</td>";
   echo "<td>" . $row["nro_inventario"] . "</td></tr>";
 }
 }
 
 elseif($tipo=='disco' || $tipo=='monitor' || $tipo=='mother' || $tipo=='procesador') { 
    if($tipo=='disco') {?>
    <caption><h3> Discos para baja </h3></caption>
    <?php  } elseif($tipo=='monitor') {?>
     <caption><h3> Monitores para baja </h3></caption>
     <?php } elseif($tipo=='mother') {?>
     <caption><h3> Placas madre para baja </h3></caption>
     <?php } elseif($tipo=='procesador') {?>
     <caption><h3> Microprocesadores para baja </h3></caption>
     <?php } ?>
 <thead>
 <tr>
  <th> Modelo </th>
  <th>Cantidad para baja</th>
 </tr>
 </thead>
 
<tbody class="table-hover">

  <?php
 /* Inserto en la tabla todas las filas de la consulta SELECT */
  while($row = mysql_fetch_array($result)){
  	echo  "<tr><td>" .$row[$tipo.'_'."modelo"]  . "</td>";
   echo "<td>" . $row["cant_baja"] . "</td></tr>";
 }
  }
  
   elseif($tipo=='fuente') { ?>
 <caption><h3> Fuentes para baja </h3></caption>
 
 <thead>
 <tr>
  <th> Fabricante </th>
  <th> Watts </th>
  <th>Cantidad para baja</th>
 </tr>
 </thead>
 
<tbody class="table-hover">

  <?php
 /* Inserto en la tabla todas las filas de la consulta SELECT */
  while($row = mysql_fetch_array($result)){
  	echo  "<tr><td>" .$row["fuente_fabricante"]  . "</td>";
  	echo  "<td>" .$row["watts"]  . "</td>";
   echo "<td>" . $row["cant_baja"] . "</td></tr>";
 }
  }
  

  
   elseif($tipo=='ram') { ?>
 <caption><h3> Memorias RAM para baja </h3></caption>
 <thead>
 <tr>
  <th>Tipo</th>
  <th>Capacidad (Mb)</th>
  <th>Cantidad para baja</th>
 </tr>
 </thead>
 
<tbody class="table-hover">

  <?php
 /* Inserto en la tabla todas las filas de la consulta SELECT */
  while($row = mysql_fetch_array($result)){
  	echo  "<tr><td>" .$row["tipo"]  . "</td>";
  	echo  "<td>" .$row["tamanio_mb"]  . "</td>";
   echo "<td>" . $row["cant_baja"] . "</td></tr>";
 }
  }
  
  
?>

  </tbody>


 
 </table>

 
   
 </body>
 </html>
   