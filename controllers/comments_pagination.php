<?php

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

    echo $comments;  
}


