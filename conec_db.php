<?php
function Conection(){
   if (!($link=mysql_connect("localhost","root","")))  {
   	die("Error al conectar a la base de datos");
      exit();
   }
   if (!mysql_select_db("uosi",$link)){
   	die ("Error al conectar a la base de datos.");
      exit();
   }
   return $link;
}
?>
