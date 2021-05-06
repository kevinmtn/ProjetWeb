<?php

class ProduitBD extends Produit
{

    private $_db; // recevoir la valeur de $cnx lors de la connexion à la bd dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    { //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }


    public function getAllProduit()
    {
        $query = "select * from vue_categorie3 order by id_cat";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while ($d = $_resultset->fetch()) {
            $_data[] = new Produit($d);
        }
        // var_dump($_data);
        return $_data;
    }

    public function getProduitsByCat($id_cat)
    {

        try {
            $query = "select * from vue_categorie3 where id_cat = :id_cat";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id_cat', $id_cat);
            $_resultset->execute();

            while ($d = $_resultset->fetch()) {

                $_data[] = new Produit($d);

            }

            return $_data;

        } catch (PDOException $e) {
            print "Echec de la requete" . $e->getMessage();

        }
    }


    public function setStock($stock, $id_produit)
    {
        try {
            $this->_db->beginTransaction();
            $query = "UPDATE produit SET stock ='$stock' WHERE id_produit='$id_produit'";
            $_resultset = $this->_db->query($query);
            $_resultset->execute();
            $this->_db->commit();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Produit($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }

            if (!empty($_data)) {
                return $_data;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function setPrix($prix, $id_produit)
    {
        try {
            $this->_db->beginTransaction();
            $query = "UPDATE produit SET prix ='$prix' WHERE id_produit='$id_produit'";
            $_resultset = $this->_db->query($query);
            $_resultset->execute();
            $this->_db->commit();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Produit($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }

            if (!empty($_data)) {
                return $_data;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function NewProduit($nom_produit, $photo, $prix, $stock, $description, $cat)
    {
        try {
            $this->_db->beginTransaction();
            $query = "insert into produit(id_produit, nom_produit, photo, prix, stock, description, id_cat) values (NEXTVAL('seq_sans_serial'),:nom_produit,:photo,:prix,:stock,:description,:id_cat) ";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':nom_produit', $nom_produit);
            $_resultset->bindValue(':photo', $photo);
            $_resultset->bindValue(':prix', $prix);
            $_resultset->bindValue(':stock', $stock);
            $_resultset->bindValue(':description', $description);
            $_resultset->bindValue(':id_cat', $cat);
            $_resultset->execute();
            $this->_db->commit();

        } catch (PDOException $e) {
            print $e->getMessage();
        }


    }

    public function getProduitbyId($id_produit)
    {

        try {
            $this->_db->beginTransaction();
            $query = "select * from produit where  id_produit=:id_produit";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_produit', $id_produit);
            $resultset->execute();
            $data = $resultset->fetch();
            if (!empty($data)) {
                $_array[0] = new Produit($data);
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

    public function suppression($id_produit)
    {
        try {
            $this->_db->beginTransaction();
            $query = "DELETE from produit WHERE id_produit=:id_produit";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_produit', $id_produit);
            $resultset->execute();
            $data = $resultset->fetch();
            if (!empty($data)) {
                $_array[0] = new Produit($data);
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