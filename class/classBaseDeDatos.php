<?php
class classBaseDeDatos {
    var $a_conexion;
    var $a_numRegistros;
    var $respuesta;
    var $a_error;
    function m_conecta(){
       $this->a_conexion=mysqli_connect("localhost","empresa","1234","empresaservicios");
    }
    function m_desconecta(){
        mysqli_close($this->a_conexion);
    }
    function m_imprLista(){

    }
    function m_query($consulta){
        $this->a_error=false;
        $this->m_conecta();
        $this->respuesta=mysqli_query($this->a_conexion,$consulta);
        if(mysqli_error($this->a_conexion)>"")
            $this->a_error=true;
        if (strpos(strtoupper($consulta),"SELECT") !== false)
            $this->a_numRegistros=mysqli_num_rows($this->respuesta); 
        else
            $this->m_desconecta();
    }
    function m_obtenerRegistro($query){
        $this->m_query($query);
        return mysqli_fetch_object($this->respuesta);
    }
    function recuRegistros(){
        return mysqli_fetch_array($this->respuesta);
    }
    
}

$oBD=new classBaseDeDatos;                        
?>
