<?php

function mySpacePage() {
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

    // ecrire ici une condition pour vérifier : pas de doublon de pseudo 
    // Si ok : 
    $usersManager = new UsersManager();
    $usersManager->addUser($pseudo, $pass, $email);

    connexionPage();
    
    // Sinon :
    // exception jetée avec msg "Pseudo déjà pris"
}


function userConnexion($pseudo, $formPass) {

    $usersManager = new UsersManager();
    $bddPass = $usersManager->getPass($pseudo);

    if (!empty($bddPass)) {

        if (password_verify($formPass, $bddPass)) {
            $user = $usersManager->getUser($pseudo, $bddPass);
    
            session_start();
            $_SESSION['id'] = $user->id();
            $_SESSION['userStatus'] = $user->status();
            $_SESSION['pseudo'] = $pseudo;
    
            mySpacePage();
        }
    }

    else {
        throw new Exception('Identifiant ou mot de passe incorrect');
    }
}
