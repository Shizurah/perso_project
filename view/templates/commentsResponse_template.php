<?php

echo 
'<div class="comments" id="comment' .$commentId. '"> 

    <div class="author-and-content">
        <div>
            <img class="user-avatar-for-comments" src="public/members/avatars/' .$authorAvatar. '" alt="avatar membre"/>
            
        </div>
        
        
        <div>
            <span class="authors">'
                .$authorPseudo.
            ': </span>

            <span id="' .$commentId. '">'
                .nl2br(htmlspecialchars($commentContent)).
            '</span>                        
        </div>
    </div>

    <div class="comments-date-and-actions">
        <i>' .$commentDate. '</i>';
    
        if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

            // 1. possibilité de modifier/supprimer son commentaire :
            if ($_SESSION['id'] == $commentAuthorId) {
            
                echo 
                    ' <a id="' .$commentId. '" class="updating-comment-btn" href="#">
                            Modifier
                    </a> - 

                    <a id="' .$commentId. '" class="deleting-comment-btn" href="#">
                            Supprimer
                    </a>';   
            }

            // 2. possibilité de signaler les commentaires :
            else {
                echo 
                    '<a id="' .$commentId. '" class="reporting-comment-btn" href="#">
                            Signaler
                    </a>';
            }

            // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $commentAuthorId) {

                echo 
                    ' - <a id="' .$commentId. '" class="deleting-comment-btn" href="#">
                                Supprimer
                        </a>';
            }
        }

echo 
    '</div>
</div>';       