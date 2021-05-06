<?php //ajout d'un produit
include('./lib/php/verification_connexion.php');

if (isset($_GET['submit_produit'])) {
    extract($_GET, EXTR_OVERWRITE);
    $add = new ProduitBD($cnx);
    $produit = $add->NewProduit($nom_produit, $photo, $prix, $stock, $description, $cat);

    if (!is_null($produit)) {

        unset($_SESSION['page']);
    } else {
        sleep(2);
        $_SESSION['page'] = "produitAdmin.php";
        print "<meta http-equiv=\"refresh\": Content=\"0;URL=index.php\">";
    }
}
?>

<div class="container">
    <div class="form-bg ">
        <div class='col-md-offset-3 col-md-6'>
            <div class="form-container ">
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get" enctype="multipart/form-data">
                    <h2 class="title">Ajouter un produit</h2>
                    <div class="col-md-6 mb-3">
                        <label>Nom du produit</label>
                        <input type="text" class="form-control" placeholder="tablette noix de coco" id="nom_produit"
                               name="nom_produit" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Prix du produit</label>
                        <input type="text" class="form-control" placeholder="3.49" id="prix"
                               name="prix" required
                               pattern="^0*([1-9][0-9]*)$|^0*([1-9][0-9]*.[0-9]*[1-9])0*$|^0*(0.[0-9]*[1-9])0*$"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Montant du stock</label>
                        <input type="text" class="form-control" placeholder="100" id="stock"
                               name="stock" required pattern="[1-9][0-9]{0,2}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Description du produit</label>
                        <textarea class="form-control" id="description" name="description" rows="5"
                                  placeholder="Description" maxlength="60" minlength="3" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Numero de la catégorie du produit *</label>
                        <input type="number" class="form-control" placeholder="1" id="cat" name="cat"
                               max="3" min="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Image du produit</label>
                        <input type="file" name="photo" id="photo" required/>
                    </div>
                    <div class="connection">
                        <button class="btn btn-primary" type="submit" id="submit_produit" name="submit_produit">
                            Valider les données
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p> ! Rmrq: <br> - Le stock doit avoir une valeur entre 1 et 999 <br>
        - Le prix doit être positif, si prix avec virgule veuillez utiliser le .<br>
        - Numero de categorie 1:-> tablette 2:-> mignonette 3:->bâton
    </p>
</div>

