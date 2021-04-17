<?php
//creation d'un compte client si le client n'en possede pas

if (isset($_GET['submit_client'])) {
    extract($_GET, EXTR_OVERWRITE);
    $add = new ClientBD($cnx);
    $client = $add->setClient($id_client, $nom_client, $prenom_client, $adresse, $numero, $telephone, $email, $motdepasse, $login);

    if (!is_null($client)) {

        unset($_SESSION['page']);
    } else {
        $_SESSION['page'] = "connection.php";
        print "<meta http-equiv=\"refresh\": Content=\"0;URL=index_.php\">";
    }
}
?>

<div class="container">
    <div class="form-bg ">

        <div class="row d-inline-block">
            <div class="col-md-offset-3 col-md-6">
                <div class="form-container ">

                    <h2 class="title">Créer un compte</h2>
                    <form class="form-horizontal">
                        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" class="form-control" placeholder="Votre nom" id="nom_client"
                                       name="nom_client" required>
                            </div>
                            <div class="form-group">
                                <label>Prenom</label>
                                <input type="text" class="form-control" placeholder="Votre prenom"
                                       id="prenom_client required"
                                       name="prenom_client" required>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" placeholder="Votre email" id="email"
                                       name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" placeholder="**********" id="motdepasse"
                                       name="motdepasse" maxlength="50" minlength="3" required>
                            </div>
                            <div class="form-group">
                                <label>Pseudo</label>
                                <input type="text" class="form-control" placeholder="Votre pseudo" id="login"
                                       name="login" required>
                            </div>
                            <h2 class="sub-title">Information personnelle</h2>
                            <div class="form-group">
                                <label>Numero de telephone</label>
                                <input type="text" class="form-control" placeholder="0478.65.22.88" id="telephone"
                                       name="telephone" required>
                            </div>
                            <div class="form-group">
                                <label>Votre adresse</label>
                                <input type="text" class="form-control" placeholder="Avenue des roses" id="adresse"
                                       name="adresse" required>
                            </div>
                            <div class="form-group">
                                <label>Numero d''habitation</label>
                                <input type="number" class="form-control" placeholder="0" id="numero" name="numero"
                                       required>
                            </div>
                            <div class="connection">
                                <button class="btn btn-primary" type="submit" id="submit_client" name="submit_client">
                                    Valider mes données
                                </button>
                            </div>
                        </form>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
