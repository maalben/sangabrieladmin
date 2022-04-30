<?php

require_once __DIR__.'/../model/AdvisorModel.php';
require_once __DIR__.'/../model/PermissionsModel.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../model/Constants.php';

class AdvisorController{

    private $advisorModel;
    private $permissionsModel;

    public function __construct(){
        $this->advisorModel = new AdvisorModel();
        $this->permissionsModel = new PermissionsModel();
    }

    public function consultAdvisors(){
        $consulta = $this->advisorModel->toListAdvisors();
        $listPermissionsOptions = $this->permissionsModel->toListPermissions();
        require_once __DIR__ . '/../view/AdvisorsListView.php';
    }

    public function enrollAdvisor(){
        require_once __DIR__ . '/../view/FormAdvisorRegister.php';
    }

    public function saveAdvisor(){

        if($_POST['seltipocuenta'] === ''){
            Util::messageAlert(sprintf(Constants::FIELD_ACCOUNT_TYPE_NOT_BLANK, Constants::FIELD, Constants::ACCOUNT_TYPE));
        }

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
        $vectorData['passwordAsesor'] = $_POST['txtpassword'];
        $vectorData['correoAsesor'] = $_POST['txtcorreo'];
        $vectorData['direccionAsesor'] = $_POST['txtdireccion'];
        $vectorData['telefonoAsesor'] = $_POST['txttelefono'];
        $vectorData['celularAsesor'] = $_POST['txtcelular'];
        $vectorData['tipoCuenta'] = $_POST['seltipocuenta'];
        $vectorData['entidadBancariaAsesor'] = $_POST['txtentidadbancaria'];
        $vectorData['numeroCuentaAsesor'] = $_POST['txtnumerocuenta'];
        $this->advisorModel->actionSaveAdvisors($vectorData);
        Util::confirmationProcess('Se ha guardado el registro.', 'index/consultAdvisors');
    }

    public function saveChangeAdvisor(){

        $vectorData['cedulaAsesor'] = $_POST['txtcedula'];
        $vectorData['nombreAsesor'] = $_POST['txtnombre'];
        $vectorData['apellidoAsesor'] = $_POST['txtapellido'];
        $vectorData['codigoAsesor'] = $_POST['txtcodigounico'];
        $vectorData['passwordAsesor'] = $_POST['txtpassword'];
        $vectorData['correoAsesor'] = $_POST['txtcorreo'];
        $vectorData['direccionAsesor'] = $_POST['txtdireccion'];
        $vectorData['telefonoAsesor'] = $_POST['txttelefono'];
        $vectorData['celularAsesor'] = $_POST['txtcelular'];
        $vectorData['tipoCuenta'] = $_POST['seltipocuenta'];
        $vectorData['entidadBancariaAsesor'] = $_POST['txtentidadbancaria'];
        $vectorData['numeroCuentaAsesor'] = $_POST['txtnumerocuenta'];
        $this->advisorModel->actionSaveChangesAdvisor($vectorData);
        Util::confirmationProcess('Se ha actualizado el registro.', 'index/consultAdvisors');
    }

}