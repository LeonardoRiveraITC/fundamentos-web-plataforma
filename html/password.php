<?php
include "../recursos/funciones.php";
include ("../class/classBaseDeDatos.php");
include("../class/class.phpmailer.php");
include("../class/class.smtp.php");
session_start();
if(isset($_POST['user']))
    if(isset($_POST['captcha']))
        if($_SESSION['captcha']==$_POST['captcha']){
            echo "Contraseña nueva enviada";
            $conexion=mysqli_connect("localhost", "empresa", '1234','empresaservicios');
            $cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
            $numeC=strlen($cadena);
            $nuevPWD="";
            for ($i=0; $i<8; $i++)
              $nuevPWD.=$cadena[rand()%$numeC]; 
            
           $oBD->m_query("select Email from usuario where Email='".$_POST['user']."'");
           $res=$oBD->a_numRegistros;
           if($res==0){
            header ("location:../index.php?e=101");
            exit();
           }
           $cad="update usuario set clave=('".$nuevPWD."') where Email='".$_POST['user']."'";
           
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
           
           $mail->Username = "19030342@itcelaya.edu.mx"; // SMTP account username
           $mail->Password = "urfnudaodjtuqkgl";  // SMTP account password
             
           $mail->From="";
           $mail->FromName="";
           $mail->Subject = "Password reset";
           $mail->MsgHTML("</h1><h2> tu nueva clave de acceso es : ".$nuevPWD."</h2>");
           $mail->AddAddress($_POST['user']);
           //$mail->AddAddress("admin@admin.com");
           if (!$mail->Send()) 
           header ("location:../index.php?e=100");
           else {
              if($oBD->a_error) 
                header ("location:index.php?e=2");
              else
                header("location: ../index.php?e=5"); }
        }else{
            echo "intente de nuevo";
        }else
            echo "por favor realize el captcha";


$cadena=captcha();
include '../recursos/nav.php';
?>
<html lang="es">
<head>
</head>
<body style="background-color: azure;">
    <div style="text-align: center; border-style:inset; width: 30%; height: 35%;margin:auto;margin-top: 10%; color: rgba(94, 76, 196, 0.815); background-color: rgb(174, 154, 247);">
        <form method="POST"action="password.php">
        <p style="color: black;">Usuario</p><input style="align-items: center;"name="user" required type="text">
        <br>
        <p style="color: black;">Qu&eacute; es?</p><input style="align-items: center;"name="captcha" required type="text" placeholder="<?php echo $cadena?>">
        <br>
        <input value="Enviar" type="submit">    
    </form>
    </div>
</body>
</html>