<?php

require_once __DIR__.'/../model/AdvisorModel.php';

class IndexController{

    private $advisorModel;

    public function __construct(){
        $this->advisorModel = new AdvisorModel();
    }

    public function index(){
        $advisorsQuantity = $this->advisorModel->getQuantityAdvisors();
        require_once  __DIR__ . '/../view/index.php';
    }

}
