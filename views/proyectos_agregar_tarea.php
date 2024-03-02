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
                <p>PROYECTOS</p>
            </div>


            <div class="contenedor-nuevo-usuario">
                <form class="formulario-nuevo-usuario" method="POST">
                    <h3 class="text-center text-secondary">Nueva Tarea</h3>
                    <?php
                    include '../models/BD.php';
                    include '../models/Tarea.php';
                    include '../controllers/ProyectosController.php';
                    include '../controllers/HerramientasController.php';
                    //INCLUIR USUARIOS QUE PERTENECEN AL PROYECTO
                    $bd = new BD();
                    $usuarios_proyecto = $bd->conexion->query(
                        '  SELECT usuarios.*
                            FROM usuarios
                            JOIN participa ON usuarios.id = participa.usuario_id
                            JOIN proyectos ON participa.proyecto_id = proyectos.id
                            WHERE proyectos.id =' . $_GET['proyecto_id'] . '
                        ;'
                    );

                    $proyectoController = new ProyectosController();
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $proyectoController->crear_tarea();
                    }
                    ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Asignar</label>
                        <select name="usuario_id" id="" class="form-control">
                            <?php while ($user = $usuarios_proyecto->fetch_object()) { ?>
                                <option value="<?= $user->id ?> ">
                                    <?= $user->nombre ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Fecha Limite</label>
                        <input type="date" name="fecha_finalziar" class="form-control">
                    </div>


                    <a href="/anderson-trial/views/proyectos_gestionar.php?proyecto_id=<?= $_GET['proyecto_id'] ?>"
                        class="boton-eliminar"><button type="button" class="btn btn-danger">
                            Volver
                        </button>
                    </a>
                    <button type="submit" class="btn btn-primary" name="btn-crear" value="ok">Aceptar</button>
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