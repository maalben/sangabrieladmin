<?php

require_once __DIR__.'/../model/BeneficiariesModel.php';
require_once __DIR__.'/../model/OwnerModel.php';

class BeneficiariesController{

    private $beneficiariesModel;
    private $ownerModel;

    public function __construct(){
        $this->beneficiariesModel = new BeneficiariesModel();
        $this->ownerModel = new OwnerModel();
    }

    public function consultBeneficiaries(){
        $consulta = $this->beneficiariesModel->toListBeneficiaries();
        require_once __DIR__ . '/../view/BeneficiariesListView.php';
    }

    public function associateHolder(){
        require_once __DIR__ . '/../view/FormBeneficiariesRegister.php';
    }

    public function saveBeneficiaries(){

        if($this->ownerModel->getUniqueOwner($_POST['txtcedulaTitular']) === ''){
            ?>
            <script>
                alert("La cédula del titular ingresada no existe. Verifique por favor.");
                history.back();
            </script>
            <?php
            exit;
        }
        $vectorData['cedulaTitular'] = $_POST['txtcedulaTitular'];
        for ($i = 0; $i < 12; $i++) {
            if( $_POST['txtcedulabeneficiario' . $i] !== '' &&
                $_POST['txtnombre' . $i] !== '' &&
                $_POST['txtfechanacimiento' .$i]!=='' &&
                $_POST['selparentesco' .$i]!==''){
                $vectorData['cedula'.$i] = $_POST['txtcedulabeneficiario' .$i];
                $vectorData['nombre'.$i] = $_POST['txtnombre' .$i];
                $vectorData['apellido'.$i] = $_POST['txtapellido' .$i];
                $vectorData['fechanacimiento'.$i] = $_POST['txtfechanacimiento' .$i];
                $vectorData['selparentesco'.$i] = $_POST['selparentesco' .$i];
                $this->beneficiariesModel->actionSaveBeneficiaries($vectorData, $i);
            }
        }
        ?><script>
            alert("Se ha guardado el registro.");
            location.href='index/consultBeneficiaries';
        </script><?php
    }
}