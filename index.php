<?php

// appel des fichiers + classes
require_once('controllers/posts_controller.php');
require_once('controllers/comments_controller.php');
require_once('controllers/users_controller.php');

function autoloading($class) {
    require 'model/' . $class . '.php';
}

spl_autoload_register('autoloading');

// 

function startSession() {
    if (!isset($_SESSION)) {
        session_start();
    }
}

//

try {

    if (isset($_GET['action'])) {

        //AFFICHAGE DES PAGES DU SITE
    
        if ($_GET['action'] == "weLoved") {
            weLovedPage();
        }

        elseif ($_GET['action'] == "tvShows") {
            tvShowsPage();
        }

        elseif ($_GET['action'] == "mySpace") {
            mySpacePage();
        }

        elseif ($_GET['action'] == "connexionPage") {
            connexionPage();
        }

        elseif ($_GET['action'] == "contact") {
            contactPage();
        }

        elseif ($_GET['action'] == "deconnexion") {
            startSession();
            session_unset();
            session_destroy();

            header('Location: index.php');
            exit;
        }

        // Création de compte : 
        elseif ($_GET['action'] == 'registration') {

            if (isset($_POST['pseudo']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['email'])) {
                userRegistration($_POST['pseudo'], $_POST['password1'], $_POST['email']);
                
                header('Location: index.php?action=connexionPage');
                exit;

            } else {
                connexionPage();
            }
        }
    } 
    
    // Par défaut : affichage de la page d'accueil du site
    else {
        homePage();
    }


} catch (Exception $e) {

}