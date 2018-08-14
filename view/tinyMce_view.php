<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>

        <title>Rédiger article</title>
        <!-- BOOTSTRAP -->
        <!-- <link rel="stylesheet" href=" <?= $href ?>">  -->

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
                    echo 'Votre article a bien été publié ! <a href="index.php?action=post_and_comments&postId=' . $newPostId . '">Voir l\'article</a>';
                }
                elseif ($_GET['action'] == 'postUpdated' && isset($_GET['postId'])) {
                    echo 'Votre article a bien été modifié ! <a href="index.php?action=post_and_comments&postId=' . $_GET['postId'] . '">Voir l\'article</a>';
                } 


                // FORMULAIRE :
                if ($_GET['action'] == 'postUpdating' && isset($_GET['postId'])) {
                    $formActionAttribute = 'index.php?action=postUpdated&postId=' . $post->id();
                    $titleValue = $post->title();

                    if ($post->category() == 'news') {
                        $isNewsChecked = 'checked';
                        $isWeLoveChecked = NULL;
                    }
                    elseif ($post->category() == 'we_love') {
                        $isWeLoveChecked = 'checked';
                        $isNewsChecked = NULL;
                    }
                    
                    $postContent = $post->content();
                }
                else {
                    $formActionAttribute = 'index.php?action=postWritten';
                    $titleValue = NULL;
                    $isNewsChecked = NULL;
                    $isWeLoveChecked = NULL;
                    $postContent = NULL;
                }

                require_once('postsForm_template.php');
            }         
        ?>

        
        <!-- <form action="index.php?action=postWritten" method="post">
            <p>
                <label for="postTitle">Titre de l'article : </label>
                <input type="text" name="postTitle" id="postTitle" required>
            </p>
           
            <p>
                Catégorie de l'article : <br/>
                <label for="news">Actus</label>
                <input type="radio" name="postCategory" value="news" id="news">
                <br/>
                <label for="news">On a aimé</label>
                <input type="radio" name="postCategory" value="weLoved" id="weLoved">
            </p>

            <textarea name="postContent" id="postContent" cols="30" rows="10"></textarea>

            <input type="submit" value="Publier">
        </form> -->

    </body>

</html>