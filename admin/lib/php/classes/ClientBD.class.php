<?php

class ClientBD extends Client
{

    private $_db; // recevoir la valeur de $cnx lors de la connexion à la bd dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    { //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }



    public function setClient($id_client,$nom_client, $prenom_client, $adresse, $numero, $telephone, $email, $motdepasse, $login)
    {
        try {
            $this->_db-> beginTransaction();
            $query = "insert into client (id_client,nom_client,prenom_client,adresse,numero,telephone,email,motdepasse,login) values (NEXTVAL('seq_sans_serial'),:nom_client,:prenom_client,:adresse,:numero,:telephone,:email,:motdepasse,:login) ";
            $_resultset = $this->_db->prepare($query);
            $_resultset-> bindValue(':nom_client', $nom_client);
            $_resultset-> bindValue(':prenom_client', $prenom_client);
            $_resultset-> bindValue(':adresse', $adresse);
            $_resultset-> bindValue(':numero', $numero);
            $_resultset-> bindValue(':telephone', $telephone);
            $_resultset-> bindValue(':email', $email);
            $_resultset->bindValue(':motdepasse', md5($motdepasse)); //md5= password crypté
            $_resultset->bindValue(':login', $login);
            $_resultset->execute();
            $this->_db->commit();


        } catch (PDOException $e) {
            print "Echec de l'enregistrement " . $e->getMessage();

        }
    }

    public function getClient($login,$motdepasse)
    {

        try{
            $this->_db->beginTransaction();
            $query= "select * from client where login='$login' and motdepasse='$motdepasse'";
            $_resultset = $this->_db->query($query);
            $_resultset->execute();
            $this->_db->commit();
            $data = $_resultset->fetch();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Client($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }

            if (!empty($_data)) {
                return $_data;
            } else {
                return null; //Lorsque la requête n'a produit aucun résultat
            }
        } catch (PDOException $e) {
            print $e->getMessage();
            $_array = null;
        }

    }

    public function getAllClients() {

        try {
            $this->_db->beginTransaction();
            $query = "select * from client order by nom_client";
            $_resultset = $this->_db->query($query);
            $this->_db->commit();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Client($data);
            }
            //var_dump($_array);

            if (!empty($_array)) {
                return $_array;
            } else {
                return null; //Lorsque la requête n'a produit aucun résultat
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }


    public function getClientbyId($id_client)
    {

        try {
            $this->_db->beginTransaction();
            $query = "select * from client where  id_client=:id_client";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_client',$id_client);
            $resultset->execute();
            $data = $resultset->fetch();
            if (!empty($data)) {
                $_array[0] = new Client($data);
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
