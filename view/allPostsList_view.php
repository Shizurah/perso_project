<?php $title = 'Articles'; ?>

<!-- HEADER -->
<?php 
    ob_start(); 

    $h2Header = 'Liste de vos articles';
    require('header_template.php'); 

    $header = ob_get_clean(); 
?>



<!-- SECTION -->
<?php ob_start(); ?>

    <?php require('asideForAdministration_template.php'); ?>

    <br/><br/>

    <table>
        <tr>
            <th>Titre</th>
            <th>Date de publication</th>
            <th>Catégorie</th>
            <th>Modifier l'article</th>
            <th>Supprimer l'article</th>
        </tr>
        

        <?php
            foreach ($posts as $post) {
        ?>
                <tr>
                    <td>
                        <strong><?= $post->title(); ?></strong>
                    </td>

                    <td>
                        <?= $post->postDate_fr(); ?>
                    </td>
                    
                    <td>
                        <?= $post->category(); ?>
                    </td>
                    
                    <td>
                        <a href="">Modifier</a> 
                    </td>

                    <td>
                        <input type="radio" name="action" value="Supprimer" id="Supprimer">
                        <input type="submit" value="Supprimer">
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