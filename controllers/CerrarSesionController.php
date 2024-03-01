<?php
if(!empty($_POST['btn-cerrar-sesion'])){
    echo 'hola';
    session_start();
    session_unset();
    session_destroy();
    header("Location: /anderson-trial/index.php");
    exit();
}
?>