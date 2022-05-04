<?php
require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/LogoutModel.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../view/header2.php';

class LogoutController{

    private $logoutModel;

    public function __construct(){
        $this->logoutModel = new LogoutModel();
    }

    public function logout(){
        $this->logoutModel->closeSession();
        echo Util::popupMessage('Logout exitoso','Hope you enjoyed it :)','success','../login');
        exit;
    }
}