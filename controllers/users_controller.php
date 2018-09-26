<?php

function connexionPage() {
    require_once('view/connexion_view.php');
}

function mySpacePage() {

    if (isset($_SESSION['id'])) {
        require_once('view/mySpace_view.php');
    } 
    else {
        echo 'FAIL';
    } 
}

function administrationPage() {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $usersManager = new UsersManager();
        $nbOfUsers = $usersManager->countUsers();
        
        $postsManager = new PostsManager();
        $nbOfPosts = $postsManager->countPosts();

        $commentsManager = new CommentsManager;
        $nbOfReportedComments = $commentsManager->countReportedComments();
        
        require_once('view/administration_view.php');
    } 
    else {
        echo 'fail';
        // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
    }
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
            $pseudo = htmlspecialchars($formPseudo);
            $key = md5(microtime(TRUE)*100000);

            $usersManager->addUser($pseudo, $pass1, $email, $key);

            // $subject = 'Activez votre compte';
            // $header = 'From:localhost.com/inscription';
            // $msg = "Bienvenue sur Localhost, \n
            //         Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou le copier/coller dans votre navigateur internet : \n
                    
            //         http://localhost/projet_perso_openclassrooms/index.php?action=activation&log=" . urlencode($pseudo) . "&key=" . urlencode($key) .
                    
            //         "\n ----------------------------------------- \n 
            //         Ceci est un mail automatique, merci de ne pas y répondre";
            
            // mail(
            //     $email, 
            //     $subject, 
            //     $msg, 
            //     $header);

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

    $msg = '';
    $usersManager = new UsersManager();
    $bddPass = $usersManager->getPass(htmlspecialchars($pseudo));

    if (!empty($bddPass)) {

        if (password_verify($formPass, $bddPass)) {
            $user = $usersManager->getUser(htmlspecialchars($pseudo), $bddPass);
    
            session_start();
            $_SESSION['id'] = $user->id();
            $_SESSION['userStatus'] = $user->userStatus();
            $_SESSION['pseudo'] = htmlspecialchars($pseudo);
            $_SESSION['avatar'] = $user->avatar();
    
            $msg = 'success';
        }
        else { 
            $msg = 'Identifiant ou mot de passe incorrect'; // mot de passe incorrect
        }

    }
    else {
        $msg = 'Identifiant ou mot de passe incorrect'; // identifiant incorrect
    }

    echo $msg;
}


function updateAvatar($fileName, $fileSize, $fileError, $fileTmpName) {

    if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {

        // $error = false;
        $errorMsg = '';
        $maxSize = 10000000;
        $valid_expansions = array('jpg', 'jpeg', 'png', 'gif');
        $uploaded_expansion = strtolower( substr( strrchr($fileName, '.'), 1) );

        if ($fileError == 0) {

            if ($fileSize > 0 && $fileSize <= $maxSize) {

                if (in_array($uploaded_expansion, $valid_expansions)) {
                    $path = 'public/members/avatars/' . $_SESSION['id'] . '.' . $uploaded_expansion;

                    if (!file_exists($path)) {
                        $moving = move_uploaded_file($fileTmpName, $path);

                        if ($moving) {
                            $newAvatarName = $_SESSION['id'] . '.' . $uploaded_expansion;

                            // ajout de l'avatar en bdd :
                            $usersManager = new UsersManager();
                            $usersManager->updateAvatar($_SESSION['id'], $newAvatarName);
                            $_SESSION['avatar'] = $newAvatarName;

                            mySpacePage();
                        }
                        else {
                            $errorMsg = 'Erreur lors de l\'importation de votre image';
                        }
                    }
                } 
                else {
                    $errorMsg = 'L\'Extension de votre image est invalide';
                }
            }
            else {
                $errorMsg = 'La taille de votre image est invalide (jusqu\'à 10000000 octets)';
            }  
        }
        else {
            $errorMsg = 'Erreur lors du transfert de votre image';
        }

        if (!empty($errorMsg)) {
            @unlink($path);
            mySpacePage();
        }
    } 
}