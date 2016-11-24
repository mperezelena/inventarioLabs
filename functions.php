<?php

/********** USUARIO Y CLAVE ********/
function existeUsuario($usuario){
 $sql="SELECT nombre FROM usuario WHERE nombre='$usuario'";
 return $sql;
}

function comprobarClave($usuario,$clave){
 $sql="SELECT id, id_nivel FROM usuario WHERE nombre='$usuario' AND clave='$clave'";
 return $sql;
} 

  /* FUNCIÓN QUE LISTA TODAS LAS PC DE TODOS LOS LABORATORIOS SI NO LE PASAN PARÁMETROS
      O SOLO LAS DEl LABORATORIO INDICADO COMO PARÁMETRO*/
 function inventarioLab($id_lab){
if($id_lab==0) {
$sql= "SELECT pc.id, pc.nombre, pc.nro_inventario, pc.en_incidente, pc.red,m.mother_fabricante, m.mother_modelo, m.cant_bancos, m.tipo_bancos, m.socket, m.version_bios,  p.procesador_fabricante, p.procesador_modelo, p.frecuencia, d.disco_fabricante, d.disco_modelo, d.capacidad_gb, f.fuente_fabricante, f.watts, mt.monitor_fabricante,mt.monitor_modelo,mt.pulgadas
					FROM pc
					INNER JOIN mother m
					INNER JOIN disco d
					INNER JOIN fuente f
					INNER JOIN monitor mt
					INNER JOIN procesador p
					WHERE pc.id_mother = m.id
					AND pc.id_disco = d.id
					AND pc.id_fuente = f.id
					AND pc.id_procesador = p.id
			      AND pc.baja=0
			      AND pc.id_monitor=mt.id
					AND pc.id_laboratorio!='NULL'
					GROUP BY pc.id
					ORDER BY pc.nombre";
		}
		else {
		 $sql= "SELECT pc.id, pc.nombre, pc.nro_inventario, pc.en_incidente, pc.red, m.mother_fabricante, m.mother_modelo, m.cant_bancos, m.tipo_bancos, m.socket, m.version_bios,  p.procesador_fabricante, p.procesador_modelo, p.frecuencia, d.disco_fabricante, d.disco_modelo, d.capacidad_gb, f.fuente_fabricante, f.watts, mt.monitor_fabricante,mt.monitor_modelo,mt.pulgadas 
					FROM pc
					INNER JOIN mother m
					INNER JOIN disco d
					INNER JOIN fuente f
					INNER JOIN monitor mt
					INNER JOIN procesador p
					WHERE pc.id_mother = m.id
					AND pc.id_disco = d.id
					AND pc.id_fuente = f.id
					AND pc.id_procesador = p.id
					AND pc.baja=0
					AND pc.id_monitor=mt.id
					AND pc.id_laboratorio=$id_lab
					GROUP BY pc.id
					ORDER BY pc.nombre"; 
}

  return $sql;
}
  

        

  /* FUNCIÓN QUE LISTA TODAS LAS PC DE TODOS LAS OFICINAS SI NO LE PASAN PARÁMETROS
      O SOLO LAS DE LA OFICINA INDICADA COMO PARÁMETRO*/
 function inventarioOfi($id_ofi){
 	if($id_ofi==0) {
          $sql=  "SELECT pc.id, pc.nombre, pc.nro_inventario, pc.en_incidente, pc.red, m.mother_fabricante, m.mother_modelo, m.cant_bancos, m.tipo_bancos, m.socket, m.version_bios,  p.procesador_fabricante, p.procesador_modelo, p.frecuencia, d.disco_fabricante, d.disco_modelo, d.capacidad_gb, f.fuente_fabricante, f.watts, mt.monitor_fabricante,mt.monitor_modelo,mt.pulgadas 
					FROM pc
					INNER JOIN mother m
					INNER JOIN disco d
					INNER JOIN fuente f
					INNER JOIN monitor mt
					INNER JOIN procesador p
					WHERE pc.id_mother = m.id
					AND pc.id_disco = d.id
					AND pc.id_fuente = f.id
					AND pc.id_procesador = p.id
					AND pc.baja=0
					AND pc.id_oficina!='NULL'
					GROUP BY pc.id
					ORDER BY pc.nombre"; 
				}
				else {
					$sql= "SELECT pc.id, pc.nombre, pc.nro_inventario, pc.en_incidente,pc.red, m.mother_fabricante, m.mother_modelo, m.cant_bancos, m.tipo_bancos, m.socket, m.version_bios,  p.procesador_fabricante, p.procesador_modelo, p.frecuencia, d.disco_fabricante, d.disco_modelo, d.capacidad_gb, f.fuente_fabricante, f.watts, mt.monitor_fabricante,mt.monitor_modelo,mt.pulgadas 
					FROM pc
					INNER JOIN mother m
					INNER JOIN disco d
					INNER JOIN fuente f
					INNER JOIN monitor mt
					INNER JOIN procesador p
					WHERE pc.id_mother = m.id
					AND pc.id_disco = d.id
					AND pc.id_fuente = f.id
					AND pc.id_procesador = p.id
					AND pc.baja=0
					AND pc.id_oficina=$id_ofi
					GROUP BY pc.id
					ORDER BY pc.nombre";
				}
				return $sql;
} 


 /* FUNCIÓN QUE LISTA TODAS LAS PC DE TODOS LOS LABORATORIOS SI NO LE PASAN PARÁMETROS
      O SOLO LAS DEl LABORATORIO INDICADO COMO PARÁMETRO*/
 function inventarioTaller(){

$sql= "SELECT pc.id, pc.nombre, pc.nro_inventario, pc.en_incidente, pc.red,m.mother_fabricante, m.mother_modelo, m.cant_bancos, m.tipo_bancos, m.socket, m.version_bios,  p.procesador_fabricante, p.procesador_modelo, p.frecuencia, d.disco_fabricante, d.disco_modelo, d.capacidad_gb, f.fuente_fabricante, f.watts, mt.monitor_fabricante,mt.monitor_modelo,mt.pulgadas
					FROM pc
					INNER JOIN mother m
					INNER JOIN disco d
					INNER JOIN fuente f
					INNER JOIN monitor mt
					INNER JOIN procesador p
					WHERE pc.id_mother = m.id
					AND pc.id_disco = d.id
					AND pc.id_fuente = f.id
					AND pc.id_procesador = p.id
			      AND pc.baja=0
			      AND pc.id_monitor=mt.id
					AND pc.en_taller=1
					GROUP BY pc.id
					ORDER BY pc.nombre";
  return $sql;
}
  
  
 /**** Cantidad de PC de lab u ofi *****/  
