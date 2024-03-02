<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href="../css/usuarios.css">
    <title>USUARIOS</title>
</head>

<body>
    <div class="main">
        <!--HEADER-->
        <?php
        include 'layouts/header.php';
        ?>

        <!--PRINCIPAL-->
        <div class="contenedor-main">
            <div class="titulo">
                <p>USUARIOS</p>
            </div>
            <div class="contenedor-nuevo-usuario">
                <form class="formulario-nuevo-usuario" method="POST">
                    <h3 class="text-center text-secondary">Nuevo Usuario</h3>
                    <?php
                    include '../models/BD.php';
                    //include '../controllers/usuarios/CrearUsuarioController.php';
                    include '../controllers/UsuariosController.php';

                    $usuario = new UsuariosController();
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $usuario->crear_usuario();
                    }
                    ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre(s)</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Repetir Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="password_repetir">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Rol</label>
                        <select id="" class="form-control" name="rol">
                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                            <option value="USUARIO">USUARIO</option>
                            <option value="EDITOR">EDITOR</option>
                        </select>
                    </div>

                    <a href="/anderson-trial/views/usuarios.php"><button type="button" class="btn btn-danger">Regresar</button></a>
                    <button type="submit" class="btn btn-primary" name="btn-registrar" value="ok">Aceptar</button>
                </form>
            </div>
        </div>



        <!--FOOTER-->
        <?php
        include 'layouts/footer.php';
        ?>
    </div>
</body>

</html>