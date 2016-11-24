<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> </title>

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
     if($tiempo_transcurrido >= 600) { 
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

  $componente=$_GET["componente"];
   $nivelUs=$_GET["nivelUs"];
 
  ?>
  
<body onload="javascript:mostrarVentana();">
 
 <div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">
    
 <!-- *****************   DISCO **************** -->    
    <?php 
     if($componente=='disco') { 
       $fabricante=$_POST['fabDisco'];
       $modelo=$_POST['modeloDisco'];
       $capacidad=$_POST['gbDisco'];
       $interfaz=$_POST['interfazDisco'];
           

       $sql=insertarDisco($fabricante,$modelo,$capacidad,$interfaz); 
       $insertaDisco=mysql_query($sql, $link);  
       
       if($insertaDisco) { ?>
         <h3>El nuevo disco se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>El nuevo disco no pudo ser creado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
   <!-- *****************   FUENTE **************** -->    
    <?php 
     if($componente=='fuente') { 
       $fabricante=$_POST['fabFuente'];
       $watts=$_POST['wattsFuente'];
      
       $sql=insertarFuente($fabricante,$watts); 
       $insertaFuente=mysql_query($sql, $link);  
       
       if($insertaFuente) { ?>
         <h3>La nueva fuente se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>La nueva fuente no pudo ser creada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
   <!-- *****************   MONITOR **************** -->    
    <?php 
     if($componente=='monitor') { 
       $modelo=$_POST['modeloMonitor'];
       $fabricante=$_POST['fabMonitor'];
       $pulgMonitor=$_POST['pulgMonitor'];
       $inventario=$_POST['inventMonitor'];
      
       $sql=insertarMonitor($modelo,$fabricante,$pulgMonitor,$inventario); 
       $insertaMonitor=mysql_query($sql, $link);  
       
       if($insertaMonitor) { ?>
         <h3>El monitor se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>El monitor no pudo ser creado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
     <!-- *****************   MOTHER **************** -->    
    <?php 
     if($componente=='mother') { 
       $modelo=$_POST['modeloMother'];
       $fabricante=$_POST['fabMother'];
       $cantBancos=$_POST['cantBancos'];
       $tipoBancos=$_POST['tipoBancos'];
       $socketMother=$_POST['socketMother'];
       $bios=$_POST['versionBios'];
      
       $sql=insertarMother($fabricante,$modelo,$cantBancos,$tipoBancos,$socketMother,$bios); 
       $insertaMother=mysql_query($sql, $link);  
       
       if($insertaMother) { ?>
         <h3>La mother se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>La mother no pudo ser creada. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
 <!-- *****************   PROCESADOR **************** -->    
    <?php 
     if($componente=='procesador') { 
       $fabricante=$_POST['fabProces'];
       $modelo=$_POST['modeloProces'];
       $frecuencia=$_POST['frecProces'];
       //$socketProces=$_POST['socketProces'];
              
      
       $sql=insertarProcesador($fabricante,$modelo,$frecuencia);//,$socketProces); 
       $insertaProcesador=mysql_query($sql, $link);  
       
       if($insertaProcesador) { ?>
         <h3>El procesador se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>El procesador no pudo ser creado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
     <!-- *****************  RAM **************** -->    
    <?php 
     if($componente=='ram') { 
       $tipoRam=$_POST['tipoRam'];
       $tamanioRam=$_POST['tamanioRam'];
       $fabRam=$_POST['fabRam'];
      
       $sql=insertarRam($tipoRam,$tamanioRam,$fabRam); 
       $insertaRam=mysql_query($sql, $link);  
       
       if($insertaRam) { ?>
         <h3>El módulo de RAM se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>El módulo de RAM no pudo ser creado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
       <!-- *****************   Sistema operativo **************** -->    
    <?php 
     if($componente=='so') { 
       $nombre=$_POST['nombreSo'];
       $version=$_POST['versionSo'];
      
       $sql=insertarSO($nombre,$version); 
       $insertaSO=mysql_query($sql, $link);  
       
       if($insertaSO) { ?>
         <h3>El nuevo sistema operativo se guardó correctamente</h3>
     	   <form action="javascript:history.go(-2);">
     	    <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			 </div>
		</form>  
      <?php } else {  
     ?>
     
       <h3>El nuevo sistema operativo no pudo ser creado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>  
          
     
  <?php   }
  }
    ?>
    
   
  
  </body>
  </html>