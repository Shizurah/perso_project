<?php

function addComment($content, $postId, $userPseudo) {
    $commentsManager = new CommentsManager();
    $commentsManager->addComment($content, $postId, $userPseudo);

    header('Location:index.php?action=post_and_comments&postId=' . $postId);
    exit;
}

// function getAllComments($postId) {
//     $commentsManager = new CommentsManager();
//     $comments = $commentsManager->getCommentsList($postId);
//     return $comments;
// }