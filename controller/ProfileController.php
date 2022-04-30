<?php

require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/ProfileModel.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../model/Constants.php';

class ProfileController{

    private $profileModel;

    public function __construct(){
        $this->profileModel = new ProfileModel();
    }

    public function profile(){
        $vectorDataUser['username'] = $_SESSION['username'];
        $vectorDataUser['rol']      = $_SESSION['rol'];
        $vectorDataUser['id']       = $_SESSION['id'];
        $consulta = $this->profileModel->getDataUserSystem($vectorDataUser);
        require_once __DIR__ . '/../view/FormProfile.php';
    }

    public function saveChangeProfile(){

        Util::valideFieldString($_POST['txtnombre'], 'No debes dejar el campo NOMBRE vacio.');
        Util::valideFieldString($_POST['txtnick'], 'No debes dejar el campo NICK o CODIGO vacio.');
        Util::valideFieldInt($_SESSION['rol'], 'No debes dejar el campo ROL vacio.');
        $vectorDataUser['username']      = $_SESSION['username'];
        $vectorDataUser['rol']           = $_SESSION['rol'];
        $vectorDataUser['id']            = $_SESSION['id'];
        switch($_SESSION['rol']){

            case '1':
                $vectorDataUser['nameUser']      = $_POST['txtnombre'];
                $vectorDataUser['nickUser']      = $_POST['txtnick'];
                $vectorDataUser['rolUser']       = $_POST['txtrol'];
                $vectorDataUser['passwordUser']  = $_POST['txtpassword'];
                break;

            case '2':
                $vectorDataUser['cedulaAsesor'] = $_POST['txtcedula'];
                $vectorDataUser['nombreAsesor'] = $_POST['txtnombre'];
                $vectorDataUser['apellidoAsesor'] = $_POST['txtapellido'];
                $vectorDataUser['codigoAsesor'] = $_POST['txtnick'];
                $vectorDataUser['passwordAsesor'] = $_POST['txtpassword'];
                $vectorDataUser['correoAsesor'] = $_POST['txtcorreo'];
                $vectorDataUser['direccionAsesor'] = $_POST['txtdireccion'];
                $vectorDataUser['telefonoAsesor'] = $_POST['txttelefono'];
                $vectorDataUser['celularAsesor'] = $_POST['txtcelular'];
                $vectorDataUser['tipoCuenta'] = $_POST['seltipocuenta'];
                $vectorDataUser['entidadBancariaAsesor'] = $_POST['txtentidadbancaria'];
                $vectorDataUser['numeroCuentaAsesor'] = $_POST['txtnumerocuenta'];
                break;

            default:
                Util::redirectTO('index/logout');
        }


        $this->profileModel->updateDataUserSystem($vectorDataUser);
        Util::confirmationProcess('Se ha actualizado el registro.', 'index/logout');
    }






}