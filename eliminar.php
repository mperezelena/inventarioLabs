

<html >
  <head>
    <meta charset="UTF-8">
    <title>Confirmar baja</title>
    
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
 
 $link=Conection();
 $nivelUs=$_GET['nivelUs'];
 $tipo=$_GET["tipo"];
 
?>

<body>
<table class="table-fill">
  <form action="confirmaEliminacion.php?tipo=<?php echo $tipo ?>&nivelUs=<?php echo $nivelUs ?>" method="post">

<?php if($tipo=='pcs') {
  $sql=listarPcBaja(); 
  $result= mysql_query($sql,$link);
?>
 
    <br>
    <br>
    <br>
    <caption><h4>Seleccionar las PC que desee eliminar</h4></caption>
   
 <br>
    <?php  
     while($row = mysql_fetch_array($result)){ 
       $nroInventario=$row['nro_inventario'];
          
       if($nroInventario==NULL) {
       	$nroInventario='-';
       }     
     ?>
     <tr>
       <td> <input type="checkbox" name="idpc[]" value="<?php echo $row['id']; ?>"/><?php echo "N° inv: ".$nroInventario." / Nombre: ".$row['nombre'];?> </td>
       </tr>  
  <?php   }
   }
   
    
 else{ 

   $sql=listarCompBaja($tipo); 
  $result= mysql_query($sql,$link);
?>
   
    <?php  
        
      if($tipo=='disco') { ?>
      
       <br>
      <br>
      <br>
      <caption><h4>Seleccionar los discos que desee eliminar</h4></caption>
       <br>
        <?php
       while($row = mysql_fetch_array($result)){ 
        $cant=$row['cant_baja'];
        while($cant>0) {  ?>
       <tr>
       <td> <input type="checkbox" name="idcomp[]" value="<?php echo $row['id']; ?>"/><?php echo $row['disco_modelo'];?> </td>
       </tr> 
       <?php  
       $cant--; } } }
       
      elseif($tipo=='fuente') { ?>
       <br>
       <br>
       <br>
       <caption><h4>Seleccionar las fuentes que desee eliminar</h4></caption>
       <br>
       <?php
        while($row = mysql_fetch_array($result)){ 
        $cant=$row['cant_baja'];
        while($cant>0) {  ?>
       <tr>
       <td> <input type="checkbox" name="idcomp[]" value="<?php echo $row['id']; ?>"/><?php echo $row['fuente_fabricante']." ".$row['watts']."W";?> </td>
       </tr> 
       <?php 
        $cant--; } } }
       
      elseif($tipo=='monitor') { ?>
       <br>
       <br>
       <br>
      <caption><h4>Seleccionar los monitores que desee eliminar</h4></caption>
       <br>
       <?php
        while($row = mysql_fetch_array($result)){ 
         $cant=$row['cant_baja'];
         while($cant>0) {  ?>
       <tr>
       <td> <input type="checkbox" name="idcomp[]" value="<?php echo $row['id']; ?>"/><?php echo $row['monitor_modelo'];?> </td>
       </tr> 
       <?php 
         $cant--; } } }
       
      elseif($tipo=='mother') { ?>
       <br>
       <br>
       <br>
      <caption><h4>Seleccionar las placas madre que desee eliminar</h4></caption>
       <br>
       <?php
        while($row = mysql_fetch_array($result)){ 
         $cant=$row['cant_baja'];
        while($cant>0) {  ?>
       <tr>
       <td> <input type="checkbox" name="idcomp[]" value="<?php echo $row['id']; ?>"/><?php echo $row['mother_modelo'];?> </td>
       </tr> 
       <?php 
         $cant--; } } }
       
      elseif($tipo=='procesador') { ?>
       <br>
       <br>
       <br>
      <caption><h4>Seleccionar los procesadores que desee eliminar</h4></caption>
       <br>
       <?php
        while($row = mysql_fetch_array($result)){ 
         $cant=$row['cant_baja'];
         while($cant>0) {  ?>
       <tr>
       <td> <input type="checkbox" name="idcomp[]" value="<?php echo $row['id']; ?>"/><?php echo $row['procesador_modelo'];?> </td>
       </tr> 
       <?php 
         $cant--;} } }
         
      elseif($tipo=='ram') { ?>
       <br>
       <br>
       <br>
       <caption><h4>Seleccionar las memorias RAM que desee eliminar</h4></caption>
       <br>
       <?php
        while($row = mysql_fetch_array($result)){ 
         $cant=$row['cant_baja'];
        while($cant>0) {  ?>
       <tr>
       <td> <input type="checkbox" name="idcomp[]" value="<?php echo $row['id']; ?>"/><?php echo strtoupper($row['tipo'])." ".$row['tamanio_mb'];?> </td>
       </tr> 
       <?php 
         $cant--; } } }
       
     
   
 }

 ?>
    
   
    <tr>
     <td> <div align="center"> 
  		      <input name="submit" type="submit" value="Eliminar" class="boton">
     		 </div> </td>
    </tr>
   </form>
</table>
   

   
</body>

</html>