<?php

class AdminBD extends Admin
{

    private $_db; // recevoir la valeur de $cnx lors de la connexion à la bd dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    { //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }


    public function getAdmin($login, $password)
    {
        try {
            $this->_db->beginTransaction();
            $query = "select * from admin where login=:login and password=:password";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':login', $login);
            $resultset->bindValue(':password',($password));
            $resultset->execute();
            $data = $resultset->fetch();
            if (!empty($data)) {
                $_array[0] = new Admin($data);
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