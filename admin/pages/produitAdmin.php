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
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                        <td>
                            <div style="text-align: center;"><label for="stock">Nouveau stock: </label></div>
                        </td>
                        <td><input name="stock" type="text" class="form-control" id="stock" placeholder="stock"  required pattern="[1-9][0-9]{0,2}"> </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: center;">
                            <button class="btn btn-secondary" type="submit" name="accepter" value="accepter"/>
                            Soumettre le nouveau stock
                            </button>
                        </div>
                    </td>
                </tr>
                </form>
            </table>

        </div>
        <p>! La valeur du stock peut valoir entre 1 et 999</p>
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
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                        <td>
                            <div style="text-align: center;"><label for="prix">Nouveau prix: </label></div>
                        </td>
                        <td><input name="prix" type="text" class="form-control" id="prix" placeholder="prix"  required pattern="^0*([1-9][0-9]*)$|^0*([1-9][0-9]*.[0-9]*[1-9])0*$|^0*(0.[0-9]*[1-9])0*$"> </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: center;">
                            <button class="btn btn-secondary" type="submit" name="MajPrix" value="MajPrix"/>
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
<div class="container">
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
                            <div id="stockRestant">
                                <?php
                                print " Identifiant du produit:  ";
                                print $liste[$i]->id_produit;
                                ?>
                            </div>
                            <div id="stockRestant">
                                <?php
                                print " Stock restant:  ";
                                print $liste[$i]->stock;

                                ?>
                            </div>

                        </div>

                        <img src="../admin/pages/images/<?php print $liste[$i]->photo; ?>" alt="Image"/>
                        <div class="card-body">
                            <p id="card-text">
                                <?php
                                print  $liste[$i]->nom_produit;
                                ?>
                            </p>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-secondary action= ">
                            <a href="<?php print $_SERVER['PHP_SELF']; ?>?action=ajout&amp;id=<?php print $liste[$i]->id_produit; ?>">
                                Modifier le stock
                            </a>
                        </button>

                        <button type="button" class=" btn btn-sm btn-outline-secondary action= ">
                            <a href="<?php print $_SERVER['PHP_SELF']; ?>?actionPrix=ajout&amp;id=<?php print $liste[$i]->id_produit; ?>">
                                  Modifier le prix
                            </a>
                        </button>


                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