function cantidadPc($tipo,$nro) {
	if($nro==0) {
		   $sql="SELECT COUNT(*) FROM pc WHERE id_laboratorio !='NULL'
              AND baja =0 AND en_incidente =0 ";
		    }
		    else { 
		       $sql="SELECT COUNT(*) FROM pc WHERE id_laboratorio=$nro
              AND baja =0 AND en_incidente =0 "; }
       
  return $sql;
 }
 
/********** Listar PCs que están para baja ********/
function listarPcBaja() {
  $sql="SELECT id, nombre, nro_inventario FROM pc WHERE baja=1";
  return $sql;
 }
 
 /********** Listar componentes que están para baja ********/
function listarCompBaja($componente) {
	if($componente=='disco') {
     $sql="SELECT id, disco_modelo, cant_baja FROM disco WHERE cant_baja>0"; }
    if($componente=='monitor') {
     $sql="SELECT id, monitor_modelo, cant_baja FROM monitor WHERE cant_baja>0"; }
    if($componente=='mother') {
     $sql="SELECT id, mother_modelo, cant_baja FROM mother WHERE cant_baja>0"; }
    if($componente=='procesador') {
     $sql="SELECT id, procesador_modelo, cant_baja FROM procesador WHERE cant_baja>0"; }
    elseif($componente=='fuente') {
     $sql="SELECT id, fuente_fabricante, watts, cant_baja FROM fuente WHERE cant_baja>0";    
    }
    elseif($componente=='ram') {
     $sql="SELECT id, tipo, tamanio_mb, cant_baja FROM ram WHERE cant_baja>0";    
    }
  
  return $sql;
 }

    ////////////********** ELIMINACIONES **********//////////////  
/********** Eliminar PC ********/  
function eliminarPc($nombrePc) {
  $sql="DELETE FROM pc WHERE nombre='$nombrePc'";
  return $sql;
}

function eliminarPcId($id){
   $sql="DELETE FROM pc WHERE id=$id";
  return $sql;
}

/********** Eliminar disco ********/  
function eliminarDisco($id) {
  $sql="UPDATE disco SET cant_baja=cant_baja-1 WHERE id=$id";
  return $sql;
}

/********** Eliminar fuente ********/  
function eliminarFuente($id) {
  $sql="UPDATE fuente SET cant_baja=cant_baja-1 WHERE id=$id";
  return $sql;
}

/********** Eliminar monitor ********/  
function eliminarMonitor($id) {
  $sql="UPDATE monitor SET cant_baja=cant_baja-1 WHERE id=$id";
  return $sql;
}

/********** Eliminar mother ********/  
function eliminarMother($id) {
  $sql="UPDATE mother SET cant_baja=cant_baja-1 WHERE id=$id";
  return $sql;
}

/********** Eliminar procesador ********/  
function eliminarProcesador($id) {
  $sql="UPDATE procesador SET cant_baja=cant_baja-1 WHERE id=$id";
  return $sql;
}

/********** Eliminar ram ********/  
function eliminarRam($id) {
  $sql="UPDATE ram SET cant_baja=cant_baja-1 WHERE id=$id";
  return $sql;
}



/********** Eliminar todos registros de la tabla pc_ram con el id_pc=$idPc ********/  
function eliminarRamPc($idPc) {
  $sql="DELETE FROM pc_ram WHERE id_pc=$idPc";
  return $sql;
}

/********** Eliminar todos registros de la tabla pc_so con el id_pc=$idPc ********/  
function eliminarSoPc($idPc) {
  $sql="DELETE FROM pc_so WHERE id_pc=$idPc";
  return $sql;
}


/********** Decrementar en 1 la cantidad de modulos con el id $idRam de la pc $idPc ********/  
function decrementarRamPc($idPc, $idRam) {
     $sql="UPDATE pc_ram SET cantidad=cantidad-1 WHERE id_pc=$idPc AND id_ram=$idRam"; 
  return $sql;
}


/********** Eliminar incidentes de la pc pasada por parametro ********/  
function eliminarIncidentesPc($idPc) {
  $sql="DELETE FROM incidente WHERE id_pc=$idPc";
  return $sql;
}


 /* Listar los nombres e id de todas las PC del laboratorio u oficina pasado por parámetro, para armar la lista select*/
function selectNombres($tipo,$nro) {
 
 if($tipo=='lab' && $nro==0) {  
      $sql="SELECT id, nombre FROM pc WHERE pc.id_laboratorio!='NULL' AND pc.baja=0 ORDER BY nombre"; }
        elseif($tipo=='lab') {
        	 $sql="SELECT id, nombre FROM pc WHERE pc.id_laboratorio=$nro AND pc.baja=0 ORDER BY nombre";  }
           elseif($tipo=='ofi' && $nro==0) {     
              $sql="SELECT id,nombre FROM pc WHERE pc.id_oficina!='NULL' AND pc.baja=0 ORDER BY nombre"; }
                elseif($tipo=='ofi') {
                	 $sql="SELECT id,nombre FROM pc WHERE pc.id_oficina=$nro AND pc.baja=0 ORDER BY nombre";  
                }
                 elseif($tipo="") {   //si $tipo es igual a "" listo todas las pc (lab y ofi)
                    $sql="SELECT id,nombre FROM pc WHERE pc.baja=0 ORDER BY nombre";                 
                 }
                 else{
                   $sql="SELECT id,nombre FROM pc WHERE pc.en_taller=1 ORDER BY nombre"; 
                 }
                return $sql;
        }
        
 /* Obtener el nombre de la PC paracargar el textbox*/    
function nombrePc($idPc) {
  $sql="SELECT nombre FROM pc WHERE pc.id=$idPc";
   return $sql;
}

 /* Obtener el id de la PC a partir del nombre*/    
function idPc($nombrePc) {
  $sql="SELECT id FROM pc WHERE pc.nombre='$nombrePc'";
   return $sql;
}


/* Obtener el id de la PC a partir del id de incidente*/    
function idPcIncid($idIncidente) {
  $sql="SELECT id_pc FROM incidente WHERE incidente.id=$idIncidente";
   return $sql;
}


/* Funcion para verificar si ya existe ese nombre de PC*/  
function verificarNombre($nombrePc) {
  $sql="SELECT nombre FROM pc WHERE nombre='$nombrePc' AND baja=0";
  return $sql;
}


 /* Obtener el nombre de la PC paracargar el textbox*/    
function nroInventarioPc($idPc) {
  $sql="SELECT nro_inventario FROM pc WHERE pc.id=$idPc";
   return $sql;
}


/* Funcion para verificar si ya existe ese nro de inventario*/  
function verificarNroInv($nroInventario) {
  $sql="SELECT nro_inventario FROM pc WHERE nro_inventario='$nroInventario'";
  return $sql;
}


/* Obtener el id del laboratorio de la pc*/
function obtenerIdLab($idPc){
  $sql="SELECT id_laboratorio FROM pc WHERE id=$idPc";
  return $sql;
} 


 /*********************** LABORATORIOS ************************/
 function laboratorioPc($idPc) {
     $sql="SELECT id_laboratorio FROM pc
            WHERE pc.id=$idPc";  
            
     return $sql; 
   }
   
 function listarLaboratorios($idPc) {
  if($idPc!="") {
    $sql="SELECT id_numero
			  FROM laboratorio
				WHERE id_numero != ( SELECT pc.id_laboratorio FROM pc WHERE pc.id =$idPc ) 
					ORDER BY id_numero";  }
     else {
	    $sql="SELECT id_numero
			  FROM laboratorio
				ORDER BY  id_numero";} 
	return $sql;		
	}
 

				
 /** se usa para verificar si ya existe el lab **/
 function verificarNumeroLab($nroLab){
  $sql="SELECT id_numero FROM laboratorio WHERE id_numero=$nroLab";
  return $sql;
}


 /*********************** OFICINAS ************************/
 
 function listarOficinas($idPc) {
   if($idPc!="") {
    $sql="SELECT id, nombre
			  FROM oficina
				WHERE id != ( SELECT pc.id_oficina FROM pc WHERE pc.id =$idPc ) 
					ORDER BY nombre";  }
     else {
	    $sql="SELECT id,nombre
			  FROM oficina
				ORDER BY nombre";} 
   return $sql; 
 } 
 
     /** se usa para verificar si ya existe la ofi **/
 function verificarNombreOfi($nombre){
  $sql="SELECT nombre FROM oficina WHERE nombre='$nombre'";
  return $sql;
}

  /*********************** DISCO ************************/     
  /* Obtener el id y modelo del disco de la PC pasada como parámetro*/
   function discoPc($idPc) {
     $sql="SELECT d.id, d.disco_fabricante, d.disco_modelo FROM disco d
           INNER JOIN pc 
            WHERE d.id = pc.id_disco
            AND pc.id=$idPc";  
            
     return $sql; 
   }
   
      /* Obtener todos  id y modelo de disco distintos al de la PC pasada como parámetro o todos si id=""*/
   function listarDiscos($idPc) {
    if($idPc!="") {
    $sql="SELECT id, disco_fabricante, disco_modelo
			  FROM disco
				WHERE id != ( SELECT d.id FROM disco d INNER JOIN pc WHERE d.id = pc.id_disco AND pc.id =$idPc ) 
					ORDER BY disco_fabricante, disco_modelo";  }
     else {
	    $sql="SELECT id,disco_fabricante, disco_modelo
			  FROM disco
				ORDER BY  disco_fabricante,disco_modelo";} 
					
	return $sql;
   } 
 
 /*********************** FUENTE ************************/       
 /* Obtener el id y modelo de la fuente de la PC pasada como parámetro*/
   function fuentePc($idPc) {
     $sql="SELECT f.id, f.fuente_fabricante,f.watts FROM fuente f
           INNER JOIN pc 
            WHERE f.id = pc.id_fuente
            AND f.id!=0
            AND pc.id=$idPc";     
            
     return $sql; 
   }
   
   
   /* Obtener todos  id y modelo de fuente distintas a la de la PC pasada como parámetro*/
   function listarFuentes($idPc) {
    if($idPc!="") {   
    $sql="SELECT id, fuente_fabricante,watts
			  FROM fuente
				WHERE id!=0 AND id != ( SELECT f.id FROM fuente f INNER JOIN pc WHERE f.id = pc.id_fuente AND pc.id =$idPc ) 
					ORDER BY  watts";  }
		else {
	    $sql="SELECT id, fuente_fabricante,watts  
           FROM fuente
            WHERE id!=0 
            ORDER BY watts" ; }					
					
					
	return $sql;
   }
   
   /*********************** MONITOR ************************/ 
  
   /* Obtener el id y modelo del monitor de la PC pasada como parámetro*/
   function monitorPc($idPc) {
    $sql="SELECT m.id, m.monitor_fabricante, m.monitor_modelo FROM monitor m
           INNER JOIN pc 
            WHERE m.id = pc.id_monitor
            AND m.id!=0
            AND pc.id=$idPc";  
            
     return $sql; 
   }
   
   
   /* Obtener todos  id y modelo de monitor distintos al de la PC pasada como parámetro*/
   function listarMonitores($idPc) {
    if($idPc!="") {
     $sql="SELECT id, monitor_fabricante,monitor_modelo
			  FROM monitor
				WHERE id != ( SELECT m.id FROM monitor m INNER JOIN pc WHERE m.id = pc.id_monitor AND pc.id =$idPc ) 
				 AND id!=0
					ORDER BY  monitor_fabricante, monitor_modelo";   }
		else {
			$sql="SELECT id, monitor_fabricante, monitor_modelo
			  FROM monitor
            WHERE id!=0 
				 ORDER BY  monitor_fabricante, monitor_modelo";   }	
					
	return $sql;
   }
    
   
   /*********************** MOTHER************************/ 
   /* Obtener el id y modelo de la mother de la PC pasada como parámetro*/
   function motherPc($idPc) {
    $sql="SELECT m.id, m.mother_fabricante, m.mother_modelo FROM mother m 
           INNER JOIN pc 
            WHERE m.id = pc.id_mother 
            AND pc.id=$idPc";  
            
     return $sql; 
   }
   
   
   /* Obtener todos  id y modelo de mother distintos al de la PC pasada como parámetro*/
   function listarMothers($idPc) {
    if($idPc!="") {
      $sql="SELECT id, mother_fabricante, mother_modelo
			  FROM mother
				WHERE id != ( SELECT m.id FROM mother m INNER JOIN pc WHERE m.id = pc.id_mother AND pc.id =$idPc ) 
					ORDER BY mother_fabricante, mother_modelo";  }
			else { 
		 $sql="SELECT id, mother_fabricante, mother_modelo
			  FROM mother
				 ORDER BY mother_fabricante,mother_modelo"; }
	return $sql;
   }
   
   /*Obtener la cantidad de bancos de la mother*/
   function cantBancosMother($idMother){
    $sql="SELECT cant_bancos FROM mother WHERE id=$idMother";
    return $sql;
   }
   
      /*********************** PROCESADOR ************************/ 
      /* Obtener el id y modelo del procesador de la PC pasada como parámetro*/
   function procesadorPc($idPc) {
    $sql="SELECT p.id, p.procesador_modelo FROM procesador p
           INNER JOIN pc 
            WHERE p.id = pc.id_procesador 
            AND pc.id=$idPc";  
            
     return $sql; 
   }
   
   
   /* Obtener todos  id y modelo de procesador distintos al de la PC pasada como parámetro 
     o todos si no recibe parametros*/
   function listarProcesadores($idPc) {
   	if($idPc!="") {
       $sql="SELECT id, procesador_modelo
			  FROM procesador
				WHERE id != ( SELECT p.id FROM procesador p INNER JOIN pc WHERE p.id = pc.id_procesador AND pc.id =$idPc ) 
					ORDER BY procesador_modelo";   }
			else {
 			 $sql="SELECT id, procesador_modelo
			   FROM procesador
				 ORDER BY procesador_modelo";   }
					
	return $sql;
   }
   

      /*********************** RAM ************************/ 
      /* Obtener todos  id y tamaño de ram de la PC pasada como parámetro
        o todos si no recibe paramatros*/
   function listarRam($idPc) {
   if($idPc!="") {
      $sql="SELECT r.id, r.tamanio_mb
			  FROM ram r
			  	INNER JOIN pc
			  	INNER JOIN mother m
              WHERE 	r.tipo= ( SELECT m.tipo_bancos FROM mother m INNER JOIN pc WHERE m.id = pc.id_mother AND pc.id =$idPc ) 
              GROUP BY r.id
					ORDER BY  r.tamanio_mb";   }
		else {
		 $sql="SELECT id, tipo, tamanio_mb
			  FROM ram 
			  	 ORDER BY  tipo, tamanio_mb";  }
					
	return $sql;
   }
   
  /* Obtener todos los modulos de ram de esa pc (id y tamaño)*/
   function ramPc($idPc) {
    $sql="SELECT r.id, r.tamanio_mb, pr.cantidad
				FROM ram r
				 INNER JOIN pc_ram pr
					WHERE pr.id_pc = $idPc
					 AND pr.id_ram=r.id
						ORDER BY r.tamanio_mb";   
					
	return $sql;
   }
   
   
   /*Obtener la suma de modulos de la PC y el tamaño total de la ram */
   function ramPcTotal($idPc) {
    $sql="SELECT  SUM(pr.cantidad) as suma_modulos, SUM(pr.cantidad*r.tamanio_mb)/1024 as ram_total FROM pc_ram pr INNER JOIN pc
 				INNER JOIN ram r
					WHERE pc.id=pr.id_pc
  					  AND pc.id=$idPc
						AND pr.id_ram=r.id
							GROUP BY pc.id ";   
					
	return $sql;
   }
   
  /*********************** SISTEMA OPERATIVO ************************/ 
 /* Obtener el so de la PC pasada como parámetro*/
function soPc($idPc) {
  $sql="SELECT id, nombre, version 
         FROM so
           INNER JOIN pc_so ps 
         WHERE so.id=ps.id_so AND ps.id_pc=$idPc
          ORDER BY nombre";
      return $sql;
}

   /* Obtener todos  id y modelo de procesador distintos al de la PC pasada como parámetro
     o todos si no recibe parametros*/
   function listarSO($idPc) {
   	if($idPc!="") {
        $sql="SELECT so.id, so.nombre, so.version
				FROM so
					WHERE so.id NOT IN ( SELECT ps.id_so FROM pc_so ps WHERE ps.id_pc =$idPc )";
           }
       else {
         $sql="SELECT id, nombre, version
		           FROM so 
				      ORDER BY nombre, version";
          }
      return $sql;
   }


 /*********************** RED ************************/     
  /* Obtener el estado de red de la pc*/
   function redPc($idPc) {
     $sql="SELECT red FROM pc 
            WHERE pc.id=$idPc";  
            
     return $sql; 
   }
   
    ////////////********** INSERCIONES **********//////////////  
    
/**** Insertar Laboratorio *****/
function insertarLab($nroLab){
 $sql="INSERT INTO laboratorio (id_numero)
       VALUES ( $nroLab )";
 return $sql;       
}

/**** Insertar Oficina *****/
function insertarOfi($nombreOfi){
 $sql="INSERT INTO oficina (nombre)
       VALUES ('$nombreOfi')";
 return $sql;       
}

    
/**** Insertar PC *****/
function insertarPc($nombrePc,$nroInventario,$idMother,$idDisco,$idFuente,$idMonitor,$idLab,$idOfi,$idProcesador,$red,$enTaller){
  if($nroInventario=='NULL') {
   $sql="INSERT INTO pc (nombre,nro_inventario,id_mother,id_disco,id_fuente,id_monitor,id_laboratorio,id_oficina,id_procesador,red, en_taller)
          VALUES ('$nombrePc',$nroInventario ,$idMother ,$idDisco , $idFuente , $idMonitor , $idLab , $idOfi , $idProcesador , $red, $enTaller )";}
     else {
     	 $sql="INSERT INTO pc (nombre,nro_inventario,id_mother,id_disco,id_fuente,id_monitor,id_laboratorio,id_oficina,id_procesador,red, en_taller)
          VALUES ('$nombrePc','$nroInventario' ,$idMother ,$idDisco , $idFuente , $idMonitor , $idLab , $idOfi , $idProcesador , $red , $enTaller )";
          
          }
      return $sql;
}
 
 /**** Insertar ram y pc en la tabla pc_ram pasando como parámetro el nombre de la pc*****/
 function insertarRamPc($idRam,$nombrePc,$cantidad) {
  $sql="INSERT INTO pc_ram
			VALUES (( SELECT id FROM pc WHERE nombre ='$nombrePc'), $idRam, $cantidad )";
      return $sql;
 }
 
  /**** Insertar ram y pc en la tabla pc_ram pasando como parámetro el id de la pc*****/
 function insertarRamPcId($idRam,$idPc,$cantidad) {
  $sql="INSERT INTO pc_ram
			VALUES (( SELECT id FROM pc WHERE id =$idPc ), $idRam, $cantidad )";
      return $sql;
 }
 
  /**** Insertar so y pc en la tabla pc_so*****/
 function insertarSoPc($idSo,$nombrePc) {
  $sql="INSERT INTO pc_so
			VALUES (( SELECT id FROM pc WHERE nombre ='$nombrePc'), $idSo )";
      return $sql;
 }

/**** Insertar disco *****/
function insertarDisco($fabricante,$modelo,$capacidad,$interfaz){
  $sql="INSERT INTO disco (disco_fabricante, disco_modelo, capacidad_gb, interfaz)
         VALUES ('$fabricante','$modelo',$capacidad,'$interfaz')";
    return $sql;
} 

/**** Insertar fuente*****/
function insertarFuente($fabricante,$watts){
 $sql="INSERT INTO fuente (fuente_fabricante, watts)
  			VALUES ('$fabricante', $watts)";
  	return $sql;
}

/**** Insertar monitor*****/
function insertarMonitor($modelo,$fabricante,$pulgMonitor,$inventario){
  $sql="INSERT INTO monitor (monitor_modelo, monitor_fabricante, pulgadas, monitor_inventario)
  			VALUES ('$modelo','$fabricante', $pulgMonitor , '$inventario')";
  return $sql;
} 

/**** Insertar mother*****/
function insertarMother($fabricante,$modelo,$cantBancos,$tipoBancos,$socket,$bios){
 $sql="INSERT INTO mother (mother_fabricante, mother_modelo, cant_bancos, tipo_bancos, socket, version_bios)
       VALUES ('$fabricante','$modelo', $cantBancos, '$tipoBancos','$socket', $bios)";
   return $sql;
}

/**** Insertar nuevo procesador*****/
function insertarProcesador($fabricante,$modelo,$frecuencia){//,$socketComp){
  $sql="INSERT INTO procesador (procesador_fabricante,procesador_modelo, frecuencia) 
  			VALUES ('$fabricante','$modelo',$frecuencia )";
  	return $sql;
}

/**** Insertar nueva ram*****/
function insertarRam($tipo, $tamanio,$fabRam ){
 $sql="INSERT INTO ram (tipo, tamanio_mb,ram_fabricante)
 			VALUES ('$tipo', $tamanio, '$fabRam')";
 return $sql;
}

/**** Insertar nuevo S.O. *****/
function insertarSO($nombre,$version){
  $sql="INSERT INTO so (nombre, version)
         VALUES ('$nombre', '$version')";
    return $sql;     
 } 

 ////////////********** MODIFICACIONES **********//////////////
 /**** Cambiar nombre  PC*****/  
 function modificarNombrePc($idPc,$nombre) {
   $sql="UPDATE pc SET nombre='$nombre' WHERE id=$idPc"; 
   return $sql;
 }  
 
function cambiarEstadoPc($estado, $idPc, $idIncidente){
 if($estado=='incidente') {
 	//actualizo el estado en_incidente solo si esa pc no está en otro incidente no finalizado (distinto al pasado por param)
 	 $sql="UPDATE pc SET en_taller=1, en_incidente = NOT (en_incidente) 
 	         WHERE id =$idPc 
 	          AND id NOT IN ( SELECT id_pc FROM incidente WHERE ISNULL( fecha_fin ) AND id!=$idIncidente )"; 
 	 }
 	 elseif($estado=='baja') {
 	 	$sql="UPDATE pc SET en_taller=1, baja= NOT (en_incidente) WHERE id=$idPc"; 
 	  }
 	  
 	  return $sql;
}
 
/**** Cambiar nro inventario*****/
  function modificarNroInvent($idPc,$nroInventario) {
   $sql="UPDATE pc SET nro_inventario='$nroInventario' WHERE id=$idPc"; 
   return $sql;
 }  
 
 /**** Cambiar laboratorio*****/
  function modificarLabPc($idPc,$laboratorio) {
  	if($laboratorio==0) {
     $sql="UPDATE pc SET id_laboratorio=NULL, en_taller=1, id_monitor=0 WHERE id=$idPc";
  	}
  	else {
   $sql="UPDATE pc SET id_laboratorio=$laboratorio WHERE id=$idPc"; } 
   return $sql;
 }  
 
  /**** Cambiar oficina*****/
  function modificarOfiPc($idPc,$oficina) {
   if($oficina==0) {
     $sql="UPDATE pc SET id_oficina=NULL, en_taller=1, id_monitor=0 WHERE id=$idPc";
  	  }
  	else {
   $sql="UPDATE pc SET id_oficina=$oficina WHERE id=$idPc"; } 
   return $sql;
 }  
 
  /**** Cambiar disco *****/  
 function modificarDisco($idPc,$idDisco) {
   $sql="UPDATE pc SET id_disco=$idDisco WHERE id=$idPc"; 
   return $sql;
 }  
 
   /**** Cambiar fuente *****/  
 function modificarFuente($idPc,$idFuente) {
   $sql="UPDATE pc SET id_fuente=$idFuente WHERE id=$idPc"; 
   return $sql;
 }  
 
 /**** Cambiar monitor *****/  
 function modificarMonitor($idPc,$idMonitor) {
   $sql="UPDATE pc SET id_monitor=$idMonitor WHERE id=$idPc"; 
   return $sql;
 }  
 
   /**** Cambiar mother *****/  
 function modificarMother($idPc,$idMother) {
   $sql="UPDATE pc SET id_mother=$idMother WHERE id=$idPc"; 
   return $sql;
 }  
 
   /**** Cambiar procesador *****/  
 function modificarProcesador($idPc,$idProcesador) {
   $sql="UPDATE pc SET id_procesador=$idProcesador WHERE id=$idPc"; 
   return $sql;
 }  
 
    /**** Cambiar S.O. *****/  
    
 //consulta para obtener el id del SO a reemplazar, ya que no se puede hacer una 
 // subconsulta en el UPDATE de la funcion modificar SO para obtener ese id
function obtenerSoAnterior($idPc,$nro) {
 if($nro==1) {
 	$sql="SELECT id_so FROM pc_so WHERE id_pc=$idPc ORDER BY id_so LIMIT 1";
 }
 else {
 	$sql="SELECT  id_so FROM pc_so WHERE id_pc=$idPc ORDER BY id_so DESC LIMIT 1";
 }

 return $sql;
}    
    
 function modificarSO($idPc,$idSo,$soReemplazado) {
   $sql="UPDATE pc_so SET id_so=$idSo WHERE id_so=$soReemplazado AND id_pc=$idPc"; 
  return $sql; 

 }  
 
  /**** Cambiar estado de red de  PC*****/  
 function modificarRed($idPc,$enRed) {
   $sql="UPDATE pc SET red=$enRed WHERE id=$idPc"; 
   return $sql;
 }  
 
   ////////////********** BAJA **********//////////////
  // Se incrementa la cant_baja de cada componente y quedan en estado pendiente de baja definitiva
  // es para los componentes y pc que ya no sirven y permanecen en el taller
  
     /**** PC *****/ 
   function darBajaPc($idPc) {
    $sql="UPDATE pc SET baja=1 WHERE id=$idPc";
    return $sql;   
   }
   
     /**** Disco *****/ 
   function bajaDisco($idDisco) {
    $sql="UPDATE disco SET cant_baja=cant_baja+1 WHERE id=$idDisco";
    return $sql;   
   }
   
      /**** Fuente *****/ 
   function bajaFuente($idFuente) {
    $sql="UPDATE fuente SET cant_baja=cant_baja+1 WHERE id=$idFuente";
    return $sql;   
   }
   
      /**** Monitor *****/ 
   function bajaMonitor($idMonitor) {
    $sql="UPDATE monitor SET cant_baja=cant_baja+1 WHERE id=$idMonitor";
    return $sql;   
   }
   
      /**** Procesador *****/ 
   function bajaProcesador($idProcesador) {
    $sql="UPDATE procesador SET cant_baja=cant_baja+1 WHERE id=$idProcesador";
    return $sql;   
   }
   
      /**** Mother *****/ 
   function bajaMother($idMother) {
    $sql="UPDATE mother SET cant_baja=cant_baja+1 WHERE id=$idMother";
    return $sql;   
   }
   
      /**** RAM *****/ 
   function bajaRam($idRam) {
    $sql="UPDATE ram SET cant_baja=cant_baja+1 WHERE id=$idRam";
    return $sql;   
   }
    
   ////////////********** INCIDENTES **********//////////////
function nombreIncidente($id) {
  $sql="SELECT pc.nombre, i.nombre_incid FROM pc INNER JOIN incidente i
          WHERE i.id_pc=pc.id  AND i.id=$id";
      return $sql;
}   
   
 /* Listar todos los incidentes pendientes para la tabla que se carga cuando se selecciona el menu Incidentes*/
   function listarPendientes() {
     $sql="SELECT pc.nombre, i.nombre_incid,i.fecha_inicio,i.fecha_fin,i.detalle
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id AND i.fecha_fin IS NULL AND pc.baja=0
                  ORDER BY i.fecha_inicio";  
        return $sql;
                
     
   }

 /* Listar todos los incidentes de todos los laboratorios o solo del pasado como parámetro  */
function incidentesLab($id_lab) {
	if($id_lab==0) {
    $sql="SELECT pc.nombre, i.nombre_incid, i.fecha_inicio, i.fecha_fin, i.detalle
				FROM pc
				 INNER JOIN incidente i
				  WHERE i.id_pc = pc.id
				    AND pc.baja=0
				    AND pc.id_laboratorio!='NULL' 
				   
					ORDER BY i.fecha_fin,i.fecha_inicio, pc.nombre ";
				}
	  else {
		$sql="SELECT pc.nombre,  i.nombre_incid, i.fecha_inicio, i.fecha_fin, i.detalle
				FROM pc
				 INNER JOIN incidente i
				  WHERE i.id_pc = pc.id AND pc.id_laboratorio=$id_lab
				   AND pc.baja=0
					ORDER BY  i.fecha_fin, i.fecha_inicio, pc.nombre";		
				}
	return $sql;
 
}

 /* Listar todos los incidentes de todas lasoficinas o solo de la pasada como parámetro */
function incidentesOfi($id_ofi) {
	if($id_ofi==0) {
    $sql="SELECT pc.id, pc.nombre, i.nombre_incid, i.fecha_inicio, i.fecha_fin, i.detalle
				FROM pc
				 INNER JOIN incidente i
				  WHERE i.id_pc = pc.id
				   AND pc.id_oficina!='NULL'
				    AND pc.baja=0
					ORDER BY pc.nombre, i.fecha_fin";
				}
	  else {
		$sql="SELECT pc.nombre, i.nombre_incid, i.fecha_inicio, i.fecha_fin, i.detalle
			 	FROM pc
				 INNER JOIN incidente i
				  WHERE i.id_pc = pc.id AND pc.id_oficina=$id_ofi
					AND pc.baja=0
					ORDER BY pc.nombre, i.fecha_fin";		
				}
				 return $sql; 
}

 /* Listar todos los incidentes de las pc que están en el taller (sin laboratorio asignado) */
function incidentesTaller() {
	
    $sql="SELECT pc.id, pc.nombre, i.nombre_incid, i.fecha_inicio, i.fecha_fin, i.detalle
				FROM pc
				 INNER JOIN incidente i
					WHERE i.id_pc = pc.id
					 AND pc.id_oficina IS NULL 
						AND pc.id_laboratorio IS NULL 
						 AND pc.en_taller =1
							AND pc.baja =0
							 ORDER BY pc.nombre, i.fecha_fin";
				
		 return $sql; 
}

  /* Listar los id de todos los incidentes pendientes (junto con su nombre y el de la pc)
   o solo los de las PC del laboratorio u oficina pasado por parámetro, para armar la lista select*/
  function selectIncidentes($estado,$tipo,$nro) {
  	if($estado=='pendiente') {
  	 if($tipo=='') {
     $sql="SELECT i.id,pc.nombre, i.nombre_incid
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id AND i.fecha_fin IS NULL AND pc.baja=0
                  ORDER BY pc.nombre";
  	    }
    elseif($tipo=='lab' && $nro==0) {  
      $sql="SELECT i.id,pc.nombre, i.nombre_incid
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id AND i.fecha_fin IS NULL AND pc.id_laboratorio!='NULL' AND pc.baja=0
                  ORDER BY pc.nombre"; }
        elseif($tipo=='lab') {
        	 $sql="SELECT i.id,pc.nombre, i.nombre_incid
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id AND i.fecha_fin IS NULL AND pc.id_laboratorio=$nro AND pc.baja=0
                  ORDER BY pc.nombre";  }
           elseif($tipo=='ofi' && $nro==0) {     
              $sql="SELECT i.id,pc.nombre, i.nombre_incid
            			FROM pc
             			 INNER JOIN incidente i
               			 WHERE i.id_pc=pc.id AND i.fecha_fin IS NULL AND pc.id_oficina!='NULL' AND pc.baja=0
                 				 ORDER BY pc.nombre"; }
                else {
                	 $sql="SELECT i.id,pc.nombre, i.nombre_incid
                    FROM pc
             		   INNER JOIN incidente i
                		 WHERE i.id_pc=pc.id AND i.fecha_fin IS NULL AND pc.id_oficina=$nro AND pc.baja=0
                  		ORDER BY pc.nombre";  
                }
             }
  elseif($estado=='todos') {
  	 if($tipo=='') {
     $sql="SELECT i.id,pc.nombre, i.nombre_incid
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id AND pc.baja=0
                  ORDER BY pc.nombre";
  	    }
    elseif($tipo=='lab' && $nro==0) {  
      $sql="SELECT i.id,pc.nombre, i.nombre_incid
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id  AND pc.id_laboratorio!='NULL' AND pc.baja=0
                  ORDER BY pc.nombre"; }
        elseif($tipo=='lab') {
        	 $sql="SELECT i.id,pc.nombre, i.nombre_incid
            FROM pc
              INNER JOIN incidente i
                WHERE i.id_pc=pc.id AND pc.id_laboratorio=$nro AND pc.baja=0
                  ORDER BY pc.nombre";  }
           elseif($tipo=='ofi' && $nro==0) {     
              $sql="SELECT i.id,pc.nombre, i.nombre_incid
            			FROM pc
             			 INNER JOIN incidente i
               			 WHERE i.id_pc=pc.id AND pc.id_oficina!='NULL' AND pc.baja=0
                 				 ORDER BY pc.nombre"; }
                else {
                	 $sql="SELECT i.id,pc.nombre, i.nombre_incid
                    FROM pc
             		   INNER JOIN incidente i
                		 WHERE i.id_pc=pc.id AND pc.id_oficina=$nro AND pc.baja=0
                  		ORDER BY pc.nombre";  
                }
             }
                return $sql;
        }
        
        
  /* Obtener el ID de la pc del incidente para cargar el textbox*/    
  function datosIncidente($idIncidente) {
  $sql="SELECT pc.nombre, i.nombre_incid, DATE_FORMAT(i.fecha_inicio,  '%d/%m/%Y') AS fecha_inicio, i.detalle
         FROM pc INNER JOIN incidente i 
          WHERE i.id=$idIncidente 
          AND i.id_pc=pc.id";
   return $sql;
}
        
 function insertarIncidente($nombreIncidente,$detalle,$fechaIni,$fechaFin,$idPc) {
 	if($fechaFin=='') {
 		$sql="INSERT INTO incidente(nombre_incid,fecha_inicio, detalle,id_pc)
        VALUES ('$nombreIncidente', '" . cambiaf_a_mysql($fechaIni) . "' , '$detalle', $idPc )";}
        else {
        	$sql="INSERT INTO incidente(nombre_incid,fecha_inicio,fecha_fin,detalle,id_pc)
          VALUES ('$nombreIncidente', '" . cambiaf_a_mysql($fechaIni) . "' , '" . cambiaf_a_mysql($fechaFin) . "' , '$detalle', $idPc )";        
        }
        return $sql; 
 }

function eliminarIncidente($id) {
  $sql="DELETE FROM incidente WHERE id=$id";
  return $sql;
   }
   
  //obtener el id del ultimo incidente insertado
 function obtenerIdIncidente() {
   $sql="SELECT id FROM incidente ORDER BY id DESC LIMIT 1";
   return $sql; 
 }
 
  ////////////********** MODIFICACIONES **********//////////////
 /**** Cambiar nombre  Incidente*****/  
 function modificarNombreIncid($idIncidente,$nombre) {
   $sql="UPDATE incidente SET nombre_incid='$nombre' WHERE id=$idIncidente"; 
   return $sql;
 }  
 
  /**** Cambiar detalle Incidente*****/  
 function modificarDetalle($idIncidente,$detalle) {
   $sql="UPDATE incidente SET detalle='$detalle' WHERE id=$idIncidente"; 
   return $sql;
 }  
 
   /**** Cambiar fecha fin Incidente*****/  
 function modificarFecha($idIncidente,$fechaFin) {
   $sql="UPDATE incidente SET fecha_fin='" . cambiaf_a_mysql($fechaFin) . "' WHERE id=$idIncidente"; 
   return $sql;
 } 
 
 //////////////////////////////////////////////////// 
//Convierte fecha de mysql a normal 
//////////////////////////////////////////////////// 
function cambiaf_a_normal($fecha){ 
   	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
   	return $lafecha; 
} 

//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 

function cambiaf_a_mysql($fecha){ 
   	ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
   	return $lafecha; 
}

//Obtener clave actual
 function obtenerClave($nivelUs) {
   $sql="SELECT clave FROM usuario WHERE id_nivel=$nivelUs";
   return $sql; 
 }
 
  function modificarClave($nivelUs,$clave) {
   $sql="UPDATE usuario SET clave='$clave' WHERE id_nivel=$nivelUs";
   return $sql; 
 }
                
?>