

<html>
<title> Nuevo incidente </title>
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

 <meta charset="UTF-8">



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
           $("#fecha_ini").datepicker();
        });
        
        $(document).ready(function() {
           $("#fecha_fin").datepicker();
        });
        
 
 //funcion para ajustar dinámicamente el tamaño del textbox
    function ajustar() {
        var texto1=document.getElementById("nombreIncid");
        var texto2=document.getElementById("detalleIncid");
        var txt1=texto1.value;
        var txt2=texto2.value;
        var tamano1=txt1.length+5;
        var tamano2=txt2.length+5;
        tamano1*=3; //el valor multiplicativo debe cambiarse dependiendo del tamaño de la fuente
        tamano2*=3;
        texto1.style.height=tamano1+"px";
        texto2.style.height=tamano2+"px";
    }
    
    </script>
</head>
<?php
   include('encabezado.php');
   include('btncerrar.php');
   include('menu.php');
 
  
  $nivelUs=$_GET['nivelUs'];
  $tipo=$_GET["tipo"];
  $nro=$_GET["nro"];
  ?>
  
  <body>

  
  <?php
   
    $link=Conection();
    
  /*****************  Nombre PC ****************/ 

    $sql=selectNombres($tipo,$nro);
    $result= mysql_query($sql,$link);
	
	 $concatenado=""; 
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['nombre']."</option>"; //concatenamos
      }
 
   mysql_free_result($result);
    
   ?>

   <form action="confirmaIncidente.php?nivelUs=<?php echo $nivelUs ?>" method="post"  >
    <table class="table-fill" >
 <br>
    <br>
    <br>
    <caption><h3>Nuevo incidente</h3></caption>
   <tr>
   
   <td> <h4> PC: </h4></td>
    <td>
     <select name="lista_pc">
        <option selected value="0">Selecciona una PC</option>
        <?php echo $concatenado; ?>
    </select>
   </td>
   </tr>
    
   
   <!--  /*****************   INCIDENTE ****************/ -->
     
    <tr>
    
     <td> <h4> Incidente: </h4></td>
     <td>
       <textarea name="nombreIncid"  id="nombreIncid" onKeyUp="javascript:ajustar()" onfocus="this.value='';"> Incidente...</textarea>
     </td>
   
    </tr>
    
     <!--  /*****************   DETALLE ****************/ -->
    
 
    <tr>
    
     <td> <h4> Detalle: </h4></td>
     <td>
       <textarea name="detalleIncid" id="detalleIncid" onKeyPress="javascript:ajustar()" onfocus="this.value='';"> Descripción del incidente </textarea>
     </td>
   
  
    </tr>
    
  <!--  /*****************   Fecha inicio ****************/-->
 
   <tr>
     
     <td> <h4> Fecha inicio: </h4></td>
    
     <td>
      <label> Seleccionar Fecha:</label>
	   <input type="text" name="fecha_ini" id="fecha_ini" readonly="readonly" size="12" />
    </td>
  
   </tr>
    
    
  <!--  /*****************   Fecha fin ****************/ -->
    <tr>

     <td> <h4> Fecha fin: </h4></td>
    
     <td>
      <label> Seleccionar Fecha:</label>
	   <input type="text" name="fecha_fin" id="fecha_fin" readonly="readonly" size="12" />
    </td>
  
 
     </tr>
      <!--  /*****************   Componentes ****************/ --> 
     <tr>
     <td> <h4> Dar de baja componente (opcional): </h4></td>
  
    
    <?php  
     $componentes = array("Disco", "Fuente", "Memoria", "Monitor", "Microprocesador", "Placa madre");
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
   
        mysql_close($link);
    ?>
    
     
    </tr>
    
    </table>

   <div align="center"> 
  		<input name="boton1" type="submit" value="Guardar incidente" class="boton">
	</div>
 
 </form>
    
 
 
 
</body>
</html>