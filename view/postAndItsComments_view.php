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

    <h3><?= $post->title(); ?></h3>
    <p>
        <?= $post->content(); ?> 
    </p>

    <p>
        <i>Publié le <?= $post->postDate_fr(); ?> </i>

        <?php 
            if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
                echo '<a href="index.php?action=postUpdating&postId=' . $post->id() . '">Modifier</a>';
            } 
        ?>
    </p> 

    <br/>

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



