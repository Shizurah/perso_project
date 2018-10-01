<form id="comment-form" action="index.php?action=commentAdded&amp;postId=<?= $_GET['postId']; ?>" method="post">
<hr/>

    <div id="comment-form-fields-container">
      
        <div id="comment-form-author-and-textarea">
            <div>
                <img src="public/members/avatars/<?= $_SESSION['avatar'] ?>" alt="avatar">
            </div>
            
            <textarea name="comment-text" id="comment-text" placeholder="Votre commentaire..." cols="40" rows="2"></textarea>  
        </div>
        
        <div id="comment-form-submit-btn">
            <input type="submit" value="Publier">
        </div>
        
   </div>

</form>