<?php 

require_once 'model/Personasm.php';

class Personasc{

    private $model_persona;

    public function __construct(){
        $this->model_persona = new Personasm();
    }

    public function index(){
        $consulta = $this->model_persona->consultar();
        require_once 'view/Personasv.php';
    }

    public function guardar(){
        $vectorDato['nombre'] = $_POST["txtnombre"];
        $vectorDato['edad'] = $_POST["txtedad"];
        $this->model_persona->insertar($vectorDato);
        $this->index();
    }

    public function modificar(){
        $id = $_REQUEST["id"];
        $consulta = $this->model_persona->consultarPersona($id);
        require_once 'view/PersonasModificarInfov.php';
    }

    public function guardarcambios(){
        $vectorGuardarDato['id'] = $_POST["txtid"];
        $vectorGuardarDato['nombre'] = $_POST["txtnombre"];
        $vectorGuardarDato['edad'] = $_POST["txtedad"];
        $this->model_persona->guardarcambios($vectorGuardarDato);
        $this->index();
    }

    public function eliminar(){
        $id = $_REQUEST["id"];
        $consulta = $this->model_persona->eliminarPersona($id);
        $this->index();
    }


}


?>