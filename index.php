<?php

// appel des fichiers + classes
require_once('controllers/posts_controller.php');
require_once('controllers/comments_controller.php');

function autoloading($class) {
 require 'model/' . $class . '.php';
}

spl_autoload_register('autoloading');

// 

try {

    if(isset($_GET['action'])) {

    
    } 
    
    // Par défaut : affichage de la page d'accueil du site
    else {
        homePage();
    }


} catch (Exception $e) {

}