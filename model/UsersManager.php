<?php

class UsersManager {

    private $db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    public function addUser($pseudo, $pass, $email) {
        $req = $this->_db->prepare('INSERT INTO users(pseudo, pass, email) VALUES(:pseudo, :pass, :email)');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('pass', $pass, PDO::PARAM_STR);
        $req->bindValue('email', $email, PDO::PARAM_STR);

        $req->execute();
    }

    public function getUser($id, $pseudo, $pass, $email, $avatar, $tvShows, $status) {

    }

    public function update() {

    }
}