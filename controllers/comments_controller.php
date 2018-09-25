<?php

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
        $commentsManager = new CommentsManager();
        $comment = $commentsManager->getOneComment($id);

        if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $comment->author_id()) {
            echo '<p class="success-msg">Le commentaire a bien été supprimé !</p>';
        }
        else {
            echo '<p class="success-msg">Votre commentaire a bien été supprimé !</p>';
        }

        $commentsManager->deleteComment($id);
    }
}


function deleteCommentsRelatedToAPost($postId) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager();
        $commentsManager->deleteComments($postId);
    }   
}


function reportComment($id) {
    
    if (isset($_SESSION['userStatus'])) {
        $commentsManager = new CommentsManager(); 
        $commentsManager->reportComment($id);

        echo '<p class="success-msg-for-reporting-comment">Le commentaire a bien été signalé</p>';
    }
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

// PAGINATION :
function displayComments($postId, $page, $commentsPerPage) {
    $commentsManager = new CommentsManager();
    $nbOfComments = $commentsManager->countNumberOfComments($postId);

    $comments = '';
    $nbOfPages = ceil($nbOfComments / $commentsPerPage);
    $firstCommentToDisplay = ($page - 1) * $commentsPerPage;

    $commentsAndUsersInfos = $commentsManager->getCommentsToDisplay($postId, $firstCommentToDisplay, $commentsPerPage);

    // while ($comment = $req->fetch()) 
    foreach ($commentsAndUsersInfos as $comment) {

        $comments .= 
        '<div class="comments" id="comment' .$comment->comment_id(). '"> 

            <div class="author-and-content">
                <div>
                    <img class="user-avatar-for-comments" src="public/members/avatars/' .$comment->author_avatar(). '" alt="avatar membre"/>
                </div>
                
                <div>
                    <span class="authors">'
                        .$comment->author_pseudo().
                    '</span>
                    
                    <span id="' .$comment->comment_id(). '">'
                        .$comment->comment_content().
                    '</span>                        
                </div>
            </div>

            <div class="comments-date-and-actions">
                <i>' .$comment->comment_date_fr(). '</i>';
    

        if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

            // 1. possibilité de modifier/supprimer son commentaire :
            if ($_SESSION['id'] == $comment->author_id()) {
                $comments .=
                    ' <a class="updating-comment-btn" href="' .$comment->comment_id(). '">
                            Modifier
                    </a> - 

                    <a class="deleting-comment-btn" href="' .$comment->comment_id(). '" 
                    onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre commentaire ?\')">
                            Supprimer
                    </a>';   
            }

            // 2. possibilité de signaler les commentairess :
            else {
                $comments .=
                    '<a class="reporting-comment-btn" href="' .$comment->comment_id(). '"
                        onclick="return confirm(\'Êtes-vous sûr de vouloir signaler ce commentaire ?\')">
                            Signaler
                    </a>';
            }

            // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $comment->author_id()) {

                $comments .= 
                    ' - <a class="deleting-comment-btn" href="' .$comment->comment_id(). '"
                            onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce commentaire ?\')">
                                Supprimer
                        </a>';
            }
        }

        $comments .= '</div></div>';              
    }

    $dataBack = array('nbOfPages' => $nbOfPages, 'commentsList' => $comments);
    $dataBack = json_encode($dataBack);

    echo $dataBack;  
}