<?php 
$title = 'Articles'; 
$other = '<link href="assets/css/administration_style.css" rel="stylesheet"';
?>

<!-- HEADER -->
<?php 
    ob_start(); 
    $h2Header = '';
    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php 
    ob_start();
    require('view/templates/asideForAdministration_template.php'); 
?>

    <div id="administration-main-content">
        <h3>Modifier vos articles</h3>
        <br/>
        <table>
            <tr>
                <th>Articles</th>
                <th>Action</th>
                <th>Date de publication</th>
                <th>Catégorie</th>
            </tr>
            
            <!-- <?php 
                if (isset($_GET['action']) && $_GET['action'] == 'postDeleting' && isset($_GET['postId']) && $_GET['postId']) {
                    echo '<p>Article supprimé</p>';
                }
            ?> -->

            <?php
                foreach ($posts as $post) {
            ?>
                    <tr>
                        <td>
                            <a class="link-for-post-action" href="index.php?action=postUpdating&amp;postId=<?= $post->id(); ?>">
                                <?= $post->title(); ?>
                                <img class="updating-icon" src="public/images/pencil.png"/>
                            </a>
                        </td>

                        <td>
                            <a href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>">Voir l'article</a>
                        </td>

                        <td>
                            <?= $post->postDate_fr(); ?>
                        </td>
                        
                        <td>
                            <?= $post->category(); ?>
                        </td>                       
                    </tr>
            <?php    
                }
            ?>
        </table>
    </div>

<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php 
    ob_start(); 
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
        echo 
            '<script src="assets/js/file.js"></script>';
    $scripts = ob_get_clean();

    require_once('view/templates/template.php'); 
?>