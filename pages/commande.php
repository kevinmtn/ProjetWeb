<?php  //cette page permet de traiter la commande du client par rapport au panier lors de la validation
$compte = array();

$client = new LoginBD($cnx);
$compte = $client->getStatutConnexion($_SESSION['login'], $_SESSION['motdepasse']);
$nbr1 = count($compte);

for ($i = 0; $i < $nbr1; $i++) {
    $id_cli = $compte[$i]->id_client;
}
 $_SESSION['id_client']=$id_cli;  //recuperation de l'id du client
//var_dump($id_cli);

$panier = $_SESSION['panier'];//session contenant les données du panier du client
$liste = $panier;
$nbr = count($liste);

for ($i = 0; $i < $nbr; $i++) {
    $id_produits[]= $liste[$i]['id_produit'];  //ajout des id produit dans un tableau
}
$stringArray = $id_produits;
$intArray = array_map(
    function($id_produits) { return (int)$id_produits; },  //convertion du tableau array string en int
    $stringArray
);

var_dump($intArray);  //contient les id produits en INT

$nbr2= count($intArray);
//var_dump($nbr2);

$pro= count($id_produits);
$id_produit=$id_produits;
//var_dump($pro);
$_SESSION['id_prod']=$intArray;
//var_dump($_SESSION['id_prod']);
$tableau=$_SESSION['id_prod'];
$date_commande = date("Y-m-d H:i:s");  //date d'aujourd'hui
$date_livraison = date("Y-m-d H:i:s", strtotime(' + 5 days')); //ajout de 5 jours pour la date de livraison
$add = new CommandeBD($cnx);

foreach($tableau as $valeur){  //on prend les id produit comme valeur
    $comm = $add->setCommande($id_commande, $id_cli+0, $valeur, $date_livraison, $date_commande);  //ajout dans la table
}

$_SESSION['panier'] = null;  //vide le panier lors de la commande
$_SESSION['page'] = "recapCommande.php";   //raffraichissement de la page
print "<meta http-equiv=\"refresh\": Content=\"0;URL=./index_.php\">";

?>







