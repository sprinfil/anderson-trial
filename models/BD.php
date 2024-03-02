<?php

class BD{
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli('localhost','root','','crud_anderson');
        $this->conexion->set_charset('utf8');
    }
}
