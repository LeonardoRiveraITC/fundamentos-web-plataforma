<?php
include "../recursos/adminNav.php";
include "../class/classRoles.php";

if(isset($_REQUEST["accion"]))
   echo $oRoles->ejecuta($_REQUEST["accion"]);
else 
   echo $oRoles->ejecuta("list");

?>
