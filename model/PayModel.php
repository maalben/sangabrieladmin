<?php

require_once __DIR__.'/Util.php';

class PayModel{

    private $bd;
    private $PayList;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->PayList = array();
    }

    public function toListPays($rol, $advisor){
        $script = "SELECT * FROM tblasesorespagos WHERE realizado=0 ORDER BY id ASC";
        if($rol !== 1){
            $script = "SELECT * FROM tblasesorespagos WHERE nickasesor='$advisor' AND realizado=0 ORDER BY id ASC";
        }
        echo $script;
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->PayList[] = $records;
            }
            return $this->PayList;
        }
        return '';
    }
}