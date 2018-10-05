<?php


abstract class Controller {

    // public function modelAutoloading($class) { // faire une 2e fonction d'autoload ds la classe Controller (parent) pour appel des classes du model ?
    //     require 'model/' . $class . '.php'; // remplacer 'model' par 'controllers' ?
    // }

    public function errorPage($msg) {

        http_response_code(401);
        $errorMsg = $msg;
        require_once('view/error.php');
    }
}