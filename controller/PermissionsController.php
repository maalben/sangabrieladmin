<?php

require_once __DIR__.'/../model/PermissionsModel.php';
require_once __DIR__.'/../model/Util.php';

class PermissionsController{

    private $permissionsModel;

    public function __construct(){
        $this->permissionsModel = new PermissionsModel();
    }

    public function saveChangePermissions(){

        $vectorData['identify'] = $_POST['txtcedula'];
        $vectorData['id'] = $this->permissionsModel->getIdUserSystem($_POST['txtUsername']);

        for ($i = 1; $i <= $this->permissionsModel->quantityPermissions(); $i++) {
            if(isset($_POST['modulo'.$i])){
                if($this->permissionsModel->getQuantityPermissionsByAdvisor($i, $vectorData['id']) === 0){
                    $this->permissionsModel->savePermissionAdvisor($i, $vectorData['id'], $this->permissionsModel->getModuleMain($i));
                }
            }else{
                $this->permissionsModel->deletePermissionAdvisor($i, $vectorData['id']);
            }
        }
        Util::confirmationProcess('Se han actualizado los permisos.', 'index/consultAdvisors');
    }
}