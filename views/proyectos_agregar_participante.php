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
            <!--VOLVER-->
            <a href="/anderson-trial/views/proyectos_gestionar.php?proyecto_id=<?=$_GET['proyecto_id']?>"
                class="boton-eliminar"><button type="button" class="btn btn-danger"
                    style="margin-left:10px;margin-top:30px;">
                    Volver
                </button>
            </a>
            <h3 class="text-secondary mt-3"  style="margin-left:30px">Agregar Participante</h3>
            <!--TABLA DE DATOS-->
            <div class=" p-4 d-flex justify-content-center align-items-center contenedor-tabla-datos">
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Username</th>
                            <th scope="col">Rol</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../models/BD.php';
                        include '../controllers/ProyectosController.php';
                        include '../controllers/UsuariosController.php';
                        include '../models/Participa.php';
                        $bd = new BD();
                        $sql = $bd->conexion->query(
                        'SELECT *
                        FROM usuarios
                        WHERE id NOT IN (
                            SELECT usuarios.id
                            FROM usuarios
                            JOIN participa ON usuarios.id = participa.usuario_id
                            JOIN proyectos ON participa.proyecto_id = proyectos.id
                            WHERE proyectos.id = '.$_GET['proyecto_id'] . '
                        );');
                        
                        $usuarioController = new UsuariosController();
                        $proyectosController = new ProyectosController();

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $proyectosController->agregar_participante();
                            $bd = new BD();
                            $sql = $bd->conexion->query('select * from usuarios');
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
                                    <?= $datos->username ?>
                                </td>
                                <td>
                                    <?= $datos->rol ?>
                                </td>
                                <td>
                                    <div class="" style="display:flex; flex-wrap: nowrap;">
                                    <form method="POST">
                                        <button type="submit" class="btn btn-primary" name="btn-agregar-participante" value="ok">
                                            <input type="text" value="<?= $datos->id ?>" hidden name="usuario_id">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="aicon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                        </form>
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