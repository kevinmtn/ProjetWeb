<!doctype html>
<?php
//index public
session_start();

include('./admin/lib/php/admin_liste_include.php');
include('./admin/lib/php/pg_connect.php');
include('./admin/lib/php/autoload.php');
$cnx = Connexion::getInstance($dsn, $user, $password);
?>

<html>
<head>
    <title>Project web Kevin Maton</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
            integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./admin/lib/css/styleBt.css"/>
    <link rel="stylesheet" href="./admin/lib/css/custom.css"/>
    <link rel="icon"  href="./admin/images/icon.png" />
    <script src="./admin/lib/js/fonctions_jquery.js"></script>

</head>

<body class="bg-dark">
<div id="page">
    <header class="img_header">

    </header>
    <section id="colGauche">
        <nav>
            <?php
            $path = "./lib/php/public_menu.php";
            if (file_exists($path)) {
                include($path);
            }
            ?>
        </nav>

    </section>
    <section class="center-block">
        <div id="main">
            <?php

            if (!isset($_SESSION['page'])) {
                $_SESSION['page'] = "accueil.php";
            }
            if (isset($_GET['page'])) {
                $_SESSION['page'] = $_GET['page'];
            }
            $path = "./pages/" . $_SESSION['page'];

            // print "path: " . $path . "<br>";
            if (file_exists($path)) {
                include($path);
            } else {
                include("./pages/page404.php");
            }
            ?>
        </div>
    </section>

</div>

<footer>
    <?php
    if (file_exists('./lib/php/public_footer.php')) {
        include('./lib/php/public_footer.php');
    }
    ?>
</footer>


</body>
</html>