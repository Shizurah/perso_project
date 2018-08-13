<?php

class UsersManager {

    private $_db;

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }

    public function addUser($pseudo, $pass, $email, $key) {
        $req = $this->_db->prepare('INSERT INTO users(pseudo, pass, email, controlKey) VALUES(:pseudo, :pass, :email, :controlKey)');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('pass', $pass, PDO::PARAM_STR);
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->bindValue('controlKey', $key, PDO::PARAM_STR);

        $req->execute();
    }

    public function getPseudo($formPseudo) { // renommer fonction en 'doesPseudoExist' ?
        $req = $this->_db->prepare('SELECT pseudo FROM users WHERE pseudo = :pseudo');

        $req->bindValue('pseudo', $formPseudo, PDO::PARAM_STR);
        $req->execute();

        $bddPseudo = $req->fetch();
        return $bddPseudo['pseudo'];
    }

    public function getPass($pseudo) { // renommer fonction en 'doesPassExist' ?
        $req = $this->_db->prepare('SELECT pass FROM users WHERE pseudo = :pseudo');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();

        $bddPass = $req->fetch();
        return $bddPass['pass'];
    }

    public function getUser($pseudo, $pass) {
        $req = $this->_db->prepare('SELECT id, pseudo, email, avatar, userStatus FROM users WHERE pseudo = :pseudo AND pass = :pass');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('pass', $pass, PDO::PARAM_STR);

        $req->execute();

        $infosUser = $req->fetch();

        if (!empty($infosUser)) {
            return new User($infosUser);
        } 
    }

    public function updateAvatar($id, $newAvatar) {
        $req = $this->_db->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');

        $req->bindValue('avatar', $newAvatar, PDO::PARAM_STR);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function addControlKey($pseudo, $key) {
        $req = $this->_db->prepare('UPDATE users SET controlKey = :controlKey WHERE pseudo = :pseudo');

        $req->bindParam('controlKey', $key, PDO::PARAM_STR);
        $req->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
    }

}

