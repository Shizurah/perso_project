<?php


class CommentsController extends Controller {

    private $_commentsManager;
    

    public function __construct() {
        $this->_commentsManager = new CommentsManager;
    }


    public function addComment($content, $postId, $userId) {

        if (isset($_SESSION['id']) && isset($_SESSION['userStatus'])) {
            // $content = $content;
    
            $lastCommentId = $this->_commentsManager->addComment(htmlspecialchars($content), $postId, $userId);
            $comment = $this->_commentsManager->getOneComment($lastCommentId);
        
            $response = '';
            $commentId = $comment->id();
            $commentContent = $comment->content();
            $commentDate = $comment->comment_date_fr();
            $commentAuthorId = $comment->author_id();
            $authorAvatar = $_SESSION['avatar'];
            $authorPseudo = $_SESSION['pseudo'];
        
            ob_start();
                require_once('view/templates/commentsResponse_template.php');
            $response = ob_get_clean();
        
            echo $response;     
        }
        else {
            parent::errorPage('Vous ne pouvez pas effectuer cette action. Veuillez vous connecter.');
        }
    }
    
    
    function getCommentToUpdate($id) { // ????
        $comment = $this->_commentsManager->getOneComment($id);
        return $comment;
    }
    
    
    public function updateComment($id, $content) {

        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'member' || $_SESSION['userStatus'] == 'admin') {
            $this->_commentsManager->updateComment($id, $content);
            echo '<span id="' .$id. '">' .nl2br(htmlspecialchars($content)). '</span>';
        }
        else {
            parent::errorPage('Vous ne pouvez pas effectuer cette action. Veuillez vous connecter.');
        }
    }
    
    
    public function deleteComment($id) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus'])) {

            $msg = '';
            $comment = $this->_commentsManager->getOneComment($id);
            $this->_commentsManager->delete($id, 'comments', 'Ce commentaire n\'existe pas');
            
            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $comment->author_id()) {
                $msg = '<p class="success-msg">Le commentaire a bien été supprimé</p>';
            }
            else {
                $msg = '<p class="success-msg">Votre commentaire a bien été supprimé !</p>';
            }
    
            $dataBack = array('status' => 'success', 'message' => $msg);
            $dataBack = json_encode($dataBack);
    
            echo $dataBack;
        }
        else {
            parent::errorPage('Vous ne pouvez pas effectuer cette action. Veuillez vous connecter.');
        }
    }
    
    
    public function deleteCommentsRelatedToAPost($postId) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
            $this->_commentsManager->deleteComments($postId);
        }   
        else {
            parent::errorPage('Vous n\'êtes pas autorisé à effectuer cette action.');
        }
    }
    
    
    public function reportComment($id) {
        
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus'])) {
        
            $this->_commentsManager->reportComment($id);
    
            $dataBack = array('status' => 'success', 'message' => '<p class="success-msg-for-reporting-comment">Le commentaire a bien été signalé</p>');
            $dataBack = json_encode($dataBack);
    
            echo $dataBack;
        }
        else {
            parent::errorPage('Vous ne pouvez pas effectuer cette action. Veuillez vous connecter.');
        }
    }
    
    
    public function getReportedComments() {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

            $reportedComments = $this->_commentsManager->getReportedComments();
            require_once('view/reportedComments_view.php');
        }
        else {
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page.');
        }
    }
    
    
    public function ignoreReportedComment($id) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

            $this->_commentsManager->ignoreReportedComment($id);
    
            $dataBack = array('status' => 'success', 'message' => '<p class="success-msg">Le commentaire a bien été ignoré</p>');
            $dataBack = json_encode($dataBack);
    
            echo $dataBack;
        }
        else {
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page.');
        }
    }
    
    
    // PAGINATION :
    public function displayComments($postId, $page, $commentsPerPage) {
 
        $nbOfComments = $this->_commentsManager->countNumberOfComments($postId);
    
        $comments = '';
        $nbOfPages = ceil($nbOfComments / $commentsPerPage);
        $firstCommentToDisplay = ($page - 1) * $commentsPerPage;
    
        $commentsAndUsersInfos = $this->_commentsManager->getCommentsToDisplay($postId, $firstCommentToDisplay, $commentsPerPage);
    
        foreach ($commentsAndUsersInfos as $comment) {
    
            $response = '';
            $commentId = $comment->comment_id();
            $commentContent = $comment->comment_content();
            $commentDate = $comment->comment_date_fr();
            $commentAuthorId = $comment->author_id();
            $authorAvatar = $comment->author_avatar();
            $authorPseudo = $comment->author_pseudo();
    
            ob_start();
                require('view/templates/commentsResponse_template.php');
            $response = ob_get_clean();
    
            $comments .= $response;
        }
    
        $dataBack = array('nbOfPages' => $nbOfPages, 'commentsList' => $comments);
        $dataBack = json_encode($dataBack);
    
        echo $dataBack;  
    }
}
