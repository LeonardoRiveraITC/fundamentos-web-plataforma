<?php
include ("../class/classBaseDeDatos.php");
include("../class/class.phpmailer.php");
include("../class/class.smtp.php");
//include "classBD.php";
session_start();


$conexion=mysqli_connect("localhost", "empresa", '1234','empresaservicios');
$cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
$numeC=strlen($cadena);
$nuevPWD="";
for ($i=0; $i<8; $i++)
  $nuevPWD.=$cadena[rand()%$numeC]; 

//$_POST['pwd']=str_replace("'","",$_POST['pwd']);
//$_POST['email']=str_replace("'","",$_POST['Email']);
$oBD->m_query("select Email from usuario where Email='".$_POST['email']."'");
$res=$oBD->a_numRegistros;
if($res!=0){
 header ("location:../index.php?e=102");
 exit();
}
$cad="insert into usuario set Nombre='".$_POST['name']."', Apellido='".$_POST['surname']."',
 Email='".$_POST['email']."',
  clave=('".$nuevPWD."'), idRol=2, fecha_Ulti_Acceso='".date("y-m-d")."'";

$oBD->m_query($cad);
$mail = new PHPMailer();
$mail->IsSMTP();
    $mail->Host="smtp.gmail.com"; //mail.google
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = 465;     // set the SMTP port for the GMAIL server
    $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
                              // 1 = errors and messages
                              // 2 = messages only
    $mail->SMTPAuth = true;   //enable SMTP authentication
    
    $mail->Username =   "19030342@itcelaya.edu.mx"; // SMTP account username
    $mail->Password = "urfnudaodjtuqkgl";  // SMTP account password
      
    $mail->From="";
    $mail->FromName="";
    $mail->Subject = "Registro completo";
    $mail->MsgHTML("<h1>BIENVENIDO ".$_POST['name']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
    $mail->AddAddress($_POST['email']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send()) 
          echo  "Error: " . $mail->ErrorInfo;
          else {
            if($oBD->a_error) 
              header ("location:../index.php?e=2");
            else
              header("location: ../index.php?e=7"); }
 
/*

PROBLEMAS A SOLUCIONAR EN EL REGISTRO
1) DETECTAR QUE EL CORREO YA ESTA REGISTRADO, 
   YA QUE ES LA LLAVE PRIMARIA Y NO SE DEBE ENVIAR
   EL CORREO SI YA ESTABA REGISTRADO.
2) LA CLAVE DEBE DE CIFRARSE, POR QUE EN EL 
   LOGUEO SE CIFRA.


*/
?>
