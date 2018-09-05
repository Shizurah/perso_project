<?php 
    $title = 'Actus'; 
    $other = NULL;
?>


<!-- HEADER -->
<?php 
    ob_start(); 
    echo '<div id="main-wrap" class="container">';

    $h1Header = '<img id="banner-img" src="public/images/logo2.png" alt="logo"/>';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>



<!-- SECTION -->
<?php ob_start(); ?>

    <div class="row">

        <!-- AFFICHAGE DES ACTUS -->
        <div id="news-posts-container" class="col-lg-7 col-md-7">

            <div class="row">
                <h2 class="col-lg-12">ACTUS</h2>
            </div>

            <br/>

            <?php
                foreach ($newsPosts as $post) {
            ?>
                    <div class="news-posts">

                        <div class="row">
                            <!-- titre post -->
                            <h3 class="col-lg-12">
                                <a href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>"> 
                                    <?= $post->title(); ?>
                                </a>
                            </h3>
                        </div>
                        
                        <div class="row">
                            <!-- affiche post -->
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <a href="index.php?action=post_and_comments&postId=<?= $post->id(); ?>">
                                    <img class="posters" src="public/posts/<?= $post->poster(); ?>" alt="affiche série"/>
                                </a>
                            </div>

                            <!-- contenu post -->
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 news-posts-content">
                                <p>
                                    <?= $post->content(). '... '; ?>
                                    <i>
                                        <a href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>">
                                            Lire la suite (...)
                                        </a>
                                    </i>
                                </p>

                                <p>
                                    <i>
                                        Publié le <?= $post->postDate_fr(); ?>
                                    </i>
                                    <br/>
                                </p> 
                            </div>   
                        </div>

                    </div>
             
                    <hr/>
            <?php   
                }
            ?>
        </div>

        <!-- AFFICHAGE DES PROCHAINES SORTIES -->
        <div id="next-releases-posts-container" class="col-lg-5 col-md-5">

            <div class="row">
                <h2 class="col-lg-12">
                    PROCHAINES SORTIES 
                </h2>
            </div>

            <br/>

            <?php
                foreach ($nextReleasesPosts as $post) {
            ?>

                    <div class="next-releases-posts">

                        <div class="row"> 
                            <h3 class="col-lg-12">
                                <a href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>">
                                    <?= $post->title(); ?>
                                </a>
                            </h3>
                        </div>

                        <div class="col-lg-12">
                            <a class="posters-frames" href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>">
                                <img class="posters" src="public/posts/<?= $post->poster(); ?>" alt="affiche série"/>
                            </a>
                        </div>

                        <div class="col-lg-12">
                            <p>
                                <?= $post->content(); ?>
                            </p>
                        </div>

                    </div>

                    <hr/>
            <?php
                }
            ?>
        </div>
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
    document.getElementById('main-wrap').style.marginTop = '150px';
    document.getElementById('nav-line').style.display = 'none';
</script>