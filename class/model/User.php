<?php


class User {

    private $_id;
    private $_pseudo;
    private $_pass;
    private $_email;
    private $_avatar;
    private $_tvShows;
    private $_userStatus;

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

    public function pseudo() {
        return $this->_pseudo;
    }

    public function email() {
        return $this->_email;
    }

    public function avatar() {
        return $this->_avatar;
    }

    public function tvShows() {
        return $this->_tvShows;
    }

    public function userStatus() {
        return $this->_userStatus;
    }

    //setters :
    public function setId($id) {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setPseudo($pseudo) {
        if (is_string($pseudo)) {
            $this->_pseudo = $pseudo;
        }
    }

    public function setEmail($email) {
        if (is_string($email)) {
            $this->_email = $email;
        }
    }

    public function setAvatar($avatar) {
        if (is_string($avatar)) {
            $this->_avatar = $avatar;
        }
    }

    public function setTvShows($tvShows) {

    }

    public function setUserStatus($userStatus) {
        if (is_string($userStatus)) {
            if ($userStatus == 'member' || $userStatus == 'admin') {
                $this->_userStatus = $userStatus;
            }
        }
    }
}