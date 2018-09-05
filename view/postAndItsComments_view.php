<?php 
    $title = 'Article et commentaires'; 
    $other = NULL;
?>

<!-- HEADER -->
<?php 
    ob_start(); 

    echo '<div id="main-wrap" class="container">';
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
    </div>
    
    <div id="post-actions">
        <?php 
            if (isset($_SESSION['userStatus'])) {
        ?>
                <!-- pour tous les membres connectés : -->
                <button id="comment-btn">
                    <img src="public/images/comment.png" width="25" height="30" alt="icône commentaire"> 
                    Commenter 
                </button>
        <?php
            } 
        ?>
    </div>
  
    <br/><br/>


    <!-- Affichage des commentaires : -->

    <div id="comments-container">

        <p>#NOMBRE COMMENTAIRES :</p>

        <!-- Adaptation du formulaire selon action de l'utilisateur : -->
        <?php
            // modification commentaire :
            if (isset($_GET['action']) && isset($_GET['commentId']) && $_GET['action'] == 'commentUpdating') {
                $formActionAttribute = 'index.php?action=commentUpdated&postId=' .$post->id(). '&commentId=' .$_GET['commentId']. '#comment' .$_GET['commentId'];
                $placeholderAttribute = '';
                $textareaContent = $comment->content();
                $autofocus = 'autofocus';
            } 
            // ajout commentaire :
            else {
                $formActionAttribute = 'index.php?action=commentAdded&postId=' .$post->id();
                $placeholderAttribute = 'Votre commentaire...';
                $textareaContent = '';
                $autofocus = '';
            }
            require_once('view/commentsForm_template.php');
        ?>

        <?php
        foreach($comments as $comment) {
        ?>
            <div class="comments" id="comment<?= $comment->id() ?>">

                <div class="author-and-content">
                    <span class="authors">
                        <?= $comment->author(); ?>
                    </span>
                    <?= $comment->content(); ?>
                </div>
                
                
            <div>

                <i>Le <?= $comment->comment_date_fr(); ?></i>
                   

                <!-- Actions possibles sur les commentaires publiés : -->
                <?php
                    // pour chaque membre connecté :
                    if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

                        // 1. possibilité de modifier/supprimer son commentaire :
                        if ($_SESSION['pseudo'] == $comment->author()) {

                            echo '<a href="index.php?action=commentUpdating&commentId=' .$comment->id(). '&postId=' .$post->id(). '#form">
                                    Modifier
                                </a> - 

                                <a href="index.php?action=commentDeleted&commentId=' .$comment->id(). '&postId=' .$post->id(). '" 
                                    onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre commentaire ?\')">
                                    Supprimer
                                </a>';   
                        }

                        // 2. possibilité de signaler les commentaires :
                        else {
                            echo '<a href="index.php?action=commentReporting&commentId=' .$comment->id(). '&postId=' .$post->id(). '"
                                    onclick="return confirm(\'Êtes-vous sûr de vouloir signaler ce commentaire ?\')">
                                    Signaler
                                </a>';
                        }

                        // 3. Pour les admin, possibilité de supprimer chacun des commentaires directement depuis la page :
                        if ($_SESSION['userStatus'] == 'admin' && $_SESSION['pseudo'] != $comment->author()) {

                            echo ' - <a href="index.php?action=commentDeleted&commentId=' .$comment->id(). '&postId=' .$post->id(). '"
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
    
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>
    <p>Ici des infos en bas de page</p>
    <a href="index.php?action=contact">Contact</a>
    </div>
<?php $footer = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script>
    document.getElementById('actions-btns').style.display = "none";

    document.getElementById('comment-btn').addEventListener('click', function() {
        document.getElementById('comments-form').style.display = 'block';
    });
</script>
