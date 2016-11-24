<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> Confirma modificar incidente</title>
    
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
  $idIncidente=$_GET['idIncidente'];
  $idPc=$_GET['idPc'];
  
  $checkNombre=$_POST['checkNombre'];
  $checkDetalle=$_POST['checkDetalle'];
  $checkFechaFin=$_POST['checkFechaFin'];
  
  $pcBaja=$_POST['bajaPc'];
  
  $componentesBaja=$_POST['lista_componentes'];
  $countComp=count($componentesBaja);
  
  $ramBaja=$_POST['lista_ram'];
  $countRam=count($ramBaja);
  ?>
  
<body onload="javascript:mostrarVentana();">
 
 <div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">
 
 <?php
 ////// Nombre

   if($checkNombre=='on') {
     $nombre=$_POST['nombreIncid'];
	  $sql=modificarNombreIncid($idIncidente,$nombre); 
	  $cambiaNombre=mysql_query($sql, $link);  
       if(!$cambiaNombre) {
       	 ?>
      	<h3> El nombre del incidente no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
 
   
  ///// Detalle
   if($checkDetalle=='on') {
     $detalle=$_POST['detalleIncid'];
     $sql=modificarDetalle($idIncidente,$detalle); 
     $cambiaDetalle=mysql_query($sql, $link);  
       if(!$cambiaDetalle) {
       	 ?>
      	<h3> El detalle del incidente no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
     ///// Fecha fin
   if($checkFechaFin=='on') {
     $fechaFin=$_POST['fechaFin'];
     $sql=modificarFecha($idIncidente,$fechaFin); 
     $cambiaFecha=mysql_query($sql, $link);  
       if(!$cambiaFecha) {
       	 ?>
      	<h3> La fecha de finalización del incidente no pudo ser modificada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
   ///// Dar de baja componentes
   if($bajaPc=='on') {
    $sql=bajaPc($idPc);
    $result= mysql_query($sql,$link);
    mysql_free_result($result);
   }
    
    ///// Dar de baja componentes
  if($countComp>0) {
  for ($i = 0; $i < $countComp; $i++) {
 	$componente=$componentesBaja[$i];
 	if($componente=='Disco') {
     $sql1=discoPc($idPc);      //obtengo el id del disco de esa PC
     $result= mysql_query($sql1,$link);
     $idDisco=mysql_result($result,0,id);	
     $sql2=bajaDisco($idDisco);  //incremento la cant_baja de ese disco en la tabla disco
     $bajaDisco=mysql_query($sql2, $link);
     mysql_free_result($result);
    }
    
    elseif($componente=='Fuente') {
     $sql1=fuentePc($idPc); //obtengo el id de la fuente de esa PC
     $result= mysql_query($sql1,$link);
     $idFuente=mysql_result($result,0,id);	
     $sql2=bajaFuente($idFuente);  //incremento la cant_baja de esa fuente en la tabla fuente
     $bajaFuente=mysql_query($sql2, $link);
     mysql_free_result($result);
    }
    
    elseif($componente=='Monitor') {
     $sql1=monitorPc($idPc);  //obtengo el id del monitor de esa PC
     $result= mysql_query($sql1,$link);
     $idMonitor=mysql_result($result,0,id);	
     $sql2=bajaMonitor($idMonitor);  //incremento la cant_baja de ese monitor en la tabla monitor
     $bajaMonitor=mysql_query($sql2, $link);
     mysql_free_result($result);
    }
    
    elseif($componente=='Microprocesador') {
     $sql1=procesadorPc($idPc); //obtengo el id del micro de esa PC
     $result= mysql_query($sql1,$link);
     $idFuente=mysql_result($result,0,id);	
     $sql2=bajaProcesador($idFuente);  //incremento la cant_baja de ese micro en la tabla microprocesador
     $bajaFuente=mysql_query($sql2, $link);
     mysql_free_result($result);
    }
    
    elseif($componente=='Placa madre') {
     $sql1=motherPc($idPc); //obtengo el id de la mother de esa PC
     $result= mysql_query($sql1,$link);
     $idFuente=mysql_result($result,0,id);	
     $sql2=bajaMother($idFuente);  //incremento la cant_baja de esa mother en la tabla mother
     $bajaFuente=mysql_query($sql2, $link);
     mysql_free_result($result);
    }
 }
 }

 	 ///// Dar de baja ram
  if($countRam>0) {
   for ($i = 0; $i < $countRam; $i++) {
    $idRam=$ramBaja[$i];
 	 $sql2=bajaRam($idRam);  //incremento la cant_baja de esa ram en la tabla ram
    $bajaRam=mysql_query($sql2, $link);
    mysql_free_result($result);
 }
 }
 
   
    
   $estado=incidente;
   $sql=cambiarEstadoPc($estado,$idPc,$idIncidente); 
   $cambiaEstado=mysql_query($sql, $link); 

        mysql_close($link);
        
    ?>
       <h3>Las modificaciones se realizaron correctamente</h3>
     	 <form action="incidentes.php?estado=pendiente&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Ir a incidentes" />
			</div>
		</form>  
    
  </body>
  </html>