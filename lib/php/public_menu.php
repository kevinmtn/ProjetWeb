<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index_.php?page=accueil.php"> <img src="./admin/images/logo.png"
                                                                         width="100px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index_.php?page=accueil.php"><b>Accueil</b>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="index_.php?page=produits_accueil.php"><b> Nos produits</b></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index_.php?page=avis.php"><b> Avis de nos clients</b></a>
                </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index_.php?page=pagePanier.php">
                            <b>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                     class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </b>
                        </a>
                    </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0" text-align='right'>
                <?php
                if (!isset($_SESSION['Connexion'])) { //si le client n'est pas connecté la page connection sera affichée
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index_.php?page=connection.php">
                            <i class="fa fa-sign-in" aria-hidden="true">
                            </i>&nbsp;
                            Se connecter
                        </a>
                    </li>
                    <?php
                } else {//si le client est connecté ces pages suivantes seront dans le menu
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index_.php?page=compte.php"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="index_.php?page=disconnect.php">
                            <i class="fa fa-sign-out" aria-hidden="true">
                            </i>&nbsp;
                            Se déconnecter
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>

        </div>
    </div>
</nav>





