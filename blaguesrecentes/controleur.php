<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
$resultat = mysqli_query($lien, "SELECT id, texte_blague FROM blagues ORDER BY date_blague DESC LIMIT 3");
if (!$resultat) {
 $erreur = "Erreur de récupération des blagues : " . mysqli_error($lien);
}
$blagues = array();

while ($ligne = mysqli_fetch_array($resultat)) {
 $blagues[] = array('texte' => $ligne['texte_blague']);
}
include './blaguesrecentes/blagues.html.php';
