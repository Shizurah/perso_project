<?php
// appel des fichiers + classes
require_once('controllers/posts_controller.php');
require_once('controllers/tvShows_controller.php');
require_once('controllers/users_controller.php');
require_once('controllers/comments_controller.php');
require_once('controllers/errors_controller.php');


function autoloading($class) {
    require 'model/' . $class . '.php';
}

spl_autoload_register('autoloading');


function startSession() {
    if (!isset($_SESSION)) {
        session_start();
    }
}


try {

    if (isset($_GET['action'])) {

        // Pages du site :

        if ($_GET['action'] == 'post_and_comments') {
            startSession();

            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                // 1: affichage de l'article
                onePostPage($_GET['postId']);                 
            }
            else {
                echo 'Cet article n\'existe pas';
            }
        }

        elseif ($_GET['action'] == 'display_comments') {
            startSession();

            if (isset($_GET['postId']) && isset($_GET['pageId']) && isset($_GET['commentsPerPage'])){
                displayComments($_GET['postId'], $_GET['pageId'], $_GET['commentsPerPage']);
            }
        }

        elseif ($_GET['action'] == 'tvShows') {
            session_start();
            tvShowsPage();
        }

        elseif ($_GET['action'] == 'tvShow') {
            session_start();

            if (isset($_GET['tvShowId']) && $_GET['tvShowId'] > 0) {
                tvShowDetailsPage($_GET['tvShowId']);
            }
        }

        elseif ($_GET['action'] == "contact") {
            contactPage();
        }

        elseif ($_GET['action'] == "connexionPage") {
            connexionPage();
        }

        elseif ($_GET['action'] == "registrationPage") {
            registrationPage();
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
                // throw new Exception('Veuillez remplir tous les champs');
            }
        }

        elseif ($_GET['action'] == "mySpace") {
            session_start();
            mySpacePage();
        }

        // changement d'avatar :
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

        elseif ($_GET['action'] == "deconnexion") {
            startSession();
            session_unset();
            session_destroy();

            header('Location: index.php');
            exit;
        }

        // Administration - gestion des articles :

        elseif ($_GET['action'] == 'administration') {
            startSession();
            administrationPage();
        }

        elseif ($_GET['action'] == 'postWriting') {
            startSession();
            tinyMcePage();
        }

        elseif ($_GET['action'] == 'postWritten') {
            startSession();

            if (isset($_POST['postTitle']) && isset($_FILES['postPoster']) && isset($_POST['postCategory']) && isset($_POST['postContent'])) {
                addNewPost($_POST['postTitle'], $_FILES['postPoster'], $_POST['postCategory'], $_POST['postContent']);
            } 

            else {
                $dataBack = array('status' => 'error', 'errorMsg' => '<p class="error-msg">Impossible d\'ajouter l\'article. Veuillez remplir tous les champs</p>');
                $dataBack = json_encode($dataBack);

                echo $dataBack;  
            }
        }

        elseif ($_GET['action'] == 'allPostsList') {
            startSession();
            allPostsPage();
        }

        elseif ($_GET['action'] == 'allPostsListForUpdating') {
            startSession();
            allPostsForUpdatingPage();
        }

        elseif ($_GET['action'] == 'postUpdating') {
            startSession();

            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                tinyMceForPostUpdating($_GET['postId']);
            }

            else {
                echo 'cet article n existe pas';
            }
        }

        elseif ($_GET['action'] == 'postUpdated') {
            startSession();

            if (isset($_GET['postId']) && isset($_POST['postTitle']) && isset($_POST['postCategory']) && isset($_POST['postContent'])) {
                updatePost($_GET['postId'], $_POST['postTitle'], $_POST['postCategory'], $_POST['postContent']);
            }
            else {
                echo 'Impossible de modifier l\'article ';
            }   
        }

        elseif ($_GET['action'] == 'postDeleting') {
            startSession();

            if (isset($_POST['postId']) && $_POST['postId'] > 0) {
                deleteCommentsRelatedToAPost($_POST['postId']);
                deletePost($_POST['postId']);
            }
            else {
                echo 'Aucun identifiant d\' article renseigné';
            }
        }

        // GESTION DES COMMENTAIRES :
    
        elseif ($_GET['action'] == 'commentAdded') {
            startSession();

            if (isset($_POST['comment-text']) && !empty($_POST['comment-text']) && isset($_GET['postId']) && isset($_SESSION['id'])) {
                addComment($_POST['comment-text'], $_GET['postId'], $_SESSION['id']);
                
            }
            else {
                echo 'Impossible d\'ajouter votre commentaire';
            }
        }

        elseif ($_GET['action'] == 'commentUpdating') {
            startSession();

            if (isset($_GET['postId']) && isset($_GET['commentId']) && $_GET['postId'] > 0 && $_GET['commentId'] > 0) {
                onePostPage($_GET['action'], $_GET['postId'], $_GET['commentId']);
            }

            else {
                // Ce commentaire n'existe pas
                echo 'fail';
            }
        }

        elseif ($_GET['action'] == 'commentUpdated') {
            startSession();

            if (isset($_GET['commentId']) && isset($_POST['updated-comment']) && $_GET['commentId'] > 0) {
                updateComment($_GET['commentId'], $_POST['updated-comment']);  
            }

            else {
                // Ce commentaire n'existe pas
                echo 'fail';
            }
        }

        elseif ($_GET['action'] == 'commentDeleted') {
            startSession();

            if (isset($_POST['commentId']) && $_POST['commentId'] > 0) {
                deleteComment($_POST['commentId']);
            }

            else {
                // Ce commentaire n'existe pas
                echo 'fail';
            }
        }

        elseif ($_GET['action'] == 'commentReporting') {
            startSession();

            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                reportComment($_GET['commentId']);
            }
        }

        elseif ($_GET['action'] == 'reportedComments') {
            startSession();
            getReportedComments();    
        }

        elseif ($_GET['action'] == 'commentIgnored') {
            startSession();

            if (isset($_POST['commentId']) && $_POST['commentId'] > 0) {
                ignoreReportedComment($_POST['commentId']);
            }
            else {
                // Ce commentaire n'existe pas
                echo 'fail';
            }
        }

    } 
    

    // Par défaut : affichage de la page d'accueil du site
    elseif (isset($_GET['error'])) {
        session_start();
        displayErrorMsg($_GET['error']);
    }

    elseif (isset($_GET['nbOfPostsToDisplay']) && isset($_GET['currentNbOfPosts'])) {

        if (ctype_digit($_GET['nbOfPostsToDisplay']) && ctype_digit($_GET['currentNbOfPosts'])) {
            fetchNextPosts($_GET['nbOfPostsToDisplay'], $_GET['currentNbOfPosts']);
        }
        else {
            http_response_code(400);
        }
    }

    else {
        session_start();
        homePage();
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

    // throw e;
}