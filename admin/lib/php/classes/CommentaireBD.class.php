<?php
class CommentaireBD extends Commentaire
{

    private $_db; // recevoir la valeur de $cnx lors de la connexion à la bd dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    { //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }



    public function setCommentaire($id_commentaire,$commentaire, $id_client, $id_produit, $id_commande, $note)
    {
        try {
            $this->_db-> beginTransaction();
            $query = "insert into commentaire (id_commentaire,commentaire,id_client,id_produit, id_commande, note) values (NEXTVAL('seq_sans_serial'),:commentaire,:id_client,:id_produit,:id_commande,:note) ";
            $_resultset = $this->_db->prepare($query);
            $_resultset-> bindValue(':commentaire', $commentaire);
            $_resultset-> bindValue(':id_client', $id_client);
            $_resultset-> bindValue(':id_produit', $id_produit);
            $_resultset-> bindValue(':id_commande', $id_commande);
            $_resultset-> bindValue(':note', $note);
            $_resultset->execute();
            $this->_db->commit();


        } catch (PDOException $e) {
            print "Echec de l'enregistrement " . $e->getMessage();

        }
    }


    public function getAllCommentaire() {

        try {
            $this->_db->beginTransaction();
            $query = "select * from commentaire order by id_client";
            $_resultset = $this->_db->query($query);
            $this->_db->commit();
            while ($data = $_resultset->fetch()) {
                $_array[] = new Client($data);
            }
            //var_dump($_array);

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
