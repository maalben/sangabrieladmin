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
        $name = $data['nombre'.$position] . ' ' . $data['apellido'.$position];
        $birthday = $data['fechanacimiento'.$position];
        $relationship = $data['selparentesco'.$position];
        $age = Util::calculateAge($birthday);
        $recordDate = Util::getDateRecord();
        $sql = "INSERT INTO tblbeneficiarios (cedulatitular, cedulabeneficiario, nombrecompletobeneficiario, fechanacimientobeneficiario, edadbeneficiario, parentescobeneficiario, recordDate) VALUES ($ownerIdentify, $identify, '$name', '$birthday', $age, '$relationship', '$recordDate')";
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
}