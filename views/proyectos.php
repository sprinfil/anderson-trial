<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/principal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="../css/usuarios.css">
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
            <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
            <!--NUEVO PROYECTO-->
            <a href="/anderson-trial/views/proyectos_create.php" class="boton-eliminar"><button type="button"
                    class="btn btn-primary" style="margin-left:10px;margin-top:30px;">
                    Nuevo Proyecto
                </button>
            </a>
            <?php } ?>
                        
            <!--TABLA DE DATOS-->
            <div class=" p-4 d-flex justify-content-center align-items-center contenedor-tabla-datos">
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../models/BD.php';
                        include '../models/Proyecto.php';
                        include '../controllers/ProyectosController.php';
                        $bd = new BD();
                        $sql = $bd->conexion->query('select * from proyectos');
                        $proyectosController = new ProyectosController();

                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            $proyectosController->eliminar();
                            $bd = new BD();
                            $sql = $bd->conexion->query('select * from proyectos');
                        }

                        while ($datos = $sql->fetch_object()) { ?>
                            <tr>
                                <th scope="row">
                                    <?= $datos->id ?>
                                </th>
                                <td>
                                    <?= $datos->nombre ?>
                                </td>
                                <td>
                                <div class="" style="display:flex; flex-wrap: nowrap;">
                                <a href="proyectos_gestionar.php?proyecto_id=<?= $datos->id ?>"
                                            style="margin-right:10px;"><button type="button" class="btn btn-primary">
                                                <i class="bi bi-pencil"></i> Ver Proyecto
                                            </button>
                                        </a>
                                        <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
                                        <a href="proyectos_update.php?id=<?= $datos->id ?>"
                                            style="margin-right:10px;"><button type="button" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="aicon">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </button>
                                        </a>
                                        <?php }?>
                                        
                                        <?php if ($_SESSION['user']['rol'] == 'ADMINISTRADOR' or $_SESSION['user']['rol'] == 'EDITOR') { ?>
                                        <a href="proyectos.php?id=<?= $datos->id ?>" class="boton-eliminar" onclick="alert_eliminar(event)">
                                        <button
                                                type="button" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="aicon">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </a>
                                        <?php }?>
                                    </div>
                                </td>
                            </tr>
                        <?php }

                        ?>

                    </tbody>
                </table>
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