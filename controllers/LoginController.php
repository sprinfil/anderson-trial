<?php
//validar sesion
session_start();

if (isset($_SESSION['user'])) {
    header('Location: views/home.php');
    exit();
}

//validar boton
if (!empty($_POST['btn-login'])) {
    //validar Campos
    if (!empty($_POST['username'] and !empty($_POST['password']))) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //REALIZAR LA CONSULTA
        $consulta = $conexion->prepare('SELECT * FROM usuarios WHERE username = ?');
        $consulta->bind_param("s", $username);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $user = $resultado->fetch_assoc();

        //VALIDAR USUARIO Y PASSWORD
        if ($user && password_verify($_POST['password'], $user['password'])) {

            //AGREGAR USUARIO A LA SESION
            $_SESSION['user'] = [
                'username' => $user['username'],
                'nombre' => $user['nombre'],
                'rol' => $user['rol']
            ];
            header("Location: views/home.php");
            echo json_encode(['success' => true]);
            exit();
        } else { 
            echo '<div class="alert alert-warning" >Contraseña Inconrrecta</div>';
        }
    } else {
        echo '<div class="alert alert-warning" >Rellena todos los campos.</div>';
    }
}


?>