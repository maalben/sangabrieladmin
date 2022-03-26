<?php

require_once __DIR__.'/../model/AdvisorModel.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../model/Constants.php';

class AdvisorController{

    private $advisorModel;

    public function __construct(){
        $this->advisorModel = new AdvisorModel();
    }

    public function consultAdvisors(){
        $consulta = $this->advisorModel->toListAdvisors();
        require_once __DIR__ . '/../view/AdvisorsListView.php';
    }

    public function enrollAdvisor(){
        require_once __DIR__ . '/../view/FormAdvisorRegister.php';
    }

    public function saveAdvisor(){

        if($this->advisorModel->getUniqueCodeAdvisor($_POST['txtcodigounico']) > 0){
            Util::messageAlert(sprintf(Constants::EXIST_RECORD, Constants::THE_CODE, Constants::ADVISOR));
        }

        if($this->advisorModel->getUniqueIdentifyAdvisor($_POST['txtcedula']) > 0){
            Util::messageAlert(sprintf(Constants::EXIST_RECORD, Constants::THE_IDENTIFY, Constants::ADVISOR));
        }

        $vectorData['cedulaAsesor'] = $_POST['txtcedula'];
        $vectorData['nombreAsesor'] = $_POST['txtnombre'];
        $vectorData['apellidoAsesor'] = $_POST['txtapellido'];
        $vectorData['codigoAsesor'] = $_POST['txtcodigounico'];
        $vectorData['correoAsesor'] = $_POST['txtcorreo'];
        $vectorData['direccionAsesor'] = $_POST['txtdireccion'];
        $vectorData['telefonoAsesor'] = $_POST['txttelefono'];
        $vectorData['celularAsesor'] = $_POST['txtcelular'];
        $vectorData['numeroCuentaAsesor'] = $_POST['txtnumerocuenta'];
        $vectorData['entidadBancariaAsesor'] = $_POST['txtentidadbancaria'];
        $this->advisorModel->actionSaveAdvisors($vectorData);

        Util::confirmationProcess('Se ha guardado el registro.', 'index/consultAdvisors');
    }
}