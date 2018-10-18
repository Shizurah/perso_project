<?php


class UsersManager extends Manager {

    public function __construct() {
        $this->_db = DbManager::dbConnect();
    }


    public function addUser($pseudo, $pass, $email) {
        $req = $this->_db->prepare('INSERT INTO users(pseudo, pass, email) 
                                    VALUES(:pseudo, :pass, :email)');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('pass', $pass, PDO::PARAM_STR);
        $req->bindValue('email', $email, PDO::PARAM_STR);

        $req->execute();
    }


    public function getPseudo($formPseudo) { 
        $req = $this->_db->prepare('SELECT pseudo 
                                    FROM users 
                                    WHERE pseudo = :pseudo');

        $req->bindValue('pseudo', $formPseudo, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch();
        return $data['pseudo'];
    }


    public function getEmail($formEmail) {
        $req = $this->_db->prepare('SELECT email 
                                    FROM users 
                                    WHERE email = :email');

        $req->bindParam('email', $formEmail, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch();
        return  $data['email'];
    }


    public function getPass($pseudo) { 
        $req = $this->_db->prepare('SELECT pass 
                                    FROM users 
                                    WHERE pseudo = :pseudo');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();

        $bddPass = $req->fetch();
        return $bddPass['pass'];
    }


    public function getUser($pseudo, $pass) {
        $req = $this->_db->prepare('SELECT id, pseudo, email, avatar, userStatus 
                                    FROM users 
                                    WHERE pseudo = :pseudo 
                                    AND pass = :pass');

        $req->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue('pass', $pass, PDO::PARAM_STR);

        $req->execute();

        $infosUser = $req->fetch();

        if (!empty($infosUser)) {
            return new User($infosUser);
        } 
    }


    public function updateAvatar($id, $newAvatar) {
        $req = $this->_db->prepare('UPDATE users 
                                    SET avatar = :avatar 
                                    WHERE id = :id');

        $req->bindValue('avatar', $newAvatar, PDO::PARAM_STR);
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
    }


    // public function addControlKey($pseudo, $key) {
    //     $req = $this->_db->prepare('UPDATE users 
    //                                 SET controlKey = :controlKey 
    //                                 WHERE pseudo = :pseudo');

    //     $req->bindParam('controlKey', $key, PDO::PARAM_STR);
    //     $req->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
    //     $req->execute();
    // }

}

