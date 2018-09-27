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
            '</span>
            
            <span id="' .$commentId. '">'
                .htmlspecialchars($commentContent).
            '</span>                        
        </div>
    </div>

    <div class="comments-date-and-actions">
        <i>' .$commentDate. '</i>';
    
        if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

            // 1. possibilité de modifier/supprimer son commentaire :
            if ($_SESSION['id'] == $commentAuthorId) {
            
                echo 
                    ' <a class="updating-comment-btn" href="' .$commentId. '">
                            Modifier
                    </a> - 

                    <a class="deleting-comment-btn" href="' .$commentId. '" 
                    onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre commentaire ?\')">
                            Supprimer
                    </a>';   
            }

            // 2. possibilité de signaler les commentaires :
            else {
                echo 
                    '<a class="reporting-comment-btn" href="' .$commentId. '"
                        onclick="return confirm(\'Êtes-vous sûr de vouloir signaler ce commentaire ?\')">
                            Signaler
                    </a>';
            }

            // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $commentAuthorId) {

                echo 
                    ' - <a class="deleting-comment-btn" href="' .$commentId. '"
                            onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce commentaire ?\')">
                                Supprimer
                        </a>';
            }
        }

echo 
    '</div>
</div>';       