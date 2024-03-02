<?php

class Tarea{
    public $id;
    public $nombre;
    public $usuario_id;
    public $fecha_finalziar;
    public $proyecto_id;
    public $finalizada;

    public function __construct() {

    }

    public function find($id){
        $bd = new BD();
        $sql = $bd->conexion->query(" SELECT * FROM tareas WHERE id = $id ");
        $datos = $sql->fetch_object();
        $this->id = $datos->id;
        $this->nombre = $datos->nombre;
        $this->usuario_id = $datos->usuario_id;
        $this->fecha_finalziar = $datos->fecha_finalziar;
        $this->proyecto_id = $datos->proyecto_id;
        $this->finalizada = $datos->finalizada;
    }

    public function save(){
        if($this->id){
            $bd = new BD();
            $nombre = $this->nombre;
            $usuario_id = $this->usuario_id;
            $fecha_finalziar = $this->fecha_finalziar;
            $proyecto_id = $this->proyecto_id;
            $finalizada = $this->finalizada;

            $consulta = $bd->conexion->prepare("UPDATE tareas SET nombre = ?, fecha_finalziar = ?, proyecto_id = ?, usuario_id = ?, finalizada = ? WHERE id = ?");
            $consulta->bind_param("ssiisi", $nombre, $fecha_finalziar, $proyecto_id, $usuario_id, $finalizada, $this->id);
        }else{
            $bd = new BD();
            $nombre = $this->nombre;
            $usuario_id = $this->usuario_id;
            $fecha_finalziar = $this->fecha_finalziar;
            $proyecto_id = $this->proyecto_id;
            $finalizada = $this->finalizada;

            $consulta = $bd->conexion->prepare("INSERT INTO tareas (nombre, fecha_finalziar, proyecto_id, usuario_id, finalizada) VALUES (?, ?, ?, ?, ?)");
            $consulta->bind_param("ssiis", $nombre, $fecha_finalziar, $proyecto_id, $usuario_id, $finalizada);
        }

        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $bd = new BD();
        $sql = $bd->conexion->prepare("DELETE FROM tareas WHERE id = ?");
        $sql->bind_param("i", $this->id);
        $resultado = $sql->execute();
        if( $resultado && $sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function eliminar_tareas_participante($usuario_id, $proyecto_id){
        $bd = new BD();
        $sql = $bd->conexion->prepare("DELETE FROM tareas WHERE usuario_id = ? AND proyecto_id = ?");
        $sql->bind_param("ii", $usuario_id, $proyecto_id);
        $resultado = $sql->execute();
        if( $resultado && $sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }

}