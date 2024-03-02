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
    <title>PROYECTOS</title>
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
                <p>PROYECTOS</p>
            </div>
            <div class="contenedor-nuevo-usuario">
                <form class="formulario-nuevo-usuario" method="POST" id="modificarForm">
                <?php
                    include '../models/BD.php';
                    include '../controllers/ProyectosController.php';

                    //CREAR CONTROLLER Y MODEL 
                    $proyectoController = new ProyectosController();
                    $proyecto = new Proyecto();
                    $proyecto->find($_GET['id']);

                    //MODIFCAR USUARIO CUANDO SE EJECUTA EL POST
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $proyectoController->modificar_proyecto();
                    }
                    ?>
                    
                    <h3 class="text-center text-secondary">EDITAR PROYECTO</h3>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre(s)</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nombre" value="<?= $proyecto->nombre ?>">
                    </div>
                    <a href="/anderson-trial/views/proyectos.php"><button type="button" class="btn btn-danger">Regresar</button></a>
                    <button type="submit" class="btn btn-primary" name="btn-modificar" value="ok">Aceptar</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="../js/jquery.js"></script>

        <!--FOOTER-->
        <?php
        include 'layouts/footer.php';
        ?>
    </div>
</body>

</html>
