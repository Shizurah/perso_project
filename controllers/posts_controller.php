<?php

function homePage() {
    $postsManager = new PostsManager();
    $newsPosts = $postsManager->getNewsPostsList();
    require_once('view/news_view.php');
}

function weLovePage() {
    $postsManager = new PostsManager();
    $weLovePosts = $postsManager->getWeLovePostsList();
    require_once('view/weLove_view.php');
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
            $postCategory = 'news';
        }
        elseif ($category == 'weLove') {
            $postCategory = 'we_love';
        }

        $postsManager = new PostsManager();
        $newPostId = $postsManager->addPost($title, $postCategory, $content);

        require_once('view/tinyMce_view.php');
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

function onePostPage($postId) {
    $postsManager = new PostsManager();
    $post = $postsManager->getPost($postId);
    $commentsManager = new CommentsManager();
    $comments = $commentsManager->getCommentsList($postId);

    require_once('view/postAndItsComments_view.php');
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


