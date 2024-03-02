<?php 





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

    public function agregar_participante(){
        if($_POST['btn-agregar-participante']){
            $participa = new Participa();
            $participa->usuario_id = $_POST['usuario_id'];
            $participa->proyecto_id = $_GET['proyecto_id'];
            $participa->save();
            HerramientasController::alert_succes('/anderson-trial/views/proyectos_gestionar.php?proyecto_id='.$_GET['proyecto_id'], 'Participante agregado');
        }
    }

    public function eliminar_participante(){
        if(!empty(['btn-elimianr'])){
            if(!empty($_GET['usuario_id']) && !empty($_GET['proyecto_id'])){
                $participa = new Participa();
                $participa->find($_GET['usuario_id'],$_GET['proyecto_id']);
                $participa->delete();
                $tarea = new Tarea();
                $tarea->eliminar_tareas_participante($_GET['usuario_id'],$_GET['proyecto_id']);
            }
        }
    }

    public function crear_tarea(){
        //VALIDAR BOTON
        if(!empty($_POST['btn-crear'])){
            if(
                !empty($_POST['nombre']) and
                !empty($_POST['usuario_id']) and
                !empty($_POST['fecha_finalziar'])
            ){
                //CREAR TAREA
                $tarea = new Tarea();
                $tarea->nombre = $_POST['nombre'];
                $tarea->usuario_id = $_POST['usuario_id'];
                $tarea->fecha_finalziar = $_POST['fecha_finalziar'];
                $tarea->proyecto_id = $_GET['proyecto_id'];
                $tarea->finalizada = "FALSE";
               
                if($tarea->save()){
                    //TAREA CREADA CON EXITO
                    HerramientasController::alert_succes('/anderson-trial/views/proyectos_gestionar.php?proyecto_id='.$_GET['proyecto_id'], 'Tarea Agregada');
                }else{
                    //ERROR
                    HerramientasController::alert_warning('/anderson-trial/views/proyectos_agregar_tarea.php?proyecto_id='.$_GET['proyecto_id'], 'Ocurrio un error');
                }
             
            }else{
                //RELLENA TODOS LOS CAMPOS
                HerramientasController::alert_warning('/anderson-trial/views/proyectos_agregar_tarea.php?proyecto_id='.$_GET['proyecto_id'], 'Rellena los campos');
            }
        }
    }

    public function eliminar_tarea(){
        if(!empty($_GET['tarea_id']) && !empty($_GET['proyecto_id']) && empty($_GET['completar'])){
            $tarea = new Tarea();
            $tarea->find($_GET['tarea_id']);
            $tarea->delete();
        }
    }
}