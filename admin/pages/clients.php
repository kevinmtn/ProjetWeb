<?php
include('./lib/php/verification_connexion.php');
$clients = new ClientBD($cnx);
$liste = $clients->getAllClients();
$affiche = count($liste);

$commande = new CommandeBD($cnx);
$liste2 = $commande->getAllCommande();
$affiche_commande = count($liste2);
?>

<h4>Nos clients</h4>
<div>
    <div class="pt-6 pb-6 ">
        <div class="row pt-2 pb-2 bg-secondary text-center text-uppercase text-light">
            <div class="col-1">
                Identifiant
            </div>
            <div class="col-1">
                Nom
            </div>
            <div class="col-2">
                Prénom
            </div>
            <div class="col-2">
                Email
            </div>
            <div class="col-2">
                Adresse
            </div>
            <div class="col-2">
              Numero
            </div>
            <div class="col-2">
                Telephone
            </div>
        </div>
        <div class="row pt-2 pb-2 text-center bg-light text-secondary ">
            <?php
            for ($i = 0; $i < $affiche; $i++) {
                ?>
                <div class="col-1 pt-2 pb-2">
                    <?php print $liste[$i]->id_client; ?>
                </div>
                <div class="col-1 pt-2 pb-2">
                    <?php print $liste[$i]->nom_client; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste[$i]->prenom_client; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste[$i]->email; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste[$i]->adresse; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste[$i]->numero; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste[$i]->telephone; ?>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>



<h4>Commandes à ce jour</h4>
<div>
    <div class="pt-5 pb-5 ">
        <div class="row pt-2 pb-2 bg-secondary text-center text-uppercase text-light">
            <div class="col">
                Identifiant de la commande
            </div>
            <div class="col">
                Identifiant du client
            </div>
            <div class="col">
                Date de la livraison
            </div>
            <div class="col">
                Date de la commande
            </div>
            <div class="col">
                Identifiant du produit
            </div>
        </div>
        <div class="row pt-2 pb-2 text-center bg-light text-secondary">
            <?php
            for ($i = 0; $i < $affiche_commande; $i++) {
                ?>
                <div class="col-3 pt-2 pb-2">
                    <?php print $liste2[$i]->id_commande; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste2[$i]->id_client; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste2[$i]->date_livraison; ?>
                </div>
                <div class="col-2 pt-2 pb-2">
                    <?php print $liste2[$i]->date_commande; ?>
                </div>
                <div class="col-3 pt-2 pb-2">
                    <?php print $liste2[$i]->id_produit; ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
