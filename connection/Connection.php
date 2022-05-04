<?php 

class Connection{

    private static $urlBase;

//    public static function getConnection(){
//        self::$urlBase = 'sangabrieladmin/';
//        $connection = new mysqli("127.0.0.1", "root", "12345678", "bdsangabriel");
//        $connection->query("SET NAMES 'utf8'");
//        return $connection;
//    }

    public static function getUrlByPermission(){
        return self::$urlBase;
    }

    public static function getConnection(){
        self::$urlBase = 'adminsangabriel/';
        $connection = new mysqli("localhost", "funerari_funeraR", "r5,gAos0V[}n", "funerari_BASEWP");
        $connection->query("SET NAMES 'utf8'");
        return $connection;
    }
}