<?php

class PostsController extends Controller {

    private $_postsManager;
    private $_commentsManager;
    

    public function __construct() {
        $this->_postsManager = new PostsManager();
        $this->_commentsManager = new CommentsManager;
    }


    public function homePage() {

        $newsPosts = $this->_postsManager->getNewsPostsList(0, 10);
        $nextReleasesPosts = $this->_postsManager->getNextReleasesPostsList();
    
        require_once('view/news_view.php');
    }
    
    
    public function fetchNextPosts($nbOfPostsToDisplay, $nbOfPostsDisplayed) {
    
        $newsPosts = $this->_postsManager->getNewsPostsList($nbOfPostsDisplayed, $nbOfPostsToDisplay);
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
    
    
    public function tinyMcePage() {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            require_once('view/tinyMce_view.php');
        } 
        else {
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page.');
        }
    }
    
    
    // Page d'un article et de ses commentaires :
    public function onePostPage($postId) {

        $post = $this->_postsManager->getPost($postId);
        $nbOfComments = $this->_commentsManager->countNumberOfComments($postId);
    
        require_once('view/postAndItsComments_view.php');
    }
    
    
    public function addNewPost($title, $poster, $category, $content) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
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
                            $newPostId = $this->_postsManager->addPost($title, $newPosterName, $category, $content);
    
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
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page');
        }
    }
    
    
    public function tinyMceForPostUpdating($postId) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            $post = $this->_postsManager->getPost($postId);
            require_once('view/tinyMce_view.php');
        } 
        else {
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page');
        }
    }
    
    
    public function updatePost($id, $title, $category, $content) {
        
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            $this->_postsManager->updatePost($id, $title, $category, $content);
            require_once('view/tinyMce_view.php');
        }
        else {
            parent::errorPage('Vous n\'êtes pas autorisé à effectuer cette action.');
        }
    }
    
    
    public function deletePost($id) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            $this->_postsManager->deletePost($id);
            echo '<p class="success-msg">L\'article a bien été supprimé</p>';
        }
        else {
            parent::errorPage('Vous n\'êtes pas autorisé à effectuer cette action.');
        }
    }
    
    
    public function allPostsPage() {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            $posts = $this->_postsManager->getAllPostsList();
            require_once('view/allPostsList_view.php');
        } 
        else {
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page');
        }
    }
    
    
    public function allPostsForUpdatingPage() {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            $posts = $this->_postsManager->getAllPostsList();
            require_once('view/allPostsListForUpdating_view.php');
        } 
        else {
            $parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page');
        }
    }
}



