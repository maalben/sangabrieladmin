<?php

require_once __DIR__.'/Util.php';

class PayModel{

    private $bd;
    private $PayList;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->PayList = array();
    }

    public function toListPendingPays($rol, $advisor){
        $script = "SELECT * FROM tblasesorespagos WHERE realizado=0 ORDER BY id ASC";
        if($rol !== '1'){
            $script = "SELECT * FROM tblasesorespagos WHERE nickasesor='$advisor' AND realizado=0 ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->PayList[] = $records;
            }
            return $this->PayList;
        }
        return '';
    }

    public function totalPendingPay($rol, $advisor){
        $script = "SELECT SUM(valor) AS 'Total' FROM tblasesorespagos WHERE realizado=0 ORDER BY id ASC";
        if($rol !== '1'){
            $script = "SELECT SUM(valor) AS 'Total' FROM tblasesorespagos WHERE nickasesor='$advisor' AND realizado=0 ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            $records = $toList->fetch_assoc();
            return $records['Total'];
        }
        return '';
    }

    public function toListPaysAccomplished($rol, $advisor){
        $script = "SELECT * FROM tblasesorespagos WHERE realizado=1 ORDER BY id ASC";
        if($rol !== '1'){
            $script = "SELECT * FROM tblasesorespagos WHERE nickasesor='$advisor' AND realizado=1 ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->PayList[] = $records;
            }
            return $this->PayList;
        }
        return '';
    }

    public function toListPaysAccomplishedWithDateRange($rol, $advisor, $data){
        $initialDate = $data['InitialDate'].' 00:00:00';
        $finalDate = $data['FinalDate'].' 23:59:59';
        $script = "SELECT * FROM tblasesorespagos WHERE recordDate BETWEEN '$initialDate' AND '$finalDate' AND realizado=1 ORDER BY id ASC";
        if($rol !== '1'){
            $script = "SELECT * FROM tblasesorespagos WHERE recordDate BETWEEN '$initialDate' AND '$$finalDate' AND nickasesor='$advisor' AND realizado=1 ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->PayList[] = $records;
            }
            return $this->PayList;
        }
        return '';
    }

    public function totalAccomplishedPay($rol, $advisor){
        $script = "SELECT SUM(valor) AS 'Total' FROM tblasesorespagos WHERE realizado=1 ORDER BY id ASC";
        if($rol !== '1'){
            $script = "SELECT SUM(valor) AS 'Total' FROM tblasesorespagos WHERE nickasesor='$advisor' AND realizado=1 ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            $records = $toList->fetch_assoc();
            return $records['Total'];
        }
        return '';
    }

    public function totalAccomplishedPayWithDateRange($rol, $advisor, $data){
        $initialDate = $data['InitialDate'].' 00:00:00';
        $finalDate = $data['FinalDate'].' 23:59:59';
        $script = "SELECT SUM(valor) AS 'Total' FROM tblasesorespagos WHERE payDate BETWEEN '$initialDate' AND '$finalDate' AND realizado=1 ORDER BY id ASC";
        if($rol !== '1'){
            $script = "SELECT SUM(valor) AS 'Total' FROM tblasesorespagos WHERE payDate BETWEEN '$initialDate' AND '$finalDate' AND nickasesor='$advisor' AND realizado=1 ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            $records = $toList->fetch_assoc();
            return $records['Total'];
        }
        return '';
    }

    public function actionSaveOwners($data){
        $idPay = $data['idPay'];
        $payDate = $recordDate = Util::getDateRecord();
        $pendingPay = "UPDATE tblasesorespagos SET realizado=1, payDate='$payDate' WHERE id=$idPay";
        mysqli_query($this->bd, $pendingPay) or die ("Error en la actualizacion.");
    }

    public function blockDetailsOwner($rol, $advisor, $ownerIdentify){
        $script = "SELECT * FROM tblasesorespagos";
        if($rol !== '1'){
            if(self::getValueOwnerPayed($advisor, $ownerIdentify) === 1){
                $script = "SELECT * FROM tblasesorespagos WHERE cedulafiliado = $ownerIdentify AND nickasesor = '$advisor' AND realizado = 1";
            }else{
                $script = "SELECT * FROM tblasesorespagos WHERE cedulafiliado = $ownerIdentify AND nickasesor = '$advisor' AND realizado = 0";
            }
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            return 1;
        }
        return 0;
    }

    private function getValueOwnerPayed($advisor, $ownerIdentify){
        $script = "SELECT realizado FROM tblasesorespagos WHERE cedulafiliado = $ownerIdentify AND nickasesor = '$advisor'";
        $value = $this->bd->query($script);
        $record = $value->fetch_assoc();
        return $record['realizado'];
    }
}