<!DOCTYPE html>

 <meta charset="UTF-8">
<link rel="stylesheet" href="css/tabla.css">
 <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script src="js/jquery.fixedTableHeader.js"></script>
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
      header('Location: index.php?error='.$error ); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
}*/

?>

	<script type="text/javascript">
function mostrarVentana1()
{
    var ventana = document.getElementById('miVentana1'); // Accedemos al contenedor
    ventana.style.marginTop = "200px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
    ventana.style.marginLeft = ((document.body.clientWidth-350) / 2) +  "px"; // Definimos su posición horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
}

//está dos veces la función porque llama a distintos contenedores, los dos tienen la misma lista selectedStyleSheetSet
//pero uno es para modificar la PC y otro para darla de baja
function mostrarVentana2()
{
    var ventana = document.getElementById('miVentana2'); // Accedemos al contenedor
    ventana.style.marginTop = "200px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
    ventana.style.marginLeft = ((document.body.clientWidth-350) / 2) +  "px"; // Definimos su posición horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
}

function ocultarVentana1()
{
    var ventana = document.getElementById('miVentana1'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
    
}

function ocultarVentana2()
{
    var ventana = document.getElementById('miVentana2'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
    
}



</script>




<?php
 include('encabezado.php');
 include('btncerrar.php');
 include('menu.php');


 $link=Conection();
 $nivelUs=$_GET['nivelUs'];
  $tipo=$_GET["tipo"];

  $nro=$_GET["nro"];
  
  if($tipo=='lab'){
    if($nro==0)
     $conc='Laboratorios - Todos';
     else 
      $conc='Laboratorio '.$nro;  
  }
  elseif($tipo=='ofi') {
   $conc='Oficinas';
  }
  else {
   $conc='Taller';  
  }
  
?>


<title> Inventario <?php echo $conc?> </title>
<?php
     /* De acuerdo al valor de la variable $tipo llamo a la función inventarioLab o inventarioOfi
      y paso la variable $nro como parámetro para indicar el nro de laboratorio u oficina */
    if($tipo==lab) {
    	
       $sql=inventarioLab($nro);
 	    $result= mysql_query($sql,$link);
 	    
  	    
     }
   elseif($tipo==ofi) {
      $sql=inventarioOfi($nro);
      $result= mysql_query($sql,$link);
            
    /* 1:   ALUMNADO*/
  	 // 2:  /* ATENCION AL ESTUDIANTE*/
  	 // case 3:  /* AREA ECONOMICA*/
  	// case 4:  /* As. PEDAGÓGICA*/
  	// case 5:  /*BEDELIA*/
  	//  case 6:  /* CONSEJO*/
  	// case 7:  /* MESA DE ENTRADA*/
  	//  case 8:  /*PERSONAL*/
  	// case 9:  /* POSGRADO*/
  	// case 10:  /* SEC ACADEMICA*/
   //  case 11:  /* SEC ADMINISTRATIVA*/
  	 // case 12:  /* SEC CIENCIA Y TEC*/
  	 // case 13:  /* SEC COORDINACION*/
   // case 14:  /* RELAC INSTITUCIONALES*/
    }
    else {
      $sql=inventarioTaller();
      $result= mysql_query($sql,$link);
    }
    





 // <!-- Botones Agregar PC y Modificar PC -->
  
   		
 		if($nivelUs==1) { ?>
 	
 		   <div> 
  			<form action="nuevaPc.php?tipo=<?php echo $tipo;?>&nivelUs=<?php echo $nivelUs ?>" method="post" style="display:inline">
       		<input name="boton1" type="submit" value="Nueva PC" class="boton1">
     		</form>

   	   <form action="javascript:mostrarVentana1();" method="post" style="display:inline">
      		<input name="boton2" type="submit" value="Modificar PC" class="boton2">
    		</form>
    		
    		<form action="javascript:mostrarVentana2();" method="post" style="display:inline">
       		<input name="boton3" type="submit" value="Dar de baja PC" class="boton3">
     		</form>
     		
     		<form action="nuevoIncidente.php?tipo=<?php echo $tipo;?>&nro=<?php echo $nro;?>&nivelUs=<?php echo $nivelUs ?>" method="post" style="display:inline">
       		<input name="boton4" type="submit" value="Nuevo incidente" class="boton4">
     		</form>
     		
     		</div>
     
   <?php }  ?>


<div class="table-title">
</div>


<table class="table-fill" class="tbl" >
<thead>
<tr>
<th rowspan="2" >Nombre PC</th>
<th colspan="6">Mother</th>
<th colspan="2">RAM</th>
<th colspan="3">Procesador</th>
<th colspan="3">Disco</th>
<th colspan="2">Fuente</th>
<th colspan="3">Monitor</th>
<th colspan="2">Sistemas operativos</th>
<th rowspan="2">Internet</th>
<th rowspan="2">Nro. inventario</th>
</tr>
<tr> 
  <th>Fabricante</th> <!--Mother -->
  <th>Modelo</th>     <!--Mother -->
  <th>Cant. bancos</th>  <!--Mother -->
  <th>Tipo bancos</th>  <!--Mother -->
  <th>Socket</th>       <!--Procesador-->
  <th>BIOS Version</th>   <!--Mother -->
  <th>Cant. módulos</th>  <!--RAM-->
  <th>Capacidad</th>  <!--Ram-->
  <th>Fabricante</th>     <!--Procesador-->
  <th>Modelo</th>       <!--Procesador-->
  <th>Frec (GHz)</th>     <!--Procesador-->
  <th>Fabricante</th>   <!--Disco-->   
  <th>Modelo</th>         <!--Disco-->
  <th>Capacidad </th>   <!--Disco-->
  <th>Fabricante</th>  <!--Fuente-->
  <th>Watts</th>      <!--Fuente-->
  <th>Fabricante</th>    <!--Monitor --> 
  <th>Modelo</th>    <!--Monitor-->
  <th>Pulg.</th>    <!--Monitor-->
  <th></th>  
  <th></th>  
</tr>
</thead>


<tbody>

  <?php
  
   $existeIncidente=0;  
 /* Inserto en la tabla todas las filas de la consulta SELECT */
  while($row = mysql_fetch_array($result)){
  	
   $idPc=$row['id'];
   $sql2=soPc($idPc); //obtener los S.O. de la PC
  	$result2= mysql_query($sql2,$link);
   $nombreSo1=mysql_result($result2,0,'nombre');
   $versionSo1=mysql_result($result2,0,'version');
   $nombreSo2=mysql_result($result2,1,'nombre');
   $versionSo2=mysql_result($result2,1,'version'); 
  	
  	$sql3=ramPcTotal($idPc);
  	$result3= mysql_query($sql3,$link);
  	$sumaModulos=mysql_result($result3,0,'suma_modulos');
  	$ramTotal=mysql_result($result3,0,'ram_total');
  	
  	
  	$nroInventario=$row["nro_inventario"];
  	
  	if($nroInventario==NULL) {
  		$nroInventario='-';
  	}
  	
  	
   $red=$row["red"];
 
   if($red==NULL){
      $enRed='-';
    }
    elseif($red==0) { 
       $enRed='NO';
     }
     else {
     	$enRed='SI';
     }
  	
  	$fuenteFab=$row["fuente_fabricante"];
  	$fuenteWatts=$row["watts"];
  	if($fuenteFab==NULL){
      $fuenteFab='-';
      $fuenteWatts='-';  	
  	}
  	
  	$monitorFab=$row["monitor_fabricante"];
  	$monitorMod=$row["monitor_modelo"];
  	$monitorPulg=$row['pulgadas'];
  	if($monitorFab==NULL){
      $monitorFab='-';
      $monitorMod='-';
      $monitorPulg='-';
        	
  	}
  	
   
  if($row["en_incidente"]==1) {
  	$existeIncidente=1;
    echo "<tr> <td><font color ='red'>" .$row["nombre"]  . "*</font></td>";
    echo "<td><font color ='red'>" . $row["mother_fabricante"] . "</font></td>";
    echo "<td><font color ='red'>" . $row["mother_modelo"] . "</font></td>";
    echo "<td><font color ='red'>" . $row["cant_bancos"] . "</font></td>";
	 echo "<td><font color ='red'>" . strtoupper($row["tipo_bancos"]) . "</font></td>";
	 echo "<td><font color ='red'>" . $row["socket"] . "</font></td>";
    echo "<td><font color ='red'>" . $row["version_bios"] . "</font></td>";
	 echo "<td><font color ='red'>" . $sumaModulos . "</font></td>";
    echo "<td><font color ='red'>" . round($ramTotal,2) . " Gb" . "</font></td>";
    echo "<td><font color ='red'>" . $row["procesador_fabricante"]. "</font></td>";
    echo "<td><font color ='red'>" . $row["procesador_modelo"]. "</font></td>";
    echo "<td><font color ='red'>" . $row["frecuencia"]. "</font></td>";
    echo "<td><font color ='red'>" . $row["disco_fabricante"] . "</font></td>";
    echo "<td><font color ='red'>" . $row["disco_modelo"] . "</font></td>";
    echo "<td><font color ='red'>" . $row["capacidad_gb"] . " Gb" .  "</font></td>";
    echo "<td><font color ='red'>" . $fuenteFab . "</font></td>";
    echo "<td><font color ='red'>" . $fuenteWatts . "</font></td>";
	 echo "<td><font color ='red'>" . $monitorFab . "</font></td>";
    echo "<td><font color ='red'>" . $monitorMod . "</font></td>";
    echo "<td><font color ='red'>" . $monitorPulg . "</font></td>";
    echo "<td><font color ='red'>" . $nombreSo1 . " " . $versionSo1 . "</font></td>";
    echo "<td><font color ='red'>" . $nombreSo2 . " " . $versionSo2 . "</font></td>"; 
    echo "<td><font color ='red'>" . $enRed. "</font></td>"; 
    echo "<td><font color ='red'>" . $nroInventario . "</font></td></tr>";  
 }
 else {
 	 echo  "<tr><td>" .$row["nombre"]  . "</td>";
    echo "<td>" . $row["mother_fabricante"] . "</td>";
    echo "<td>" . $row["mother_modelo"] . "</td>";
    echo "<td>" . $row["cant_bancos"] . "</td>";
	 echo "<td>" . strtoupper($row["tipo_bancos"]) . "</td>";
	 echo "<td>" . $row["socket"] . "</td>";
    echo "<td>" . $row["version_bios"] . "</td>";
	 echo "<td>" . $sumaModulos . "</td>";
    echo "<td>" . round($ramTotal,2) . " Gb" . "</td>";
    echo "<td>" . $row["procesador_fabricante"]. "</td>";
    echo "<td>" . $row["procesador_modelo"]. "</td>";
    echo "<td>" . $row["frecuencia"]. "</td>";
    echo "<td>" . $row["disco_fabricante"] . "</td>";
    echo "<td>" . $row["disco_modelo"] . "</td>";
    echo "<td>" . $row["capacidad_gb"] . " Gb" .  "</td>";
    echo "<td>" . $fuenteFab  . "</td>";
    echo "<td>" . $fuenteWatts . "</td>";
	 echo "<td>" . $monitorFab . "</td>";
    echo "<td>" . $monitorMod . "</td>"; 
    echo "<td>" . $monitorPulg . "</td>"; 
    echo "<td>" . $nombreSo1 . " " . $versionSo1 . "</font></td>";
    echo "<td>" . $nombreSo2 . " " . $versionSo2 . "</font></td>";
    echo "<td>" . $enRed . "</td>";  
    echo "<td>" . $nroInventario . "</td></tr>";    
 }
 }
	    
	 
  mysql_free_result($result);
  //mysql_close($link);
?>

   
     </tbody> 
     
</table>


<div class="reparacion" >
 <?php
 if($existeIncidente) { ?>
<style>
 .reparacion{
   position: absolute;
   left:200px; 
 }
</style>

 
       <font color='red'>  <?php echo "<br> * PCs en reparación";
}
 ?>
</div>

<div class="cantidad" >
<style>
 .cantidad{
   position: absolute;
   right: 40px; 
   font-weight: bold;
   font-size: 13px;
 }
</style>

<?php
   if($tipo=='lab'){
   	$sql=cantidadPC($tipo,$nro);
   	$result= mysql_query($sql,$link);
   	$cantidad=mysql_result($result,0);
     
    if($nro==0)
          $conc='PCs disponibles actualmente en laboratorios: '.$cantidad;
     else 
      $conc='PCs disponibles actualmente en laboratorio '.$nro.': '.$cantidad;
      ?>
      <font color=#5288e2>  <?php echo "<br> $conc"; 
  }
  ?>
      

 
</div>
<!-- Ventana modal que está oculta y se muestra cuando se llama a la función MostrarVentana() -->
<!-- Tiene un select donde se cargan las opciones: los nombres de todas las pc si estoy en "Laboratorios" o
de las pc del laboratorio donde estoy posicionado (lo mismo para las oficinas) - Para eso uso las variables $tipo y $nro -->
<div id="miVentana1" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Seleccionar PC</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">

    <?php 
    $sql2=selectNombres($tipo,$nro);

    $result= mysql_query($sql2,$link);
    
    $concatenado="";
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['nombre']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     ?>  
      
<!--       /* select para elegir la pc a modificar, con dos botones: Aceptar, que redirige a otra página
      para realizar la modificación y Cancelar que cierra la ventana emergente */ -->
     
    <form action="modificarPc.php?nivelUs=<?php echo $nivelUs ?>&tipo=<?php echo $tipo;?>" method="post" align="center">
     <div align="center">
     <select name="lista_pc">
       <option selected value="0">Selecciona una opcion</option>
       <?php echo $concatenado; ?>
    </select>
    </div>
      <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
       <input id="btnAceptar" onclick="ocultarVentana1();" type="submit" name="btnAceptar" size="20" type="button" value="Aceptar" />
       <input id="btnCancelar" onclick="ocultarVentana1();" name="btnCancelar" size="20" type="button" value="Cancelar" />
     </div>
     
   </form>
   </p>
   </div>

<!-- Ventana modal que está oculta y se muestra cuando se llama a la función MostrarVentana() -->
<!-- Tiene un select donde se cargan las opciones: los nombres de todas las pc si estoy en "Laboratorios" o
de las pc del laboratorio donde estoy posicionado (lo mismo para las oficinas) - Para eso uso las variables $tipo y $nro -->
<div id="miVentana2" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Seleccionar PC</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">

    <?php 
    $sql2=selectNombres($tipo,$nro);

    $result= mysql_query($sql2,$link);
    
    $concatenado="";
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['nombre']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_close($link);
     ?>  
      
<!--       /* select para elegir la pc a modificar, con dos botones: Aceptar, que redirige a otra página
      para realizar la modificación y Cancelar que cierra la ventana emergente */ -->
      
    <form action="darBajaPc.php?nivelUs=<?php echo $nivelUs ?>" method="post" align="center">
     <div align="center">
     <select name="lista_pc">
       <option selected value="0">Selecciona una opcion</option>
       <?php echo $concatenado; ?>
    </select>
    </div>
      <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
       <input id="btnAceptar" onclick="ocultarVentana2();" type="submit" name="btnAceptar" size="20" type="button" value="Aceptar" />
       <input id="btnCancelar" onclick="ocultarVentana2();" name="btnCancelar" size="20" type="button" value="Cancelar" />
     </div>
     
   </form>
   </p>
   </div>
   

<script type="text/javascript">
  $(document).ready(function () {
    $('table').fixedTableHeader();
 
  });
  


</script>

