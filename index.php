<?php 

require_once __DIR__.'/controller/mainController.php';

if(empty($_REQUEST['accion'])){
    $controller_index->index();
}else{
    $metodo = $_REQUEST['accion'];
    if(method_exists($controller_personas, $metodo)){
        $controller_personas->$metodo();
    }else{
        $controller_personas->index();
    }
}


?>