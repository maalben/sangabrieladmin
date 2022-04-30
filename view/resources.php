<?php
require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../model/PermissionsModel.php';
require_once __DIR__.'/header.php';
$url = 'index/logout';
Util::guard($url);
$permissionsModel = new PermissionsModel();
$listPermissionsEnable = $permissionsModel->generateMenuWithPermission($_SESSION['id']);
require_once __DIR__.'/menuLateral.php' ?>

<div class="main-content">

    <?php require_once __DIR__.'/superiorside.php' ?>

    <div class="row">
