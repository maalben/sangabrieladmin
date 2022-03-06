<?php 

class Conexion{

    public static function getConexion(){
        $conexion = new mysqli("127.0.0.1", "root", "12345678", "dbpersona");
        //$conexion->query("SET NAMES 'utf8mb4'");
        return $conexion;
    }
}
?>