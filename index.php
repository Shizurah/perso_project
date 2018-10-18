<?php

function startSession() {
    if (!isset($_SESSION)) {
        session_start();
    }
}


function autoload($class, $dir = null) {
 
    if (is_null($dir)) {
        $dir = $_SERVER['DOCUMENT_ROOT']. '/projet5/class';
    }
     
    foreach (scandir($dir) as $file) { // scandir => liste les fichiers et dossiers dans un dossier (tableau retourné)
 
        // dossier ?
        if (is_dir($dir. '/' .$file) && substr($file, 0, 1) !== '.') {
            autoload($class, $dir. '/' .$file. '/');
        }

        // fichier php ?
        if (substr($file, 0, 2) !== '._' && preg_match("/.php$/i" , $file )) {

            // nom du fichier = nom de la classe ?
            if (str_replace('.php', '', $file) == $class) {
                include $dir . $file;
            }
        }
    }
}


spl_autoload_register('autoload');

$postsController = new PostsController();
$usersController = new UsersController();
$commentsController = new CommentsController();
$tvShowsController = new TvShowsController();
$errorsController = new ErrorsController();


try {

    if (isset($_GET['action'])) {

        // Pages du site :

        if ($_GET['action'] == 'post_and_comments') {
            startSession();

            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                $postsController->onePostPage($_GET['postId']);            
            }
            else {
                $errorMsg = 'Cet article n\'existe pas.';
                require_once('view/error.php');
            }
        }

        elseif ($_GET['action'] == 'display_comments') {
            startSession();

            if (isset($_GET['postId']) && isset($_GET['pageId']) && isset($_GET['commentsPerPage'])){
                $commentsPerPage = (int) $_GET['commentsPerPage'];
                $commentsController->displayComments($_GET['postId'], $_GET['pageId'], $commentsPerPage);
            }
        }

        elseif ($_GET['action'] == 'tvShows') {
            session_start();
            $tvShowsController->tvShowsPage();
        }

        elseif ($_GET['action'] == 'tvShow') {
            session_start();

            if (isset($_GET['tvShowId']) && $_GET['tvShowId'] > 0) {
                $tvShowsController->tvShowDetailsPage($_GET['tvShowId']);
            } 
            else {
                $errorMsg = 'Impossible d\'afficher cette série.';
                require_once('view/error.php');
            }
        }

        elseif ($_GET['action'] == "contact") {
            $usersController->contactPage();
        }

        elseif ($_GET['action'] == "connexionPage") {
            $usersController->connexionPage();
        }

        elseif ($_GET['action'] == "registrationPage") {
            $usersController->registrationPage();
        }

        // Création de compte : 
        elseif ($_GET['action'] == 'registration') {

            if (isset($_POST['pseudo']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['email'])) {
                $usersController->userRegistration($_POST['pseudo'], $_POST['password1'], $_POST['password2'], $_POST['email']);
            } 
            else {
                throw new Exception('Veuillez remplir tous les champs');
            }
        }

        // Connexion sur le site :
        elseif ($_GET['action'] == 'connexion') {

            if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                $usersController->userConnexion($_POST['pseudo'], $_POST['password']);
            } 
            else {
                // throw new Exception('Veuillez remplir tous les champs');
            }
        }

        elseif ($_GET['action'] == "mySpace") {
            session_start();
            $usersController->mySpacePage();
        }

        // changement d'avatar :
        elseif ($_GET['action'] == 'avatar') {
            startSession();
            
            if (isset($_FILES['avatar']) && !empty($_FILES['avatar'])) {
            // if (isset($_FILES[0]) && !empty($_FILES[0])) {
            //     print_r($_FILES[0]);
                
                $usersController->updateAvatar($_FILES['avatar']['name'], $_FILES['avatar']['size'], $_FILES['avatar']['error'], $_FILES['avatar']['tmp_name']);
            } 
            else {
                $errorMsg = 'Impossible d\'effectuer cette action.';
                require_once('view/error.php');
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
            $usersController->administrationPage();
        }

        elseif ($_GET['action'] == 'postWriting') {
            startSession();
            $postsController->tinyMcePage();
        }

        elseif ($_GET['action'] == 'postWritten') {
            startSession();

            if (isset($_POST['postTitle']) && isset($_FILES['postPoster']) && isset($_POST['postCategory']) && isset($_POST['postContent'])) {
                $postsController->addNewPost($_POST['postTitle'], $_FILES['postPoster'], $_POST['postCategory'], $_POST['postContent']);
            } 

            else {
                $dataBack = array('status' => 'error', 'errorMsg' => '<p class="error-msg">Impossible d\'ajouter l\'article. Veuillez remplir tous les champs</p>');
                $dataBack = json_encode($dataBack);

                echo $dataBack;  
            }
        }

        elseif ($_GET['action'] == 'allPostsList') {
            startSession();
            $postsController->allPostsPage();
        }

        elseif ($_GET['action'] == 'allPostsListForUpdating') {
            startSession();
            $postsController->allPostsForUpdatingPage();
        }

        elseif ($_GET['action'] == 'postUpdating') {
            startSession();

            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                $postsController->tinyMceForPostUpdating($_GET['postId']);
            }

            else {
                $errorMsg = 'Impossible d\'effectuer cette action.';
                require_once('view/error.php');
            }
        }

        elseif ($_GET['action'] == 'postUpdated') {
            startSession();

            if (isset($_GET['postId']) && isset($_POST['postTitle']) && isset($_POST['postCategory']) && isset($_POST['postContent'])) {
                $postsController->updatePost($_GET['postId'], $_POST['postTitle'], $_POST['postCategory'], $_POST['postContent']);
            }
            else {
                $errorMsg = 'Impossible d\'effectuer cette action.';
                require_once('view/error.php');
            }   
        }

        elseif ($_GET['action'] == 'postDeleting') {
            startSession();

            if (isset($_POST['postId']) && $_POST['postId'] > 0) {
                $commentsController->deleteCommentsRelatedToAPost($_POST['postId']);
                $postsController->deletePost($_POST['postId']);
            }
            else {
                $errorMsg = 'Impossible d\'effectuer cette action.';
                require_once('view/error.php');
            }
        }

        // GESTION DES COMMENTAIRES :
    
        elseif ($_GET['action'] == 'commentAdded') {
            startSession();

            if (isset($_POST['comment-text']) && !empty($_POST['comment-text']) && isset($_GET['postId']) && isset($_SESSION['id'])) {
                $commentsController->addComment($_POST['comment-text'], $_GET['postId'], $_SESSION['id']);
            }
            else {
                $errorMsg = 'Impossible d\'ajouter votre commentaire';
                require_once('view/error.php');
            }
        }

        elseif ($_GET['action'] == 'commentUpdating') {
            startSession();

            if (isset($_GET['postId']) && isset($_GET['commentId']) && $_GET['postId'] > 0 && $_GET['commentId'] > 0) {
                $postsController->onePostPage($_GET['action'], $_GET['postId'], $_GET['commentId']);
            }

            else {
                throw new Exception('Impossible de modifier votre commentaire');
            }
        }

        elseif ($_GET['action'] == 'commentUpdated') {
            startSession();

            // ajax
            if (isset($_GET['commentId']) && isset($_POST['updated-comment']) && $_GET['commentId'] > 0) {
                $commentsController->updateComment($_GET['commentId'], $_POST['updated-comment']); 
            }

            else {
                throw new Exception('Impossible de modifier votre commentaire'); 
            }
        }

        elseif ($_GET['action'] == 'commentDeleted') {
            startSession();

            // ajax
            if (isset($_POST['commentId']) && $_POST['commentId'] > 0) {
                $commentsController->deleteComment($_POST['commentId']);
            }

            else {
                throw new Exception('Impossible de supprimer ce commentaire');
            }
        }
        
        elseif ($_GET['action'] == 'commentReporting') {
            startSession();

            // ajax
            if (isset($_POST['commentId']) && $_POST['commentId'] > 0) {
                $commentsController->reportComment($_POST['commentId']);
            }

            else {
                throw new Exception('Impossible de signaler ce commentaire');
            }
        }

        elseif ($_GET['action'] == 'reportedComments') {
            startSession();
            $commentsController->getReportedComments();    
        }

        elseif ($_GET['action'] == 'commentIgnored') {
            startSession();

            // if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            //     throw new Exception('Impossible d\'effectuer cette action');
            // }

            // ajax
            if (isset($_POST['commentId']) && $_POST['commentId'] > 0) {
                $commentsController->ignoreReportedComment($_POST['commentId']);
            }
            else {
                throw new Exception('Impossible d\'effectuer cette action');
            }

        }

    } 
    
    elseif (isset($_GET['error'])) {
        startSession();
        $errorsController->displayErrorMsg($_GET['error']);
    }

    elseif (isset($_GET['nbOfPostsToDisplay']) && isset($_GET['currentNbOfPosts'])) {

        // ajax
        if (ctype_digit($_GET['nbOfPostsToDisplay']) && ctype_digit($_GET['currentNbOfPosts'])) {
            $nbOfPostsToDisplay = (int) $_GET['nbOfPostsToDisplay'];
            $currentNbOfPosts = (int) $_GET['currentNbOfPosts'];
            $postsController->fetchNextPosts($nbOfPostsToDisplay, $currentNbOfPosts);
        }
        else {
            throw new Exception('Impossible d\'afficher plus d\'articles.');
        }
    }

    // Par défaut : affichage de la page d'accueil du site
    else {
        startSession();
        $postsController->homePage();
    }


} catch (Exception $e) {
    startSession();

    $errorMsg = '<p id="error-msg">' .$e->getMessage(). '</p>';

    $dataBack = array('status' => 'error', 'message' => $errorMsg);
    $dataBack = json_encode($dataBack);

    echo $dataBack;
    // require_once('view/error.php');
}