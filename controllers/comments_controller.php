<?php

function addComment($content, $postId, $userId) {
    $content = $content;

    $commentsManager = new CommentsManager();
    $lastCommentId = $commentsManager->addComment(htmlspecialchars($content), $postId, $userId);

    $comment = $commentsManager->getOneComment($lastCommentId);

    $response = '';
    $commentId = $comment->id();
    $commentContent = $comment->content();
    $commentDate = $comment->comment_date_fr();
    $commentAuthorId = $comment->author_id();
    $authorAvatar = $_SESSION['avatar'];
    $authorPseudo = $_SESSION['pseudo'];

    ob_start();
        require_once('view/templates/commentsResponse_template.php');
    $response = ob_get_clean();

    echo $response;     
}


function getCommentToUpdate($id) {
    $commentsManager = new CommentsManager();
    $comment = $commentsManager->getOneComment($id);
    return $comment;
}


function updateComment($id, $content) {
    $commentsManager = new CommentsManager();
    $commentsManager->updateComment($id, $content);

    echo '<span id="' .$id. '">' .$content. '</span>';
}


function deleteComment($id) {

    if (isset($_SESSION['id'])) {
        $commentsManager = new CommentsManager();
        $comment = $commentsManager->getOneComment($id);

        if ($_SESSION['userStatus'] == 'admin' && $_SESSION['id'] != $comment->author_id()) {
            echo '<p class="success-msg">Le commentaire a bien été supprimé</p>';
        }
        else {
            echo '<p class="success-msg">Votre commentaire a bien été supprimé !</p>';
        }

        $commentsManager->deleteComment($id);
    }
}


function deleteCommentsRelatedToAPost($postId) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager();
        $commentsManager->deleteComments($postId);
    }   
}


function reportComment($id) {
    
    if (isset($_SESSION['userStatus'])) {
        $commentsManager = new CommentsManager(); 
        $commentsManager->reportComment($id);

        echo '<p class="success-msg-for-reporting-comment">Le commentaire a bien été signalé</p>';
    }
}


function getReportedComments() {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager(); 
        $reportedComments = $commentsManager->getReportedComments();

        require_once('view/reportedComments_view.php');
    }
}


function ignoreReportedComment($id) {

    if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {
        $commentsManager = new CommentsManager();
        $commentsManager->ignoreReportedComment($id);

        echo '<p class="success-msg">Le commentaire a bien été ignoré</p>';
    }
}


// PAGINATION :
function displayComments($postId, $page, $commentsPerPage) {
    header('Content-type: application/json');

    $commentsManager = new CommentsManager();
    $nbOfComments = $commentsManager->countNumberOfComments($postId);

    $comments = '';
    $nbOfPages = ceil($nbOfComments / $commentsPerPage);
    $firstCommentToDisplay = ($page - 1) * $commentsPerPage;

    $commentsAndUsersInfos = $commentsManager->getCommentsToDisplay($postId, $firstCommentToDisplay, $commentsPerPage);

    foreach ($commentsAndUsersInfos as $comment) {

        $response = '';
        $commentId = $comment->comment_id();
        $commentContent = $comment->comment_content();
        $commentDate = $comment->comment_date_fr();
        $commentAuthorId = $comment->author_id();
        $authorAvatar = $comment->author_avatar();
        $authorPseudo = $comment->author_pseudo();

        ob_start();
            require('view/templates/commentsResponse_template.php');
        $response = ob_get_clean();

        $comments .= $response;
    }

    $dataBack = array('nbOfPages' => $nbOfPages, 'commentsList' => $comments);
    $dataBack = json_encode($dataBack);

    echo $dataBack;  
}