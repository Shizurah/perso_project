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


function userRegistration($formPseudo, $pass1, $pass2, $email) {
    
    $usersManager = new UsersManager();
    $bddPseudo = $usersManager->getPseudo($formPseudo);

    if (empty($bddPseudo)) {

        if ($pass1 == $pass2) {
            $usersManager->addUser($formPseudo, $pass1, $email);
            connexionPage();
        }

        else {
            throw new Exception ('Les mots de passe ne sont pas identiques');
        }   
    } 
    
    else {
        throw new Exception('Ce pseudo est déjà pris');
    }
}


function userConnexion($pseudo, $formPass) {

    $usersManager = new UsersManager();
    $bddPass = $usersManager->getPass($pseudo);

    if (!empty($bddPass)) {

        if (password_verify($formPass, $bddPass)) {
            $user = $usersManager->getUser($pseudo, $bddPass);
    
            session_start();
            $_SESSION['id'] = $user->id();
            $_SESSION['userStatus'] = $user->userStatus();
            $_SESSION['pseudo'] = $pseudo;
    
            mySpacePage();
        }

        else {
            throw new Exception('Identifiant ou mot de passe incorrect');
        }
    }

    else {
        throw new Exception('Identifiant ou mot de passe incorrect');
    }
}
