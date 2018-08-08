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
            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
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
            $_SESSION['avatar'] = $user->avatar();
    
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

function updateAvatar($fileName, $fileSize, $fileError, $fileTmpName) {

    if (isset($_SESSION['id'])) {

        $maxSize = 512000;
        $valid_expansions = array('jpg', 'jpeg', 'png', 'gif');
        $uploaded_expansion = strtolower( substr( strrchr($fileName, '.'), 1) );

        if ($fileError == 0) {

            if ($fileSize <= $maxSize) {

                if (in_array($uploaded_expansion, $valid_expansions)) {
                    $path = 'public/members/avatars/' . $_SESSION['id'] . '.' . $uploaded_expansion;
                    $moving = move_uploaded_file($fileTmpName, $path);

                    if ($moving) {
                        $newAvatar = $_SESSION['id'] . '.' . $uploaded_expansion;
                        // instanciation classe et appel des méthodes :
                        $usersManager = new UsersManager();
                        $usersManager->updateAvatar($_SESSION['id'], $newAvatar);
                        $_SESSION['avatar'] = $newAvatar;

                        mySpacePage();
                    }

                    else {
                        //erreur lors de l'importation de votre image
                    }
                } 
                
                else {
                    //extension incorrecte
                }
            }

            else {
                // le fichier est trop lourd
            }  
        }

        else {
            //erreur lors du transfert de l'image
        }
    } 
}