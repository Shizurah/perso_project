<?php

class CommentsManager {

    private $_db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }


    public function addComment($content, $postId, $userId) {
        $req = $this->_db->prepare('INSERT INTO comments(content, comment_date, post_id, author_id) VALUES(:content, NOW(), :postId, :authorId)');

        $req->bindParam('content', $content, PDO::PARAM_STR);
        $req->bindParam('postId', $postId, PDO::PARAM_INT);
        $req->bindParam('authorId', $userId, PDO::PARAM_STR);

        $req->execute();

        return $this->_db->lastInsertId();
    }

    
    public function getCommentsToDisplay($postId, $firstComment, $commentsPerPage) {
        $req = $this->_db->prepare('SELECT comments.id AS comment_id, post_id, author_id, content as comment_content,
                                           DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr,
                                           pseudo AS author_pseudo, avatar AS author_avatar
                                    FROM comments
                                    INNER JOIN users
                                    ON comments.author_id = users.id
                                    WHERE post_id = :postId
                                    ORDER BY comment_date DESC
                                    LIMIT :firstComment, :commentsPerPage');

        $req->bindParam('postId', $postId, PDO::PARAM_INT);
        $req->bindParam('firstComment', $firstComment, PDO::PARAM_INT);
        $req->bindParam('commentsPerPage', $commentsPerPage, PDO::PARAM_INT);

        $req->execute();

        $commentsAndUsersInfos = [];

        while ($data = $req->fetch()) {
            $commentsAndUsersInfos[] = new CommentAndUserInfos($data);
        }

        return $commentsAndUsersInfos;
    }


    public function getOneComment($id) {
        $req = $this->_db->prepare('SELECT id, content, author_id, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr 
                                    FROM comments 
                                    WHERE id = :id');
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


    // Supprimer un commentaire :
    public function deleteComment($id) {
        $req = $this->_db->prepare('DELETE FROM comments WHERE id = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);

        $req->execute();
    }

    // Supprimer les commentaires associés à un article lors de sa suppression :
    public function deleteComments($postId) {
        $req = $this->_db->prepare('DELETE FROM comments WHERE post_id = :postId');
        $req->bindParam('postId', $postId, PDO::PARAM_INT);

        $req->execute();
    }


    public function reportComment($id) {
        $req = $this->_db->prepare('UPDATE comments SET reports = reports + 1 WHERE id = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);

        $req->execute();
    }


    public function getReportedComments() {
        $reports = 1;

        $req = $this->_db->prepare('SELECT id, author_id, content, reports, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date_fr 
                                    FROM comments WHERE reports >= :reports 
                                    ORDER BY reports DESC');

        $req->bindParam('reports', $reports, PDO::PARAM_INT);
        $req->execute();

        $reportedComments = [];

        while ($data = $req->fetch()) {
            $reportedComments[] = new Comment($data);
        }

        return $reportedComments;
    }


    public function countReportedComments() {
        $req = $this->_db->query('SELECT COUNT(*) AS reportedComments FROM comments WHERE reports >= 1');
        $data = $req->fetch();
        $nbOfReportedComments = $data['reportedComments'];
        
        return $nbOfReportedComments;
    }


    public function ignoreReportedComment($id) {
        $req = $this->_db->prepare('UPDATE comments SET reports = 0 WHERE id = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
    }


    public function countNumberOfComments($postId) {
        $req = $this->_db->prepare('SELECT COUNT(*) AS numberOfComments FROM comments WHERE post_id = :postId');
        $req->bindParam('postId', $postId, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch();
        $nbOfComments = $data['numberOfComments'];
        return $nbOfComments;
    }
}