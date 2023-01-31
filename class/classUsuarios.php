<?php
include "../class/classBaseDeDatos.php";
class Usuarios extends classBaseDeDatos{
function ejecuta(){
$html="";
switch($_REQUEST['accion']){
        case 'newForm':
            $html='<form method="post">
            <input type="hidden" name="Id" value="'.(isset($_POST['Id'])? $_POST['Id']:"").'"/>
            <input type="hidden" name="accion" value="'.(isset($_POST['Id'])? "update":"insert").'"/>
            <input type="image" src="../img/Button-Add-icon.png" value="insert"/>
            Nombre <input type="text" name="name" value="'.(isset($_POST['Id'])? $_POST["name"]:"").'"/>
            Apellido <input type="text" name="surname" value="'.(isset($_POST['Id'])? $_POST["surname"]:"").'"/>
            Email <input type="text" name="email" value="'.(isset($_POST['Id'])? $_POST["Email"]:"").'"/>
            Genero<input type="text" name="gender" value="'.(isset($_POST['Id'])? $_POST["gender"]:"").'"/>
            Accesos<input type="text" name="access" value="'.(isset($_POST['Id'])? $_POST["access"]:"").'"/>
            Clave<input type="text" name="Clave" value="'.(isset($_POST['Id'])? $_POST["IdRol"]:"").'"/>
            IdRol<input type="text" name="IdRol" value="'.(isset($_POST['Id'])? $_POST["Clave"]:"").'"/>
            </form>'; 
            break;
        case 'insert':
            $this->m_query("Insert into usuario set Nombre='".$_POST['name']."',Apellido='".$_POST['surname']."'
            ,Email='".$_POST['email']."',Genero='".$_POST['gender']."'
            ,Accesos='".$_POST['access']."', Clave='".$_POST["Clave"]."', IdRol='".$_POST["IdRol"]."'");
            $html=$this->listar();
            break;
        case 'delete':
            $this->m_query("DELETE from usuario where Id='".$_POST['Id']."'");
            $html=$this->listar();
            break;
        case 'update': 
            $this->m_query("update usuario set Nombre='".$_POST['name']."',Apellido='".$_POST['surname']."'
            ,Email='".$_POST['email']."',Genero='".$_POST['gender']."'
            ,Accesos='".$_POST['access']."', Clave='".$_POST["Clave"]."', IdRol='".$_POST["IdRol"]."' where Id ='".$_POST["Id"]."'");
            $html=$this->listar();
            break;
        case 'list': $html=$this->listar();break;
        default:
        $html= $_REQUEST['accion']. "No mapped action";
    }
    return $html;
}
public function listar(){
    $this->m_query("Select * from usuario order by Nombre");
    $resp='
    <table border="1">
    <tr>
    <td colspan="2">
    <form method="post">
    <input type="hidden" name="accion" value="newForm"/>
    <input type="image" src="../img/Button-Add-icon.png" value="newForm" style="display: block;margin-top: auto;margin-bottom: auto;width: 20%;"/>
    </form>
    </td>
    <td>Id</td>
    <td>Nombre</td>
    <td>Apellido</td>
    <td>Feha_Ulti_Acceso</td>
    <td>Email</td>
    <td>Genero</td>
    <td>Acceos</td>
    <td>Clave</td>     
    <td>Rol</td>     
    </tr>';
    for($cont=0;$cont<$this->a_numRegistros;$cont++){
        $tupla=$this->recuRegistros();
        $resp.='
        <tr>
        <td width="35px">
        <form method="post">
        <input type="hidden" name="accion" value="delete"/>
        <input type="hidden" name="Id" value="'.$tupla['Id'].'"/>
        <input type="image" src="../img/Recycle-Bin-Icon.png" value="delete"/>
        </form>
        </td>
        <td>
        <form method="post">
        <input type="hidden" name="accion" value="newForm"/>
        <input type="hidden" name="Id" value="'.$tupla['Id'].'"/>
        <input type="hidden" name="name" value="'.$tupla['Nombre'].'"/>
        <input type="hidden" name="surname" value="'.$tupla['Apellido'].'"/>
        <input type="hidden" name="lastAccess" value="'.$tupla['Fecha_Ulti_Acceso'].'"/>
        <input type="hidden" name="Email" value="'.$tupla['Email'].'"/>
        <input type="hidden" name="gender" value="'.$tupla['Genero'].'"/>
        <input type="hidden" name="access" value="'.$tupla['Accesos'].'"/>
        <input type="hidden" name="Clave" value="'.$tupla['Clave'].'"/>
        <input type="hidden" name="IdRol" value="'.$tupla['IdRol'].'"/>
        <input type="image" src="../img/Actions-document-edit-icon.png" value="newForm"/>
        </form>
        </td>
        <td>'.$tupla['Id'].'</td>
        <td>'.$tupla['Nombre'].'</td>
        <td>'.$tupla['Apellido'].'</td>
        <td>'.$tupla['Fecha_Ulti_Acceso'].'</td>
        <td>'.$tupla['Email'].'</td>
        <td>'.$tupla['Genero'].'</td>
        <td>'.$tupla['Accesos'].'</td>
        <td>'.$tupla['Clave'].'</td>
        <td>'.$tupla['IdRol']."</td>
        </tr>";
    }
    return $resp.='</table>';
}
}
$oUsuarios=new Usuarios;   
?>