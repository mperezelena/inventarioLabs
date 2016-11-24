<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> Confirmar eliminación </title>
    
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
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      $error='expiro';
      header('Location: index.php?error='.$error); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
}*/
?>
      <link rel="stylesheet" href="css/modal.css">
 

	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
	
	<script type="text/javascript">
	function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.marginTop = "200px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
    ventana.style.marginLeft = ((document.body.clientWidth-350) / 2) +  "px"; // Definimos su posición horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
    
}

</script>

</head>

<?php 

  include('encabezado.php');
  include('btncerrar.php');
  include('menu.php');
  
  $link=Conection();
  $nivelUs=$_GET['nivelUs'];
  $tipo=$_GET['tipo']; //obtiene el tipo a eliminar: pc o componente
  
  if($tipo=='pcs') {
   $idpc=$_POST["idpc"]; //obtengo un array con los valores seleccionados en el checkbox
   $count = count($idpc); }
  else {
   $idcomp=$_POST["idcomp"]; //obtengo un array con los valores seleccionados en el checkbox
   $count = count($idcomp); }

?>

<body onload="javascript:mostrarVentana();">
 
 <div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">
 
  <?php 
   for ($i = 0; $i < $count; $i++) {
   	if($tipo=='pcs') {
        $id=$idpc[$i];
        $sql=eliminarPcId($id);
        $eliminaPc=mysql_query($sql, $link);          
        
        
        if(!$eliminaPc) { 
           $sql2=nombrePc($id);
           $result=mysql_query($sql2, $link);
           $nombre=mysql_result($result,0);
        ?>
      <h3>La PC <?php echo $nombre ?> no pudo ser eliminada. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       }   
       
     else {
     	 $id=$idcomp[$i];
       
       if($tipo=='disco') {
         $sql=eliminarDisco($id);
         $eliminaDisco=mysql_query($sql, $link);          
              
         if(!$eliminaDisco) { 
        ?>
      <h3>No pudieron eliminarse todos los discos seleccionados. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       }  
       
      if($tipo=='fuente') {
         $sql=eliminarFuente($id);
         $eliminaFuente=mysql_query($sql, $link);          
              
         if(!$eliminaFuente) { 
        ?>
      <h3>No pudieron eliminarse todos las fuentes seleccionadas. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       } 
       
      if($tipo=='monitor') {
         $sql=eliminarMonitor($id);
         $eliminaMonitor=mysql_query($sql, $link);          
              
         if(!$eliminaMonitor) { 
        ?>
      <h3>No pudieron eliminarse todos los monitores seleccionados. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       } 
       
      if($tipo=='mother') {
         $sql=eliminarMother($id);
         $eliminaMother=mysql_query($sql, $link);          
              
         if(!$eliminaMother) { 
        ?>
      <h3>No pudieron eliminarse todas las placas madre selecionadas. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       } 
       
      if($tipo=='procesador') {
         $sql=eliminarProcesador($id);
         $eliminaProcesador=mysql_query($sql, $link);          
              
         if(!$eliminaProcesador) { 
        ?>
      <h3>No pudieron eliminarse todos los microprocesadores seleccionados. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       } 
       
       if($tipo=='ram') {
         $sql=eliminarRam($id);
         $eliminaRam=mysql_query($sql, $link);          
              
         if(!$eliminaRam) { 
        ?>
      <h3>No pudieron eliminarse todos las memorias RAM seleccionadas. <br> Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
       } 
     
     } 
  }   
    ?>
    
    <h3>La eliminación se realizó correctamente</h3>
     	 <form action="baja.php?tipo=<?php echo $tipo ?>&nro=0&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
   

</body>
</html>
