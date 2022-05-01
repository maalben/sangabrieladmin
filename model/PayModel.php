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

    public function actionSaveOwners($data){
        $idPay = $data['idPay'];
        $pendingPay = "UPDATE tblasesorespagos SET realizado=1 WHERE id=$idPay";
        mysqli_query($this->bd, $pendingPay) or die ("Error en el guardado.");
    }
}