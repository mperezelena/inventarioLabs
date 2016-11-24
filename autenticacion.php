<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<?php
session_cache_limiter('private_no_expire');
  include("conec_db.php");
  include("functions.php");
  $link=Conection();

  $usuario=$_POST['usuario'];
  $clave=$_POST['clave'];

  $sql=existeUsuario($usuario);
  $result=mysql_query($sql, $link);

  $existe=mysql_result($result,0);

  echo $existe;
  mysql_free_result($result);
     
  if($existe) {

    $sql2=comprobarClave($usuario,$clave); 
    $result=mysql_query($sql2, $link);
    $compruebaClave=mysql_result($result,0,'id');
    $nivelUs=mysql_result($result,0,'id_nivel');
    mysql_free_result($result); 

    if($compruebaClave) { 
  
   //usuario y contraseña válidos 

   session_start(); 
    // inicio la sesión 
    $_SESSION["autentificado"]= "SI"; 
    //defino la sesión que demuestra que el usuario está autorizado 
        session_name("loginUsuario"); 
    //asigno un nombre a la sesión para poder guardar diferentes datos 
    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 
    //defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss 
    //header ("Location: aplicacion.php"); 
    
      
      header ('Location: inventario.php?tipo=lab&nro=0&nivelUs='.$nivelUs);
         
    }
    else {
     $error='clave';
      header ('Location: index.php?error='.$error);
    }
  }
  else {
   $error='usuario';
    header ('Location: index.php?error='.$error);
  }
  ?>