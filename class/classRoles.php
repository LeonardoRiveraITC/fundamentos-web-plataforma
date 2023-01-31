<?php
include "../class/classBaseDeDatos.php";
class Roles extends classBaseDeDatos{
function ejecuta(){
$html="";
switch($_REQUEST['accion']){
        case 'newForm':
            $html='<form method="post">
            <input type="hidden" name="id" value="'.(isset($_POST['Id'])? $_POST['Id']:"").'"/>
            <input type="hidden" name="accion" value="'.(isset($_POST['Id'])? "update":"insert").'"/>
            <input type="image" src="../img/Button-Add-icon.png" value="insert"/>
            <input type="text" name="name" value="'.(isset($_POST['Id'])? $_POST["Nombre"]:"").'"/>
            </form>'; 
            break;
        case 'insert':
            $this->m_query("Insert into rol set Nombre='".$_POST['name']."'");
            $html=$this->listar();
            break;
        case 'delete':
            $this->m_query("DELETE from Rol where Id='".$_POST['Id']."'");
            $html=$this->listar();
            break;
        case 'update': 
            $this->m_query("update Rol set Nombre='".$_POST['name']."' where Id='".$_POST['id']."'");
            $html=$this->listar();
            break;
        case 'list': $html=$this->listar();break;
        default:
        $html= $_REQUEST['accion']. "No mapped action";
    }
    return $html;
}
private function listar(){
    $this->m_query("Select * from Rol order by Nombre");
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
        <input type="hidden" name="Nombre" value="'.$tupla['Nombre'].'"/>
        <input type="image" src="../img/Actions-document-edit-icon.png" value="newForm"/>
        </form>
        </td>
        <td>'.$tupla['Id'].'</td>
        <td>'.$tupla['Nombre']."</td>
        </tr>";
    }
    return $resp.='</table>';
}
}
$oRoles=new Roles;   
?>