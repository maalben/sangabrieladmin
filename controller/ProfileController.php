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
        Util::valideFieldInt($_POST['txtrol'], 'No debes dejar el campo ROL vacio.');

        $vectorDataUser['username']      = $_SESSION['username'];
        $vectorDataUser['rol']           = $_SESSION['rol'];
        $vectorDataUser['id']            = $_SESSION['id'];
        $vectorDataUser['nameUser']      = $_POST['txtnombre'];
        $vectorDataUser['nickUser']      = $_POST['txtnick'];
        $vectorDataUser['rolUser']       = $_POST['txtrol'];
        $vectorDataUser['passwordUser']  = $_POST['txtpassword'];
        $this->profileModel->updateDataUserSystem($vectorDataUser);
        Util::confirmationProcess('Se ha actualizado el registro.', 'index/logout');
    }






}