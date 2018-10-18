<?php


class PostsManager extends Manager {

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    
    public function addPost($poster, $title, $category, $content) {
        $req = $this->_db->prepare('INSERT INTO posts(poster, title, category, content, postDate) 
                                    VALUES(:poster, :title, :category, :content, NOW())');

        $req->bindParam('poster', $poster, PDO::PARAM_STR);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);
        
        $req->execute();

        return $this->_db->lastInsertId();
    }


    public function getAllPostsList() {
        $req = $this->_db->prepare('SELECT id, title, category, content, 
                                    DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr 
                                    FROM posts 
                                    ORDER BY postDate DESC');
        $req->execute();

        $posts = [];

        while ($data = $req->fetch()) {
            $posts[] = new Post($data);
        }

        return $posts;
    }


    public function getNewsPostsList($firstPost, $postsPerPage) {
        $category = 'news';

        $req = $this->_db->prepare('SELECT id, poster, title, SUBSTR(content, 1, 190) AS content, 
                                    DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr 
                                    FROM posts 
                                    WHERE category = :category 
                                    ORDER BY postDate DESC
                                    LIMIT :firstPost, :postsPerPage');

        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->bindParam('firstPost', $firstPost, PDO::PARAM_INT);
        $req->bindParam('postsPerPage', $postsPerPage, PDO::PARAM_INT);

        $req->execute();

        $newsPosts = [];

        while ($data = $req->fetch()) {
            $newsPosts[] = new Post($data);
        }

        return $newsPosts;
    }


    public function getNextReleasesPostsList() {
        $category = 'next_releases';
        $req = $this->_db->prepare('SELECT id, poster, title, content, 
                                    DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr 
                                    FROM posts 
                                    WHERE category = :category 
                                    ORDER BY postDate DESC');

        $req->bindParam('category', $category, PDO::PARAM_STR);
        $req->execute();

        $nextReleasesPosts = [];

        while ($data = $req->fetch()) {
            $nextReleasesPosts[] = new Post($data);
        }

        return $nextReleasesPosts;
    }


    public function getPost($id) {
        $req = $this->_db->prepare('SELECT id, poster, title, category, content, 
                                    DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDate_fr 
                                    FROM posts 
                                    WHERE id = :id');

        if ($this->exists($id, 'posts')) {
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch();
            
            return new Post($data);
        }
        else {
            throw new Exception('Cet article n\'existe pas');
        }
    }


    public function updatePost($id, $title, $category, $content) {
        $req = $this->_db->prepare('UPDATE posts 
                                    SET title = :title, category = :category, content = :content 
                                    WHERE id = :id');

        if ($this->exists($id, 'posts')) {
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->bindParam('title', $title, PDO::PARAM_STR);
            $req->bindParam('category', $category, PDO::PARAM_STR);
            $req->bindParam('content', $content, PDO::PARAM_STR);
            
            $req->execute();
        }
        else {
            throw new Exception('Cet article n\'existe pas');
        }
        
    }
    
}