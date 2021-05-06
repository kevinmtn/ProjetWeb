<?php

if(!isset($_SESSION['admin'])){

    print "Accés réservé aux admins";
    session_destroy();
    ?>
    <meta http-equiv="refresh": content="0.2;URL=../index_.php">
    <?php
}