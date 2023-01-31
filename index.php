<?php
session_start();
session_destroy();
?>
<html lang="es">
<head>
</head>
<body style="background-color: azure;">

    <?php
        if (isset($_GET['e'])){
            switch($_GET['e']){
            case 1:
                echo "<h1> Login Incorrecto </h1>";
                break;
                case 7:
                echo "<h1> Registro exitoso, revisa tu correo </h1>";
                break;
                case 5:
                echo "<h1> Contraseña reiniciada, revisa tu correo </h1>";
                break;     
                case 100:
                echo "<h1> Correo invalido </h1>";
                break;        
                case 101:
                echo "<h1> Correo no registrado </h1>";
                break; 
                case 102:
                echo "<h1> Correo existente </h1>";
                break;                                        
            }    
        }
    ?>
    <body>
        <nav style=" font-size:large; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif;background-color: rgb(191, 210, 226);">
        <a href="index.php">Login</a> | <a href="./html/about.html">About</a>|<a href="./html/password.php">Password Reset</a> |<a href="./html/registro.php">Registro</a>    
    </nav>
    <div style="text-align: center; border-style:inset; width: 30%; height: 35%;margin:auto;margin-top: 10%; color: rgba(94, 76, 196, 0.815); background-color: rgb(174, 154, 247);">
        <form method="POST"action="./html/validar.php">
        <p style="color: black;">Usuario</p><input style="align-items: center;"name="user" type="text"  required>
        <p style="color: black;">Contraseña</p><input name="pwd"type="password" required>
        <br>
        <input value="Enviar" type="submit">
    </form>
    </div>
</body>
</html>