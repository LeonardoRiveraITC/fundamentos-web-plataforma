<?php
include "../recursos/adminNav.php";
include "../class/classUsuarios.php";

if(isset($_REQUEST["accion"]))
   echo $oUsuarios->ejecuta($_REQUEST["accion"]);
else 
   echo $oUsuarios->listar();

?>
