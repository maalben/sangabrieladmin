<?php

require_once __DIR__.'/Util.php';

class BeneficiariesModel{

    private $bd;
    private $BeneficiariesList;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->BeneficiariesList = array();
    }

    public function toListBeneficiaries(){
        $toList = $this->bd->query("SELECT * FROM tblbeneficiarios");
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->BeneficiariesList[] = $records;
            }
            return $this->BeneficiariesList;
        }
        return '';
    }

    public function actionSaveBeneficiaries($data, $position){
        $ownerIdentify = $data['cedulaTitular'];
        $identify = $data['cedula'.$position];
        $name = $data['nombre'.$position];
        $lastName = $data['apellido'.$position];
        $birthday = $data['fechanacimiento'.$position];
        $relationship = $data['selparentesco'.$position];
        $age = Util::calculateAge($birthday);
        $recordDate = Util::getDateRecord();
        $sql = "INSERT INTO tblbeneficiarios (cedulatitular, cedulabeneficiario, nombrebeneficiario, fechanacimientobeneficiario, edadbeneficiario, parentescobeneficiario, recordDate, apellidobeneficiario) VALUES ($ownerIdentify, $identify, '$name', '$birthday', $age, '$relationship', '$recordDate', '$lastName')";
        mysqli_query($this->bd, $sql) or die ('Error en el guardado.');
    }

    public function actionSaveChangeBeneficiary($data){
        $ownerIdentify = $data['cedulaTitular'];
        $identify = $data['cedula'];
        $name = $data['nombre'];
        $lastName = $data['apellido'];
        $birthday = $data['fechanacimiento'];
        $relationship = $data['selparentesco'];
        $age = Util::calculateAge($birthday);
        $sql = "UPDATE tblbeneficiarios SET nombrebeneficiario='$name', apellidobeneficiario='$lastName', fechanacimientobeneficiario='$birthday', edadbeneficiario=$age, parentescobeneficiario='$relationship' WHERE cedulatitular=$ownerIdentify AND cedulabeneficiario=$identify";
        mysqli_query($this->bd, $sql) or die ('Error en el guardado.');
    }

    public function getQuantityBeneficiaries($ownerIdentify){
        $toList = $this->bd->query("SELECT * FROM tblbeneficiarios WHERE cedulatitular=$ownerIdentify");
        return $toList->num_rows;
    }

    public function getTotalQuantityBeneficiaries(){
        $query = $this->bd->query('SELECT COUNT(*) as totalBeneficiaries FROM tblbeneficiarios');
        $totalBeneficiaries = $query->fetch_assoc();
        return $totalBeneficiaries['totalBeneficiaries'];
    }

    public function toListBeneficiariesByOwner($identify){
        $toList = $this->bd->query("SELECT DISTINCT cedulabeneficiario, nombrebeneficiario, apellidobeneficiario FROM tblbeneficiarios WHERE cedulatitular=$identify GROUP BY cedulabeneficiario, nombrebeneficiario, apellidobeneficiario");
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                echo $records['cedulabeneficiario'] . ' -> -> -> ' . $records['nombrebeneficiario'] . ' ' . $records['apellidobeneficiario'] .'<br>';
            }
        }else{
            echo 'No tiene registros';
        }
    }
}