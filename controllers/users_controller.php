<?php

function mySpacePage($pseudo) {
    require_once('view/mySpace_view.php');
}

function connexionPage() {
    require_once('view/connexion_view.php');
}

function contactPage() {
    require_once('view/contact_view.php');
}

function userRegistration($pseudo, $pass, $email) {
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $usersManager = new UsersManager();
    $usersManager->addUser($pseudo, $pass, $email);
}


function userConnexion($pseudo, $pass) {
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $usersManager = new UsersManager();
    $user = $usersManager->getUser($pseudo, $pass);

    if (!empty($user)) {
        session_start();

        $_SESSION['id'] = $user->id();
        $_SESSION['pseudo'] = $pseudo;

        mySpacePage();
    } 
    
    else {
        connexionPage();
    }
}