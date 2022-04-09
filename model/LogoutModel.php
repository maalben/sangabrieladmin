<?php
require_once __DIR__.'/../resources/session.php';

class LogoutModel{

    public function closeSession(){

        $_SESSION['loggedin'] = '';
        $_SESSION['username'] = '';
        $_SESSION['id'] = '';
        $_SESSION['fingerPrint'] = '';
        $_SESSION['lastActive'] = '';
        $_SESSION['rol'] = '';
        $_SESSION['name'] = '';
        unset($_SESSION['loggedin'], $_SESSION['username'], $_SESSION['id'], $_SESSION['fingerPrint'], $_SESSION['lastActive'], $_SESSION['rol'], $_SESSION['name']);
        session_regenerate_id(true);
        session_destroy();
    }
}