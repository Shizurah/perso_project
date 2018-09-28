<?php 
    $title = 'Administration du site'; 
    $other = '<link href="assets/css/administration_style.css" rel="stylesheet"';
?>

<!-- HEADER -->
<?php 
    ob_start(); 
    $h2Header = '';
    require('view/templates/header_template.php'); 

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <!-- <h2>Gestion du site</h2> -->
    <?php require_once('view/templates/asideForAdministration_template.php'); ?>

    <br/>
    
    <h3>Commentaires signalés</h3>
    
    <table>
        <tr>
            <th>Auteur</th>
            <th>Message</th>
            <th>Date de publication</th>
            <th>Nombre de signalements</th>
            <th>Supprimer le commentaire</th>
            <th>Ignorer le commentaire</th>
        </tr>
    
    <?php
        foreach ($reportedComments as $comment) {
    ?>
            <tr>
                <td><?= $comment->author_id() ?></td>
                <td><?= $comment->content() ?></td>
                <td><?= $comment->comment_date_fr() ?></td>
                <td><?= $comment->reports() ?></td>
                <td>
                    <form action="index.php?action=commentDeleted&commentId=<?= $comment->id() ?>" method="post">
                        <input type="radio" name="action" value="commentDeleting" required>
                        <input type="submit" value="Supprimer">
                    </form> 
                </td>
                <td>
                    <form action="index.php?action=commentIgnored&commentId=<?= $comment->id() ?>" method="post">
                        <input type="radio" name="action" value="commentIgnoring" required>
                        <input type="submit" value="Ignorer">
                    </form> 
                </td>
            </tr>
    <?php
        }
    ?>
    </table>
    

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

