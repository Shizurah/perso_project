<?php

class PostsManager {

    private $_db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    public function addPost($title, $category, $content) {
        $req = $this->_db->prepare('INSERT INTO posts(title, category, content, postDate) VALUES(:title, :category, :content, NOW())');

        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);
        // $req->bindParam('poster', $poster, PDO::PARAM_STR);
        $req->execute();

        return $this->_db->lastInsertId();
    }

    public function getPostsList() {

    }

    public function getPost($id) {
        $req = $this->_db->prepare('SELECT id, title, category, content, DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr FROM posts WHERE id = :id');

        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch();
        return new Post($data);
    }

    public function updatePost() {

    }

    public function deletePost() {

    }
}