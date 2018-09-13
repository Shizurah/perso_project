<?php

// use \eloise\projet5\CommentsManager;

function addComment($content, $postId, $userId) {
    $content = nl2br($content);

    $commentsManager = new CommentsManager();
    $lastCommentId = $commentsManager->addComment($content, $postId, $userId);

    $comment = $commentsManager->getOneComment($lastCommentId);
    
    echo 

        '<div class="comments" id="comment' .$comment->id(). '"> 

            <div class="author-and-content">
                <div>
                    <img class="user-avatar-for-comments" src="public/members/avatars/' .$_SESSION['avatar']. '" alt="avatar membre"/>
                </div>
                
                <div>
                    <span class="authors">'
                        .$_SESSION['pseudo'].
                    '</span>
                    
                    <span id="' .$lastCommentId. '">'
                        .$comment->content().
                    '</span>                        
                </div>
            </div>

            <div class="comments-date-and-actions">
                <i>' .$comment->comment_date_fr(). '</i>';
            
                if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

                    // 1. possibilité de modifier/supprimer son commentaire :
                    if ($_SESSION['id'] == $comment->author_id()) {
                    
                        echo 
                            ' <a class="updating-comment-btn" href="' .$comment->id(). '">
                                    Modifier
                            </a> - 

                            <a class="deleting-comment-btn" href="' .$comment->id(). '" 
                            onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre commentaire ?\')">
                                    Supprimer
                            </a>';   
                    }

                    // 2. possibilité de signaler les commentaires :
                    else {
                        echo 
                            '<a href="index.php?action=commentReporting&commentId=' .$comment->id(). '&postId=' .$comment->post_id(). '"
                                onclick="return confirm(\'Êtes-vous sûr de vouloir signaler ce commentaire ?\')">
                                    Signaler
                            </a>';
                    }

                    // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
                    if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $comment->author_id()) {

                        echo 
                            ' - <a href="index.php?action=commentDeleted&commentId=' .$comment->id(). '&postId=' .$comment->post_id(). '"
                                    onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce commentaire ?\')">
                                        Supprimer
                                </a>';
                    }
                }

        echo '</div>
        </div>';       
}


function getCommentToUpdate($id) {
    $commentsManager = new CommentsManager();
    $comment = $commentsManager->getOneComment($id);
    return $comment;
}


function updateComment($id, $content) {
    $commentsManager = new CommentsManager();
    $commentsManager->updateComment($id, $content);

    echo '<span id="' .$id. '">' .$content. '</span>';
}


function deleteComment($id) {

    if (isset($_SESSION['id'])) {
        $successMsg = '<p class="success-msg">';
        $commentsManager = new CommentsManager();
        $comment = $commentsManager->getOneComment($id);

        if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $comment->author_id()) {
            $successMsg = $successMsg. 'Le commentaire a bien été supprimé !</p>';
        }
        else {
            $successMsg = $successMsg .'Votre commentaire a bien été supprimé !</p>';
        }

        $commentsManager->deleteComment($id);

        echo $successMsg;
    }
}


function deleteCommentsRelatedToAPost($postId) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager();
        $commentsManager->deleteComments($postId);
    }   
}


function reportComment($id) {
    $commentsManager = new CommentsManager(); 
    $commentsManager->reportComment($id);
}


function getReportedComments() {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager(); 
        $reportedComments = $commentsManager->getReportedComments();

        require_once('view/reportedComments_view.php');
    }
}


function ignoreReportedComment($id) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager();
        $commentsManager->ignoreReportedComment($id);
    }
}
