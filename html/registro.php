<?php
session_start();
include ('../recursos/funciones.php');
include '../recursos/nav.php';
if(isset($_GET['e'])){
    switch($_GET['e']){
        case 102:
            echo "intenta de nuevo";
            break;
    }
}
$cadena=captcha();
$_SESSION['captcha']=$cadena;
?>
<html lang="es">
<head>
</head>
<body style="background-color: azure;">
    <div style="text-align: center; border-style:inset; width: 30%; height: 70%;margin:auto;margin-top: 10%; color: rgba(94, 76, 196, 0.815); background-color: rgb(174, 154, 247);">
        <form method="POST"action="registrarse.php">
        <p style="color: black;">Email</p><input style="align-items: center;"name="email" required type="text">
        <p style="color: black;">Nombre</p><input style="align-items: center;"name="name" required type="text">
        <p style="color: black;">Apellido</p><input style="align-items: center;"name="surname" required type="text">
        <p style="color: black;">¿Qu&eacute; es?</p><input style="align-items: center;"name="captcha" required type="text" placeholder="<?php echo $cadena?>">
        <br>
        <input value="Enviar" type="submit">
    </form>
    </div>
</body>
</html>