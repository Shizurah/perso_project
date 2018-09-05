<form action="<?= $formActionAttribute ?>" method="post" enctype="multipart/form-data">
    <p>
        <label for="postTitle">Titre : </label>
        <input type="text" name="postTitle" id="postTitle" value="<?= $titleValue ?>" required>
    </p>

    <p>
        <input type="hidden" name="max-file-size" value="204800">

        <label for="postPoster">Affiche : </label>
        <input type="file" name="postPoster" id="postPoster">
    </p>
    
    <p>
        Catégorie : <br/>
        <label for="news">Actus</label>
        <input type="radio" name="postCategory" value="news" id="news" <?= $isNewsCategoryChecked ?>>
        <br/>
        <label for="next-releases">Prochaines sorties</label>
        <input type="radio" name="postCategory" value="next-releases" id="next-releases" <?= $isNextReleasesCategoryChecked ?>>
    </p>

    <textarea name="postContent" id="postContent" cols="30" rows="10"><?= $postContent ?></textarea>

    <input type="submit" value="Publier">
</form>