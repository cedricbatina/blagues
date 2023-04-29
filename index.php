<?php
//require 'connexion.php';
//require 'connexion.php';

if (ini_get('magic_quotes_gpc')) {
 function stripslashes_profond($valeur)
 {
  $valeur = is_array($valeur) ? array_map('stripslashes_profond', $valeur) : stripslashes($valeur);
  return $valeur;
 }
 $_POST = array_map('stripslashes_profond', $_POST);
 $_GET = array_map('stripslashes_profond', $_GET);
 $_COOKIE = array_map('stripslashes_profond', $_COOKIE);
 $_REQUEST = array_map('stripslashes_profond', $_REQUEST);
}

/*$query = 'SELECT * FROM blagues';
if (!mysqli_query($lien, $query)) {
 $erreur =  'Erreur dans la requête' . mysqli_error($lien);
 exit();
}*/













if (isset($_POST['texte_blague'])) {
 include 'bdi.inc.php';
 $texte_blague = mysqli_real_escape_string($lien, $_POST['texte_blague']);
 $date_blague = time();
 $query = 'INSERT INTO blagues (texte_date, date_blague) VALUES ("' . $texte_blague . ' " , $date_blague)';
 if (!mysqli_query($lien, $query)) {
  $erreur = 'Erreur pour ajouter la blague' . mysqli_error($lien);
  echo mysqli_error($lien);

  exit();
 }
 header('Location : .');
 exit();
}



//require 'blagues.html.php';
if (isset($_GET['ajoutblague'])) {
 require 'form.html.php';
 exit();
}
/////Supprimer une blague 
if (isset($_GET['supprblague'])) {
 include 'bdi.inc.php';

 $id = mysqli_real_escape_string($lien, $_POST['id']);
 $query = 'DELETE FROM blagues WHERE id = "$id"';
 if (!mysqli_query($lien, $query)) {
  $erreur = 'Erreur dans la suppression de la blague' .   mysqli_error($lien);
  exit();
 }
 header('Location : .');
 die();
}
include 'bdi.inc.php';

$query = 'SELECT blagues.id, texte_blague, nom, mails.mail FROM blagues INNER JOIN auteurs ON blagues.id_auteur = auteurs.id INNER JOIN mails ON auteurs.id = mails.id_auteur';


$resultat = mysqli_query($lien, $query);

if (!$resultat) {
 $erreur =
  'Erreur de lecture de la blague' .   mysqli_error($lien);
 exit();
}
while ($ligne = mysqli_fetch_array($resultat)) {
 $blagues[] = array('id' => $ligne['id'], 'texte_blague' => $ligne['texte_blague'], 'nom' => $ligne['nom'], 'mail' => $ligne['mail']);
 //$auteurs[] = array('id' => $ligne['id'], 'nom' => $ligne['nom']);
}

include 'blagues.html.php';
