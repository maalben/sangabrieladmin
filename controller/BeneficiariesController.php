<?php

require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/BeneficiariesModel.php';
require_once __DIR__.'/../model/OwnerModel.php';
require_once __DIR__.'/../model/Util.php';

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

        if($this->ownerModel->getUniqueOwner($_POST['txtcedulaTitular'], $_SESSION['rol'], $_SESSION['username']) === ''){
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
        Util::confirmationProcess('Se ha guardado el registro.', 'index/consultBeneficiaries');
    }

    public function saveChangeBeneficiary(){

        $vectorData['cedulaTitular'] = $_POST['txtcedulaTitular'];
        $vectorData['cedula'] = $_POST['txtcedulabeneficiario'];
        $vectorData['nombre'] = $_POST['txtnombrebeneficiario'];
        $vectorData['fechanacimiento'] = $_POST['txtfechanacimientobeneficiario'];
        $vectorData['selparentesco'] = $_POST['selparentesco'];
        $this->beneficiariesModel->actionSaveChangeBeneficiary($vectorData);
        Util::confirmationProcess('Se ha guardado el registro.', 'index/consultBeneficiaries');
    }
}