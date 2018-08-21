<?php $title = 'Article et commentaires'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = '';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <h3> <?= $post->title(); ?> </h3>

    <p> <?= $post->content(); ?> </p>

    <p>
        <i>Publié le <?= $post->postDate_fr(); ?> </i>  
        <?php 
            if (isset($_SESSION['userStatus'])) {

                if ($_SESSION['userStatus'] == 'admin') {
                    echo ' - <a href="index.php?action=postUpdating&postId=' . $post->id() . '">Modifier</a>';
                }
        ?>
                <br/>
                <span><img src="public/images/comment.png" width="25" height="30" alt="icône commentaire"> Commenter </span>

                <br/><br/>
                
                <?php 
                    if (isset($_GET['action']) && isset($_GET['commentId']) && $_GET['action'] == 'commentUpdating') {
                        $formActionAttribute = 'index.php?action=commentUpdated&postId=' .$post->id(). '&commentId=' .$_GET['commentId']. '#comment' .$_GET['commentId'];
                        $placeholderAttribute = '';
                        $textareaContent = $comment->content();
                    } 
                    
                    else {
                        $formActionAttribute = 'index.php?action=commentAdded&postId=' .$post->id();
                        $placeholderAttribute = 'Votre commentaire...';
                        $textareaContent = '';
                    }

                    require_once('view/commentsForm_template.php');
                ?>
        <?php
            } 
        ?>
    </p> 

    <br/><br/>

    <p>#NOMBRE COMMENTAIRES :</p>

        <?php
            foreach($comments as $comment) {
        ?>
                <p id="comment<?= $comment->id() ?>">
                    <?= $comment->author(); ?>, <i>le <?= $comment->comment_date_fr(); ?></i><br/>
                    <?= $comment->content(); ?><br/>   
                    <?php
                        if (isset($_SESSION['pseudo']) && isset($_SESSION['userStatus'])) {

                            // possibilité pour chaque membre connecté de modifier/supprimer son commentaire :
                            if ($_SESSION['pseudo'] == $comment->author()) {
                                echo '<a href="index.php?action=commentUpdating&postId=' .$post->id(). '&commentId=' .$comment->id(). '#form">Modifier</a> - <a href="index.php?action=commentDeleting">Supprimer</a>';
                                
                            }

                            else {
                                echo '<a href="index.php?action=commentReporting">Signaler</a> - ';
                            }

                            // les admin du site doivent pouvoir supprimer chacun des commentaires :
                            if ($_SESSION['userStatus'] == 'admin' && $_SESSION['pseudo'] != $comment->author()) {
                                echo '<a href="index.php?action=commentDeleting">Supprimer</a>';
                            }
                        }   
                    ?>
                </p>
                
        <?php
            }
        ?>
    

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>



