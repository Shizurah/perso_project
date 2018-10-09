<?php


class CommentAndUserInfos {

    private $_comment_id;
    private $_post_id;
    private $_author_id;
    private $_author_pseudo;
    private $_author_avatar;
    private $_comment_content;
    private $_comment_date_fr;
    private $_reports;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {

        foreach ($data as $key => $value) {
            $method = 'set' .ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // getters :
    public function comment_id() {
        return $this->_comment_id;
    }

    public function post_id() {
        return $this->_post_id;
    }

    public function author_id() {
        return $this->_author_id;
    }

    public function author_pseudo() {
        return $this->_author_pseudo;
    }

    public function author_avatar() {
        return $this->_author_avatar;
    }

    public function comment_content() {
        return $this->_comment_content;
    }

    public function comment_date_fr() {
        return $this->_comment_date_fr;
    }

    public function reports() {
        return $this->_reports;
    }

    // setters :
    public function setComment_id($commentId) {
        $commentId = (int) $commentId;

        if (is_int($commentId) && $commentId > 0) {
            $this->_comment_id = $commentId;
        } 
    }

    public function setPost_id($postId) {
        $postId = (int) $postId;

        if (is_int($postId) && $postId > 0) {
            $this->_post_id = $postId;
        }
    }

    public function setAuthor_id($authorId) {
        $authorId = (int) $authorId;

        if (is_int($authorId) && $authorId > 0) {
            $this->_author_id = $authorId;
        }
    }

    public function setAuthor_pseudo($authorPseudo) {
        if (is_string($authorPseudo)) {
            $this->_author_pseudo = $authorPseudo;
        }
    }

    public function setAuthor_avatar($authorAvatar) {
        if (is_string($authorAvatar)) {
            $this->_author_avatar = $authorAvatar;
        }
    }

    public function setComment_content($commentContent) {
        if (is_string($commentContent)) {
            $this->_comment_content = $commentContent;
        }
    }

    public function setComment_date_fr($commentDate) {
        if (is_string($commentDate)) {
            $this->_comment_date_fr = $commentDate;
        }
    }

    public function setReports($reports) {
        $reports = (int) $reports;
        if ($reports >= 0) {
            $this->_reports = $reports;
        }
    }

}