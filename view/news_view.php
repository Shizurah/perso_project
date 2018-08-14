<?php $title = 'Actus'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = 'Bienvenue sur notre page d\'actus ciné !';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>



<!-- SECTION -->
<?php ob_start(); ?>

<p>Ici des articles</p>

<?php
    foreach ($newsPosts as $post) {
?>
        <br/>
        <h3><?= $post->title(); ?></h3>
        <p>
            <?= $post->content(); ?> 
            <i>Publié le <?= $post->postDate_fr(); ?></i>
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