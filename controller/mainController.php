<?php

require_once __DIR__.'/../connection/Connection.php';
require_once __DIR__.'/../controller/IndexController.php';
require_once __DIR__.'/../controller/OwnerController.php';
require_once __DIR__.'/../controller/BeneficiariesController.php';
require_once __DIR__.'/../controller/AdvisorController.php';
require_once __DIR__.'/../controller/LogoutController.php';
require_once __DIR__.'/../controller/ProfileController.php';
require_once __DIR__.'/../controller/Personasc.php';
require_once __DIR__.'/../model/Util.php';

$controller_index = new IndexController();
$ownerController = new OwnerController();
$beneficiariesController = new BeneficiariesController();
$advisorsController = new AdvisorController();
$logoutController = new LogoutController();
$profileController = new ProfileController();
$controller_personas = new Personasc();