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
            require('asideForAdministration_template.php'); 

            if (isset($_GET['action']) && $_GET['action'] == 'postWritten') {
            echo 'Votre article a bien été publié ! <a href="index.php?action=post_and_comments&postId=' . $newPostId . '">Voir l\'article</a>';
            }
        ?>


        <form action="index.php?action=postWritten" method="post">
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

            <!-- <p>
                Affiche de l'article : <br/>
                <input type="hidden" name="max-file-size" value="204800"> 
                <input type="file" name="avatar">
            </p> -->

            <textarea name="postContent" id="postContent" cols="30" rows="10"></textarea>

            <input type="submit" value="Publier">
        </form>

    </body>

</html>