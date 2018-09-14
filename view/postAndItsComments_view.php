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

        <div id="post-content"> 
            <?= $post->content(); ?> 
        </div>

        <?php 
            if (isset($_SESSION['userStatus'])) {

                // pour les admin, accès à la modification des articles directement depuis la page :
                if ($_SESSION['userStatus'] == 'admin') {

                    echo '<a href="index.php?action=postUpdating&postId=' . $post->id() . '">
                             Modifier
                          </a>';          
                }
        ?>
                <hr/>
                <div id="post-actions-container">

                    <!-- pour tous les membres connectés : -->
                    <!-- 1. commenter -->
                    <div id="comment-btn" class="post-actions-btn">
                        <!-- <img src="public/images/comment.png" width="25" height="30" alt="icône commentaire">  -->
                        Commenter 
                    </div>

                    <!-- 2. partager -->
                    <div id="sharing-btns-container" class="post-actions-btn">
                        <img id="logo-fb" class="sharing-btn" src="public/images/logo_fb1.png" alt=""/>
                        <img class="sharing-btn" src="public/images/logo_twitter1.png" alt=""/>
                        <img class="sharing-btn" src="public/images/logo_instagram1.png" alt=""/>
                    </div>

                </div>

        <?php                    
                require_once('view/commentsForm_template.php');
            } else {
                echo '<hr/>';
            }
                // echo '</div>';
        ?>
    </div>   
    

    <!-- AFFICHAGE DES COMMENTAIRES -->
    <div id="comments-container">

        <p>
            <span class="nb-of-comments"><?= $nbOfComments; ?></span> COMMENTAIRES
        </p>

     
    </div>

    <div id="pagination">
        <a href="index.php?action=display_comments&amp;postId=<?= $_GET['postId']; ?>" id="1"></a>
    </div>
</div> <!-- FIN MAIN-WRAP -->
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    require_once('footer_template.php');
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
        echo 
            '<script src="assets/js/postAndItsComments.js"></script>';
    $scripts = ob_get_clean();

    require('template.php'); 
?>




