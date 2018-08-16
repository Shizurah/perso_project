<?php

class Comment {

    private $_id;
    private $_content;
    private $_comment_date_fr;
    private $_post_id;
    private $_author;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {

        foreach($data as $key => $value) {

            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //getters :
    public function id() {
        return $this->_id;
    }

    public function content() {
        return $this->_content;
    }

    public function comment_date_fr() {
        return $this->_comment_date_fr;
    }

    public function post_id() {
        return $this->_post_id;
    }

    public function author() {
        return $this->_author;
    }

    //setters :
    public function setId($id) {
        $id = (int) $id;

        if (is_int($id)) {
            $this->_id = $id;
        }
    }

    public function setContent($content) {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setComment_date_fr($commentDate) {
        $this->_comment_date_fr = $commentDate;
    }

    public function setPost_id($postId) {
        $postId = (int) $postId;

        if (is_int($postId)) {
            $this->_post_id = $postId;
        }
    }

    public function setAuthor($userPseudo) {
        if (is_string($userPseudo)) {
            $this->_author = $userPseudo;
        }
    }
}