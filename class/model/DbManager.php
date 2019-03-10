<?php


class DbManager {

    public static function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

}
