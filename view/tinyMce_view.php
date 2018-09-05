<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>

        <title>Rédiger article</title>
        <!-- BOOTSTRAP -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- TinyMCE : -->
        <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <script>
            tinymce.init({
                selector: '#postContent',
                plugins : 'image, link'
            });
        </script>
    </head>

    <body>
        <div class="container">
            <?php 
                $h2Header = '';
                require('header_template.php');

                // echo '<h2>Gestion du site</h2>';
                require('asideForAdministration_template.php'); 
            ?>

            <br/>

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

                    require_once('postsForm_template.php');
                }         
            ?>
        </div>

        <script src="assets/js/file.js"></script>
    </body>

</html>