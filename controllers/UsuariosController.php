<?php

    include 'HerramientasController.php';
    include '../models/Usuario.php';

class UsuariosController
{
    public function crear_usuario()
    {
        $bd = new BD();
        
        if (!empty($_POST['btn-registrar'])) {
            //VALIDAR LOS CAMPOS
            if (
                !empty($_POST['nombre'])
                and !empty($_POST['username'])
                and !empty($_POST['password'])
                and !empty($_POST['password_repetir'])
                and !empty($_POST['rol'])

            ) {
                //VALIDAR CONTRASENAS IGUALES
                if ($_POST['password'] == $_POST['password_repetir']) {
                    //REGISTRAR USUARIO
                    $nombre = $_POST['nombre'];
                    $username = $_POST['username'];
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $rol = $_POST['rol'];

                    $consulta = $bd->conexion->prepare("INSERT INTO usuarios (nombre ,username, password, rol) VALUES (?, ?, ?, ?)");
                    $consulta->bind_param("ssss", $nombre, $username, $password, $rol);

                    if ($consulta->execute()) {
                        //USUARIO CREADO
                        HerramientasController::alert_succes('/anderson-trial/views/usuarios.php', 'Usuario creado con exito');
                    } else {
                        //OCURRIO UN ERROR AL INSERTAR LOS VALORES
                        echo '<div class="alert alert-danger">OCURRIO UN ERROR AL INSERTAR LOS VALORES</div>';
                    }

                } else {
                    //LAS CONTRASENAS NO COINCIDEN
                    HerramientasController::alert_warning('/anderson-trial/views/usuarios_create.php', 'Las contraseñas no coinciden');
                }
            } else {
                //RELLENA TODOS LOS CAMPOS
                HerramientasController::alert_warning('/anderson-trial/views/usuarios_create.php', 'Llena todos los campos');
            }
        }


    }

    public function modificar_usuario()
    {
        //CONEXION
        $bd = new BD();
        //OBTENER USUARIO
        $usuario = new Usuario($_GET['id']);

        //VALIDAR PETICION
        if (!empty($_POST['btn-modificar'])) {
            //VALIDAR SI MODIFICO PASSWORD
            if (!empty($_POST['password']) and !empty($_POST['password_repetir'])) {
                //VALIDAR SI LAS PASSWORD SON IGUALES
                if ($_POST['password'] == $_POST['password_repetir']) {
                    //MODIFICAR USUARIO
                    $nombre = $_POST['nombre'];
                    $username = $_POST['username'];
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $rol = $_POST['rol'];

                    $consulta = $bd->conexion->prepare("UPDATE usuarios SET nombre = ?, username = ?, password = ?, rol = ? WHERE id = $usuario->id");
                    $consulta->bind_param("ssss", $nombre, $username, $password, $rol);

                    if ($consulta->execute()) {
                        //USUARIO MODIFICADO
                        HerramientasController::alert_succes('/anderson-trial/views/usuarios.php', 'Usuario modificado con exito');
                    } else {
                        //OCURRIO UN ERROR AL MODIFICAR EL USUARIO
                        echo '<div class="alert alert-danger">OCURRIO UN ERROR AL MODIFICAR USUARIO</div>';
                    }
                } else {
                    //ERROR PASSWORD DISTINTAS
                    HerramientasController::alert_warning('/anderson-trial/views/usuarios.php', 'Las Contraseñas son distintas');
                }
            } else {
                //VALIDAR PASSWORD
                if (!empty($_POST['password']) or !empty($_POST['password_repetir'])) {
                    HerramientasController::alert_warning('/anderson-trial/views/usuarios.php', 'Rellena ambas Contraseñas');
                } else {
                    //NO MODIFICO PASSWORD
                    //MODIFICAR USUARIO
                    $nombre = $_POST['nombre'];
                    $username = $_POST['username'];
                    $rol = $_POST['rol'];

                    $consulta = $bd->conexion->prepare("UPDATE usuarios SET nombre = ?, username = ?, rol = ? WHERE id = $usuario->id");
                    $consulta->bind_param("sss", $nombre, $username, $rol);

                    if ($consulta->execute()) {
                        //USUARIO MODIFICADO
                        HerramientasController::alert_succes('/anderson-trial/views/usuarios.php', 'Usuario modificado con exito');
                    } else {
                        //OCURRIO UN ERROR AL MODIFICAR EL USUARIO
                        echo '<div class="alert alert-danger">OCURRIO UN ERROR AL MODIFICAR USUARIO</div>';
                    }
                }
            }
        }
    }

    public function eliminar(){
        if(!empty($_GET['id'])){
            $usuario = new Usuario($_GET['id']);
            $usuario->delete();
        }
    }
}