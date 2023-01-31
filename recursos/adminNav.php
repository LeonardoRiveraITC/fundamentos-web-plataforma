<?php
session_start();
if (isset($_SESSION['user'])){
    
}
else header("location: index.php?e=100");
?>
<body style="background-color: azure;">
    <nav style=" font-size:large; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif;background-color: rgb(191, 210, 226);">
        <a href="../views/roles.php?accion=list">Roles</a>|<a href="../views/usuarios.php">Usuarios</a> |<a href="../index.php">Cerrar sesion</a>
        <?php
        echo "Bienvenido ". $_SESSION['user'];
        ?>   
    </nav>
<script>
    document.write('<h1>hola mundo</h1>')
</script>