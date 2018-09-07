<?php 
    $title = 'Article et commentaires'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">'; // --> DEBUT MAIN-WRAP
    $h1Header = NULL;
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <!-- Affichage des articles : -->
    <div id="post-container">
        <h3> <?= $post->title(); ?> </h3>

        <p id="post-date">
            <i> Publié le <?= $post->postDate_fr(); ?> </i>  
        </p>

        <p id="post-poster">
            <img src="public/posts/<?= $post->poster(); ?>" alt="affiche article">
        </p>

        <div id="post-content"> <?= $post->content(); ?> </div>

        <?php 
            if (isset($_SESSION['userStatus'])) {

                // pour les admin, accès à la modification des articles directement depuis la page :
                if ($_SESSION['userStatus'] == 'admin') {

                    echo '<a href="index.php?action=postUpdating&postId=' . $post->id() . '">
                             Modifier
                          </a>';          
                }
            }
        ?>
        <hr/>

        <div class="row" id="post-actions-container">
            <?php 
                if (isset($_SESSION['userStatus'])) {
            ?>
                    <div class="post-actions-btn col-lg-4">
                        <?= $nbOfComments; ?> commentaires
                    </div>

                    <!-- pour tous les membres connectés : -->
                    <div id="comment-btn" class="post-actions-btn col-lg-4">
                        <img src="public/images/comment.png" width="25" height="30" alt="icône commentaire"> 
                        Commenter 
                    </div>

                    <div id="sharing-btn" class="post-actions-btn col-lg-4">
                        <div class="row">
                            <img class="col-log-4" src="public/images/logo_fb1.png" alt="" width="20px"/>
                            <img class="col-log-4" src="public/images/logo_twitter1.png" alt=""/>
                            <img class="col-log-4" src="public/images/logo_instagram1.png" alt=""/>
                        </div> 
                    </div>
            <?php
                } 
            ?>
        </div>

    </div>
    

    <!-- Affichage des commentaires : -->
    <div id="comments-container">

        <p><?= $nbOfComments; ?> COMMENTAIRES</p>

        <?php
            foreach($commentsAndUsersInfos as $commentAndUserInfos) {
        ?>
            <!-- id pour ancre : -->
            <div class="comments" id="comment<?= $commentAndUserInfos->comment_id() ?>"> 

                <div class="author-and-content">
                    
                    <!-- avatar membre -->
                    <div>
                        <img class="user-avatar-for-comments" src="public/members/avatars/<?= $commentAndUserInfos->author_avatar(); ?>" alt="avatar membre"/>
                    </div>
                    

                    <div>
                         <!-- pseudo membre -->
                        <span class="authors">
                            <?= $commentAndUserInfos->author_pseudo(); ?>
                        </span>
                        
                        <!-- texte commentaire -->
                        <?= $commentAndUserInfos->comment_content(); ?>
                        </div>
                    </div>
                
                <div class="comments-date-and-actions">
                    <!-- date commentaire -->
                    <i><?= $commentAndUserInfos->comment_date_fr(); ?></i>
                    
                    <!-- Actions possibles sur les commentaires publiés : -->
                    <?php
                        // pour chaque membre connecté :
                        if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

                            // 1. possibilité de modifier/supprimer son commentaire :
                            if ($_SESSION['id'] == $commentAndUserInfos->author_id()) {

                                echo '<a href="index.php?action=commentUpdating&commentId=' .$commentAndUserInfos->comment_id(). 
                                     '&postId=' .$commentAndUserInfos->post_id(). '#form">
                                         Modifier
                                     </a> - 

                                     <a href="index.php?action=commentDeleted&commentId=' .$commentAndUserInfos->comment_id(). 
                                     '&postId=' .$commentAndUserInfos->post_id(). '" 
                                         onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre commentaire ?\')">
                                         Supprimer
                                     </a>';   
                            }

                            // 2. possibilité de signaler les commentaires :
                            else {
                                echo '<a href="index.php?action=commentReporting&commentId=' .$commentAndUserInfos->comment_id(). 
                                     '&postId=' .$commentAndUserInfos->post_id(). '"
                                         onclick="return confirm(\'Êtes-vous sûr de vouloir signaler ce commentaire ?\')">
                                         Signaler
                                     </a>';
                            }

                            // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
                            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $commentAndUserInfos->author_id()) {

                                echo ' - <a href="index.php?action=commentDeleted&commentId=' .$commentAndUserInfos->comment_id(). 
                                     '&postId=' .$commentAndUserInfos->post_id(). '"
                                         onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce commentaire ?\')">
                                         Supprimer
                                     </a>';
                            }
                        }   
                    ?>
                    </div>

            </div>    
        <?php
        }
        ?>
    </div>
</div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    require_once('footer_template.php');
    $footer = ob_get_clean(); 

    require('template.php'); 
?>

<script>
    document.getElementById('actions-btns').style.display = "none";

    document.getElementById('comment-btn').addEventListener('click', function() {
        document.getElementById('comments-form').style.display = 'block';
    });
</script>
