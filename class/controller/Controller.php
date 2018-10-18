<?php


abstract class Controller {

    public function errorPage($msg) {

        http_response_code(401);
        $errorMsg = $msg;
        require_once('view/error.php');
    }
}