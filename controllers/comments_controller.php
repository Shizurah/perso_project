<?php

function addComment($content, $postId, $userPseudo) {
    $commentsManager = new CommentsManager();
    $commentsManager->addComment($content, $postId, $userPseudo);

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
}

function deleteComment($id) {
    $commentsManager = new CommentsManager();
    $commentsManager->deleteComment($id);
}

function deleteCommentsRelatedToAPost($postId) {
    $commentsManager = new CommentsManager();
    $commentsManager->deleteComments($postId);
}

// function getAllComments($postId) {
//     $commentsManager = new CommentsManager();
//     $comments = $commentsManager->getCommentsList($postId);
//     return $comments;
// }