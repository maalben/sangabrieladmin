<?php

require_once __DIR__.'/Util.php';

class PermissionsModel{

    private $bd;
    private $permissionsList;
    private $permissionsModule;

    public function __construct(){
        $this->bd = Connection::getConnection();
        $this->permissionsList = array();
        $this->permissionsModule = array();
    }

    public function toListPermissions(){
        $toList = $this->bd->query("SELECT Nombre, Id FROM tblmodulos Where Padre_id > 0 ORDER BY Padre_id ASC");
        if($toList->num_rows > 0){
            while($records = $toList->fetch_assoc()){
                $this->permissionsList[] = $records;
            }
            return $this->permissionsList;
        }
        return '';
    }

    public function advisorPermission($idModulo, $idCustomer){
        $data = $this->bd->query("SELECT Usuario, Modulo FROM tblpermisos where Modulo=$idModulo and Usuario=$idCustomer");
        if($data->num_rows > 0){
            return $data->fetch_assoc()['Usuario'];
        }
        return '';
    }

    public function quantityPermissions(){
        $toList = $this->bd->query("SELECT count(Id) AS 'Total' FROM tblmodulos");
        if($toList->num_rows > 0){
            return $toList->fetch_assoc()['Total'];
        }
        return 0;
    }

    public function getQuantityPermissionsByAdvisor($index, $idAdvisor){
        $query = $this->bd->query("SELECT Modulo FROM tblpermisos WHERE Modulo=$index and Usuario=$idAdvisor");
        if($query->num_rows > 0){
            return $query->num_rows;
        }
        return 0;
    }

    public function getModuleMain($index){
        $query = $this->bd->query("SELECT Padre_id FROM tblmodulos WHERE Id=$index");
        if($query->num_rows > 0){
            return $query->fetch_assoc()['Padre_id'];
        }
        return 0;
    }

    public function getIdUserSystem($nickUser){
        $data = $this->bd->query("SELECT id, rol FROM tblusuarios where nick='$nickUser'");
        if($data->num_rows > 0){
            return $data->fetch_assoc()['id'];
        }
        return '';
    }

    public function savePermissionAdvisor($index, $idAdvisor, $idMainModule){
        $sql = "INSERT INTO tblpermisos (Modulo, Usuario, Padre) VALUES ($index, $idAdvisor, $idMainModule)";
        mysqli_query($this->bd, $sql) or die ('Error en el guardado de los permisos.');
    }

    public function deletePermissionAdvisor($index, $idAdvisor){
        $sql = "DELETE FROM tblpermisos WHERE Modulo=$index AND Usuario=$idAdvisor";
        mysqli_query($this->bd, $sql) or die ('Error en el eliminado de los permisos.');
    }

    public function generateMenuWithPermission($idSessionUser){
        $sql = $this->bd->query("SELECT DISTINCT tblmodulos.Nombre, tblmodulos.Fin, tblmodulos.Id FROM tblmodulos, tblpermisos WHERE tblmodulos.Padre_id=0 AND tblpermisos.Padre=tblmodulos.Id AND tblpermisos.Usuario=$idSessionUser ORDER BY tblmodulos.Id");
        if($sql->num_rows > 0){
            while($records = $sql->fetch_assoc()){
                $this->permissionsList[] = $records;
            }
            return $this->permissionsList;
        }
        return '';
    }

    public function getModuleEnableByUser($idModule, $idSessionUser, $prexis){
        $prexisUrl = $prexis;
        $id = $idSessionUser;
        $sql = $this->bd->query("SELECT tblmodulos.Nombre, tblmodulos.Fin, tblmodulos.Id FROM tblmodulos, tblpermisos WHERE tblmodulos.Padre_id=$idModule AND tblpermisos.Modulo=tblmodulos.Id AND tblpermisos.Usuario=$id");
        if($sql->num_rows > 0){
            while($records = $sql->fetch_assoc()){
                if($records['Fin'] !== 0){ ?>
                    <li>
                        <a href="<?php echo  $prexisUrl.$records['Fin']; ?>">
                            <span class="title"><?php echo  $records['Nombre']; ?></span>
                        </a>
                    </li>
               <?php } ?>

              <?php
                $this->getModuleEnableByUser($records['Id'], $id, $prexisUrl);
            }
        }
    }
}