<?php

require_once __DIR__.'/Util.php';

class ProfileModel{

    private $bd;
    private $getDataProfile;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->getDataProfile = array();
    }

    public function getDataUserSystem($data){
        $username = $data['username'];
        $rol = $data['rol'];
        $id = $data['id'];
        if($rol === '1'){
            $query = $this->bd->query("SELECT * FROM tblusuarios WHERE id=$id and nick='$username' and rol=$rol");
        }else{
            $query = $this->bd->query("SELECT * FROM tblasesores WHERE cedula='$username'");
        }

        while($row = $query->fetch_assoc()){
            $this->getDataProfile[] = $row;
        }
        return $this->getDataProfile;
    }

    public function updateDataUserSystem($data){
        $username      = $data['username'];
        $rol           = $data['rol'];
        $id            = $data['id'];
        $nameUser      = $data['nameUser'];
        $nickUser      = $data['nickUser'];
        $rolUser       = $data['rolUser'];
        $passwordUser  = $data['passwordUser'];
        $query = "UPDATE tblusuarios SET nombre='$nameUser', nick='$nickUser', rol='$rolUser' WHERE id=$id";
        if(!empty($passwordUser) || !$passwordUser===''){
            $query = "UPDATE tblusuarios SET nombre='$nameUser', nick='$nickUser', rol='$rolUser', clave='$passwordUser'  WHERE id=$id";
        }

        mysqli_query($this->bd, $query) or die ('Error en la actualización de datos.');
    }

    public function deleteUserSystemWithCode($code){
        $query = "DELETE tblusuarios WHERE nick='$code'";
        mysqli_query($this->bd, $query) or die ('Error en la eliminacion.');
    }


}