<?php $title = 'Articles'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = '';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>



<!-- SECTION -->
<?php ob_start(); ?>

    <?php require('asideForAdministration_template.php'); ?>

    <br/>

    <h3>Vos articles</h3>
    <br/>
    <table>
        <tr>
            <th>Titre</th>
            <th>Date de publication</th>
            <th>Catégorie</th>
            <th>Modifier l'article</th>
            <th>Supprimer l'article</th>
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
                        <strong><a href="index.php?action=post_and_comments&amp;postId=<?= $post->id(); ?>"><?= $post->title(); ?></a></strong>
                    </td>

                    <td>
                        <?= $post->postDate_fr(); ?>
                    </td>
                    
                    <td>
                        <?= $post->category(); ?>
                    </td>
                    
                    <td>
                        <a href="index.php?action=postUpdating&amp;postId=<?= $post->id(); ?>">Modifier</a> 
                    </td>

                    <td>
                        <form action="index.php?action=postDeleting&amp;postId=<?= $post->id(); ?>" method="post">
                            <input type="radio" name="action" value="postDeleting" required>
                            <input type="submit" value="Supprimer">
                        </form>  
                    </td>
                    
                </tr>
        <?php    
            }
        ?>
    </table>
    
<?php $section = ob_get_clean(); ?>


<!-- FOOTER -->
<?php ob_start(); ?>

<p>Ici des infos en bas de page</p>
<a href="index.php?action=contact">Contact</a>

<?php $footer = ob_get_clean(); ?>


<?php require('template.php'); ?>