<?php
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
session_start();
session_regenerate_id(true);
session_destroy();
header('Location: login.php');