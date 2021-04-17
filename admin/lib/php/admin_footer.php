<?php
// données de l'admin
$info = array();

$admin = new AdminBD($cnx);
$info = $admin->getAdmin($_SESSION['login'], $_SESSION['password']);
$nbr = count($info);
?>

<div class="footer-basic">
    <footer>
        <div class="social">
            <?php for ($i = 0; $i < $nbr; $i++){
            ?>
            <h3>Connecté sous le pseudo administrateur: </h3>
                 <?php print $info[$i]->login; ?>
        </div>
        <?php
        }
        ?>
        <p class="copyright">Copyright @2021 Kevin Maton </p>
    </footer>
</div>