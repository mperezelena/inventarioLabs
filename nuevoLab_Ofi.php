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
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<script type="text/javascript">

 //funcion para ajustar dinámicamente el tamaño del textbox
    function ajustar() {
        var texto1=document.getElementById("nombreOfi");
        var txt1=texto1.value;
        var tamano1=txt1.length;
       tamano1*=15; //el valor multiplicativo debe cambiarse dependiendo del tamaño de la fuente
        texto1.style.width=tamano1+"px";
    }
</script>

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
  
  <form action="confirmaInsertarLab_Ofi.php?tipo=<?php echo $tipo ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
    <table class="table-fill">
    
  <?php if($tipo=='lab') { ?>
  <title>Nuevo laboratorio</title>
    <br>
    <br>
    <br>
    <caption><h4>Nuevo laboratorio</h4></caption>
  
      <!--/*****************   NUMERO ****************/ -->
   

   <tr>
   <td> <h4> Número: </h4></td>
     
   <td>
     <input type="text" name="nroLab" id="nroLab">
   </td>
 
      </tr>
      
        
      <!--/*****************  CANT PC ****************/ 
      <tr>
   <td> <h4> Cantidad de PC (opcional): </h4></td>
     
   <td>
     <input type="text" name="cantPc" id="cantPc">
   </td>
 
      </tr> -->
      
      </table>
       	     <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Guardar laboratorio" class="boton">
     		
     		</div>
 
     	<?php }
     	
     else { ?>   
     <title>Nueva oficina</title>  		
     	 <br>
       <br>
       <br>
       <caption><h4>Nueva oficina</h4></caption>
  
      <!--/*****************   NOMBRE ****************/ -->
   

   <tr>
   <td> <h4> Nombre: </h4></td>
     
   <td>
    <input type="text" name="nombreOfi" id="nombreOfi" onKeyUp="javascript:ajustar()" onfocus="this.value='';" value="Nombre">
   </td>
 
      </tr>
      
        
      <!--/*****************  CANT PC ****************/ 
      <tr>
   <td> <h4> Cantidad de PC (opcional): </h4></td>
     
   <td>
     <input type="text" name="cantPc" id="cantPc">
   </td>
 
      </tr>-->
      
      </table>
       	     <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Guardar oficina" class="boton">
     		
     		</div>
     	<?php }	?>
     		</form>
     		


</body>
</html>