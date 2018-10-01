<?php 
    $title = 'Rédiger un article'; 
    $other = '<link href="assets/css/administration_style.css" rel="stylesheet">';
?>

<!-- TinyMCE : -->
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#postContent',
        plugins : 'image, link',
        width: '80%',
        height: '450px'
    });
</script>

<!-- HEADER -->
<?php 
    ob_start(); 
    $h1Header = '';

    $header = ob_get_clean(); 
?>


<!-- SECTION -->
<?php ob_start(); ?>

    <?php require_once('templates/asideForAdministration_template.php'); ?>

    <div id="administration-main-content">

        <?php
            if (!isset($_GET['postId'])) {
                echo '<h3>Rédiger un article</h3>';
            } 
            else {
                echo '<h3>Modifier l\'article</h3>';
            }
    
            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'postWritten') {
                    echo '<p>Votre article a bien été publié ! <a href="index.php?action=post_and_comments&postId=' . $newPostId . '">Voir l\'article</a></p>';
                }
                elseif ($_GET['action'] == 'postUpdated' && isset($_GET['postId'])) {
                    echo '<p>Votre article a bien été modifié ! <a href="index.php?action=post_and_comments&postId=' . $_GET['postId'] . '">Voir l\'article</a></p>';
                } 


                // FORMULAIRE (fichier postForm_template.php) :
                if ($_GET['action'] == 'postUpdating' && isset($_GET['postId'])) {
                    $formActionAttribute = 'index.php?action=postUpdated&postId=' . $post->id();
                    $titleValue = $post->title();

                    if ($post->category() == 'news') {
                        $isNewsCategoryChecked = 'checked';
                        $isNextReleasesCategoryChecked = NULL;
                    }
                    elseif ($post->category() == 'next_releases') {
                        $isNextReleasesCategoryChecked = 'checked';
                        $isNewsCategoryChecked = NULL;
                    }
                    
                    $postContent = $post->content();
                }
                else {
                    $formActionAttribute = 'index.php?action=postWritten';
                    $titleValue = NULL;
                    $isNewsCategoryChecked = NULL;
                    $isNextReleasesCategoryChecked = NULL;
                    $postContent = NULL;
                }

                require_once('view/templates/postsForm_template.php');
            }         
        ?>
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

<?php
    $scripts = ob_get_clean();
    require_once('templates/template.php'); 
?>




