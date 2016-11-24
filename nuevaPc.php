<meta charset="UTF-8">
<link rel="stylesheet" href="css/central.css">
<html>
<title> Nueva PC </title>
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


 
<script type="text/javascript">

 //funcion para ajustar dinámicamente el tamaño del textbox
    function ajustar() {
        var texto1=document.getElementById("nombrePc");
         var texto2=document.getElementById("nroInventario");
        var txt1=texto1.value;
         var txt2=texto2.value;
        var tamano1=txt1.length;
         var tamano2=txt2.length;
        tamano1*=20; //el valor multiplicativo debe cambiarse dependiendo del tamaño de la fuente
        tamano2*=15;
        texto1.style.width=tamano1+"px";
        texto2.style.width=tamano2+"px";
    }
    
</script>

</head>
<?php
   include('encabezado.php');
    include('btncerrar.php');
 include('menu.php');

  $link=Conection();
  $tipo=$_GET["tipo"];
  $nivelUs=$_GET["nivelUs"];
  ?>
  
  <body>

  
    
    
    <!--/*****************   NOMBRE****************/ -->
   
    <form action="confirmaInsertarPc.php?tipo=<?php echo $tipo ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
    <table class="table-fill">
    <br>
    <br>
    <br>
    <caption><h3>Nueva PC</h3></caption>
   <tr>
   <td> <h4> Nombre: </h4></td>
     
   <td>
     <input type="text" name="nombrePc" id="nombrePc" onKeyUp="javascript:ajustar()" onfocus="this.value='';" value="Nombre">
   </td>
 
      </tr>
 
   <!--/*****************   NRO INVENTARIO ****************/ -->
   

   <tr>
   <td> <h4> Nro. de inventario: </h4></td>
     
   <td>
     <input type="text" name="nroInventario" id="nroInventario" onKeyUp="javascript:ajustar()" onfocus="this.value='';" value="Inventario">
   </td>
 
      </tr>
      
  <?php
    if($tipo==lab) {  
 // echo $tipo;
 /*****************   LABORATORIO ****************/
   
    $sql=listarLaboratorios(); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
       
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id_numero']."'>Laboratorio ".$row['id_numero']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
       
     ?>
    
   <tr>
   <td> <h4> Laboratorio: </h4></td>
     
   <td>
     <select id="lista_lab" name="lista_lab">
        <option selected value="0">Seleccionar laboratorio</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
 
    </tr>
    
    <?php } else if($tipo==ofi)  {
    /*<!-- *****************  OFICINA **************** -->*/
        $sql=listarOficinas(); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
       
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'> ".$row['nombre']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
       
     ?>
    
   <tr>
   <td> <h4> Oficina: </h4></td>
     
   <td>
     <select id="lista_lab" name="lista_lab">
        <option selected value="0">Seleccionar oficina</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
 
    </tr>
    
  <?php } ?>    
  <!-- *****************   DISCO **************** -->
  
   <?php 
    $sql=listarDiscos(); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
       
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['disco_fabricante']. " " . $row['disco_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
       
     ?>
    
   <tr>
   <td> <h4> Disco: </h4></td>
     
   <td>
     <select name="lista_disco">
        <option selected value="0">Seleccionar disco</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
 
     <td>
      <a href="nuevoComponente.php?componente=disco&nivelUs=<?php echo $nivelUs ?>"> Agregar nuevo disco</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>


 <!-- /**********************************************/ -->
 
 <!-- *****************   FUENTE **************** -->
   <?php
    $sql=listarFuentes();  //Obtener todos las fuentes

	 $result= mysql_query($sql,$link);
       
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['fuente_fabricante']." ".$row['watts']." watts"."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
      
     ?>
    

      <tr>
   <td> <h4> Fuente: </h4></td>
     
   <td>
     <select name="lista_fuente">
       <option selected value="0">Seleccionar fuente</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
      <td>
      <a href="nuevoComponente.php?componente=fuente&nivelUs=<?php echo $nivelUs ?>"> Agregar nueva fuente</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>



 <!-- /**********************************************/ -->
 
 
  <!-- *****************   MONITOR **************** -->
   <?php
   if($tipo!='taller') {
    $sql=listarMonitores(); //Obtener todos los modelos de monitor

	 $result= mysql_query($sql,$link);

    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['monitor_fabricante']." ".$row['monitor_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
 
    ?>

      <tr>
     <td> <h4> Monitor: </h4></td>
      <td>
     <select name="lista_mon">
       <option selected value="0">Seleccionar monitor</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
     <td>
      <a href="nuevoComponente.php?componente=monitor&nivelUs=<?php echo $nivelUs ?>"> Agregar nuevo monitor</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
 
 <?php } ?>

 <!-- /**********************************************/ -->
 
      
   <!-- /*****************   MOTHER ****************/ -->
    <?php
    
    $sql=listarMothers(); //Obtener todos los modelos de mother
	 $result= mysql_query($sql,$link);
 
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['mother_fabricante']." ".$row['mother_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
   
     ?>
    
  <tr>
   <td> <h4> Mother: </h4></td>
     
   <td>
     <select name="lista_mother">
       <option selected value="0">Seleccionar mother</option>
       <?php echo $concatenado; ?>
    </select>
   </td>

     <td>
      <a href="nuevoComponente.php?componente=mother&nivelUs=<?php echo $nivelUs ?>"> Agregar nueva mother</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
  

  
  <!-- ********************************************** -->


 <!-- *****************   PROCESADOR **************** -->
   <?php
   
    $sql=listarProcesadores(); //Obtener todos los modelos de procesador
 
    $result= mysql_query($sql,$link);
    
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['procesador_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     ?>
    

      <tr>
   <td> <h4> Procesador: </h4></td>
     
   <td>
     <select name="lista_proc">
       <option selected value="0">Seleccionar procesador</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
   
     <td>
      <a href="nuevoComponente.php?componente=procesador&nivelUs=<?php echo $nivelUs ?>"> Agregar nuevo procesador</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
 


 <!-- /**********************************************/ -->
 

 
 <!-- *****************    RAM  **************** -->
 <?php
   $sql=listarRam(); //Obtener todos las ram que pueden ser conectadas a esa pc (mismo tipo de banco)
   $result= mysql_query($sql,$link);
 
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".strtoupper($row['tipo']).": ".$row['tamanio_mb']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);

    
     ?>
    
 
     <table class="table-fill">
      <tr>
   <td> <h4> RAM: </h4></td> 
   <td> </td>
   <td>
    <input type="text" name="cantidad1" onfocus="this.value='';" value="Cantidad" >
   </td>
   <td>
     <select name="lista_ram1">
      <option selected value="0">Tamaño (Mb)</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
  
     <td>
      <a href="nuevoComponente.php?componente=ram&nivelUs=<?php echo $nivelUs ?>"> Agregar nueva ram</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
   <tr>
   
   <td> </td> 
   <td> </td>
   <td>
    <input type="text" name="cantidad2" onfocus="this.value='';" value="Cantidad" >
   </td>
   <td>
     <select name="lista_ram2">
      <option selected value="0">Tamaño (Mb)</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
  
    </tr>
    </table>
    
    <!-- *****************   Sistemas operativos **************** -->
   <?php
   
    $sql=listarSO(); //Obtener todos los sistemas operativos
    $result= mysql_query($sql,$link);
    
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['nombre']. " " . $row['version']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
          mysql_close($link);
     ?>
    
     <table class="table-fill">
      <tr>

   <td> <h4> Sistemas <br> operativos: </h4></td>
     
   <td>
     <select name="lista_so1">
       <option selected value="0">Seleccionar S.O.</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
   
     <td>
      <a href="nuevoComponente.php?componente=so&nivelUs=<?php echo $nivelUs ?>"> Agregar nuevo S.O.</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
    
    <tr>
      <td></td>
         
       <td>
     <select name="lista_so2">
       <option selected value="0">Seleccionar S.O.</option>
       <?php echo $concatenado; ?>
    </select>
   </td>    
    </tr>
 
   <!-- *****************   Internet **************** -->
 <?php 
 if($tipo!='taller') { ?>
    <tr>
   <td> <h4> Tiene internet: </h4></td>
     
   <td>
     <select id="lista_red" name="lista_red">
        <option selected value="0">Seleccionar opción</option>
        <option value=1>SI</option>
        <option value=2>NO</option>

    </select>
   </td>
 
    </tr>
    <?php } ?>
 
  </table>
   
 	     <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Guardar PC" class="boton">
     		
     		</div>
     		</form>
     		


</body>
</html>