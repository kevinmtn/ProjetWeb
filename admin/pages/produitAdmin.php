<?php
include('./lib/php/verification_connexion.php');

$prod = new ProduitBD($cnx);
if (isset($_GET['id_cat'])) {
    $liste = $prod->getProduitsByCat($_GET['id_cat']);
} else {
    $liste = $prod->getAllProduit();
}
$nbr = count($liste);

?>


<?php
if (isset($_GET['action'])) {  //si l'admin clique sur le bouton modification
    extract($_GET, EXTR_OVERWRITE); //on extrait les données pour le produit voulu
    //var_dump($_GET['id'] + 0);//convertion du string en int
    $_SESSION['id'] = $_GET['id'];//recupere l'id du produit pour le changement voulu
    $_SESSION['st'] = $_GET['oldStock']; //ancien stock
    $inf = $_SESSION['id'];
    ?>


    <div class="container">
        <div class="stock">
            <table>
                <h5> Modification du stock</h5>
                <tr>
                    <td>
                        <div style="text-align: center;">Identifiant du produit</div>
                    </td>
                    <td>
                        <?php
                        print $_SESSION['id'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: center;">Ancien stock</div>
                    </td>
                    <td>
                        <?php
                        print $_SESSION['st'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                        <td>
                            <div style="text-align: center;"><label for="stock">Nouveau stock: </label></div>
                        </td>
                        <td><input name="stock" type="text" class="form-control" id="stock" placeholder="stock" required
                                   pattern="[1-9][0-9]{0,2}"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: center;">
                            <button class="btn btn-secondary" type="submit" name="accepter" value="accepter">
                                Soumettre le nouveau stock
                            </button>
                        </div>
                    </td>
                </tr>
                </form>
            </table>

        </div>
        <p>! La valeur du stock doit valoir entre 1 et 999</p>
    </div>
<?php }
?>

<?php
if (isset($_GET['accepter'])) {// si l'admin valide les changements
    extract($_GET, EXTR_OVERWRITE);  //on extrait les informations du produit souhaité
    $accept = array();
    $stck = new ProduitBD($cnx);
    $_SESSION['stock'] = $_GET['stock'];

    $accept = $stck->setStock($_SESSION['stock'] + 0, $_SESSION['id'] + 0); //on envoie les données du stock est de l'id produit

    $_SESSION['page'] = "produitAdmin.php";
    print "<meta http-equiv=\"refresh\": Content=\"0;URL=index.php\">"; //raffraichissement de la page
}
?>


<?php
if (isset($_GET['actionPrix'])) {  //si l'admin clique sur le bouton modification du prix
    extract($_GET, EXTR_OVERWRITE); //on extrait les données pour le produit voulu
    //var_dump($_GET['id'] + 0);//convertion du string en int
    $_SESSION['id'] = $_GET['id'];//recupere l'id du produit pour le changement voulu
    $_SESSION['prize'] = $_GET['prize'];  //ancien prix du produit
    $inf = $_SESSION['id'];
    ?>


    <div class="container">
        <div class="stock">
            <table>
                <h5> Modification du Prix</h5>
                <tr>
                    <td>
                        <div style="text-align: center;">Identifiant du produit</div>
                    </td>
                    <td>
                        <?php
                        print $_SESSION['id'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: center;">Ancien prix</div>
                    </td>
                    <td>
                        <?php
                        print $_SESSION['prize'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                        <td>
                            <div style="text-align: center;"><label for="prix">Nouveau prix: </label></div>
                        </td>
                        <td><input name="prix" type="text" class="form-control" id="prix" placeholder="prix" required
                                   pattern="^0*([1-9][0-9]*)$|^0*([1-9][0-9]*.[0-9]*[1-9])0*$|^0*(0.[0-9]*[1-9])0*$">
                        </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: center;">
                            <button class="btn btn-secondary" type="submit" name="MajPrix" value="MajPrix">
                                Soumettre le nouveau prix
                            </button>
                        </div>
                    </td>
                </tr>
                </form>
            </table>
        </div>
        <p>! La valeur du prix doit être positif</p>
        <p> Si nombre à virgule veuillez utiliser le .</p>
    </div>
<?php }
?>

<?php
if (isset($_GET['MajPrix'])) {// si l'admin valide les changements du prix
    extract($_GET, EXTR_OVERWRITE);  //on extrait les informations du produit souhaité
    $acceptPrix = array();
    $pri = new ProduitBD($cnx);
    $_SESSION['prix'] = $_GET['prix'];

    $acceptPrix = $pri->setPrix($_SESSION['prix'] + 0, $_SESSION['id'] + 0); //on envoie les données du new prix est de l'id produit

    $_SESSION['page'] = "produitAdmin.php";
    print "<meta http-equiv=\"refresh\": Content=\"0;URL=index.php\">"; //raffraichissement de la page
}
?>

<?php
if (isset($_GET['actionSuppression'])) { //si l'admin veut supprimer un produit
    extract($_GET, EXTR_OVERWRITE);
    $accept = array();
    $stck = new ProduitBD($cnx);
    $_SESSION['ide'] = $_GET['identifiant'];
    $_SESSION['photo'] = $_GET['photo'];
    //print $_SESSION['ide'];
    ?>
    <div class="container">
        <div class="stock">
            <h5>
                Identifiant du produit: <?php
                print $_SESSION['ide'];
                ?>
            </h5>

            <table>
                <tr>
                    <td colspan="2">
                        <img src="../admin/images/<?php print $_SESSION['photo']; ?>" alt="Image"/>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">Souhaitez-vous valider la suppression de ce produit ?</td>

                </tr>
                <tr>
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                        <td colspan="2">
                            <div style="text-align: center;">
                                <button class="btn btn-secondary" type="submit" name="Suppression" value="Suppression">
                                    Supprimer ce produit*
                                </button>
                            </div>
                        </td>
                    </form>
                </tr>

                <tr>
                    <td colspan="2">
                        <div style="text-align: right;">
                            <button class="btn btn-secondary" type="submit">
                                <a href="index.php?page=produitAdmin.php" class="button">Annuler</a>
                            </button>
                        </div>
                    </td>
                </tr>
                </form>
            </table>
        </div>
        <p> *! Si le produit posséde un avis, il ne pourra être supprimé</p>
    </div>

    <?php
}
?>

<?php
if (isset($_GET['Suppression'])) {// si l'admin valide la suppression du produit
    extract($_GET, EXTR_OVERWRITE);  //on extrait les informations du produit souhaité
    $acceptSuppression = array();
    $supp = new ProduitBD($cnx);
//var_dump($_SESSION['ide']);
    $id_produit=$_SESSION['ide'];

    $acceptSuppression = $supp->suppression($id_produit);
    $_SESSION['page'] = "produitAdmin.php";
   print "<meta http-equiv=\"refresh\": Content=\"0;URL=index.php\">"; //raffraichissement de la page
}
?>


<div class="container">

    <h5> Produit disponible: <?php print $nbr ?></h5>

    <div class="position">
        <button type="button" class="btn btn-primary">
            <a href="index.php?page=ajoutProduit.php" class="button">Ajouter un produit</a>
        </button>
    </div>

    <div class="album py-5 bg-dark ">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
            <?php
            for ($i = 0; $i < $nbr; $i++) {
                ?>
                <div class="col">
                    <div class="card shadow-sm d-inline-block">
                        <div class="card-title">

                            <div id="prixAccueil">
                                <?php
                                print $liste[$i]->prix;
                                print"€"
                                ?>
                            </div>
                            <div id="gestionProd">
                                <?php
                                print " Identifiant du produit:  ";
                                print $liste[$i]->id_produit;
                                ?>
                            </div>
                            <div id="gestionProd">
                                <?php
                                print " Stock restant:  ";
                                print $liste[$i]->stock;

                                ?>
                            </div>

                        </div>

                        <img src="../admin/pages/images/<?php print $liste[$i]->photo; ?>" alt="Image" width="260"/>
                        <div class="card-body">
                            <p id="card-text">
                                <?php
                                print  $liste[$i]->nom_produit;
                                ?>
                            </p>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-secondary action= ">
                            <a href="<?php print $_SERVER['PHP_SELF']; ?>?action=ajout&amp;id=<?php print $liste[$i]->id_produit; ?> &oldStock=<?php print $liste[$i]->stock; ?>">
                                Modifier le stock
                            </a>
                        </button>

                        <button type="button" class=" btn btn-sm btn-outline-secondary action= ">
                            <a href="<?php print $_SERVER['PHP_SELF']; ?>?actionPrix=ajout&amp;id=<?php print $liste[$i]->id_produit; ?> &prize=<?php print $liste[$i]->prix; ?>">
                                Modifier le prix
                            </a>
                        </button>

                        <div class="position2">
                            <button type="button" title="Supprimer" class=" btn btn-sm btn-outline-secondary action= ">
                                <a href="<?php print $_SERVER['PHP_SELF']; ?>?actionSuppression=ajout&amp;identifiant=<?php print $liste[$i]->id_produit; ?> &photo=<?php print $liste[$i]->photo; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-trash"
                                         viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


