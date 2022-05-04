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
            $query = $this->bd->query("SELECT * FROM tblasesores WHERE codigoasesor='$username'");
        }

        while($row = $query->fetch_assoc()){
            $this->getDataProfile[] = $row;
        }
        return $this->getDataProfile;
    }

    public function updateDataUserSystem($data){

        $rol           = $data['rol'];
        $username      = $data['username'];
        $id            = $data['id'];

        switch($_SESSION['rol']) {

            case '1':
                $nameUser      = $data['nameUser'];
                $nickUser      = $data['nickUser'];
                $rolUser       = $data['rolUser'];
                $passwordUser  = $data['passwordUser'];

                $query = "UPDATE tblusuarios SET nombre='$nameUser', nick='$nickUser' WHERE id=$id";
                if(!empty($passwordUser) || !$passwordUser===''){
                    $passwordUser  = Util::passwordCrypt($data['passwordUser']);
                    $query = "UPDATE tblusuarios SET nombre='$nameUser', nick='$nickUser', rol='$rolUser', clave='$passwordUser' WHERE id=$id";
                }
                break;

            case '2':
                $identify = $data['cedulaAsesor'];
                $firstName = $data['nombreAsesor'];
                $lastName = $data['apellidoAsesor'];
                $code = $data['codigoAsesor'];
                $passwordUser = $data['passwordAsesor'];
                $email = $data['correoAsesor'];
                $address = $data['direccionAsesor'];
                $telephone = $data['telefonoAsesor'];
                $phone = $data['celularAsesor'];
                $accountType = $data['tipoCuenta'];
                $bankingEntity = $data['entidadBancariaAsesor'];
                $accountNumber = $data['numeroCuentaAsesor'];

                $completeName = $firstName . ' ' . $lastName;

                $query = "UPDATE tblasesores SET nombre='$firstName', apellido='$lastName', emailasesor='$email', direccionasesor='$address', telefonoasesor='$telephone', celularasesor='$phone', bancocuentaasesor='$bankingEntity', numerocuentaasesor='$accountNumber', tipoCuenta='$accountType' WHERE cedula='$identify' AND codigoasesor='$code'";

                $sqlAdvisor = "UPDATE tblusuarios SET nombre='$completeName' WHERE nick='$code'";

                if(!empty($passwordUser) || !$passwordUser===''){
                    $passwordUser  = Util::passwordCrypt($passwordUser);
                    $query = "UPDATE tblasesores SET nombre='$firstName', apellido='$lastName', emailasesor='$email', direccionasesor='$address', telefonoasesor='$telephone', celularasesor='$phone', bancocuentaasesor='$bankingEntity', numerocuentaasesor='$accountNumber', tipoCuenta='$accountType', password='$passwordUser' WHERE cedula='$identify' AND codigoasesor='$code'";
                    $sqlAdvisor = "UPDATE tblusuarios SET nombre='$completeName', clave='$passwordUser' WHERE nick='$code'";
                }

                mysqli_query($this->bd, $sqlAdvisor) or die ('Error en la actualización.');
                break;

            default:
                Util::redirectTO('index/logout');
        }
        mysqli_query($this->bd, $query) or die ('Error en la actualización de datos.');
    }
}