<?php
$prod = new ProduitBD($cnx);
if (isset($_GET['id_cat'])) {
    $liste = $prod->getProduitsByCat($_GET['id_cat']);
} else {

    $liste = $prod->getAllProduit();
}

$nbr = count($liste);
//var_dump($liste);
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
                            <div id="stockRestant">
                                <?php
                                print " Stock restant:  ";
                                print $liste[$i]->stock;

                                ?>
                            </div>

                        </div>

                        <img src="./admin/images/<?php print $liste[$i]->photo; ?>" alt="Image"/>
                        <div class="card-body">
                            <p id="card-text">
                                <?php
                                print  $liste[$i]->description;
                                ?>
                            </p>
                        </div>

                        <div id="panier">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Ajouter au
                                    panier
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-basket3" viewBox="0 0 16 16">
                                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div id="prixAccueil">
                            <?php
                            print $liste[$i]->prix;
                            print"€"
                            ?>
                        </div>
                    </div>

                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>