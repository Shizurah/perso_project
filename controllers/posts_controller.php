<?php

function homePage() {
    require_once('view/news_view.php');
}

function weLovedPage() {
    require_once('view/weLoved_view.php');
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


function addNewPost($title, $category, $content) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

        $postCategory = '';

        if ($category == 'news') {
            $postCategory = 'Actus';
        }
        elseif ($category == "weLoved") {
            $postCategory = 'On a aimé';
        }

        $postsManager = new PostsManager();
        $newPostId = $postsManager->addPost($title, $postCategory, $content);

        require_once('view/tinyMce_view.php');
    }

    else {
        echo 'Vous n\'êtes pas autorisé à effectuer cette action';
    }
    
}