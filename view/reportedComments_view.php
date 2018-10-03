<?php 
    $title = 'Administration du site'; 
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
    require_once('view/templates/asideForAdministration_template.php'); 
?>

    <div id="administration-main-content">

        <h3>Commentaires signalés</h3>
        <br/>
        <table>
            <tr>
                <th>Signalements</th>
                <th>Message</th>
                <th>Auteur</th>
                <th>Date de publication</th>
                <th>Article associé</th>
                <th>Ignorer</th>
                <th><img src="public/images/trash.png"/></th>
            </tr>
        
        <?php
            foreach ($reportedComments as $comment) {
        ?>
                <tr id="<?= $comment->comment_id() ?>" >

                    <td><?= $comment->reports() ?></td>
                    <td><?= nl2br(htmlspecialchars($comment->comment_content())) ?></td>
                    <td><?= htmlspecialchars($comment->author_pseudo()) ?></td>
                    <td><?= $comment->comment_date_fr() ?></td>
                    <td><a href="index.php?action=post_and_comments&amp;postId=<?= $comment->post_id(); ?>">Voir</a></td>
                   
                    <td>
                        <a class="link-for-comment-ignoring" href="#">Ignorer</a>
                    </td>

                    <td>
                        <a class="link-for-comment-deleting" href="#">Supprimer</a>
                    </td>
                </tr>
        <?php
            }
        ?>
        </table>

    </div>


<?php $section = ob_get_clean();

    // FOOTER :
    ob_start(); 
    $footer = ob_get_clean(); 

    // SCRIPTS JS :
    ob_start();
        echo 
            '<script src="assets/js/admin.js"></script>';
    $scripts = ob_get_clean();

    require_once('view/templates/template.php'); 
?>

