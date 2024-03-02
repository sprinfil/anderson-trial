<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>PROYECTOS</title>
</head>

<body>
    <div class="contenedor-principal">
        <!--LOGIN-->
        <div class="tarjeta-login">
            <div class="contenedor-imagen">
                <img src="img/2.jpg" alt="">
            </div>
            <!--FORMULARIO-->
            <div class="contenedor-formulario">
                <form class="row" method="POST" id="loginForm">

                    <div class="col-12">
                    <h1 class="mb-4">BIENVENIDO</h1>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <!--IMPORTACIONES-->
                     <?php 
                        include 'models/BD.php';
                        include 'controllers/LoginController.php';
                        $loginController = new LoginController();
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $loginController->login();
                        }
                    ?>
                    <button type="submit" class="btn btn-primary" name="btn-login" value="ok">Iniciar Sesion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

