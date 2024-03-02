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
    <link rel="stylesheet" href="../css/proyectos_gestionar.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/alertas.js"></script>
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
            <?php
            include '../models/Proyecto.php';
            include '../models/BD.php';
            $proyecto = new Proyecto();
            $proyecto->find($_GET['proyecto_id']);
            ?>

            <!--VOLVER-->
            <a style="margin-left:20px;" href="/anderson-trial/views/proyectos.php" class="boton-eliminar"><button
                    type="button" class="btn btn-danger" style="margin-left:10px;margin-top:30px;">
                    Volver
                </button>
            </a>


            <h3 class="mt-5" style="margin-left:30px">PROYECTO:
                <?= $proyecto->nombre ?>
            </h3>

            <div class="contenedor-responsive">
                <div>
                    <h3 class=" text-secondary mt-2" style="margin-left:30px">PARTICIPANTES</h3>
                    <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
                    <!--NUEVO PARTICIPANTE-->
                    <a style="margin-left:20px;"
                        href="/anderson-trial/views/proyectos_agregar_participante.php?proyecto_id=<?= $_GET['proyecto_id'] ?>"
                        class="boton-eliminar"><button type="button" class="btn btn-primary"
                            style="margin-left:10px;margin-top:30px;">
                            Agregar Participante
                        </button>
                    </a>
                    <?php } ?>
                    <!--TABLA DE PARTICIPANTES-->
                    <div class=" p-4 d-flex justify-content-center align-items-center contenedor-tabla-datos">

                        <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Username</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                include '../controllers/UsuariosController.php';
                                include '../controllers/ProyectosController.php';
                                include '../models/Participa.php';
                                include '../models/Tarea.php';
                                $bd = new BD();
                                $sql = $bd->conexion->query('select * from usuarios');
                                $usuarioController = new UsuariosController();
                                $proyectosController = new ProyectosController();

                                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                    $bd = new BD();
                                    $sql = $bd->conexion->query(
                                        '  SELECT usuarios.*
                        FROM usuarios
                        JOIN participa ON usuarios.id = participa.usuario_id
                        JOIN proyectos ON participa.proyecto_id = proyectos.id
                        WHERE proyectos.id =' . $_GET['proyecto_id'] . '
                    ;'
                                    );
                                }

                                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                    $proyectosController->eliminar_participante();
                                    $bd = new BD();
                                    $sql = $bd->conexion->query(
                                        '  SELECT usuarios.*
                        FROM usuarios
                        JOIN participa ON usuarios.id = participa.usuario_id
                        JOIN proyectos ON participa.proyecto_id = proyectos.id
                        WHERE proyectos.id =' . $_GET['proyecto_id'] . '
                    ;'
                                    );
                                }

                                while ($datos = $sql->fetch_object()) { ?>
                                    <tr>
                                        <td>
                                            <?= $datos->nombre ?>
                                        </td>
                                        <td>
                                            <?= $datos->username ?>
                                        </td>
                                        <td>
                                        <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
                                            <a href="proyectos_gestionar.php?proyecto_id=<?= $proyecto->id ?>&usuario_id=<?= $datos->id ?>"
                                                onclick="alert_eliminar(event)">
                                                <div class="" style="display:flex; flex-wrap: nowrap;">
                                                    <button type="submit" class="btn btn-danger" name="btn_eliminar"
                                                        value="ok">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="aicon">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <h3 class=" text-secondary mt-2" style="margin-left:30px;">TAREAS</h3>
                    <!--NUEVA TAREA-->
                    <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
                    <a style="margin-left:20px;"
                        href="/anderson-trial/views/proyectos_agregar_tarea.php?proyecto_id=<?= $_GET['proyecto_id'] ?>"
                        class="boton-eliminar"><button type="button" class="btn btn-primary"
                            style="margin-left:10px;margin-top:30px;">
                            Agregar Tarea
                        </button>
                    </a>
                    <?php } ?>
                    <div class=" p-4 d-flex justify-content-center align-items-center contenedor-tabla-datos">
                        <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">Tarea</th>
                                    <th scope="col">Asignado</th>
                                    <th scope="col">fecha limite</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                           
                                $bd = new BD();
                                $sql = $bd->conexion->query('select * from tareas where proyecto_id = ' . $_GET['proyecto_id']);

                                //INVOCAR FUNCION PARA ELIMINAR TAREA
                                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                    $proyectosController->eliminar_tarea();
                                    $bd = new BD();
                                    $sql = $bd->conexion->query('select * from tareas where proyecto_id = ' . $_GET['proyecto_id']);
                                }

                                while ($datos = $sql->fetch_object()) {
                                    $usuario = new Usuario($datos->usuario_id) ?>
                                    <tr>
                                        <td>
                                            <?= $datos->nombre ?>
                                        </td>
                                        <td>
                                            <?= $usuario->nombre ?>
                                        </td>
                                        <td>
                                            <?= $datos->fecha_finalziar ?>
                                        </td>
                                        <td>
                                        <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
                                            <a href="proyectos_gestionar.php?proyecto_id=<?= $proyecto->id ?>&tarea_id=<?= $datos->id ?>"
                                                onclick="alert_eliminar(event)">
                                                <div class="" style="display:flex; flex-wrap: nowrap;">
                                                    <button type="submit" class="btn btn-danger" name="btn_eliminar"
                                                        value="ok">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="aicon">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!--FIN PRINCIPAL-->
        </div>


        <!--FOOTER-->
        <?php
        include 'layouts/footer.php';
        ?>
    </div>
</body>

</html>