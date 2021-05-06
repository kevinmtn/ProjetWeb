<?php //pdf de la table produit
include('../admin/lib/php/pg_connect.php');
include('../admin/lib/php/classes/Connexion.class.php');
include('../admin/lib/php/classes/Produit.class.php');
include('../admin/lib/php/classes/ProduitBD.class.php');


$cnx = Connexion::getInstance($dsn, $user, $password);
$pr = array();
$produit = new ProduitBD($cnx);

$listeprod = $produit->getAllProduit();
$nbr = count($listeprod);

$listecateg = $produit->getProduitsByCat('1');
$cat = count($listecateg);
include('../admin/lib/php/TCPDF/tcpdf.php');

$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(0, 0, 0);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);


$pdf->AddPage();

$pdf->SetFont('times', '', '12');
$pdf->SetTextColor(88, 24, 69);

$x = 20;
$y = 50;
$pdf->SetTitle('PDF projet web');
$pdf->Cell(0, 30, 'PRODUITS DISPONIBLE', 1, 0, 'C');
$pdf->setPage(1, true);
$pdf->SetY(50);
for ($i = 0; $i < 1; $i++) {
    $pdf->Text($x, $y, 'Identifiant');
    $pdf->Text($x + 30, $y, 'Nom du produit');
    $pdf->Text($x + 100, $y, 'Prix');
    $pdf->Text($x + 130, $y, 'Stock disponible');

    $y += 20;
}

for ($i = 0; $i < $nbr; $i++) {
    $pdf->Text($x, $y, $listeprod[$i]->id_produit);
    $pdf->Text($x + 30, $y, $listeprod[$i]->nom_produit);
    $pdf->Text($x + 100, $y, $listeprod[$i]->prix);
    $pdf->Text($x + 140, $y, $listeprod[$i]->stock);

    $y += 10;

}

ob_end_clean();
$pdf->Output('ProjetWeb_KevinMaton.pdf', 'D');