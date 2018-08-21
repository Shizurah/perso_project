<?php

class CommentsManager {

    private $_db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    public function addComment($content, $postId, $userPseudo) {
        $req = $this->_db->prepare('INSERT INTO comments(content, comment_date, post_id, author) VALUES(:content, NOW(), :postId, :author)');

        $req->bindParam('content', $content, PDO::PARAM_STR);
        $req->bindParam('postId', $postId, PDO::PARAM_INT);
        $req->bindParam('author', $userPseudo, PDO::PARAM_STR);
        $req->execute();
    }

    public function getCommentsList($postId) {
        $req = $this->_db->prepare('SELECT id, content, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date_fr, post_id, author 
                                    FROM comments WHERE post_id = :postId ORDER BY comment_date DESC');

        $req->bindParam('postId', $postId, PDO::PARAM_INT);
        $req->execute();

        $commentsList = [];

        while ($data = $req->fetch()) {
            $commentsList[] = new Comment($data);
        }

        return $commentsList;
    }

    public function getOneComment($id) {
        $req = $this->_db->prepare('SELECT content FROM comments WHERE id = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch();
        return new Comment($data);
    }

    public function updateComment($id, $content) {
        $req = $this->_db->prepare('UPDATE comments SET content = :content WHERE id = :id');

        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->bindParam('content', $content, PDO::PARAM_STR);
        $req->execute();
    }

    public function deleteComment($id) {
        $req = $this->_db->prepare('DELETE FROM comments WHERE id = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}