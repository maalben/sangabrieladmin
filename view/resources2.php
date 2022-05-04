<?php
require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../model/PermissionsModel.php';
require_once __DIR__.'/header2.php';
$url = '../index/logout';
Util::guard($url);
$permissionsModel = new PermissionsModel();
$listPermissionsEnable = $permissionsModel->generateMenuWithPermission($_SESSION['id']);
require_once __DIR__.'/menuLateral2.php' ?>

<div class="main-content">
    <?php
    if(Util::getPartUrlForValidation() === 'index'){
    }elseif($permissionsModel->validateAccessURL(Util::getPartUrlForValidation(), $_SESSION['id']) === '1'){
    }else{
        echo Util::popupMessage('Logout exitoso','Hope you enjoyed it :)','success','../index/logout');
        exit;
    }

    require_once __DIR__.'/superiorside2.php' ?>
<div class="row">
