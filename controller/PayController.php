<?php

require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/PayModel.php';
require_once __DIR__.'/../model/Util.php';

class PayController{

    private $payModel;

    public function __construct(){
        $this->payModel = new PayModel();
    }

    public function consultPaysPending(){
        $consulta = $this->payModel->toListPendingPays($_SESSION['rol'], $_SESSION['username']);
        $totalPay = $this->payModel->totalPendingPay($_SESSION['rol'], $_SESSION['username']);
        require_once __DIR__ . '/../view/PayListPendingView.php';
    }

    public function consultPaysAccomplished(){
        $consulta = $this->payModel->toListPaysAccomplished($_SESSION['rol'], $_SESSION['username']);
        $totalPay = $this->payModel->totalAccomplishedPay($_SESSION['rol'], $_SESSION['username']);
        require_once __DIR__ . '/../view/PayListAccomplishedView.php';
    }

    public function payOwner(){
        $vectorDataUser['idPay'] = $_REQUEST['id'];
        $this->payModel->actionSaveOwners($vectorDataUser);
        Util::confirmationProcess('Se ha actualizado el pago.', 'index/consultPaysPending');
    }
}