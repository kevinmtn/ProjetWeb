<?php

class Connexion{
    private static $_instance =null;

    public static function getInstance($dsn, $user, $password){
        // ::-> manière d'atteindre une variable statique
        if(!self::$_instance){

            try{
                self::$_instance= new PDO($dsn, $user,$password);
                //print"Vous etes connecté à la base de donnée";
            } catch (PDOException $e){
                print "Echec: ".$e->getMessage();
            }
        }

        return self::$_instance;
    }
}
