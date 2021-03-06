<?php
$compte = array();
$client = new LoginBD($cnx);
$compte = $client->getStatutConnexion($_SESSION['login'], $_SESSION['motdepasse']);
$nbr1 = count($compte);

for ($i = 0; $i < $nbr1; $i++) {
    $id_cli = $compte[$i]->id_client;
}

$_SESSION['id_client'] = $id_cli;  //recuperation de l'id du client connecté
$comm = array();
$commande = new CommandeBD($cnx);
$comm = $commande->getCommande($_SESSION['id_client'] + 0);

if ($comm != null){ //si le client a passé une commande
$nbr = count($comm);
//var_dump($nbr);

$id = new ProduitBD($cnx);

if ($nbr != 0) {
?>
<h4> Recapitulatif de votre/vos commande(s)</h4>

<h5>Votre identifiant: <?php print $id_cli; ?></h5>
<div class="pt-6 pb-6 ">
    <div class="row pt-2 pb-2 bg-secondary text-center text-uppercase text-light">
        <div class="col-2">
            Produit
        </div>
        <div class="col-3">
            Nom du produit
        </div>
        <div class="col-3">
            Date de la commande
        </div>
        <div class="col-2">
            Date de livraison estimée
        </div>
        <div class="col-2">
            Prix du produit
        </div>
    </div>

    <div class="row pt-2 pb-2 text-center bg-light text-dark ">
        <?php for ($i = 0; $i < $nbr; $i++) {
            ?>
            <?php $comm[$i]->id_produit; ?>
            <?php
            $id_p = $comm[$i]->id_produit;
            $_SESSION['id_p'] = $id_p;
            ?>

            <?php
            $tableau = $_SESSION['id_p'];

            $prod = $id->getProduitbyId($_SESSION['id_p']);  //recuperation de l'id du produit pour afficher ses informations
            if ($prod != null) {
                $nbr2 = count($prod);
                for ($j = 0; $j < $nbr2; $j++) {
                    ?>
                    <div class="col-2 pt-1 pb-1">
                        <img src="./admin/images/<?php print $prod[$j]->photo; ?>" alt="Image"
                             width="80%"/>
                    </div>
                    <?php
                }
            }
            else{ //si le produit a été supprimé par un admin
                ?>
                <div class="col-2 pt-5 pb-1">
                    Produit supprimé*
                </div>
                <?php
            }
            ?>

            <?php
            $tableau = $_SESSION['id_p'];
            $prod = $id->getProduitbyId($_SESSION['id_p']);  //recuperation de l'id du produit pour afficher ses informations
            if ($prod != null) {
                $nbr2 = count($prod);
                for ($j = 0; $j < $nbr2; $j++) {
                    ?>
                    <div class="col-3 pt-5 pb-2">
                        <?php print $prod[$j]->nom_produit; ?>
                    </div>
                    <?php
                }
            }
            else{ //si le produit a été supprimé par un admin
                ?>
                <div class="col-3 pt-5 pb-2">
                    Produit supprimé
                </div>
                <?php
            }

            ?>
            <div class="col-3 pt-5 pb-2">
                <?php print $comm[$i]->date_commande; ?>
            </div>

            <div class="col-2 pt-5 pb-2">
                <?php print $comm[$i]->date_livraison; ?>
            </div>

            <?php
            $tableau = $_SESSION['id_p'];

            $prod = $id->getProduitbyId($_SESSION['id_p']);  //recuperation de l'id du produit pour afficher ses informations
            if ($prod != null) {
                $nbr2 = count($prod);
                for ($j = 0; $j < $nbr2; $j++) {
                    ?>
                    <div class="col-2 pt-5 pb-2">
                    <?php print $prod[$j]->prix; ?>
                    <?php print '€';?>
                    </div>
                    <?php
                }
            }else{ //si le produit a été supprimé par un admin
                ?>
                <div class="col-2 pt-5 pb-2">
                    Produit supprimé
                </div>
        <?php
            }
        }
        ?>

    </div>
    <p> *Si vous ne pouvez pas voir votre commande, le produit a été supprimé par un administrateur</p>
    <?php
    }

    } else { //si le client n'a pas passé de commande
        ?>

        <h4> Vous n'avez aucune commande pour le moment</h4>
        <div class="vide2">
            <a href="index_.php?page=produits_accueil.php" title="Faire une commande">
                <img src="./admin/images/commandeVide.JPG" width="200px">
            </a>
        </div>
        <?php
    }
    ?>


