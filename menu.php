 <link href="css/styles.css" rel="stylesheet">
 <link href="css/font-awesome.min.css" rel="stylesheet">
    
<?php


$nivelUs=$_GET['nivelUs'];

include("conec_db.php");
include("functions.php");
$link=Conection();

$sqlL=listarLaboratorios();
$resultL= mysql_query($sqlL,$link);

$sqlO=listarOficinas();
$resultO= mysql_query($sqlO,$link);
 
?>
<nav>
        <ul>
             <li>
                <a href="#">
                    Inventario
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul>
                  <li>
                   <a href="#"> Laboratorios
                    <i class="fa fa-angle-right"></i>
                   </a>
                    <ul>
                     <li>  <a href="inventario.php?tipo=lab&nro=0&nivelUs=<?php echo $nivelUs ?>"><b>Todos</b></a> </li>
                     <?php    
					       while($rowL = mysql_fetch_array($resultL)){
					    	 $nro=$rowL['id_numero']; 
					    	   ?> 
					    	 
					    	 <li><a href="inventario.php?tipo=lab&nro=<?php echo $nro ?>&nivelUs=<?php echo $nivelUs ?>" >Laboratorio <?php echo $nro ?></a></li>
 											    
 					     <?php }
 					    
 					      if($nivelUs==1) { ?>
 					      <li><a href="nuevoLab_Ofi.php?tipo=lab&nivelUs=<?php echo $nivelUs ?>"><b>Agregar Laboratorio</b></a></li> 
 					   <?php }
 					    ?>
                  </ul>
                  </li>
					
					 
                  <li>
                   <a href="#"> Oficinas
                    <i class="fa fa-angle-right"></i>
                   </a>
                    <ul>
                     <li>  <a href="inventario.php?tipo=ofi&nro=0&nivelUs=<?php echo $nivelUs ?>"><b>Todas</b></a> </li>
                 	<?php 
					           while($rowO = mysql_fetch_array($resultO)){
					        	    $idOfi=$rowO['id'];
					    	       $nombre=$rowO['nombre']; ?> 
					    	    <li><a href="inventario.php?tipo=ofi&nro=<?php echo $idOfi ?>&nivelUs=<?php echo $nivelUs ?>" ><?php echo $nombre ?></a></li> 
 								
					       <?php }
 					         if($nivelUs==1) { ?>
 					       <li><a href="nuevoLab_Ofi.php?tipo=ofi&nivelUs=<?php echo $nivelUs ?>" ><b>Agregar oficina</b></a></li> 
 					        <?php }
 					         ?>
                  </ul>
                  </li>
                  
                     <li>
                   <a href="inventario.php?tipo=taller&nivelUs=<?php echo $nivelUs ?>"> Taller
                    
                   </a>
                   
                  </li>
					</ul>
				
            </li>
               <li>
                <a href="incidentes.php?estado=pendiente&nivelUs=<?php echo $nivelUs ?>">
                    Incidentes
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul>
                  <li>
                   <a href="#"> Laboratorios
                    <i class="fa fa-angle-right"></i>
                   </a>
                    <ul>
                     <li>  <a href="incidentes.php?tipo=lab&nro=0&nivelUs=<?php echo $nivelUs ?>" ><b>Todos</b></a> </li>
                     <?php    
                       $resultL= mysql_query($sqlL,$link);
                       while($rowL = mysql_fetch_array($resultL)){
					    	 $nro=$rowL['id_numero']; ?> 
					    	 <li><a href="incidentes.php?tipo=lab&nro=<?php echo $nro ?>&nivelUs=<?php echo $nivelUs ?>" >Laboratorio <?php echo $nro ?></a></li>
 											    
 					     <?php }
 					       ?>
                  </ul>
                  </li>
							 
                  <li>
                   <a href="#"> Oficinas
                    <i class="fa fa-angle-right"></i>
                   </a>
                    <ul>
                     <li>  <a href="incidentes.php?tipo=ofi&nro=0&nivelUs=<?php echo $nivelUs ?>" ><b>Todas</b></a> </li>
                 	<?php 
                 	   $resultO= mysql_query($sqlO,$link);
					           while($rowO = mysql_fetch_array($resultO)){
					        	    $idOfi=$rowO['id'];
					    	       $nombre=$rowO['nombre']; ?> 
					    	    <li><a href="incidentes.php?tipo=ofi&nro=<?php echo $idOfi ?>&nivelUs=<?php echo $nivelUs ?>"><?php echo $nombre?></a></li> 
 								
					       <?php } ?>
                  </ul>
                  </li>
                  
                  <li>
                   <a href="incidentes.php?tipo=taller&nivelUs=<?php echo $nivelUs ?>" > Taller
                    
                   </a>
                    
                  </li>
                  
					</ul>
				
            </li>
            
            <li>
                <a href="#">
                    Baja
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul>
                  <li><a href="baja.php?tipo=pcs&nivelUs=<?php echo $nivelUs ?>" >PC's</a> 
		    	  		<li><a href="baja.php?tipo=disco&nivelUs=<?php echo $nivelUs ?>" >Discos</a>  
				  		<li><a href="baja.php?tipo=fuente&nivelUs=<?php echo $nivelUs ?>" >Fuentes</a></li>
				  		<li><a href="baja.php?tipo=ram&nivelUs=<?php echo $nivelUs ?>" >Memorias</a></li>
				  		<li><a href="baja.php?tipo=procesador&nivelUs=<?php echo $nivelUs ?>" >Microprocesadores</a></li> 
			     		<li><a href="baja.php?tipo=monitor&nivelUs=<?php echo $nivelUs ?>r" >Monitores</a></li>
				  		<li><a href="baja.php?tipo=mother&nivelUs=<?php echo $nivelUs ?>" >Placas madres</a></li>
                </ul>
            </li>

          <?php if($nivelUs==1) { ?>
           <li>
              <a href="#"> 
                Usuario
                <i class="fa fa-angle-down"></i>
                </a>
                <ul>
                  <li><a href="cambiarClave.php?nivelUs=<?php echo $nivelUs ?>" >Cambiar contraseña</a>
                 </ul> 
           </li>
           <?php }?>
        </ul>
    </nav>
    <br>