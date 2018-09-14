<?php

function displayComments($postId, $page, $commentsPerPage) {
    $comment = '';
    $commentsManager = new CommentsManager();
    $nbOfComments = $commentsManager->countNumberOfComments($postId);

    $nbOfPages = ceil($nbOfComments / $commentsPerPage);
    $firstCommentToDisplay = ($page - 1) * $commentsPerPage;

    $req = $commentsManager->getCommentsToDisplay($postId, $firstCommentToDisplay, $commentsPerPage);

    while ($data = $req->fetch()) {

        $comment .= 
        '<div class="comments" id="comment' .$data['comment_id']. '"> 

            <div class="author-and-content">
                <div>
                    <img class="user-avatar-for-comments" src="public/members/avatars/' .$data['author_avatar']. '" alt="avatar membre"/>
                </div>
                
                <div>
                    <span class="authors">'
                        .$data['author_pseudo'].
                    '</span>
                    
                    <span id="' .$data['comment_id']. '">'
                        .$data['comment_content'].
                    '</span>                        
                </div>
            </div>

            <div class="comments-date-and-actions">
                <i>' .$data['comment_date_fr']. '</i>';
    

        if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

            // 1. possibilité de modifier/supprimer son commentaire :
            if ($_SESSION['id'] == $data['author_id']) {
                $comment .=
                    ' <a class="updating-comment-btn" href="' .$data['comment_id']. '">
                            Modifier
                    </a> - 

                    <a class="deleting-comment-btn" href="' .$data['comment_id']. '" 
                    onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre commentaire ?\')">
                            Supprimer
                    </a>';   
            }

            // 2. possibilité de signaler les commentaires :
            else {
                $comment .=
                    '<a href="index.php?action=commentReporting&commentId=' .$data['comment_id']. '&postId=' .$data['post_id']. '"
                        onclick="return confirm(\'Êtes-vous sûr de vouloir signaler ce commentaire ?\')">
                            Signaler
                    </a>';
            }

            // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $data['author_id']) {

                $comment .= 
                    ' - <a href="index.php?action=commentDeleted&commentId=' .$data['comment_id']. '&postId=' .$data['post_id']. '"
                            onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce commentaire ?\')">
                                Supprimer
                        </a>';
            }
        }

        $comment .= '</div></div>';              
    }

    echo $comment;  
}


