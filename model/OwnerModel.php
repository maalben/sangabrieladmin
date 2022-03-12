<?php 

class OwnerModel{

    private $bd;
    private $OwnerList;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->OwnerList = array();
    }

    public function toListOwners(){
        $toList = $this->bd->query("SELECT * FROM tbltitular");
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->OwnerList[] = $records;
            }
            return $this->OwnerList;
        }
        return '';
    }
}