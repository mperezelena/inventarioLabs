<!DOCTYPE html>

<html >
  <head>
    <meta charset="UTF-8">

    
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
    
      <link rel="stylesheet" href="css/tabla.css">
    <html lang="en">
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

  $estado=$_GET["estado"];
  $tipo=$_GET["tipo"];
  $nro=$_GET["nro"];
  $nivelUs=$_GET['nivelUs'];
 
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
  
  
  
    $link=Conection();
    
   if($estado==pendiente) {
     $sql=listarPendientes();
     $result= mysql_query($sql,$link);   
   }
   elseif($tipo==lab) {
      $sql=incidentesLab($nro);
      $result= mysql_query($sql,$link);
 
   }
  
    elseif($tipo==ofi) {
       $sql=incidentesOfi($nro);
       $result= mysql_query($sql,$link);
   }
   
   elseif($tipo==taller) {
       $sql=incidentesTaller();
       $result= mysql_query($sql,$link); 
   }
   
      $filas=mysql_num_rows($result);
  
?>

<title> Incidentes <?php echo $conc?> </title>

<body>

 <!-- Botones Nuevo Incidente  - Modificar Incidente y Eliminar incidente -->
   <?php
    if($nivelUs==1) { ?>
 		   <div align="center"> 
  			<form action="nuevoIncidente.php?tipo=<?php echo $tipo;?>&nro=<?php echo $nro;?>&nivelUs=<?php echo $nivelUs ?>" method="post" style="display:inline">
       		<input name="boton1" type="submit" value="Nuevo incidente" class="boton1">
     		</form>
     		
     	   		
     <?php  if($filas!=0) { ?>
   	   <form action="javascript:mostrarVentana();" method="post" style="display:inline">
      		<input name="boton2" type="submit" value="Modificar incidente" class="boton2">
    		</form>
    		
    		<form action="eliminarIncidente.php?tipo=<?php echo $tipo;?>&nro=<?php echo $nro;?>&nivelUs=<?php echo $nivelUs ?>" method="post" style="display:inline">
       		<input name="boton1" type="submit" value="Eliminar incidente" class="boton3">
     		</form>
     		
			</div>
   <?php } }  ?>
   
   
  

<table class="table-fill3">
<thead>
<tr>
<th >Nombre PC</th>
<th>Incidente</th>
<th>Fecha inicio</th>
<th>Fecha fin</th>
<th>Detalle</th>
</tr>

</thead>

<tbody class="table-hover">

 <?php


   

   
   while($row = mysql_fetch_array($result))
    
  
  { echo "<tr><td>" .$row["nombre"]  . "</td>";
    echo "<td>" . $row["nombre_incid"] . "</td>";
    $fechaIni=cambiaf_a_normal($row["fecha_inicio"]);
    echo "<td>" . $fechaIni . "</td>";
    if($row["fecha_fin"]==NULL) {
      echo "<td> <font color='red'> No finalizado </font></td>";  }
    else {
    	$fechaFin=cambiaf_a_normal($row["fecha_fin"]);
      echo "<td> ". $fechaFin ."</td>";
    }
  	 echo "<td>" . $row["detalle"] . "</td></tr>"; 
  	 }

 
   mysql_free_result($result);
   mysql_close($link);
?>

    
     </tbody> 
</table>


<!-- Ventana modal que está oculta y se muestra cuando se llama a la función MostrarVentana() -->
<!-- Tiene un select donde se cargan las opciones: los nombres de todas las pc si estoy en "Laboratorios" o
de las pc del laboratorio donde estoy posicionado (lo mismo para las oficinas) junto con el nombre del incidente
  - Para eso uso las variables $tipo y $nro -->
<div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#a8cf64">Seleccionar incidente</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">


    <?php 
     
    $link=Conection();
    
    $sql=selectIncidentes('pendiente',$tipo,$nro);
   
    $result= mysql_query($sql,$link);
    
    $concatenado="";
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['nombre'].": ".$row['nombre_incid']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_close($link);
     ?>  
      
<!--       /* select para elegir la pc a modificar, con dos botones: Aceptar, que redirige a otra página
      para realizar la modificación y Cancelar que cierra la ventana emergente */ -->
      
    <form action="modificarIncidente.php?nivelUs=<?php echo $nivelUs ?>" method="post" >
    <div style="text-align: center"> <select name="lista_incid">
       <option selected value="0">Selecciona una opcion</option>
       <?php echo $concatenado; ?>
    </select>
    </div>
      <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
       <input id="btnAceptar" onclick="ocultarVentana();" type="submit" name="btnAceptar" size="20" type="button" value="Aceptar" />
       <input id="btnCancelar" onclick="ocultarVentana();" name="btnCancelar" size="20" type="button" value="Cancelar" />
     </div>
     
   </form>
   </p>
   </div>
   
   
</body>

</html>