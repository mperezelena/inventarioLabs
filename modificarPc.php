<html>
<head>
<title>Modificar PC</title>
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
 
<script type="text/javascript">
function activar(l_str_input) {
document.getElementById(l_str_input).disabled = !document.getElementById(l_str_input).disabled;
}

 //funcion para ajustar dinámicamente el tamaño del textbox
    function ajustar() {
       
         var texto2=document.getElementById("nroInventario");
       
         var txt2=texto2.value;
       
         var tamano2=txt2.length;
       //el valor multiplicativo debe cambiarse dependiendo del tamaño de la fuente
        tamano2*=20;
       
        texto2.style.width=tamano2+"px";
    }

</script>

</head>
<?php
 include('encabezado.php');
 include('menu.php');
  $idPc=$_POST['lista_pc'];
  $link=Conection();
  $nivelUs=$_GET['nivelUs'];
  $tipo=$_GET['tipo'];
  ?>
  
  <body>

  <?php
   
    /*****************   NOMBRE****************/
    $sql=nombrePc($idPc);  //Obtener nombre de la PC con id=$idPc
	 $result= mysql_query($sql,$link);
	
	 $texto=mysql_result($result,0);
  
    ?>
    
   <form action="confirmaModifPc.php?idPc=<?php echo $idPc ?>&tipo=<?php echo $tipo ?>&nivelUs=<?php echo $nivelUs ?>" method="post">
    <table class="table-fill">
    <br>
    <br>
    <br>
    <br>
    <caption><h4>Modificar PC</h4></caption>
   <tr>
   <td> <h4> Nombre: </h4></td>
     
    <td>
     <input type="checkbox"  onclick="javascript:activar('nombrePc');"  name="checkNombre" />
    </td>
     
       <td>
     <input type="text"  id="nombrePc" name="nombrePc"  value="<?php echo $texto; ?>" disabled="true" />


     </td>
    
      </tr>
    

 <!-- /*****************   NRO INVENTARIO ****************/ -->
   <?php 
    $sql=nroInventarioPc($idPc);  //Obtener nombre de la PC con id=$idPc
	 $result= mysql_query($sql,$link);
	
	 $texto=mysql_result($result,0);
  
    ?>
    

   <tr>
    <td> <h4> Nro. inventario: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('nroInventario');"  name="checkInventario" />
   </td>
     
   <td>
     <input type="text" id="nroInventario" name="nroInventario" onKeyUp="javascript:ajustar()" value="<?php echo $texto; ?>"  disabled="true" />
  </td>
    
      </tr>
   
      <!-- *****************   LABORATORIO **************** -->
    <?php
    if($tipo==lab) {  

   
    $sql=laboratorioPc($idPc);  //Obtener el modelo de disco de la PC con id=$idPc
    $sql2=listarLaboratorios($idPc); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id_laboratorio']."'>Laboratorio ".$row['id_laboratorio']."</option>";
    }
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id_numero']."'>Laboratorio ".$row2['id_numero']."</option>";//concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);
    
     $concatenado.= " <option value=0>Taller</option>";
     ?>
    

      <tr>
   <td> <h4> Laboratorio: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_lab');"  name="checkLab" />
   </td> 
     
   <td>
     <select id="lista_lab" name="lista_lab" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>

    </tr>
    
     <!-- *****************  OFICINA **************** -->
    <?php } elseif($tipo==ofi) {
   
    $sql=oficinaPc($idPc);  //Obtener el modelo de disco de la PC con id=$idPc
    $sql2=listarOficinas($idPc); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id_numero']."'>".$row['nombre']."</option>";
    }
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id_numero']."'>".$row2['nombre']."</option>";//concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);
     
      $concatenado.= " <option value=0>Taller</option>";
     ?>
    

      <tr>
   <td> <h4> Oficina: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_ofi');"  name="checkOfi" />
   </td> 
     
   <td>
     <select id="lista_ofi" name="lista_ofi" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>

    </tr>
<?php } ?>

 <!-- /**********************************************/ -->
      
  <!-- *****************   DISCO **************** -->
   <?php
    $sql=discoPc($idPc);  //Obtener el modelo de disco de la PC con id=$idPc
    $sql2=listarDiscos($idPc); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id']."'>".$row['disco_fabricante']." ".$row['disco_modelo']."</option>";
    }
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id']."'>".$row2['disco_fabricante']." ".$row2['disco_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);
     
     ?>
    

      <tr>
   <td> <h4> Disco: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_disco');"  name="checkDisco" />
   </td> 
     
   <td>
     <select id="lista_disco" name="lista_disco" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>

     <td>
      <a href="nuevoComponente.php?componente=disco"> Agregar nuevo disco</a>
      </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
 


 <!-- /**********************************************/ -->
 
 <!-- *****************   FUENTE **************** -->
   <?php
    $sql=fuentePc($idPc);  //Obtener el modelo de disco de la PC con id=$idPc
    $sql2=listarFuentes($idPc); //Obtener todos los modelos de disco

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id']."'>".$row['fuente_fabricante']." ".$row['watts']." watts"."</option>";
    }
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id']."'>".$row2['fuente_fabricante']." ".$row2['watts']." watts"."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);
     
     ?>
    

      <tr>
   <td> <h4> Fuente: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_fuente');"  name="checkFuente" />
   </td> 
   
   <td>
     <select id="lista_fuente" name="lista_fuente" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>
 
     <td>
      <a href="nuevoComponente.php?componente=fuente"> Agregar nueva fuente</a>
      </td> 
        </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
    </tr>



 <!-- /**********************************************/ -->
 
 
  <!-- *****************   MONITOR **************** -->
