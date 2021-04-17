<?php

class LoginBD extends Login {

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getStatutConnexion($login, $motdepasse) {
        try {
            $this->_db->beginTransaction();
            $query = "select * from client where login=:login and motdepasse=:motdepasse";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':login', $login);
            $resultset->bindValue(':motdepasse',md5($motdepasse)); //mot de passe crypté
            $resultset->execute();
            $data = $resultset->fetch();
            if (!empty($data)) {
                $_array[0] = new Login($data);
            } else {
                $_array = null;
            }
            $this->_db->commit();

        } catch (PDOException $e) {
            print $e->getMessage();
            $_array = null;
        }
        return $_array;
    }

}
