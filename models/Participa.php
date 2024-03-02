<?php

class Participa{
    public $id;
    public $usuario_id;
    public $proyecto_id;

    public function __construct() {

    }

    public function find($usuario_id, $proyecto_id){
        $bd = new BD();
        $sql = $bd->conexion->prepare(" SELECT * FROM participa WHERE usuario_id = ?  and proyecto_id = ? ");
        $sql->bind_param("ii", $usuario_id, $proyecto_id);
        $sql->execute();
        $resultado = $sql->get_result();
            // Verifica si hay resultados
        if ($resultado->num_rows > 0) {
            // Obtén la primera fila como un objeto
            $datos = $resultado->fetch_object();
            
            // Asigna los valores a las variables
            $this->usuario_id = $datos->usuario_id;
            $this->proyecto_id = $datos->proyecto_id;
            $this->id = $datos->id;
        } else {

        }
    }

    public function save(){
        if($this->id){
            $bd = new BD();
            $usuario_id = $this->usuario_id;
            $proyecto_id = $this->proyecto_id;
            $consulta = $bd->conexion->prepare("UPDATE participa SET usuario_id = ?, proyecto_id = ? WHERE id = ?");
            $consulta->bind_param("iii", $usuario_id, $proyecto_id,$this->id);
        }else{
            $bd = new BD();
            $usuario_id = $this->usuario_id;
            $proyecto_id = $this->proyecto_id;
            $consulta = $bd->conexion->prepare("INSERT INTO participa (usuario_id, proyecto_id) VALUES (?, ?)");
            $consulta->bind_param("ii", $usuario_id, $proyecto_id);
        }

        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $bd = new BD();
        $sql = $bd->conexion->prepare("DELETE FROM participa WHERE id = ?");
        $sql->bind_param("i", $this->id);
        $resultado = $sql->execute();
        if( $resultado && $sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
}