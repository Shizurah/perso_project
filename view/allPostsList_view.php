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
        <h3>Vos articles</h3>
        <br/>
        <table>
            <tr>
                <th>Titre</th>
                <th>Date de publication</th>
                <th>Catégorie</th>
                <th><img src="public/images/pencil.png"/></th>
                <th><img src="public/images/trash.png"/></th>
            </tr>
            
            <?php 
                if (isset($_GET['action']) && $_GET['action'] == 'postDeleting' && isset($_GET['postId']) && $_GET['postId']) {
                    echo '<p>Article supprimé</p>';
                }
            ?>

            <?php
                foreach ($posts as $post) {
            ?>
                    <tr>
                        <td>
                            <a class="link-for-post-watching" href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>">
                                <?= $post->title(); ?>
                                <img class="updating-icon" src="public/images/eye.png"/>
                            </a>
                        </td>

                        <td>
                            <?= $post->postDate_fr(); ?>
                        </td>
                        
                        <td>
                            <?= $post->category(); ?>
                        </td>
                        
                        <td>
                            <a class="link-for-post-updating" href="index.php?action=postUpdating&amp;postId=<?= $post->id(); ?>">Modifier</a> 
                        </td>

                        <td>
                            <a id="<?= $post->id(); ?>" class="link-for-post-deleting" href="#">
                                Supprimer
                                <!-- <img src="public/images/trash1.png"/> -->
                            </a>
                            <!-- <form action="index.php?action=postDeleting&amp;postId=<?= $post->id(); ?>" method="post">
                                <input type="radio" name="action" value="postDeleting" required>
                                <input type="submit" value="Supprimer">
                            </form>   -->
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
?>

    <script src="assets/js/file.js"></script>
    <script>
        $('table td').css('padding', '6px 20px');
    </script>

<?php
    $scripts = ob_get_clean();

    require_once('view/templates/template.php'); 
?>