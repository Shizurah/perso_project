<?php

class PostsManager {

    private $db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    public function addPost($title, $category, $content) {
        $req = $this->_db->prepare('INSERT INTO posts(title, category, content, datePost) VALUES(:title, :category, :content, NOW())');

        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);
        // $req->bindParam('poster', $poster, PDO::PARAM_STR);

        $req->execute();

        return $this->_db->lastInsertId();
    }

    public function getPostsList() {

    }

    public function getPost() {

    }

    public function updatePost() {

    }

    public function deletePost() {

    }
}