<?php
    $sql=monitorPc($idPc);  //Obtener el modelo de monitor de la PC con id=$idPc
    $sql2=listarMonitores($idPc); //Obtener todos los modelos de monitor

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id']."'>".$row['monitor_fabricante']." ".$row['monitor_modelo']."</option>";
    }
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id']."'>".$row2['monitor_fabricante']." ".$row2['monitor_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);

     
     ?>

    <tr>
     <td> <h4> Monitor: </h4></td>

   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_mon');"  name="checkMonitor" />
   </td> 
   
     <td>
     <select id="lista_mon" name="lista_mon" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>
   <td>
      <a href="nuevoComponente.php?componente=monitor"> Agregar nuevo monitor</a>
      </td> 

     </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
    </tr>


 <!-- /**********************************************/ -->
 
      
   <!-- /*****************   MOTHER ****************/ -->
    <?php
    $sql=motherPc($idPc);  //Obtener el modelo de mother de la PC con id=$idPc
    $sql2=listarMothers($idPc); //Obtener todos los modelos de mother

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id']."'>".$row['mother_fabricante']." ".$row['mother_modelo']."</option>";
    }
    
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id']."'>".$row2['mother_fabricante']." ".$row2['mother_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);
    
     ?>
    


   <tr>
   <td> <h4> Mother: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_mother');"  name="checkMother" />
   </td> 
   
   <td>
     <select id="lista_mother" name="lista_mother" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>
  
     <td>
      <a href="nuevoComponente.php?componente=mother"> Agregar nueva mother</a>
      </td> 
     </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
    </tr>
  

  
  <!-- ********************************************** -->


 <!-- *****************   PROCESADOR **************** -->
   <?php
    $sql=procesadorPc($idPc);  //Obtener el modelo de procesador de la PC con id=$idPc
    $sql2=listarProcesadores($idPc); //Obtener todos los modelos de procesador
    
	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0=""; //Primera opción del select
    while($row = mysql_fetch_array($result)){
    $opcion0 .=" <option value='".$row['id']."'>".$row['procesador_modelo']."</option>";
    }
       
    $concatenado=""; //El resto de la lista select
    while($row2 = mysql_fetch_array($result2))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row2['id']."'>".$row2['procesador_modelo']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);
     mysql_free_result($result2);
     
     ?>
    

      <tr>
   <td> <h4> Procesador: </h4></td>

    <td>
    <input type="checkbox"  onclick="javascript:activar('lista_proc');"  name="checkProcesador" />
   </td> 
   
   <td>
     <select id="lista_proc" name="lista_proc" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>

     <td>
      <a href="nuevoComponente.php?componente=procesador"> Agregar nuevo procesador</a>
      </td> 
     </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
    </tr>
    </table>


 <!-- /**********************************************/ -->
 

 
 <!-- *****************    RAM  **************** -->
  <!-- *****************  Agregar  **************** -->
   <?php
   $sql=listarRam(); //Obtener todos las ram que pueden ser conectadas a esa pc (mismo tipo de banco)
   $result= mysql_query($sql,$link);
 
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['tipo'].": ".$row['tamanio_mb']."</option>"; //concatenamos
      }
    
     mysql_free_result($result);

     
     ?>
    

     <table class="table-fill">
      <tr>
   <td> <h4> RAM: </h4></td> 
   <td> <h5> Agregar: </h5></td>
   <td>
     <input type="checkbox"  onclick="javascript:activar('cantidad1');javascript:activar('lista_ram1')"  name="checkRam1" />
   </td>  
 
   <td>
    <input type="text" id="cantidad1" name="cantidad1"  onfocus="this.value='';" value="Cantidad"  disabled="true">
   </td>
   
   <td>
    <select id="lista_ram1" name="lista_ram1" disabled="true">
      <option selected value="0">Tamaño (Mb)</option>
       <?php echo $concatenado; ?>
    </select>
   </td>

     <td>
      <a href="nuevoComponente.php?componente=ram"> Agregar nueva RAM</a>
      </td> 
     
      <td><a href="javascript:location.reload()">Actualizar</a></td>
    </tr>
    
    <tr>
        <td></td>
        <td></td>
           <td>
     <input type="checkbox"  onclick="javascript:activar('cantidad2');javascript:activar('lista_ram2')"  name="checkRam2" />
   </td>  
 
   <td>
    <input type="text" id="cantidad2" name="cantidad2" onfocus="this.value='';" value="Cantidad"  disabled="true">
   </td>
   
   <td>
    <select id="lista_ram2" name="lista_ram2" disabled="true">
      <option selected value="0">Tamaño (Mb)</option>
       <?php echo $concatenado; ?>
    </select>
   </td>
            
    </tr>
    


  
   <!-- *****************    RAM  **************** -->
  <!-- *****************  Eliminar  **************** -->
   <?php
    $sql=ramPc($idPc); //Obtener los módulos ram de esa pc
    $result= mysql_query($sql,$link);
  ?>
 
  <tr>
   <td> </td> 
   <td> <h5> Eliminar: </h5></td>
  
    <td>
  
   </td> 
    
    <?php  
     while($row = mysql_fetch_array($result)){ 
      $cant=$row['cantidad'];
      while($cant>0) {     
     ?>
      
     <td>
        <input type="checkbox"  name="lista_ramElim[]" id="lista_ramElim[]" value="<?php echo $row['id']; ?>"  /><?php echo "1x ".$row['tamanio_mb']; ?> 
       </td>  
  <?php  
   $cant--;
     }   
    }
      mysql_free_result($result);
      
    ?>
    
     
    </tr>
    </table>
   

  
     
 <!-- /**********************************************/ -->
 
   <!-- /*****************   Sistemas operativos ****************/ -->
    <?php
    $sql=soPc($idPc);  //Obtener los SO de la Pc
    $sql2=listarSO($idPc); //Obtener todos los sistemas operativos distintos a los de la pc

	 $result= mysql_query($sql,$link);
    $result2= mysql_query($sql2,$link);
    
    $opcion0_1=""; //Primera opción del select 1
    $row1 =mysql_fetch_array($result); //primera fila del resultado de la consulta
    $row2 =mysql_fetch_array($result); //segunda fila del resultado de la consulta
  
    $opcion0_1 .=" <option value='".$row1['id']."'>".$row1['nombre']. " " .$row1['version']."</option>"; //opción por defecto del primer select
           
    $concatenado=""; //El resto de la lista select 1
    while($row = mysql_fetch_array($result2))
    
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>".$row['nombre']. " " .$row['version']."</option>"; //concatenamos
      }
   
    
    if ($row2) { //si hay una segunda fila armo la opción por defecto del segundo select
    	$opcion0_2=""; //Primera opción del select 2
       $opcion0_2 .=" <option value='".$row2['id']."'>".$row2['nombre']. " " .$row2['version']."</option>";
     }
    
    
     mysql_free_result($result);
     mysql_free_result($result2);
    
    
     ?>
    
     <table class="table-fill">

   <tr>
   <td></td>
   <td> <h4> <br> Sistemas <br> operativos: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_so1');"  name="checkSo1" />
   </td> 
   
   <td>
     <select id="lista_so1" name="lista_so1" disabled="true">
       <?php echo $opcion0_1; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>
  
     <td>
      <a href="nuevoComponente.php?componente=so"> Agregar nuevo S.O.</a>
      </td> 
     </td> 
      <td><a href="javascript:location.reload()">Actualizar</a></td>
      
      <td>
       <input type="text"  id="soAnterior1" name="soAnterior1" value="<?php echo $row1['id']; ?>" style="display:none;" />
      </td>
    </tr>
    
    <?php if($row2) {?>
    <tr>
     <td></td>
     <td></td>
        <td>
    <input type="checkbox"  onclick="javascript:activar('lista_so2');"  name="checkSo2" />
   </td> 
   
   <td>
     <select id="lista_so2" name="lista_so2" disabled="true">
       <?php echo $opcion0_2; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>
        <td>
       <input type="text"  id="soAnterior2" name="soAnterior2" value="<?php echo $row2['id']; ?>" style="display:none;" />
      </td>
    </tr> <?php } 
    
   
   /**********************************************/
 
 /*****************  Internet ****************/ 
    $sql=redPc($idPc);  
    $result= mysql_query($sql,$link);
    $enRed=mysql_result($result,0);
    $concatenado="";    
    if($enRed==NULL) {
      $opcion0="<option selected value=2>Sin definir</option>";
      $concatenado .= "<option value=1>SI</option>" . "<option value=0>NO</option>";  
    }
    elseif($enRed==0) {
      $opcion0="<option value=0>NO</option>";
      $concatenado = "<option value=1>SI</option>";  
    }
    else {
     $opcion0="<option selected value=1>SI</option>";
     $concatenado = "<option value=0>NO</option>";  
    }
    
    mysql_free_result($result);
    mysql_free_result($result2);
    
     ?>

      <tr>
      <td></td>
   <td> <h4> Tiene internet: </h4></td>
     
   <td>
    <input type="checkbox"  onclick="javascript:activar('lista_red');"  name="checkRed" />
   </td> 
     
   <td>
     <select id="lista_red" name="lista_red" disabled="true">
       <?php echo $opcion0; ?>
       <?php echo $concatenado; ?>
    </select>
   </td>

    </tr>
    
      </table>
  

  
  <!-- ********************************************** -->
  
     <div align="center"> 
  			
       		<input name="boton1" type="submit" value="Guardar cambios" class="boton">
     		
     		</div>
     		</form>
 
</body>
</html>