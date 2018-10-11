<form id="<?= $formId ?>" action="<?= $formActionAttribute ?>" method="post" enctype="multipart/form-data">
    <p>
        <label for="postTitle"><span>Titre</span></label><br/>
        <input type="text" name="postTitle" id="postTitle" value="<?= $titleValue ?>" required>
    </p>

    <p>
        <input type="hidden" name="max-file-size" value="204800">

        <label for="postPoster">
            <span>
                Affiche 
            </span>
        </label>
        <?= $note ?>
        <br/>
        <input type="file" name="postPoster" id="postPoster">
    </p>
    
    <p>
        <span>Catégorie</span>
        <br/>
        <label for="news">Actus</label>
        <input type="radio" name="postCategory" value="news" id="news" <?= $isNewsCategoryChecked ?>>
        
        <label for="next_releases">Prochaines sorties</label>
        <input type="radio" name="postCategory" value="next_releases" id="next_releases" <?= $isNextReleasesCategoryChecked ?>>
    </p>

    <textarea name="postContent" id="postContent" cols="30" rows="10"><?= $postContent ?></textarea>

    <input type="submit" value="Publier">
</form>