<?php
require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/../model/PermissionsModel.php';
$url = '../index/logout';
Util::guard($url);
require_once __DIR__.'/header2.php';
$permissionsModel = new PermissionsModel();
$listPermissionsEnable = $permissionsModel->generateMenuWithPermission($_SESSION['id']);
require_once __DIR__.'/menuLateral2.php'
?>

<div class="main-content">
<?php require_once __DIR__.'/superiorside2.php' ?>
<div class="row">
