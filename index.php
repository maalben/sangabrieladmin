<?php

require_once __DIR__.'/controller/mainController.php';

if(empty($_REQUEST['accion'])){
    $controller_index->index();
}else{
    $method = $_REQUEST['accion'];
    if(method_exists($ownerController, $method)){
        $ownerController->$method();
    }elseif(method_exists($beneficiariesController, $method)){
        $beneficiariesController->$method();
    }elseif(method_exists($advisorsController, $method)){
        $advisorsController->$method();
    }elseif(method_exists($logoutController, $method)){
        $logoutController->$method();
    }elseif(method_exists($profileController, $method)){
        $profileController->$method();
    }elseif(strpos($method, '/')){
        Util::messageAlert('Ha ocurrido un error');
    }else{
        $controller_index->index();
    }
}