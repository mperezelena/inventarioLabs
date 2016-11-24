<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Confirma nueva PC </title>
    
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
<style>

</style>
</head>

<?php 

    include('encabezado.php');
  include('btncerrar.php');
  include('menu.php');
  $link=Conection();
  $nivelUs=$_GET["nivelUs"];
  

$nombrePc=$_POST["nombrePc"];
$tipo=$_GET["tipo"];
$nroInventario=$_POST["nroInventario"];
$idLab=$_POST["lista_lab"];
$idOfi=$_POST["lista_ofi"];
$idDisco=$_POST["lista_disco"];
$idFuente=$_POST["lista_fuente"];
$idMonitor=$_POST["lista_mon"];
$idMother=$_POST["lista_mother"];
$idProcesador=$_POST["lista_proc"];
$cantRam1=$_POST["cantidad1"];
$idRam1=$_POST["lista_ram1"];
$cantRam2=$_POST["cantidad2"];
$idRam2=$_POST["lista_ram2"];
$idSo1=$_POST['lista_so1'];
$idSo2=$_POST['lista_so2'];
$enRed=$_POST['lista_red'];

?>

<body onload="javascript:mostrarVentana();">
 
 <?php 
 
 //verificar que el nombre no esté duplicado
  $sql=verificarNombre($nombrePc); 
  $result= mysql_query($sql,$link);
  $existePc=mysql_result($result,0);
   
  mysql_free_result($result);
  
 //verificar que el nro de invetario no esté duplicado
  $sql=verificarNroInv($nroInventario); 
  $result= mysql_query($sql,$link);
  $existeInv= mysql_result($result,0);
 
  mysql_free_result($result);
  
 
  ?>

<div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">

<!-- ///Aviso: falta ingresar nombre -> Regresar///-->	
	<?php 
     if($nombrePc=='' || $nombrePc=='Nombre') {  ?>
     	 <h3> Debe ingresar el nombre de la PC</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		
 <!--///Aviso: ya existe ese nombre de PC -> Regresar///-->
    <?php  break; }
     if($existePc!="") {  //si $existePc contiene algo es porque ya existe ese nombre de PC ?>
     	 <h3>El nombre de la PC ya existe. <br> Debe ingresar otro</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
	

		
		
<!--///Aviso: ya existe ese nro de inventario -> Regresar///-->	
	<?php break; }
	 
	  if($existeInv!="") {  //si existeInv contiene algo es porque ya existe ese nro inventario ?>
     	 <h3>El número de inventario ya existe. <br> Debe ingresar otro</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
   
   
 <!-- ///Aviso: falta ingresar Lab -> Regresar///-->	
	<?php  break;}
	  if($idLab==0 && $idOfi==0 && $tipo!='taller') {  ?>
     	 <h3> Debe ingresar el laboratorio u oficina</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		 	 

		
<!-- ///Aviso: falta ingresar disco -> Regresar///-->	
	<?php break; }
     if($idDisco==0) {  ?>
     	 <h3> Debe ingresar el disco de la PC</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
	
<!-- ///Aviso: falta ingresar mother -> Regresar///--> 
	<?php break;}
     if($idMother==0) {  ?>
     	 <h3> Debe ingresar la mother de la PC </h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		
 <!-- ///Aviso: falta ingresar procesador -> Regresar///--> 
 <?php break;}
     if($idProcesador==0) {  ?>
     	 <h3> Debe ingresar el procesador de la PC </h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
		
 <!-- ///Aviso: falta ingresar ram -> Regresar///--> 
 <?php break;}
     if($idRam1==0 && $idRam2==0) {  ?>
     	 <h3> Debe ingresar la memoria RAM de la PC </h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>		
  <?php   break;} 
   
   else {
     if($idLab!="") {
    	$idOfi='NULL';
    	}
    	else {
       $idLab='NULL';    	
    	}
    	
   if($nroInventario=='Inventario' || $nroInventario=='') {
     $nroInventario='NULL';
     
   }

    
    $sql=cantBancosMother($idMother);
    $result= mysql_query($sql,$link);
    $cantBancos=mysql_result($result,0);
    
    $sumaModulos=$cantRam1+$cantRam2;
    if($cantBancos<$sumaModulos) { ?>
     <font color=#32639A size=2.5>  <h4> La cantidad de módulos de RAM es superior a la cantidad de bancos de la mother </h4></font>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>		
  <?php   break 2;} 
     
     if($enRed==0) {
       $red='NULL';     
     }
     elseif($enRed==2) {
        $red=0;
     }
          
    if($tipo=='taller') {
     $enTaller=1; 
     $idLab='NULL';
     $idOfi='NULL';
     $idMonitor=0;
     $red='NULL'; 
  
    }      
    else {
     $enTaller=0;    
    }
    $sql=insertarPc($nombrePc,$nroInventario,$idMother,$idDisco,$idFuente,$idMonitor,$idLab,$idOfi,$idProcesador,$red,$enTaller); 
    $insertaPc=mysql_query($sql, $link);

   
    
    if($cantRam1>0) {
     $sql1=insertarRamPc($idRam1,$nombrePc,$cantRam1);
     $insertaRam1=mysql_query($sql1, $link);
    } 
      
         
    if($cantRam2 > 0) {
        $sql2=insertarRamPc($idRam2,$nombrePc,$cantRam2);
        $insertaRam2=mysql_query($sql2, $link);
     }
     
     if($idSo1!=0) {
     
      $sql=insertarSoPc($idSo1, $nombrePc);
      $insertaSo1=mysql_query($sql, $link);     
     }
     
     if($idSo2!=0) {
      $sql=insertarSoPc($idSo2, $nombrePc);
      $insertaSo2=mysql_query($sql, $link);     
     } 
   
      
  
  if (($insertaPc && $insertaRam1) || ($insertaPc && $insertaRam2)){
   ?>
   <h3>La nueva PC ha sido creada </h3>
     <?php if($idLab!="") { ?>
     	 <form action="inventario.php?tipo=lab&nro=<?php echo $idLab ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
     	 <?php } else { ?>
     	  <form action="inventario.php?tipo=ofi&nro=<?php echo $idOfi ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
     	  <?php } ?>
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnAceptar" type="submit" name="btnAceptar" size="20" type="button" value="Ir al inventario" />
			</div>
			</form>

   <?php }  elseif($insertaPc && !$insertaRam1 && !$insertaRam2) {
      $sql=eliminarPc($nombrePc);   	
      mysql_query($sql, $link);
   	?>
      <h3>La nueva PC no pudo ser creada. Por favor intente nuevamente </h3>
     	<form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>		
   <?php } elseif(!$insertaPc) {
    ?>
      <h3>La nueva PC no pudo ser creada. Por favor intente nuevamente </h3>
     	<form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>	
	<?php }
	}
  ?>
     
   
   </p>
   </div>


</body>
</html>