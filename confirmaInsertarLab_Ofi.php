<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Confirmar </title>
    
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
  $tipo=$_GET['tipo'];
  
  if($tipo=='lab') {
   $nroLab=$_POST["nroLab"];
  }
  else {
    $nombreOfi=$_POST['nombreOfi'];

 }
 $cantPc=$_POST['cantPc'];
 if($cantPc=='') {
  $cantPc='NULL'; 
 }
 ?>
 
 <body onload="javascript:mostrarVentana();">


<div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">

	<?php 
	 if($tipo=='lab') {
	 	if($nroLab=='') {  ?>
     	 <h3>Debe ingresar el número del laboratorio </h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		<?php break 2; }
		
		

    else {
      //verificar que el numero no esté duplicado
 	  $sql=verificarNumeroLab($nroLab); 
 	  $result= mysql_query($sql,$link);
 	  $existeLab=mysql_result($result,0);
 	  mysql_free_result($result);
   
      if($existeLab!='') {  ?>
       <!-- ///Aviso: El nro de lab ya existe -> Regresar///-->	
     	 <h3>El número de laboratorio ya existe. <br> Debe ingresar otro</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		<?php break 3; } 
		}
		
		//insertarLab
		 $sql=insertarLab($nroLab);
		 $insertaLab=mysql_query($sql, $link);
		
	 if(!$insertaLab) { ?>
       <h3>El nuevo laboratorio no pudo ser creado. Por favor intente nuevamente </h3>
     	   <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>			
	<?php 	break 2; }
	
	 else { ?>
	  <h3>El nuevo laboratorio ha sido creado </h3>
     	 <form action="inventario.php?tipo=lab&nro=0&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnAceptar" type="submit" name="btnAceptar" size="20" type="button" value="Ir al inventario" />
			</div>
		</form>
	
	<?php }
	}
	
	elseif($tipo=='ofi') {
	 	if($nombreOfi=='' || $nombreOfi=='Nombre') {  ?>
     	 <h3>Debe ingresar el nombre de la oficina </h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		<?php break 2; }
		
		

    else {
     //verificar que el nombre de oficina no esté duplicado
  	 $sql=verificarNombreOfi($nombreOfi); 
  	 $result= mysql_query($sql,$link);
 	 $existeOfi= mysql_result($result,0);
  	 mysql_free_result($result);
   
      if($existeOfi!='') {  ?>
       <!-- ///Aviso: El nombre de oficina ya existe -> Regresar///-->	
     	 <h3>El nombre de oficina ya existe. <br> Debe ingresar otro</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		<?php break 3; } 
		
		}
		
		//insertarOfi
		 $sql=insertarOfi($nombreOfi);
		 $insertaOfi=mysql_query($sql, $link);
	
	 if(!$insertaOfi) { ?>
       <h3>La nueva oficina no pudo ser creada. Por favor intente nuevamente </h3>
     	   <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>			
	<?php break 2;	}
	
	 else { ?>
	  <h3>La nueva oficina ha sido creada </h3>
     	 <form action="inventario.php?tipo=lab&nro=0&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnAceptar" type="submit" name="btnAceptar" size="20" type="button" value="Ir al inventario" />
			</div>
		</form>
	
	<?php }
	} ?>

   
   </p>
   </div>


</body>
</html>			
		
		