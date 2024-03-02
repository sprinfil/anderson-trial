<?php

class Proyecto{
    public $id;
    public $nombre;

    public function __construct() {

    }

    public function find($id){
        $bd = new BD();
        $sql = $bd->conexion->query(" SELECT * FROM proyectos WHERE id = $id ");
        $datos = $sql->fetch_object();
        $this->id = $datos->id;
        $this->nombre = $datos->nombre;
    }

    public function save(){
        if($this->id){
            $bd = new BD();
            $nombre = $this->nombre;
            $consulta = $bd->conexion->prepare("UPDATE proyectos SET nombre = ? WHERE id = ?");
            $consulta->bind_param("si", $nombre,$this->id);
        }else{
            $bd = new BD();
            $nombre = $this->nombre;
            $consulta = $bd->conexion->prepare("INSERT INTO proyectos (nombre) VALUES (?)");
            $consulta->bind_param("s", $nombre);
        }

        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $bd = new BD();
        $sql = $bd->conexion->prepare("DELETE FROM proyectos WHERE id = ?");
        $sql->bind_param("i", $this->id);
        $resultado = $sql->execute();
        if( $resultado && $sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
}