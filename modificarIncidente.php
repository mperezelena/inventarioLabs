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

	<meta name="description" content="Demo de jQuery Data Picker" />
	<meta name="keywords" content="Demo, calendario, Data Picker" />
	<meta name="author" content="Mariana" />

	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
 	<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    

        $(document).ready(function() {
           $("#fechaFin").datepicker();
        });
        
 
 //funcion para ajustar dinámicamente el tamaño del textbox
    function ajustar() {
        var texto1=document.getElementById("nombreIncid");
         var texto2=document.getElementById("detalleIncid");
        var txt1=texto1.value;
         var txt2=texto2.value;
        var tamano1=txt1.length;
         var tamano2=txt2.length;
        //tamano*=2.1; //el valor multiplicativo debe cambiarse dependiendo del tamaño de la fuente
        texto1.style.height=tamano1+"px";
        texto2.style.height=tamano2+"px";
    }
    
 

function activar(l_str_input) {
document.getElementById(l_str_input).disabled = !document.getElementById(l_str_input).disabled;
   
}

</script>
</head>

<?php
  include('encabezado.php');
  include('btncerrar.php');
  include('menu.php');
  $nivelUs=$_GET['nivelUs'];
  ?>
  
  <body>

  <?php
    $idIncidente=$_POST['lista_incid'];
   
    $link=Conection();
    
    $sql=datosIncidente($idIncidente);  
    $result= mysql_query($sql,$link);
	
	 $nombre=""; //Primera opción del select
    $incidente="";
 	 $fecha_inicio="";
 	 $detalle="";
    while($row = mysql_fetch_array($result)){
     $nombrePc=$row['nombre'];
     $incidente=$row['nombre_incid'];
     $fecha_inicio=$row['fecha_inicio'];
     $detalle=$row['detalle'];
    }
    
    mysql_free_result($result);

    $sql2=idPc($nombrePc);
    $result= mysql_query($sql2,$link);
    $idPc=mysql_result($result,0);

 
     mysql_free_result($result);
 
   ?>
   
   <!-- /*****************  Nombre PC ****************/ -->
     

    <table class="table-fill">
    <br>
    <br>
    <br>
    <caption><h3>Modificar incidente</h3></caption>
   <tr>
    <td> <h4> Nombre PC: </h4></td>
     <td></td>
    <td> <h5> <?php echo $nombrePc; ?></h5></td>
   </tr>
    
   <!--  /*****************   INCIDENTE ****************/ -->
    
 
    <tr>
     <form action="confirmaModifIncid.php?idIncidente=<?php echo $idIncidente ?>&idPc=<?php echo $idPc ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
                
     <td> <h4> Incidente: </h4></td>
       <td>
     <input type="checkbox"  onclick="javascript:activar('nombreIncid');"  name="checkNombre" />
    </td>
    
     <td>
       <textarea name="nombreIncid" id="nombreIncid" onKeyUp="javascript:ajustar()" disabled="true" ><?php echo $incidente; ?></textarea>
     </td>
  

    </tr>
    
     <!--  /*****************   DETALLE ****************/ -->
    
 
    <tr>
   
     <td> <h4> Detalle: </h4></td>
    <td>
     <input type="checkbox"  onclick="javascript:activar('detalleIncid');"  name="checkDetalle" />
    </td>
     <td>
       <textarea name="detalleIncid" id="detalleIncid" onKeyUp="javascript:ajustar()" disabled="true" ><?php echo $detalle; ?> </textarea>
     </td>
   
    </tr>
    
  <!--  /*****************   Fecha inicio ****************/-->
 
   <tr>
    <td> <h4> Fecha inicio: </h4></td>
    <td></td>
    <td> <h5> <?php echo $fecha_inicio; ?></h5></td>
   </tr>
    
    
  <!--  /*****************   Fecha fin ****************/ -->
    <tr>
     <form action="" method="post">
     <td> <h4> Fecha fin: </h4></td>
    <td>
     <input type="checkbox"  onclick="javascript:activar('fechaFin');"  name="checkFechaFin" />
    </td>
    
     <td>
            	
           <label> Seleccionar Fecha:</label>
	       <input type="text" name="fechaFin" id="fechaFin" readonly="readonly" size="12" disabled="true" />
 
    </td>
  
    </tr>
    
  <!--  /*****************  Dar baja ****************/ -->
  <!--  /********  PC **********/ -->  
  <tr>
      <td> <h4> Dar de baja PC: </h4></td>
     <td>
        <input type="checkbox"  name="bajaPc" />
       </td>
  </tr> 
       
   
   <!--  /********   Componentes *********/ --> 
         
       
     <td> <h4> Dar de baja componente: </h4></td>
  
    <?php  
     $componentes = array("Disco", "Fuente", "Monitor", "Microprocesador", "Placa madre");
     $count = count($componentes);
     for ($i = 0; $i < $count; $i++) {
  
     ?>
      
     <td>
        <input type="checkbox"  name="lista_componentes[]" value="<?php echo $componentes[$i]; ?>"  /><?php echo $componentes[$i]; ?> 
       </td>
       </tr>  
       <tr>
        <td></td>
  <?php  
   }
    ?>
    
          <!-- *****************    RAM  **************** -->

   <?php
    $sql=ramPc($idPc); //Obtener los módulos ram de esa pc
    $result= mysql_query($sql,$link);
  ?>
 
   <?php  
    
     while($row = mysql_fetch_array($result)){ 
      $cant=$row['cantidad'];
      while($cant>0) {     
     ?>
      
     <td>

        <input type="checkbox"  name="lista_ram[]" value="<?php echo $row['id']; ?>"  /><?php echo "RAM: 1x ".$row['tamanio_mb']; ?> 
       </td>  
  <?php  
   $cant--;
     }   
    }
      mysql_free_result($result);
        mysql_close($link);
    ?>
    </tr>
   </table>
   
         <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Guardar cambios" class="boton">
     		
     		</div>
     		</form>
    

 
 
 
 
 
</body>
</html>