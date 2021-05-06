<?php
$compte = array();
$client = new LoginBD($cnx);
$compte = $client->getStatutConnexion($_SESSION['login'], $_SESSION['motdepasse']);
$nbr1 = count($compte);

for ($i = 0; $i < $nbr1; $i++) {
    $id_cli = $compte[$i]->id_client;
}

$_SESSION['id_client'] = $id_cli;
$comm = array();
$commande = new CommandeBD($cnx);
$comm = $commande->getCommande($_SESSION['id_client'] + 0);

if ($comm != null) {//si le client a passé une commande
    $nbr = count($comm);

//var_dump($nbr);

    if (isset($_GET['action'])) {  //si le client clique sur le bouton "faire mon avis"
        extract($_GET, EXTR_OVERWRITE); //recuperation des données du produit voulu

        $_SESSION['idcommande'] = $_GET['id_commande'];
        $_SESSION['idp'] = $_GET['id'];
        ?>

        <div class="container">
            <div class="avis">
                <h5> Identifiant de ma commande: <?php
                    print $_SESSION['idcommande'];
                    ?>
                </h5>
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                    <div class="form-group">
                        <br>
                        <label for="avis">Mon avis</label>
                        <textarea class="form-control" name="avis" id="avis" rows="3"
                                  placeholder=" mon avis" maxlength="150" minlength="3" required>
                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="note">Ma note</label>
                        <input name="note" type="number" class="form-control2" id="note"
                               placeholder="  sur 5" min="0" max="5" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="publier" name="publier">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-check2" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                        </svg>
                        Publier mon avis
                    </button>

                </form>
            </div>
            <p> Nous vous remercions d'avance pour votre commentaire
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-emoji-smile"
                     viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                </svg>
            </p>
        </div>

        <?php
    }
    ?>
    <?php
    if (isset($_GET['publier'])) {// si le client publie son avis
        extract($_GET, EXTR_OVERWRITE);
        $accept = array();
        $avis = new CommentaireBD($cnx);
        $_SESSION['commentaire'] = $_GET['avis']; //on recupere le commentaire et la note du formulaire
        $_SESSION['note'] = $_GET['note'];
        $note = $_SESSION['note'];
        $commentaire = $_SESSION['commentaire'];
        //var_dump($_SESSION['idp']+0);
        $accept = $avis->setCommentaire($id_commentaire, $commentaire, $id_cli, $_SESSION['idp'], $_SESSION['idcommande'], $_SESSION['note']); //on envoie les données du stock est de l'id produit
        $_SESSION['page'] = "avis.php";
        print "<meta http-equiv=\"refresh\": Content=\"0;URL=index_.php\">"; //raffraichissement de la page
    }
    ?>

    <?php
    $id = new ProduitBD($cnx);

    if ($nbr != 0) { //si le client a fait une commande au minimum
        ?>
        <div class="container">
            <h4> Partager votre avis</h4>
            <h5> Ecrire un avis pour une commande passée</h5>
            <br>
            <div class="pt-6 pb-6 ">
                <div class="row pt-2 pb-2 bg-secondary text-center text-uppercase text-light">
                    <div class="col-3">
                        Produit
                    </div>
                    <div class="col-3">
                        Nom du produit
                    </div>
                    <div class="col-4">
                        Date de la commande
                    </div>
                </div>
                <div class="row pt-2 pb-2 text-center text-dark ">
                    <?php for ($i = 0; $i < $nbr; $i++) {
                        ?>
                        <?php $comm[$i]->id_produit; ?>
                        <?php
                        $id_p = $comm[$i]->id_produit;
                        $_SESSION['id_p'] = $id_p;  //recuperation de l'id du produit
                        ?>

                        <?php
                        $tableau = $_SESSION['id_p'];

                        $prod = $id->getProduitbyId($_SESSION['id_p']);  //recuperation de l'id du produit pour afficher ses informations
                        if ($prod != null) {
                            $nbr2 = count($prod);
                            for ($j = 0; $j < $nbr2; $j++) {
                                ?>
                                <div class="col-3 pt-3 pb-2">
                                    <img src="./admin/images/<?php print $prod[$j]->photo; ?>" alt="Image"
                                         width="65%"/>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                        }

                        else{
                            ?>
                            <div class="col-3 pt-5 pb-2">
                                Produit supprimé *
                            </div>
                            <?php

                        }

                        ?>
                        <?php
                        $tableau = $_SESSION['id_p'];
                        $prod = $id->getProduitbyId($_SESSION['id_p']);  //recuperation de l'id du produit pour afficher ses informations
                       if($prod!=null){
                           $nbr2 = count($prod);
                           for ($j = 0; $j < $nbr2; $j++) {
                               ?>
                               <div class="col-3 pt-5 pb-3">
                                   <?php print $prod[$j]->nom_produit; ?>
                               </div>
                               <?php
                           }
                           ?>
                               <?php
                       }
                       else{
                           ?>
                           <div class="col-3 pt-5 pb-2">
                               Produit supprimé
                           </div>
                           <?php

                       }

                        ?>

                        <div class="col-4 pt-5 pb-2">
                            <?php print $comm[$i]->date_commande; ?>
                        </div>

                        <?php
                        $tableau = $_SESSION['id_p'];

                        $prod = $id->getProduitbyId($_SESSION['id_p']);  //recuperation de l'id du produit pour afficher ses informations
                        if($prod!=null){
                            $nbr2 = count($prod);
                            for ($j = 0; $j < $nbr2; $j++) {
                                ?>
                                <div class="col-2 pt-5 pb-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary action= ">
                                        <a href="<?php print $_SERVER['PHP_SELF']; ?>?action=ajout&amp;id=<?php print $prod[$j]->id_produit; ?>&id_commande=<?php print $comm[$i]->id_commande; ?> &id_client=<?php print $id_cli; ?>">
                                            Ecrire mon avis
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                    </button>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                        }
                        else{
                            ?>
                            <div class="col-2 pt-5 pb-2">
                                Produit supprimé
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </div>
            </div>  <p> *Si vous ne pouvez pas écrire votre avis, le produit a été supprimé par un administrateur</p>
        </div>

        <?php
    }

} else { //si le client n'a pas fait de commande
    ?>
    <h4> Vous ne pouvez pas partager d'avis car vous n'avez pas encore fait de commande</h4>
    <div class="vide2">
        <a href="index_.php?page=produits_accueil.php" title="Faire une commande">
            <img src="./admin/images/avisCommande.JPG" width="400px">
        </a>
    </div>

    <?php
}
?>





