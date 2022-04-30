<?php

require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/PayModel.php';
require_once __DIR__.'/../model/Util.php';

class PayController{

    private $payModel;

    public function __construct(){
        $this->payModel = new PayModel();
    }

    public function consultPays(){
        $consulta = $this->payModel->toListPays($_SESSION['rol'], $_SESSION['username']);
        require_once __DIR__ . '/../view/PayListView.php';
    }
}