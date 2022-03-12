<?php

require_once __DIR__.'/../connection/Connection.php';
require_once __DIR__.'/../controller/IndexController.php';
require_once __DIR__.'/../controller/OwnerController.php';
require_once __DIR__.'/../controller/Personasc.php';

$controller_index = new IndexController();
$ownerController = new OwnerController();
$controller_personas = new Personasc();