<?php

class CommentsManager {

    private $_db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    public function addComment($content, $postId, $memberId) {
        $req = $this->_db->prepare('INSERT INTO comments(content, comment_date, post_id, member_id) VALUES(:content, NOW(), :postId, :memberId)');

        $req->bindParam('content', $content, PDO::PARAM_STR);
        $req->bindParam('postId', $postId, PDO::PARAM_INT);
        $req->bindParam('memberId', $memberId, PDO::PARAM_STR);
        $req->execute();
    }
}