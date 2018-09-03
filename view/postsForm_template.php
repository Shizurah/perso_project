<form action="<?= $formActionAttribute ?>" method="post">
    <p>
        <label for="postTitle">Titre de l'article : </label>
        <input type="text" name="postTitle" id="postTitle" value="<?= $titleValue ?>" required>
    </p>
    
    <p>
        Catégorie de l'article : <br/>
        <label for="news">Actus</label>
        <input type="radio" name="postCategory" value="news" id="news" <?= $isNewsChecked ?>>
        <br/>
        <label for="weLove">On a aimé</label>
        <input type="radio" name="postCategory" value="weLove" id="weLove" <?= $isWeLoveChecked ?>>
    </p>

    <textarea name="postContent" id="postContent" cols="30" rows="10"><?= $postContent ?></textarea>

    <input type="submit" value="Publier">
</form>