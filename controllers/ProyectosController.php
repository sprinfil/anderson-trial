<?php 
    include 'HerramientasController.php';
    include '../models/Proyecto.php';

class ProyectosController{

    public function crear(){
        //VALIDAR BOTON
        if (!empty($_POST['btn-crear'])) {
            //VALIDAR CAMPOS
            if (!empty($_POST['nombre'])){
                //REGISTRAR PROYECTO
                $proyecto = new Proyecto();
                $proyecto->nombre = $_POST['nombre'];

                if ($proyecto->save()) {
                    //PROYECTO CREADO
                    HerramientasController::alert_succes('/anderson-trial/views/proyectos.php', 'Proyecto Creado');
                } else {
                    //OCURRIO UN ERROR AL CREAR
                    echo '<div class="alert alert-danger">OCURRIO UN ERROR AL INSERTAR LOS VALORES</div>';
                }
            }else{
                //RELLENA LOS CAMPOS
                HerramientasController::alert_warning('/anderson-trial/views/proyectos_create.php', 'Llena todos los campos');
            }
        }
    }

    public function modificar_proyecto(){
        if (!empty($_POST['btn-modificar'])) {
            if(!empty($_POST['nombre'])){
                $proyecto = new Proyecto();
                $proyecto->find($_GET['id']);
                $proyecto->nombre = $_POST['nombre'];
                if ($proyecto->save()) {
                    //PROYECTO EDITADO
                    HerramientasController::alert_succes('/anderson-trial/views/proyectos.php', 'Proyecto Editado');
                } else {
                    //OCURRIO UN ERROR AL CREAR
                    echo '<div class="alert alert-danger">OCURRIO UN ERROR AL INSERTAR LOS VALORES</div>';
                }
            }else{
                //RELLENA LOS CAMPOS
                HerramientasController::alert_warning('/anderson-trial/views/proyectos_update.php', 'Rellena los campos');
            }
        }
    }
    public function eliminar(){
        if(!empty($_GET['id'])){
            $proyecto = new Proyecto();
            $proyecto->find($_GET['id']);
            $proyecto->delete();
        }
    }
}