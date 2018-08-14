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

    public function getAllPostsList() {
        $req = $this->_db->prepare('SELECT id, title, category, content, DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr FROM posts ORDER BY postDate DESC');
        $req->execute();

        $posts = [];

        while ($data = $req->fetch()) {
            $posts[] = new Post($data);
        }

        return $posts;
    }

    public function getNewsPostsList() {
        $category = 'news';
        $content = 'content';

        $req = $this->_db->prepare('SELECT id, title, SUBSTR(content, 1, 780) AS content, DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr FROM posts WHERE category = :category ORDER BY postDate DESC');

        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->execute();

        $newsPosts = [];

        while ($data = $req->fetch()) {
            $newsPosts[] = new Post($data);
        }

        return $newsPosts;
    }

    public function getWeLovePostsList() {
        $category = 'we_love';
        $req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr FROM posts WHERE category = :category ORDER BY postDate DESC');

        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->execute();

        $weLovePosts = [];

        while ($data = $req->fetch()) {
            $weLovePosts[] = new Post($data);
        }

        return $weLovePosts;
    }

    public function getPost($id) {
        $req = $this->_db->prepare('SELECT id, title, category, content, DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr FROM posts WHERE id = :id');

        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch();
        return new Post($data);
    }

    public function updatePost($id, $title, $category, $content) {
        $req = $this->_db->prepare('UPDATE posts SET title = :title, category = :category, content = :content WHERE id = :id');

        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);
        
        $req->execute();
    }

    public function deletePost() {

    }
}