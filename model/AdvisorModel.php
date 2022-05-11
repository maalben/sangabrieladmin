<?php

require_once __DIR__.'/Util.php';

class AdvisorModel{

    private $bd;
    private $AdvisorList;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->AdvisorList = array();
    }

    public function toListAdvisors(){
        $toList = $this->bd->query("SELECT * FROM tblasesores  WHERE id<>1");
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->AdvisorList[] = $records;
            }
            return $this->AdvisorList;
        }
        return '';
    }

    public function actionSaveAdvisors($data){
        $identify = $data['cedulaAsesor'];
        $firstName = $data['nombreAsesor'];
        $lastName = $data['apellidoAsesor'];
        $code = $data['codigoAsesor'];
        $password = Util::passwordCrypt($data['passwordAsesor']);
        $email = $data['correoAsesor'];
        $address = $data['direccionAsesor'];
        $telephone = $data['telefonoAsesor'];
        $phone = $data['celularAsesor'];
        $accountType = $data['tipoCuenta'];
        $bankingEntity = $data['entidadBancariaAsesor'];
        $accountNumber = $data['numeroCuentaAsesor'];
        $recordDate = Util::getDateRecord();

        $completeName = $firstName . ' ' . $lastName;

        $sql = "INSERT INTO tblasesores (nombre, apellido, cedula, codigoasesor, emailasesor, direccionasesor, telefonoasesor, celularasesor, bancocuentaasesor, numerocuentaasesor, recordDate, tipoCuenta, password) VALUES ('$firstName', '$lastName', '$identify', '$code', '$email', '$address', '$telephone', '$phone', '$bankingEntity', '$accountNumber', '$recordDate','$accountType', '$password')";

        $sqlAdvisor = "INSERT INTO tblusuarios (nombre, nick, clave, rol) VALUES ('$completeName', '$code', '$password', '2')";

        mysqli_query($this->bd, $sql) or die ('Error en el guardado.');
        mysqli_query($this->bd, $sqlAdvisor) or die ('Error en el guardado.');

        $lastId = self::getLastAdvisorId($code);
        $sqlAdvisorPermission = "INSERT INTO tblpermisos (Modulo, Usuario, Padre) VALUES (5, $lastId, 1), (6, $lastId, 1), (7, $lastId, 2), (8, $lastId, 2), (11, $lastId, 4), (12, $lastId, 4), (13, $lastId, 4)";
        mysqli_query($this->bd, $sqlAdvisorPermission) or die ('Error en el guardado.');
    }

    private function getLastAdvisorId($nick){
        $record = $this->bd->query("SELECT id FROM tblusuarios WHERE nick='$nick'");
        if($record->num_rows > 0){
            $data = $record->fetch_assoc();
            return $data['id'];
        }
        return '';
    }

    public function actionSaveChangesAdvisor($data){
        $identify = $data['cedulaAsesor'];
        $firstName = $data['nombreAsesor'];
        $lastName = $data['apellidoAsesor'];
        $code = $data['codigoAsesor'];
        $email = $data['correoAsesor'];
        $address = $data['direccionAsesor'];
        $telephone = $data['telefonoAsesor'];
        $phone = $data['celularAsesor'];
        $accountType = $data['tipoCuenta'];
        $bankingEntity = $data['entidadBancariaAsesor'];
        $accountNumber = $data['numeroCuentaAsesor'];
        $passwordUser = $data['passwordAsesor'];

        $completeName = $firstName . ' ' . $lastName;

        $sql = "UPDATE tblasesores SET nombre='$firstName', apellido='$lastName', emailasesor='$email', direccionasesor='$address', telefonoasesor='$telephone', celularasesor='$phone', bancocuentaasesor='$bankingEntity', numerocuentaasesor='$accountNumber', tipoCuenta='$accountType' WHERE cedula='$identify' AND codigoasesor='$code'";

        $sqlAdvisor = "UPDATE tblusuarios SET nombre='$completeName' WHERE nick='$code'";

        if(!empty($passwordUser) || !$passwordUser===''){
            $passwordUser  = Util::passwordCrypt($passwordUser);
            $sql = "UPDATE tblasesores SET nombre='$firstName', apellido='$lastName', emailasesor='$email', direccionasesor='$address', telefonoasesor='$telephone', celularasesor='$phone', bancocuentaasesor='$bankingEntity', numerocuentaasesor='$accountNumber', tipoCuenta='$accountType', password='$passwordUser' WHERE cedula='$identify' AND codigoasesor='$code'";
            $sqlAdvisor = "UPDATE tblusuarios SET nombre='$completeName', clave='$passwordUser' WHERE nick='$code'";
        }

        mysqli_query($this->bd, $sql) or die ('Error en la actualización.');
        mysqli_query($this->bd, $sqlAdvisor) or die ('Error en la actualización.');
    }

    public function getQuantityAdvisors($rol, $advisor){

        $script = "SELECT * FROM tblasesores WHERE codigoasesor<>'admin'";
        if($rol !== '1'){
            $script = "SELECT * FROM tblasesores WHERE codigoasesor='$advisor'";
        }
        $toList = $this->bd->query($script);
        return $toList->num_rows;
    }

    public function getUniqueCodeAdvisor($advisorCode){
        $toList = $this->bd->query("SELECT * FROM tblasesores WHERE codigoasesor='$advisorCode'");
        return $toList->num_rows;
    }

    public function getUniqueIdentifyAdvisor($advisorIdentify){
        $toList = $this->bd->query("SELECT * FROM tblasesores WHERE cedula='$advisorIdentify'");
        return $toList->num_rows;
    }

    public function getNameAdvisor($advisorCode){
        $toList = $this->bd->query("SELECT * FROM tblasesores WHERE codigoasesor='$advisorCode'");
        if($toList->num_rows > 0){
            $records = $toList->fetch_assoc();
            return $records['nombre'] . ' ' . $records['apellido'];
        }
        return '';
    }
}