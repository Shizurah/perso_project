<?php

function addComment($content, $postId, $userId) {
    
    $commentsManager = new CommentsManager();
    $commentsManager->addComment($content, $postId, $userId);
    onePostPage($postId);
}