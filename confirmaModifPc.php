<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> Confirma modificar PC </title>
 
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
    
  $idPc=$_GET['idPc'];
$checkNombre=$_POST['checkNombre'];
$checkInventario=$_POST['checkInventario'];
$checkLab=$_POST['checkLab'];
$checkOfi=$_POST['checkOfi'];
$checkDisco=$_POST['checkDisco'];
$checkFuente=$_POST['checkFuente'];
$checkMother=$_POST['checkMother'];
$checkMonitor=$_POST['checkMonitor'];
$checkProcesador=$_POST['checkProcesador'];
$checkRam1=$_POST['checkRam1'];
$checkRam2=$_POST['checkRam2'];
$ramElim=$_POST['lista_ramElim'];
$countRam=count($ramElim);

$checkSo1=$_POST['checkSo1'];
$checkSo2=$_POST['checkSo2'];
$checkRed=$_POST['checkRed'];
?>


<body onload="javascript:mostrarVentana();">
 
 <div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">
 
 <?php
 ////// Nombre

   if($checkNombre=='on') {
     $nombre=$_POST['nombrePc'];
     $sql=modificarNombrePc($idPc,$nombre); 
     $cambiaNombre=mysql_query($sql, $link);  
       if(!$cambiaNombre) {
       	 ?>
      	<h3> El nombre de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
 
   
  ///// Inventario 
   if($checkInventario=='on') {
     $nroInventario=$_POST['nroInventario'];
     $sql=modificarNroInvent($idPc,$nroInventario); 
     $cambiaInventario=mysql_query($sql, $link);  
       if(!$cambiaInventario) {
       	 ?>
      	<h3> El número de inventario de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
    
   ////// Laboratorio
   if($checkLab=='on') {
     $laboratorio=$_POST['lista_lab'];
     $sql=modificarLabPc($idPc,$laboratorio); 
     $cambiaLab=mysql_query($sql, $link);  
       if(!$cambiaLab) {
       	 ?>
      	<h3> El laboratorio de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
    ////// Oficina
   if($checkOfi=='on') {
     $oficina=$_POST['lista_ofi'];
     $sql=modificarOfiPc($idPc,$oficina); 
     $cambiaOfi=mysql_query($sql, $link);  
       if(!$cambiaOfi) {
       	 ?>
      	<h3> La oficina de la PC no pudo ser modificada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
  ///// Disco
  if($checkDisco=='on') {
    $idDisco=$_POST['lista_disco'];
    $sql=modificarDisco($idPc,$idDisco); 
    $cambiaDisco=mysql_query($sql, $link);  
       if(!$cambiaDisco) {
       	 ?>
      	<h3> El disco de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
  ///// Fuente
  if($checkFuente=='on') {
    $idFuente=$_POST['lista_fuente'];
    $sql=modificarFuente($idPc,$idFuente); 
    $cambiaFuente=mysql_query($sql, $link);  
       if(!$cambiaFuente) {
       	 ?>
      	<h3> La fuente de la PC no pudo ser modificada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
  ///// Monitor
  if($checkMonitor=='on') {
    $idMonitor=$_POST['lista_mon'];
    $sql=modificarMonitor($idPc,$idMonitor); 
    $cambiaMonitor=mysql_query($sql, $link);  
       if(!$cambiaMonitor) {
       	 ?>
      	<h3> El monitor de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
   ///// Mother
  if($checkMother=='on') {
    $idMother=$_POST['lista_mother'];
    $sql=modificarMother($idPc,$idMother); 
    $cambiaMother=mysql_query($sql, $link);  
       if(!$cambiaMother) {
       	 ?>
      	<h3> La mother de la PC no pudo ser modificada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
  ///// Procesador
  if($checkProcesador=='on') {
    $idProcesador=$_POST['lista_proc'];
    $sql=modificarProcesador($idPc,$idProcesador); 
    
    $cambiaProcesador=mysql_query($sql, $link);  
       if(!$cambiaProcesador) {
       	 ?>
      	<h3> El procesador de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
      ///// RAM: eliminar
 for ($i = 0; $i < $countRam; $i++) {
 	$idRam=$ramElim[$i];
 	$sql=decrementarRamPc($idPc,$idRam);
   $eliminaRam=mysql_query($sql, $link);
      if(!$eliminaRam) {
       	 ?>
      	<h3> La RAM de la PC no pudo ser modificada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
 ///// RAM: insertar
  if($checkRam1=='on') {
    $idRam1=$_POST['lista_ram1'];
    $cantidad1=$_POST['cantidad1'];
   
   // while($cantidad1>0) {
     $sql1=insertarRamPcId($idRam1,$idPc,$cantidad1); //insertar ram en pc_ram por id de pc
     $insertaRam1=mysql_query($sql1, $link);
    // --$cantRam1;    
     
      if(!$insertaRam1) {
       	 ?>
      	<h3> La nueva RAM no pudo ser agregada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
       
    //}
  } 
  
   if($checkRam2=='on') {
    $idRam2=$_POST['lista_ram2'];
    $cantidad2=$_POST['cantidad2'];
    while($cantidad2>0) {
     $sql1=insertarRamPc($idRam2,$idPc);
     $insertaRam2=mysql_query($sql2, $link);
     --$cantRam2;
     
      if(!$insertaRam2) {
       	 ?>
      	<h3> La nueva RAM no pudo ser agregada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}    
    }
  } 
  
      

  
    ///// Sistemas operativos
  if($checkSo1=='on') {
    $idSo=$_POST['lista_so1']; //id del nuevo SO
    $primerSo=$_POST['soAnterior1'];   //obtengo el id del primer SO a reemplazar  
    
    $sql2=modificarSO($idPc,$idSo,$primerSo); 
    $cambiaSo=mysql_query($sql2, $link);  
       if(!$cambiaSo) {
       	 ?>
       	 <h3> El primer sistema operativo de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
   if($checkSo2=='on') {
    $idSo=$_POST['lista_so2'];
    $segundoSo=$_POST['soAnterior2'];   //obtengo el id del primer SO a reemplazar  
    
    $sql2=modificarSO($idPc,$idSo,$segundoSo); 
    $cambiaSo=mysql_query($sql2, $link);  
       if(!$cambiaSo) {
       	 ?>
       <h3> El segundo sistema operativo de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
    
    $sql=obtenerIdLab($idPc);
    $result= mysql_query($sql,$link);
    $idLab=mysql_result($result,0);
    
       ///// Red
  if($checkRed=='on') {
    $enRed=$_POST['lista_red'];
    $sql=modificarRed($idPc,$enRed); 
    $cambiaRed=mysql_query($sql, $link);  
       if(!$cambiaRed) {
       	 ?>
      	<h3> El estado de red de la PC no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
  ?>
  

    
    
   <h3>Las modificaciones se realizaron correctamente</h3>
     <?php if($tipo==lab) { ?>
     	 <form action="inventario.php?tipo=lab&nro=0&nivelUs=<?php echo $nivelUs ?>" method="post">
     	 <?php } elseif($tipo==ofi) { ?>
     	  <form action="inventario.php?tipo=ofi&nro=0&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <?php } else { ?>
     	  <form action="inventario.php?tipo=taller&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <?php }  ?>
     	  
     	 <form action="inventario.php?tipo=lab&nro=0 &nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Ir al inventario" />
			</div>
		</form>  
		
</body>

</html>