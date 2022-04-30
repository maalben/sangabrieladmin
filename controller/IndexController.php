<?php

require_once __DIR__.'/../model/AdvisorModel.php';
require_once __DIR__.'/../model/OwnerModel.php';
require_once __DIR__.'/../model/BeneficiariesModel.php';
require_once __DIR__.'/../model/PermissionsModel.php';

class IndexController{

    private $advisorModel;
    private $ownerModel;
    private $beneficiariesModel;
    private $permissionsModel;

    public function __construct(){
        $this->advisorModel = new AdvisorModel();
        $this->ownerModel = new OwnerModel();
        $this->beneficiariesModel = new BeneficiariesModel();
        $this->permissionsModel = new PermissionsModel();
    }

    public function index(){
        $advisorsQuantity = $this->advisorModel->getQuantityAdvisors();
        $ownerQuantity = $this->ownerModel->getQuantityOwner();
        $beneficiariesQuantity = $this->beneficiariesModel->getTotalQuantityBeneficiaries();
        require_once  __DIR__ . '/../view/index.php';
    }

}
