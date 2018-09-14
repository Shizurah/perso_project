<?php
require_once('controllers/comments_pagination.php');

function homePage() {
    $postsManager = new PostsManager();
    $newsPosts = $postsManager->getNewsPostsList();
    $nextReleasesPosts = $postsManager->getNextReleasesPostsList();

    require_once('view/news_view.php');
}

function tvShowsPage() {
    require_once('view/tvShows_view.php');
}


function tinyMcePage() {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        require_once('view/tinyMce_view.php');
    } 
    else {
        echo 'fail';
        // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
    }
}


// Page d'un article et de ses commentaires :
function onePostPage($postId) {
    $postsManager = new PostsManager();
    $post = $postsManager->getPost($postId);

    $commentsManager = new CommentsManager();
    $nbOfComments = $commentsManager->countNumberOfComments($postId);

    require_once('view/postAndItsComments_view.php');
}


function addNewPost($title, $poster, $category, $content) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

        // changer ces lignes :
        // if ($category == 'news') {
        //     $category = 'news';
        // }
        // elseif ($category == 'next-releases') {
        //     $category = 'next_releases';
        // }
        //

        $maxSize = 512000;
        $valid_expansions = array('jpg', 'jpeg', 'png', 'gif');
        $uploaded_expansion = strtolower( substr( strrchr($poster['name'], '.'), 1) );

        if ($poster['error'] == 0) {

            if ($poster['size'] <= $maxSize) {

                if (in_array($uploaded_expansion, $valid_expansions)) {
                    $uniqId = uniqid();

                    $path = 'public/posts/' . $uniqId . '.' . $uploaded_expansion;
                    $moving = move_uploaded_file($poster['tmp_name'], $path);

                    if ($moving) {
                        $newPosterName = $uniqId . '.' . $uploaded_expansion;
                        // instanciation classe et appel des méthodes :
                        $postsManager = new PostsManager();
                        $newPostId = $postsManager->addPost($title, $newPosterName, $category, $content);

                        require_once('view/tinyMce_view.php');
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

        //

    }
    else {
        echo 'Vous n\'êtes pas autorisé à effectuer cette action';
    }
}


function tinyMceForPostUpdating($postId) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $postsManager = new PostsManager();
        $post = $postsManager->getPost($postId);

        require_once('view/tinyMce_view.php');
    } 
    else {
        echo 'fail';
        // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
    }
}


function updatePost($id, $title, $category, $content) {
    
    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $postsManager = new PostsManager();
        $postsManager->updatePost($id, $title, $category, $content);

        require_once('view/tinyMce_view.php');
    }
    else {
        echo 'fail';
        // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
    }
}


function deletePost($id) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $postsManager = new PostsManager();
        $postsManager->deletePost($id);

        allPostsPage();
    }
}


function allPostsPage() {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

        $postsManager = new PostsManager();
        $posts = $postsManager->getAllPostsList();
        require_once('view/allPostsList_view.php');
    } 
    else {
        echo 'fail';
        // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
    }
}


