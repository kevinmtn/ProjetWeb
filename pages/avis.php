<?php //page pour afficher les avis des clients
$commentaire = new CommentaireBD($cnx);
$liste_comm = $commentaire->getAllCommentaire();
$affiche_comm = count($liste_comm);

$commande = new CommandeBD($cnx);
$liste2 = $commande->getAllCommande();
$affiche_commande = count($liste2);

$clients = new ClientBD($cnx);


$id = new ProduitBD($cnx);
?>
<h4>
    Vos avis
</h4>

<div class="container">
    <div class="table-users">
        <?php
        for ($i = 0; $i < $affiche_comm; $i++) {
            ?>

            <table>
                <tr>
                    <th width="600">
                        <div style="text-align: center;"/>
                        Chocolat
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-archive-fill" viewBox="0 0 16 16">
                            <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/>
                        </svg>

                    </th>
                    <th width="200"> Pseudo
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd"
                                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    </th>
                    <th width="200"> Note
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </th>
                    <th width="500">Commentaire
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </th>
                </tr>

                <tr>

                    <?php
                    $id_p = $liste_comm[$i]->id_produit;
                    $_SESSION['id_produitComm'] = $id_p;
                    $_SESSION['id_cli'] = $liste_comm[$i]->id_client; //recuperation de l'id client pour afficher les infos
                    ?>

                    <?php
                    $tableau = $_SESSION['id_produitComm'];

                    $prod = $id->getProduitbyId($_SESSION['id_produitComm']);  //recuperation de l'id du produit pour afficher ses informations
                    $nbr2 = count($prod);
                    for ($j = 0; $j < $nbr2; $j++) {
                        ?>
                        <td>
                            <div style="text-align: center;"/>
                            <img src="./admin/images/<?php print $prod[$j]->photo; ?>" alt="Image"
                                 width="40%"/>
                        </td>
                        <?php
                    }
                    ?>

                    <?php
                    $liste = $clients->getClientbyId($_SESSION['id_cli']);
                    $affiche = count($liste);
                    for ($k = 0; $k < $affiche; $k++) {
                        ?>
                        <td> <?php print $liste[$k]->login; ?> </td>
                        <?php
                    }
                    ?>
                    <td><?php print $liste_comm[$i]->note;
                        print "/5" ?>
                    </td>
                    <td> <?php print $liste_comm[$i]->commentaire; ?></td>
                </tr>


            </table>

            <?php
        }
        ?>

        <?php
        if (isset($_SESSION['Connexion'])) { //si le client est connecté il pourra faire un avis sur ses commandes
        ?>
    </div>

    <div class="connection">

        <h5> Souhaitez vous partager votre avis ?</h5>
        <button type="button" class="btn btn-primary">
            <a href="index_.php?page=creationAvis.php" class="button">Ecrire mon avis</a>
        </button>

    </div>
    <?php
    } else { //si pas il devra se connecter avant
        ?>
        <div class="connection">
            <h5> Souhaitez vous faire votre avis ?</h5>
            <button type="button" class="btn btn-primary">
                <a href="index_.php?page=connection.php" class="button">Cliquez ici</a>
            </button>
        </div>

        <?php
    }
    ?>

</div>