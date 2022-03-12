<?php

require_once __DIR__.'/../model/OwnerModel.php';

class OwnerController{

    private $ownerModel;

    public function __construct(){
        $this->ownerModel = new OwnerModel();
    }

    public function consultOwner(){
        $consulta = $this->ownerModel->toListOwners();
        require_once __DIR__ . '/../view/OwnerListView.php';
    }

    public function registerOwner(){
        require_once __DIR__ . '/../view/FormOwnerRegister.php';
    }
}