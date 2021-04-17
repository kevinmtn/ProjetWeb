<?php

class CommandeBD extends Commande
{

    private $_db; // recevoir la valeur de $cnx lors de la connexion à la bd dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    { //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }


    public function setCommande($id_commande, $id_client, $id_produit, $date_livraison, $date_commande)
    {
        try {
            $this->_db->beginTransaction();
            $query = "insert into commande (id_commande,id_client,id_produit,date_livraison,date_commande) values (NEXTVAL('seq_sans_serial'),:id_client,:id_produit,:date_livraison,:date_commande) ";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_client', $id_client);
            $resultset->bindValue(':id_produit', $id_produit);
            $resultset->bindValue(':date_livraison', $date_livraison);
            $resultset->bindValue(':date_commande', $date_commande);

            $resultset->execute();
            $this->_db->commit();


        } catch (PDOException $e) {
            print "Echec de l'enregistrement " . $e->getMessage();

        }
    }


    public function getCommande($id_client) //recherche des commandes pour un id_client
    {
        try{
            $this->_db->beginTransaction();
            $query= "select * from commande where id_client='$id_client'";
            $_resultset = $this->_db->query($query);
            $_resultset->execute();
            $this->_db->commit();
            $data = $_resultset->fetch();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Commande($data);
            }
            //var_dump($_array);
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


    public function getAllCommande() { //recherche de toutes les commandes

        try {
            $this->_db->beginTransaction();
            $query = "select * from commande order by id_commande";
            $_resultset = $this->_db->query($query);
            $this->_db->commit();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Commande($data);
            }

            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}