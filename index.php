<?php
//require 'connexion.php';
//require 'connexion.php';

include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
/*$query = 'SELECT * FROM blagues';
if (!mysqli_query($lien, $query)) {
 $erreur =  'Erreur dans la requête' . mysqli_error($lien);
 exit();
}*/

if (isset($_POST['texte_blague'])) {
 //include 'bdi.inc.php';
 $texte_blague = mysqli_real_escape_string($lien, $_POST['texte_blague']);
 $date_blague =
  date('Y-m-d H:i:s');
 $query = "INSERT INTO blagues (texte_date, date_blague) VALUES (' " . $texte_blague . " '  , '$date_blague')";
 if (!mysqli_query($lien, $query)) {
  $erreur = 'Erreur pour ajouter la blague' . mysqli_error($lien);
  echo mysqli_error($lien);

  exit();
 }
 header('Location : index.php');
 exit();
}


/////Supprimer une blague 
if (isset($_GET['supprblague'])) {
 //include 'bdi.inc.php';

 $id = mysqli_real_escape_string($lien, $_POST['id']);
 $query = "DELETE FROM blagues WHERE id = '$id'";
 if (!mysqli_query($lien, $query)) {
  $erreur = 'Erreur dans la suppression de la blague' .   mysqli_error($lien);
  exit();
 }
 header('Location : .');
 die();
}
//include 'bdi.inc.php';

$query = 'SELECT blagues.id, texte_blague, nom, mails.mail FROM blagues INNER JOIN auteurs ON blagues.id_auteur = auteurs.id INNER JOIN mails ON auteurs.id = mails.id_auteur';


$resultat = mysqli_query($lien, $query);

if (!$resultat) {
 $erreur =
  'Erreur de lecture de la blague' .   mysqli_error($lien);
 exit();
}
if (mysqli_num_rows($resultat) > 0) {
 $blagues = array();

 while ($ligne = mysqli_fetch_array($resultat)) {
  $blagues[] = array('id' => $ligne['id'], 'texte_blague' => $ligne['texte_blague'], 'nom' => $ligne['nom'], 'mail' => $ligne['mail']);
  //$auteurs[] = array('id' => $ligne['id'], 'nom' => $ligne['nom']);
 }
}

//require 'blagues.html.php';
if (isset($_GET['ajoutblague'])) {
 require 'form.html.php';
 exit();
}
include 'blagues.html.php';
