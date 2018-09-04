<?php $title = 'Actus'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = '<img id="banner-img" src="public/images/logo2.png" alt="logo"/>';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>



<!-- SECTION -->
<?php ob_start(); ?>

<?php
    foreach ($newsPosts as $post) {
?>
        <br/>

        <div class="row comments">

            <div class="col-lg-6">
                <a href="index.php?action=post_and_comments&postId=<?= $post->id(); ?>">
                    <img class="posters" src="public/posts/<?= $post->poster(); ?>" alt="Affiche"/>
                </a>
            </div>

            <div class="col-lg-6">
                <h3><?= $post->title(); ?></h3>

                <p>
                    <?= $post->content(). ' (...)'; ?>
                    <i><a href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>"> Lire la suite</a></i>
                </p>

                <p>
                    <i>Publié le <?= $post->postDate_fr(); ?></i><br/><a href="index.php?action=post_and_comments&amp;postId=<?= $post->id() ?>">Commentaires</a>
                </p> 
            </div>
            
        </div>

        <br/>
        <hr/>
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