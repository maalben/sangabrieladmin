<?php 

class Connection{

    public static function getConnection(){
        $connection = new mysqli("127.0.0.1", "root", "12345678", "bdsangabriel");
        $connection->query("SET NAMES 'utf8'");
        return $connection;
    }
}