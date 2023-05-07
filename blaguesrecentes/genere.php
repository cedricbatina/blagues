<?php
$url_src = 'http://localhost/blagues/blaguesrecentes/controleur.php';
$monfic_temp = $_SERVER['DOCUMENT_ROOT'] . 'blagues/blaguesrecentes/indextemp.html';
$monfic_cible = $_SERVER['DOCUMENT_ROOT'] . 'blagues/blaguesrecentes/index.html.';

if (file_exists($monfic_temp)) {
 unlink($monfic_temp);
}
$html = file_get_contents($url_src);
if (!$html) {
 $erreur = 'Impossible de charger $url_src. Abandon de la modification de la page statique!';
 include $_SERVER['DOCUMENT_ROOT'] . $erreur;
 exit();
}
if (!file_get_contents($monfic_temp, $html)) {
 $erreur = 'Impossible de charger $url_src. Abandon de la modification de la page statique!';
 include $_SERVER['DOCUMENT_ROOT'] . $erreur;
}

copy($monfic_temp, $monfic_cible);
unlink($monfic_temp);
