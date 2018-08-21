<form id="form" action="<?= $formActionAttribute ?>" method="post">
    <img src="public/members/avatars/<?= $_SESSION['avatar'] ?>" width="50" height="50" alt="avatar">

    <textarea name="comment-text" id="comment-text" placeholder="<?= $placeholderAttribute ?>" cols="40" rows="2" <?= $autofocus ?>><?= $textareaContent ?></textarea>
        
    <br/><br/>

    <input type="submit" value="Publier">
</form>