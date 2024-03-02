<?php

class Usuario{
    public $id;
    public $nombre;
    public $username;
    public $password;
    public $rol;

    public function __construct($id) {
        $bd = new BD();
        $sql = $bd->conexion->query(" SELECT * FROM usuarios WHERE id = $id ");
        $datos = $sql->fetch_object();
        $this->nombre = $datos->nombre;
        $this->username = $datos->username;
        $this->password = $datos->password;
        $this->rol = $datos->rol;
        $this->id = $datos->id;
    }

    public function delete(){
        $bd = new BD();
        $sql = $bd->conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        $sql->bind_param("i", $this->id);
        $resultado = $sql->execute();
        if( $resultado && $sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
}