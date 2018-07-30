<?php

class DbManager {

    public static function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=projet_perso;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

}