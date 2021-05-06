<?php
$cat = new CategorieBD($cnx);
$liste_cat = $cat->getCategorie();
$nbr_cat = count($liste_cat);

?>



<div class=container>
    <h2> Decouvrez notre gamme de chococats Belge</h2>
    <div class="card-group">
        <?php
        for ($i = 0; $i < $nbr_cat; $i++) {
            ?>
            <div class="card align-items-center">
                <img src="./admin/images/<?php print $liste_cat[$i]->image; ?>" class=card-img-top" alt="Chocolat">
                <div class="card-body">
                    <div class="card-title">
                        <a class="lien"
                           href="index_.php?page=produit.php&id_cat=<?php print $liste_cat[$i]->id_cat; ?>">
                            <?php print $liste_cat[$i]->nom_cat; ?>
                        </a>
                    </div>

                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>