<!DOCTYPE html>
<meta charset="UTF-8">
<html>
  <head>
    

    
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

      <link href="css/central.css" rel="stylesheet" type="text/css" media="screen" />
      <link rel="stylesheet" href="css/modal.css">
 <style type="text/css"> 

  input{
    display: inline;
   
    width: auto;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
}​

</style> 

	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
	

<script type="text/javascript">
   function capturar()
    {
        var resultado="ninguno";
 
        var porNombre=document.getElementsByName("interfazDisco");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }
 
        document.getElementById("resultado").innerHTML=" \
            Interfaz: "+resultado;
    }
    </script>



</head>


<?php 
   include('encabezado.php');
   include('btncerrar.php');
   include('menu.php');
 
   $componente=$_GET["componente"];
   $nivelUs=$_GET["nivelUs"];
  ?>
<body>

    <form name="formulario" id="formulario" action="insertarComponente.php?componente=<?php echo $componente ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
    <table class="table-fill">
    
 <!--/*****************   DISCO  ****************/ -->
<?php 
 if($componente=='disco') {
?>  
<title> Nuevo disco </title>
<br>
<br>
<br>
 <h3> <b> Nuevo disco </h3> 
     <!--/*****************   Fabricante ****************/ -->
   
   <tr>
   <td> <h4> Fabricante: </h4></td>
     
   <td>
     <input type="text" name="fabDisco" id="fabDisco" size="15" >
   </td>
  </tr>
    <!--/*****************   Modelo ****************/ -->
   
   <tr>
   <td> <h4> Modelo: </h4></td>
     
   <td>
     <input type="text" name="modeloDisco" id="modeloDisco" size="30" >
   </td>
  </tr>
 
   <!--/*****************  Capacidad ****************/ -->
  <tr>
   <td> <h4> Capacidad (Gb): </h4></td>
     
   <td>
     <input type="text" name="gbDisco" id="gbDisco" size="15" >
   </td>
 
      </tr>
      
  <!--/*****************  Interfaz ****************/ -->
  <tr>
   <td> <h4> Interfaz: </h4></td>
     
      <td>  
      <input type="radio" name="interfazDisco" value="SATA" > SATA </div>
      <input type="radio" name="interfazDisco" value="IDE" > IDE </div>  
     


     
    </td>
 
  </tr>
  <?php } ?>
  
   <!--/*****************   FUENTE  ****************/ -->
  <?php 
 if($componente=='fuente') {
?>  
<title> Nueva fuente </title>
 <br>
<br>
<br>
 <h3> <b> Nueva fuente </h1> 
    <!--/*****************   Fabricante ****************/ -->
   
   <tr>
   <td> <h4> Fabricante: </h4></td>
     
   <td>
     <input type="text" name="fabFuente" id="fabFuente" size="15" >
   </td>
  </tr>
 
   <!--/*****************  Watts ****************/ -->
  <tr>
   <td> <h4> Watts: </h4></td>
     
   <td>
     <input type="text" name="wattsFuente" id="wattsFuente" size="15" >
   </td>
 
      </tr>

   <?php } ?>
   
    <!--/*****************   MONITOR  ****************/ -->
<?php 
 if($componente=='monitor') {
?>  
<title> Nuevo monitor </title>
 <br>
<br>
<br>
 <h3> <b> Nuevo monitor </h1> 
 
    <!--/*****************  Fabricante ****************/ -->
  <tr>
   <td> <h4> Fabricante: </h4></td>
     
   <td>
     <input type="text" name="fabMonitor" id="fabMonitor" size="15" >
   </td>
 
      </tr>
      
    <!--/*****************   Modelo ****************/ -->
   
   <tr>
   <td> <h4> Modelo: </h4></td>
     
   <td>
     <input type="text" name="modeloMonitor" id="modeloMonitor" size="30" >
   </td>
  </tr>
 

      
 <!--/*****************  Pulgadas ****************/ -->
  <tr>
   <td> <h4> Pulgadas: </h4></td>
     
   <td>
     <input type="text" name="pulgMonitor" id="pulgMonitor" size="5" >
   </td>
 
      </tr>
      
      
  <!--/*****************  Nro inventario ****************/ -->
  <tr>
   <td> <h4> Nro. inventario (opcional): </h4></td>
     
   <td>
     <input type="text" name="inventMonitor" id="inventMonitor" size="15" >
   </td>
 
  </tr>
  <?php } ?>
    
       
