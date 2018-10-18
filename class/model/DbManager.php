<?php


class DbManager {

    public static function dbConnect() {

        // $db = new PDO('mysql:host=db757934014.db.1and1.com;dbname=db757934014;charset=utf8', 'dbo757934014', '9qBqU2q3*', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $db = new PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

}