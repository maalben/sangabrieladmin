<?php 

class OwnerModel{

    private $bd;
    private $OwnerList;
    private $OwnerData;

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

    public function actionSaveOwners($data){
        $date = new DateTime();
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
        $date->setTimezone(new DateTimeZone('America/Bogota'));
        $recordDate = $date->format('d-m-Y h:i:s');

        if($numberBeneficiaries === 0 || $numberBeneficiaries === null || $numberBeneficiaries === ''){
            $sql = "INSERT INTO tbltitular (cedulaafiliado, codigoasesor, nombretitular, apellidotitular, estadociviltitular, fechanacimientotitular, edadtitular, direcciontitular, barriotitular, municipiotitular, celulartitular, correotitular, mensualidadtitular, cantidadbeneficiarios, recordDate) VALUES ($identify, 'Administrador', '$firstName', '$lastName', '$civilStatus', '$birthday', $age, '$address', '$town', '$city', $phone, '$email', $monthlyPayment, 0, '$recordDate')";
        }else{
            $sql = "INSERT INTO tbltitular (cedulaafiliado, codigoasesor, nombretitular, apellidotitular, estadociviltitular, fechanacimientotitular, edadtitular, direcciontitular, barriotitular, municipiotitular, celulartitular, correotitular, mensualidadtitular, cantidadbeneficiarios, recordDate) VALUES ($identify, 'Administrador', '$firstName', '$lastName', '$civilStatus', '$birthday', $age, '$address', '$town', '$city', $phone, '$email', $monthlyPayment, $numberBeneficiaries, '$recordDate')";
        }
        mysqli_query($this->bd, $sql) or die ("Error en el guardado.");
        ?>
        <script> alert("Se ha guardado el registro."); </script>
        <?php
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

    public function getUniqueOwner($identify){
        $getDataOwner = $this->bd->query("SELECT * FROM tbltitular WHERE cedulaafiliado=$identify");
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
}