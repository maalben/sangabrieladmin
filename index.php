<?php 

require_once __DIR__.'/controller/mainController.php';

if(empty($_REQUEST['accion'])){
    $controller_index->index();
}else{
    $method = $_REQUEST['accion'];
    if(method_exists($ownerController, $method)){
        $ownerController->$method();
    }else{
        $controller_index->index();
    }
}