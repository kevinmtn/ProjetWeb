<?php

class ProduitBD extends Produit{

    private $_db; // recevoir la valeur de $cnx lors de la connexion à la bd dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx){ //$cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }


    public function getAllProduit(){
        $query = "select * from vue_categorie3 order by id_cat";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while( $d = $_resultset->fetch()){
            $_data[] = new Produit($d);
        }
        // var_dump($_data);
        return $_data;
    }

    public function getProduitsByCat($id_cat){

        try{
            $query="select * from vue_categorie3 where id_cat = :id_cat";
            $_resultset = $this ->_db->prepare ($query);
            $_resultset ->bindValue(':id_cat',$id_cat);
            $_resultset->execute();

            while($d= $_resultset-> fetch()){

                $_data[] = new Produit($d);

            }

            return $_data;

        }catch(PDOException $e){
            print "Echec de la requete".$e->getMessage();

        }
    }
}