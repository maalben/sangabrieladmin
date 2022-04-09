<?php
require_once __DIR__.'/../resources/session.php';
require_once __DIR__.'/../model/Util.php';
require_once __DIR__.'/header.php';
$url = 'index/logout';
Util::guard($url);
require_once __DIR__.'/menuLateral.php' ?>

<div class="main-content">

    <?php require_once __DIR__.'/superiorside.php' ?>

    <div class="row">
