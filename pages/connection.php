<?php
//connection si le client possede un compte
if (isset($_POST['submit_login'])) {
    /* extract extrait les données hors tableau $_POST */
    extract($_POST, EXTR_OVERWRITE);
    /* instanciation de la classe BD et appel de la méthode */
    $connect = new LoginBD($cnx);
    $visite = $connect->getStatutConnexion($login, $motdepasse);
    //var_dump($visite);

    if (!is_null($visite)) { //si le client est bien connecté
            $_SESSION['Connexion'] = '';
            $_SESSION['page'] = "compte.php";

            print "<meta http-equiv=\"refresh\": Content=\"0;URL=./index_.php\">";
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['motdepasse'] = $_POST['motdepasse'];

    }else { //si il n'est pas connecté
        $_SESSION['page'] = "connection.php";

        print "<meta http-equiv=\"refresh\": Content=\"0;URL=index_.php\">";
    }
}
?>

<div class="container">
    <div class="modal fade" id="co" tabindex="-1" role="dialog" aria-labelledby="connection"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="column" id="main">
                        <h1>Vous connecter </h1>
                        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" class="form-control" id="login" name="login"
                                       placeholder="Votre pseudo">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mot de passe </label>
                                <input type="password" class="form-control" id="motdepasse" name="motdepasse"
                                       aria-describedby="mdp" placeholder="******">
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit_login" name="submit_login">Se
                                connecter
                            </button>
                        </form>

                    </div>
                    <div>
                        <svg width="67px" height="580px" viewBox="0 0 67 578" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M11.3847656,-5.68434189e-14 C-7.44726562,36.7213542 5.14322917,126.757812 49.15625,270.109375 C70.9827986,341.199016 54.8877465,443.829224 0.87109375,578 L67,578 L67,-5.68434189e-14 L11.3847656,-5.68434189e-14 Z"
                                      id="Path" fill=" brown">

                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="column" id="secondary">
                        <div class="sec-content">
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                            <h3>Ravis de vous revoir !</h3>
                            <h5> Ne manquez pas nos nouveautés dans la page produit !</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit_admin'])) {//connection pour les admins
    extract($_POST, EXTR_OVERWRITE);
    $connect = new AdminBD($cnx);
    $adm = $connect->getAdmin($loginAdmin, $password);
    //var_dump($visite);

    if (!is_null($adm)) {
        $_SESSION['admin'] = '';
        unset($_SESSION['page']);
        /* Redirection vers le dossier admin */
        print "<meta http-equiv=\"refresh\": Content=\"0;URL=./admin/index.php\">";
        /* else possible pour tester un statut "visiteur" au lieu d'"admin" */
        $_SESSION['login'] = $_POST['loginAdmin'];
        $_SESSION['password'] = $_POST['password'];

    }  else {
        $_SESSION['page'] = "accueil.php"; //si echec de la connection redirection a l'accueil

        print "<meta http-equiv=\"refresh\": Content=\"0;URL=index_.php\">";
    }
}

?>

<div class="container">
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Me connecter</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Creer un compte</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <div class="group">
                        <input type="submit" class="button" value="Vous possedez un compte?" data-toggle="modal" data-target="#co">
                    </div>

                </div>
                <div class="sign-up-htm">
                    <div class="group">
                        <a href="index_.php?page=newCompte.php" class="button">Créer mon compte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="connection">
        <h4>Administrateur</h4>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ConnexionAdmi">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-person-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
            Me connecter
        </button>



        <div class="modal fade" id="ConnexionAdmi" tabindex="-1" role="dialog" aria-labelledby="connection"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="column" id="main">

                            <h1>Vous connecter </h1>
                            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group">
                                    <label for="login">Pseudo</label>
                                    <input type="text" class="form-control" id="loginAdmin" name="loginAdmin"
                                           placeholder="Votre pseudo">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           aria-describedby="mdp" placeholder="******">
                                </div>


                                <button type="submit" class="btn btn-primary" id="submit_admin" name="submit_admin">Se
                                    connecter
                                </button>


                            </form>

                        </div>
                        <div>

                            <svg width="67px" height="580px" viewBox="0 0 67 578" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="M11.3847656,-5.68434189e-14 C-7.44726562,36.7213542 5.14322917,126.757812 49.15625,270.109375 C70.9827986,341.199016 54.8877465,443.829224 0.87109375,578 L67,578 L67,-5.68434189e-14 L11.3847656,-5.68434189e-14 Z"
                                          id="Path" fill=" brown">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <div class="column" id="secondary">
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                            <div class="sec-content">
                                <h3> Reservé aux administrateurs !</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
