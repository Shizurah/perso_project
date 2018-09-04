<form action="<?= $formActionAttribute ?>" method="post">
    <p>
        <label for="postTitle">Titre de l'article : </label>
        <input type="text" name="postTitle" id="postTitle" value="<?= $titleValue ?>" required>
    </p>
    
    <p>
        Catégorie de l'article : <br/>
        <label for="news">Actus</label>
        <input type="radio" name="postCategory" value="news" id="news" <?= $isNewsCategoryChecked ?>>
        <br/>
        <label for="next-releases">Prochaines sorties</label>
        <input type="radio" name="postCategory" value="next-releases" id="next-releases" <?= $isNextReleasesCategoryChecked ?>>
    </p>

    <textarea name="postContent" id="postContent" cols="30" rows="10"><?= $postContent ?></textarea>

    <input type="submit" value="Publier">
</form>