<!--/*****************   MOTHER  ****************/ -->
<?php 
 if($componente=='mother') {
?>  
<title> Nueva mother </title>
<br>
<br>
<br>
 <h3> <b> Nueva mother </h1> 
 
  <!--/*****************  Fabricante ****************/ -->
  <tr>
   <td> <h4> Fabricante: </h4></td>
     
   <td>
     <input type="text" name="fabMother" id="fabMother" size="15" >
   </td>
 
      </tr>
      
    <!--/*****************   Modelo ****************/ -->
   
   <tr>
   <td> <h4> Modelo: </h4></td>
     
   <td>
     <input type="text" name="modeloMother" id="modeloMother" size="30" >
   </td>
  </tr>
 
       
  <!--/*****************  Cant bancos ****************/ -->
  <tr>
   <td> <h4> Cantidad de bancos de RAM: </h4></td>
     
   <td>
     <input type="text" name="cantBancos" id="cantBancos" size="15" >
   </td>
 
  </tr>
  
   <!--/*****************  Tipo bancos ****************/ -->
  <tr>
   <td> <h4> Tipo de bancos (DDR#): </h4></td>
     
   <td>
     <input type="text" name="tipoBancos" id="tipoBancos" size="15" >
   </td>
 
  </tr>
  
     <!--/*****************  Socket ****************/ -->
  <tr>
   <td> <h4> Socket: </h4></td>
     
   <td>
     <input type="text" name="socketMother" id="socketMother" size="15" >
   </td>
 
      </tr>

    
 
  
     <!--/*****************  Version BIOS ****************/ -->
  <tr>
   <td> <h4> Versión de BIOS: </h4></td>
     
   <td>
     <input type="text" name="versionBios" id="versionBios" size="15" >
   </td>
 
  </tr>
  
  <?php } ?>
  
  <!--/*****************   PROCESADOR  ****************/ -->
<?php 
 if($componente=='procesador') {
?>  
 <title> Nuevo procesador </title>
<br>
<br>
<br>
 <h3> <b> Nuevo procesador </h1> 
    <!--/*****************   Fabricante ****************/ -->
   
   <tr>
   <td> <h4> Fabricante: </h4></td>
     
   <td>
     <input type="text" name="fabProces" id="fabProces" size="20" >
   </td>
  </tr>
 
 <!--/*****************   Modelo ****************/ -->
   
   <tr>
   <td> <h4> Modelo: </h4></td>
     
   <td>
     <input type="text" name="modeloProces" id="modeloProces" size="30" >
   </td>
  </tr>
  
  <!--/*****************   Frecuencia ****************/ -->
   
   <tr>
   <td> <h4> Frecuencia (GHz): </h4></td>
     
   <td>
     <input type="text" name="frecProces" id="frecProces" size="30" >
   </td>
  </tr>
  
    <?php } ?>  
 
  <!--/*****************   RAM  ****************/ -->   
    <?php 
 if($componente=='ram') {
?>  
<title> Nueva RAM </title>
 <br>
<br>
<br>
 <h3> <b> Nueva RAM </h1> 
    <!--/*****************   Tipo ****************/ -->
   
   <tr>
   <td> <h4> Tipo: </h4></td>
     
   <td>
     <input type="text" name="tipoRam" id="tipoRam" size="15" >
   </td>
  </tr>
 
   <!--/*****************  Tamaño ****************/ -->
  <tr>
   <td> <h4> Tamaño (Mb): </h4></td>
     
   <td>
     <input type="text" name="tamanioRam" id="tamanioRam" size="15" >
   </td>
 
      </tr>

  <!--/*****************   Fabricante ****************/ -->
   
   <tr>
   <td> <h4> Fabricante: </h4></td>
     
   <td>
     <input type="text" name="fabRam" id="fabRam" size="25" >
   </td>
  </tr>
  
    <?php } ?>   
  
    
   <!--/*****************   Sistema operativo  ****************/ -->
  <?php 
 if($componente=='so') {
?>  
<title> Nuevo sistema operativo</title>
 <br>
<br>
<br>
 <h3> <b> Nuevo sistema operativo </h1> 
    <!--/*****************   Nombre ****************/ -->
   
   <tr>
   <td> <h4> Nombre: </h4></td>
     
   <td>
     <input type="text" name="nombreSo" id="nombreSo" size="15" >
   </td>
  </tr>
 
   <!--/*****************  Version ****************/ -->
  <tr>
   <td> <h4> Versión: </h4></td>
     
   <td>
     <input type="text" name="versionSo" id="versionSo" size="15" >
   </td>
 
      </tr>

   <?php } ?>
  </table>
    <div align="center"> 
  			
       		<input name="boton1" id="boton1" type="submit" value="Guardar" class="boton">
     		
     		</div>
  </form>
  
<div id="resultado"></div>
</body>