<?php

// use \eloise\projet5\CommentsManager;

function addComment($content, $postId, $userId) {
    $content = nl2br($content);

    $commentsManager = new CommentsManager();
    $commentsManager->addComment($content, $postId, $userId);

    header('Location:index.php?action=post_and_comments&postId=' . $postId);
    exit;
}


function getCommentToUpdate($commentId) {
    $commentsManager = new CommentsManager();
    $comment = $commentsManager->getOneComment($commentId);
    return $comment;
}


function updateComment($id, $content) {
    $commentsManager = new CommentsManager();
    $commentsManager->updateComment($id, $content);

    echo '<span id="' .$id. '">' .$content. '</span>';
}


function deleteComment($id) {
    $commentsManager = new CommentsManager();
    $commentsManager->deleteComment($id);
}


function deleteCommentsRelatedToAPost($postId) {
    $commentsManager = new CommentsManager();
    $commentsManager->deleteComments($postId);
}


function reportComment($id) {
    $commentsManager = new CommentsManager(); 
    $commentsManager->reportComment($id);
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
    }
}
