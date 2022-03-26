<?php

require_once __DIR__.'/../model/OwnerModel.php';
require_once __DIR__.'/../model/BeneficiariesModel.php';

class OwnerController{

    private $ownerModel;
    private $beneficiariesModel;

    public function __construct(){
        $this->beneficiariesModel = new BeneficiariesModel();
        $this->ownerModel = new OwnerModel();
    }

    public function consultOwner(){
        $consulta = $this->ownerModel->toListOwners();
        require_once __DIR__ . '/../view/OwnerListView.php';
    }

    public function registerOwner(){
        require_once __DIR__ . '/../view/FormOwnerRegister.php';
    }

    public function saveOwner(){
        $vectorDato['cedula'] = $_POST["txtcedula"];
        $vectorDato['nombre'] = $_POST["txtnombre"];
        $vectorDato['apellido'] = $_POST["txtapellido"];
        $vectorDato['selestadocivil'] = $_POST["selestadocivil"];
        $vectorDato['fechanacimiento'] = $_POST["txtfechanacimiento"];
        $vectorDato['direccion'] = $_POST["txtdireccion"];
        $vectorDato['barrio'] = $_POST["txtbarrio"];
        $vectorDato['selmunicipio'] = $_POST["selmunicipio"];
        $vectorDato['celular'] = $_POST["txtcelular"];
        $vectorDato['correo'] = $_POST["txtcorreo"];
        $vectorDato['cantidadbeneficiarios'] = $_POST["txtcantidadbeneficiarios"];
        $vectorDato['mensualidad'] = $_POST["txtmensualidad"];
        $this->ownerModel->actionSaveOwners($vectorDato);
        ?><script>location.href='index/consultOwner';</script><?php
    }
}