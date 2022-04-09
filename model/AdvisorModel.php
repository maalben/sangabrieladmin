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
        $toList = $this->bd->query("SELECT * FROM tblasesores");
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
        $email = $data['correoAsesor'];
        $address = $data['direccionAsesor'];
        $telephone = $data['telefonoAsesor'];
        $phone = $data['celularAsesor'];
        $accountNumber = $data['numeroCuentaAsesor'];
        $bankingEntity = $data['entidadBancariaAsesor'];
        $recordDate = Util::getDateRecord();

        $completeName = $firstName . ' ' . $lastName;

        $sql = "INSERT INTO tblasesores (nombre, apellido, cedula, codigoasesor, emailasesor, direccionasesor, telefonoasesor, celularasesor, bancocuentaasesor, numerocuentaasesor, recordDate) VALUES ('$firstName', '$lastName', '$identify', '$code', '$email', '$address', '$telephone', '$phone', '$bankingEntity', '$accountNumber', '$recordDate')";

        $sqlAdvisor = "INSERT INTO tblusuarios (nombre, nick, clave, rol) VALUES ('$completeName', '$identify', '$code', '2')";

        mysqli_query($this->bd, $sql) or die ('Error en el guardado.');
        mysqli_query($this->bd, $sqlAdvisor) or die ('Error en el guardado.');
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
}