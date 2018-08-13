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
            session_start();
            weLovedPage();
        }

        elseif ($_GET['action'] == "tvShows") {
            session_start();
            tvShowsPage();
        }

        elseif ($_GET['action'] == "mySpace") {
            session_start();

            if (isset($_SESSION['pseudo'])) {
                mySpacePage();
            } 

            else {
                echo 'FAIL';
            }
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
                userRegistration($_POST['pseudo'], $_POST['password1'], $_POST['password2'], $_POST['email']);
            } 
            
            else {
                throw new Exception('Veuillez remplir tous les champs');
            }
        }

        // Connexion sur le site :
        elseif ($_GET['action'] == 'connexion') {

            if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                userConnexion($_POST['pseudo'], $_POST['password']);
            } 
            
            else {
                throw new Exception('Veuillez remplir tous les champs');
            }
        }

        elseif ($_GET['action'] == 'administration') {
            startSession();
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                administrationPage();
            } 

            else {
                echo 'fail';
                // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
            }
        }

        elseif ($_GET['action'] == 'postWriting') {
            startSession();
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                tinyMcePage();
            } 

            else {
                echo 'fail';
                // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
            }
        }

        // changement d'avatar
        elseif ($_GET['action'] == 'avatar') {
            startSession();
            
            if (isset($_FILES['avatar']) && !empty($_FILES['avatar'])) {
                updateAvatar($_FILES['avatar']['name'], $_FILES['avatar']['size'], $_FILES['avatar']['error'], $_FILES['avatar']['tmp_name']);
            } 

            else {
                // Veuillez compléter les champs
                echo 'fail';
            }
        }

    } 
    
    // Par défaut : affichage de la page d'accueil du site
    else {
        session_start();
        homePage();
        // test :
    //     mail(
    //         'shizurah@gmail.com',
    //         'Works!',
    //         'An email has been generated from your localhost, congratulations!');
    }


} catch (Exception $e) {
    
    $errorMsg = $e->getMessage();
    $file = $e->getFile();
    $path = 'E:\wamp64\www\projet_perso_openclassrooms';

// GERER LES ERREURS AVEC UN CODE -> EX : CODE 0 POUR ERREUR DE CONNEXION ??
    if ($file == $path . '\controllers\users_controller.php') {

        switch($errorMsg) {
            case 'Ce pseudo est déjà pris' :
                $errorPseudo = $errorMsg;
                break;

            case 'Les mots de passe ne sont pas identiques' :
                $errorPass = $errorMsg;
                break;

            case 'Identifiant ou mot de passe incorrect' :
                $errorConnexion = $errorMsg;
                break;
        }
        
        require_once('view/connexion_view.php');
    }

    elseif ($file == $path . '\index.php') {

        switch($errorMsg) {
            case 'Veuillez remplir tous les champs':
                $errorFields = $errorMsg;
                require_once('view/connexion_view.php');
                break;
        }
    }
}