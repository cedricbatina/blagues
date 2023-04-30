<?php
include  './includes/bdi.inc.php';

function fct_totalbagues()
{
 global $lien;
 $query = 'SELECT COUNT(*) FROM blagues';
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = 'Erreur de comptage des blagues!';
  exit();
 }
 $ligne =  mysqli_fetch_array($resultat);
 return $ligne[0];
}
