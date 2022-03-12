<?php 

class Personasm{

    private $bd;
    private $listaPersonas;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->listaPersonas = array();
    }

    public function consultar(){
        $consulta = $this->bd->query("SELECT * FROM tblpersonas");
        while($fila = $consulta->fetch_assoc()){
            $this->listaPersonas[] = $fila;
        }
        return $this->listaPersonas;
    }

    public function insertar($data){
        $nombre = $data['nombre'];
        $edad = $data['edad'];
        $consulta = "INSERT INTO tblpersonas (nombre, edad) VALUES ('$nombre', '$edad')";
        mysqli_query($this->bd, $consulta) or die ("Error en el guardado.");
        ?>
        <script> alert("Se ha guardado el registro."); </script>
        <?php
    }

    public function consultarPersona($id){
        $consulta = $this->bd->query("SELECT * FROM tblpersonas WHERE id = ". $id);
        while($fila = $consulta->fetch_assoc()){
            $this->listaPersonas[] = $fila;
        }
        return $this->listaPersonas;
    }

    public function guardarcambios($data){
        $id = $data['id'];
        $nombre = $data['nombre'];
        $edad = $data['edad'];
        $consulta = "UPDATE tblpersonas SET nombre='$nombre', edad='$edad' WHERE id = '$id'";
        mysqli_query($this->bd, $consulta) or die ("Error en actualizar los datos.");
        ?>
        <script> alert("Se ha actualizado el registro."); </script>
        <?php
    }

    public function eliminarPersona($id){
        $consulta = "DELETE FROM tblpersonas WHERE id = '$id'";
        mysqli_query($this->bd, $consulta) or die ("Error al eliminar el registro.");
        ?>
        <script> alert("Se ha eliminado el registro."); </script>
        <?php
    }

}


?>