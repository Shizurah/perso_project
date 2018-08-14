<?php

class Post {

    private $_id;
    private $_title;
    private $_category;
    private $_content;
    private $_postDate_fr;

    public function __construct(array $data) {
        $this->hydrate($data);
    }
    
    public function hydrate (array $data) {
        foreach($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // getters :
    public function id() {
        return $this->_id;
    }

    public function title() {
        return $this->_title;
    }

    public function category() {
        return $this->_category;
    }

    public function content() {
        return $this->_content;
    }

    public function postDate_fr() {
        return $this->_postDate_fr;
    }

    // setters :
    public function setId($id) {
        $id = (int) $id;

        if (is_int($id) && $id > 0) {
            $this->_id = $id;
        }
    }

    public function setTitle($title) {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setCategory($category) {
        $valid_categories = array('news', 'we_love');

        if (is_string($category)) {
            if (in_array($category, $valid_categories)) {
                $this->_category = $category;
            }
        }
    }

    public function setContent($content) {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setPostDate_fr($postDate) {
        if (is_string($postDate)) {
            $this->_postDate_fr = $postDate;
        }
    }
}