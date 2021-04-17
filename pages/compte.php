<?php
// données du client
$compte = array();

$client = new LoginBD($cnx);
$compte = $client->getStatutConnexion($_SESSION['login'], $_SESSION['motdepasse']);

$nbr = count($compte);
?>


<div class="container">
    <div class='col-sm-20' id="inner-div">
        <h4> Votre compte</h4>
        <table>
            <?php for ($i = 0; $i < $nbr; $i++) {
                ?>

                <tr>
                    <td style="text-align: center;";><br><br> Votre login</td>
                    <td><br><br> <?php print $compte[$i]->login; ?></td>
                </tr>

                <tr>
                    <td> <div style="text-align: center;">Votre nom</td>
                    <td><?php print $compte[$i]->nom_client; ?> </td>
                </tr>

                <tr>
                    <td> <div style="text-align: center;">Votre prenom</td>
                    <td>    <?php print $compte[$i]->prenom_client; ?> </td>

                </tr>

                <tr>
                    <td> <div style="text-align: center;">Votre adresse</td>
                    <td><?php print $compte[$i]->adresse; ?></td>
                </tr>

                <tr>
                    <td style="text-align: center;"> Votre numero de localite</td>
                    <td><?php print $compte[$i]->numero; ?></td>

                </tr>

                <tr>
                    <td> <div style="text-align: center;">Votre email</td>
                    <td> <?php print $compte[$i]->email; ?></td>

                </tr>

                <tr>
                    <td> <div style="text-align: center;">Votre numero de telephone </td>
                    <td> <?php print $compte[$i]->telephone; ?></td>

                </tr>
                <tr>
                    <td colspan="2"><div style="text-align: center;">
                            <button type="button" class="btn btn-primary">

                                <a href="index_.php?page=recapCommande.php" class="button">Voir mes commandes</a>
                            </button></div>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>
    </div>
</div>



