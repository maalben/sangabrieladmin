<?php 

class OwnerModel{

    private $bd;
    private $OwnerList;
    private $OwnerData;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->OwnerList = array();
    }

    public function toListOwners($rol, $advisor){
        $script = "SELECT * FROM tbltitular ORDER BY id ASC";
        if($rol !== 1){
            $script = "SELECT * FROM tbltitular WHERE codigoasesor='$advisor' ORDER BY id ASC";
        }
        $toList = $this->bd->query($script);
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->OwnerList[] = $records;
            }
            return $this->OwnerList;
        }
        return '';
    }

    public function actionSaveOwners($data){
        $date = new DateTime();
        $identify = $data['cedula'];
        $advisor = $data['asesor'];
        $firstName = $data['nombre'];
        $lastName = $data['apellido'];
        $civilStatus = $data['selestadocivil'];
        $birthday = $data['fechanacimiento'];
        $address = $data['direccion'];
        $town = $data['barrio'];
        $city = $data['selmunicipio'];
        $phone = $data['celular'];
        $email = $data['correo'];
        $numberBeneficiaries = $data['cantidadbeneficiarios'];
        $monthlyPayment = $data['mensualidad'];

        $age = $this->calculateAge($birthday);
        $date->setTimezone(new DateTimeZone('America/Bogota'));
        $recordDate = $date->format('d-m-Y h:i:s');

        if($numberBeneficiaries === 0 || $numberBeneficiaries === null || $numberBeneficiaries === ''){  $numberBeneficiaries  = 0; }

        $sql = "INSERT INTO tbltitular (cedulaafiliado, codigoasesor, nombretitular, apellidotitular, estadociviltitular, fechanacimientotitular, edadtitular, direcciontitular, barriotitular, municipiotitular, celulartitular, correotitular, mensualidadtitular, cantidadbeneficiarios, recordDate) VALUES ($identify, '$advisor', '$firstName', '$lastName', '$civilStatus', '$birthday', $age, '$address', '$town', '$city', $phone, '$email', $monthlyPayment, $numberBeneficiaries, '$recordDate')";
        mysqli_query($this->bd, $sql) or die ("Error en el guardado.");

        $pendingpay = "INSERT INTO tblasesorespagos (nickasesor, cedulafiliado, valor, recordDate, realizado) VALUES ('$advisor', $identify, $monthlyPayment, '$recordDate', 0)";
        mysqli_query($this->bd, $pendingpay) or die ("Error en el guardado.");
        ?>
        <script> alert("Se ha guardado el registro."); </script>
        <?php
    }

    public function actionSaveChangeOwner($data){

        $identify = $data['cedula'];
        $firstName = $data['nombre'];
        $lastName = $data['apellido'];
        $civilStatus = $data['selestadocivil'];
        $birthday = $data['fechanacimiento'];
        $address = $data['direccion'];
        $town = $data['barrio'];
        $city = $data['selmunicipio'];
        $phone = $data['celular'];
        $email = $data['correo'];
        $numberBeneficiaries = $data['cantidadbeneficiarios'];
        $monthlyPayment = $data['mensualidad'];

        $age = $this->calculateAge($birthday);

        if($numberBeneficiaries === 0 || $numberBeneficiaries === null || $numberBeneficiaries === ''){
            $sql = "UPDATE tbltitular SET nombretitular='$firstName', apellidotitular='$lastName', estadociviltitular='$civilStatus', fechanacimientotitular='$birthday', edadtitular=$age, direcciontitular='$address', barriotitular='$town', municipiotitular='$city', celulartitular=$phone, correotitular='$email', mensualidadtitular=$monthlyPayment WHERE cedulaafiliado=$identify";
        }else{
            $sql = "UPDATE tbltitular SET nombretitular='$firstName', apellidotitular='$lastName', estadociviltitular='$civilStatus', fechanacimientotitular='$birthday', edadtitular=$age, direcciontitular='$address', barriotitular='$town', municipiotitular='$city', celulartitular=$phone, correotitular='$email', mensualidadtitular=$monthlyPayment, cantidadbeneficiarios=$numberBeneficiaries WHERE cedulaafiliado=$identify";
        }
        mysqli_query($this->bd, $sql) or die ("Error en la actualizacion.");
    }

    function calculateAge($birthday){
        list($ano,$mes,$dia) = explode("-",$birthday);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;
        return $ano_diferencia;
    }

    function dateSort($date){
        list($dia,$mes,$ano) = explode('-',$date);
        return $ano.'-'.$mes.'-'.$dia;
    }

    public function getUniqueOwner($identify, $rol, $advisor){
        $script = "SELECT * FROM tbltitular WHERE cedulaafiliado=$identify";
        if($rol !== 1){
            $script = "SELECT * FROM tbltitular WHERE cedulaafiliado=$identify AND codigoasesor='$advisor'";
        }
        $getDataOwner = $this->bd->query($script);
        if($getDataOwner->num_rows > 0){
            $records = $getDataOwner->fetch_assoc();
            $this->OwnerData[] = $records;
            return $this->OwnerData;
        }
        return '';
    }

    public function getQuantityOwner(){
        $getDataOwner = $this->bd->query("SELECT COUNT(*) as totalOwner FROM tbltitular");
        $data = $getDataOwner->fetch_assoc();
        return $data['totalOwner'];
    }

    public function getInformationOwner($identify){
        return $this->bd->query("SELECT * FROM tbltitular WHERE cedulaafiliado=$identify")->fetch_assoc();
    }
}