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

                <form action="index.php?action=commentAdded" method="post">
                    <img src="public/members/avatars/<?= $_SESSION['avatar'] ?>" width="50" height="50" alt="avatar">
                    <textarea name="comment-text" id="comment-text" placeholder="Votre commentaire..." cols="40" rows="2"></textarea><br/><br/>
                    <input type="submit" value="Publier">
                    <!-- <input type="text" name="comment-text" id="comment-text" placeholder="Votre commentaire..."> -->
                </form>
        <?php
            } 
        ?>
    </p> 

    <br/>

    

    <br/><br/>

    <p>
        #NOMBRE COMMENTAIRES :
    </p>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>



