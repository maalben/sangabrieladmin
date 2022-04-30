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

    public function getQuantityAdvisors(){
        $toList = $this->bd->query("SELECT * FROM tblasesores");
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