<?php

function homePage() {

    $postsManager = new PostsManager();

    // $totalPosts = $postsManager->countPosts();
    // $postsPerPage = 10;
    // $firstPost = ($pageId - 1) * $postsPerPage;
    
    $newsPosts = $postsManager->getNewsPostsList(0, 10);
    $nextReleasesPosts = $postsManager->getNextReleasesPostsList();

    // if ($pageId == 1) 
    require_once('view/news_view.php');

    // $response = '';

    // foreach ($newsPosts as $post) {
    //     $response .=

    //         '<div class="news-posts">

    //             <div class="row">
    //                 <!-- titre post -->
    //                 <h3 class="col-lg-12">
    //                     <a href="index.php?action=post_and_comments&postId=' .$post->id(). '">' 
    //                         .$post->title().
    //                     '</a>
    //                 </h3>
    //             </div>
                
    //             <div class="row">
    //                 <!-- affiche post -->
    //                 <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
    //                     <a href="index.php?action=post_and_comments&postId=' .$post->id(). '">
    //                         <img class="posters" src="public/posts/' .$post->poster(). '" alt="affiche série"/>
    //                     </a>
    //                 </div>

    //                 <!-- contenu post -->
    //                 <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 news-posts-content">
    //                     <p>'
    //                         .$post->content(). '...
    //                         <i>
    //                             <a href="index.php?action=post_and_comments&amp;postId=' .$post->id(). '">
    //                                 Lire l\'article 
    //                             </a>
    //                         </i>
    //                     </p>

    //                     <p>
    //                         <i>
    //                             Publié le ' .$post->postDate_fr().
    //                         '</i>
    //                         <br/>
    //                     </p> 
    //                 </div>   
    //             </div>

    //         </div>
        
    //         <hr/>';
    // }

    // echo $response;   

}


function fetchNextPosts($nbOfPostsToDisplay, $nbOfPostsDisplayed) {
    $postsManager = new PostsManager();
    $newsPosts = $postsManager->getNewsPostsList($nbOfPostsDisplayed, $nbOfPostsToDisplay);

    $response = '';

    foreach ($newsPosts as $post) {
        $response .=

            '<div class="news-posts">

                <div class="row">
                    <!-- titre post -->
                    <h3 class="col-lg-12">
                        <a href="index.php?action=post_and_comments&postId=' .$post->id(). '">' 
                            .$post->title().
                        '</a>
                    </h3>
                </div>
                
                <div class="row">
                    <!-- affiche post -->
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <a href="index.php?action=post_and_comments&postId=' .$post->id(). '">
                            <img class="posters" src="public/posts/' .$post->poster(). '" alt="affiche série"/>
                        </a>
                    </div>

                    <!-- contenu post -->
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 news-posts-content">
                        <p>'
                            .$post->content(). '...
                            <i>
                                <a href="index.php?action=post_and_comments&amp;postId=' .$post->id(). '">
                                    Lire l\'article 
                                </a>
                            </i>
                        </p>

                        <p>
                            <i>
                                Publié le ' .$post->postDate_fr().
                            '</i>
                            <br/>
                        </p> 
                    </div>   
                </div>

            </div>
        
            <hr/>';
    }

    echo $response;   
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

                        // $dataBack = array('status' => 'success', 'successMsg' => '<p class="error-msg">Votre article a bien été publié !</p>');
                        // $dataBack = json_encode($dataBack);

                        // echo $dataBack;  

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

        echo '<p class="success-msg">L\'article a bien été supprimé</p>';
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


function allPostsForUpdatingPage() {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

        $postsManager = new PostsManager();
        $posts = $postsManager->getAllPostsList();
        require_once('view/allPostsListForUpdating_view.php');
    } 
    else {
        echo 'fail';
        // throw new Exception('Vous n\'êtes pas autorisé à vous rendre sur cette page');
    }
}


