<?php


abstract class Manager {
    
    protected $_db;


    public function delete($id, $table, $msg) { 
        $req = $this->_db->prepare("DELETE FROM $table WHERE id = :id");

        if ($this->exists($id, $table)) {
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();
        }
        else {
            throw new Exception($msg);
        }
    }


    public function exists($id, $table) { 
        $req = $this->_db->prepare("SELECT id FROM $table WHERE id = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch();

        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }


    public function count($table) {
        $req = $this->_db->query("SELECT COUNT(*) AS $table FROM $table");
        $data = $req->fetch();
        $nbOfUsers = $data[$table];
        
        return $nbOfUsers;
    }
    
}