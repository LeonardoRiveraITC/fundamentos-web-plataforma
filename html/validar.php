<?php
include "../class/classBaseDeDatos.php";
session_start();
//echo($oBD->m_query("SELECT * from Usuario where Email='".$_POST['user']."'AND Clave=password('".$_POST['pwd']."')"));
$datoUsuario=($oBD->m_obtenerRegistro("SELECT * from Usuario where Email='".$_POST['user']."'AND Clave='".$_POST['pwd']."'"));
if($oBD->a_numRegistros==1){
    $_SESSION['user']=$_POST['user'];
    $_SESSION['nombre']=$datoUsuario->Nombre." ".$datoUsuario->Apellido;
    
    $oBD->m_query("update Usuario set Fecha_Ulti_Acceso='".date("Y-m-d")."',Accesos=(Accesos+1) where Email='".$_POST['Email']."'");
    header("location: home.php");
}else{
    header("location: ../index.php?e=1");
}
?>

