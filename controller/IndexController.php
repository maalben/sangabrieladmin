<?php

require_once __DIR__.'/../model/AdvisorModel.php';
require_once __DIR__.'/../model/OwnerModel.php';
require_once __DIR__.'/../model/BeneficiariesModel.php';
require_once __DIR__.'/../model/PermissionsModel.php';
require_once __DIR__.'/../model/PayModel.php';
require_once __DIR__.'/../model/Util.php';

class IndexController{

    private $advisorModel;
    private $ownerModel;
    private $beneficiariesModel;
    private $permissionsModel;
    private $payModel;

    public function __construct(){
        $this->advisorModel = new AdvisorModel();
        $this->ownerModel = new OwnerModel();
        $this->beneficiariesModel = new BeneficiariesModel();
        $this->permissionsModel = new PermissionsModel();
        $this->payModel = new PayModel();
    }

    public function index(){
        $advisorsQuantity = $this->advisorModel->getQuantityAdvisors($_SESSION['rol'], $_SESSION['username']);
        $ownerQuantity = $this->ownerModel->getQuantityOwner($_SESSION['rol'], $_SESSION['username']);
        $beneficiariesQuantity = $this->beneficiariesModel->getTotalQuantityBeneficiaries($_SESSION['rol'], $_SESSION['username']);
        $accomplishedPay = $this->payModel->totalAccomplishedPay($_SESSION['rol'], $_SESSION['username']);
        $pendingPay = $this->payModel->totalPendingPay($_SESSION['rol'], $_SESSION['username']);
        require_once  __DIR__ . '/../view/index.php';
    }

}
