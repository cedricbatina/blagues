<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');




if (isset($_POST['action']) and $_POST['action'] == 'depot') {

 if (preg_match('/^image\/p?jpeg$/i', $_FILES['depot']['type'])) {
  $ext = '.jpg';
 } elseif (preg_match('/^image\/p?jpg$/i', $_FILES['depot']['type'])) {
  $ext = '.jpg';
 } elseif (preg_match('/^image\/p?png$/i', $_FILES['depot']['type'])) {
  $ext = '.png';
 } elseif (preg_match('/^image\/p?gif$/i', $_FILES['depot']['type'])) {
  $ext = '.gif';
 } elseif (preg_match('/^image\/p?pdf$/i', $_FILES['depot']['type'])) {
  $ext = '.pdf';
 } else {
  $ext = '.inconnu';
 }
 // le chemin/nom complet
 $monfic = 'C:/depots' . time() . $_SERVER['REMOTE_ADDR'] . $ext;
 // copie du fichier s'il semble sûr
 if (!is_uploaded_file($_FILES['depot']['tmp_name']) || !copy($_FILES['depot']['tmp_name'], $monfic)) {
  $erreur = 'Impossible de sauvegarder $monfic!';
  exit();
 }










 // ignore le fichier si ce n'est pas un dépôt
 if (!is_uploaded_file($_FILES['depot']['tmp_name'])) {
  $erreur = "Ce n'est pas un fichier déposé";
  exit();
 }
 $fichier_depot = $_FILES['depot']['tmp_name'];
 $nom_depot = $_FILES['depot']['name'];
 $type_depot = $_FILES['depot']['type'];
 $desc_depot = $_POST['desc'];
 $donnees_depot = file_get_contents($fichier_depot);

 // préparation des données soumises avant insertion dans la base 

 $nom_depot = mysqli_real_escape_string($lien, $nom_depot);
 $type_depot = mysqli_real_escape_string($lien, $type_depot);
 $desc_depot = mysqli_real_escape_string($lien, $desc_depot);
 $donnees_depot = mysqli_real_escape_string($lien, $donnees_depot);

 $query = "INSERT INTO fichiers SET nomfic='$nom_depot', typemime='$type_depot', description='$desc_depot',contenu='$donnees_depot' ";
 if (!mysqli_query($lien, $query)) {
  $erreur =  "Impossible d'ajouter le fichier";
  exit();
 }
 header('Location: .');
 exit();
}
if (isset($_GET['action']) and ($_GET['action'] == 'voir' || $_GET['action'] == 'télécharge')) {
 $id = mysqli_real_escape_string($lien, $query);
 $query = "SELECT nomfic, typemime, contenu FROM fichiers WHERE id = '$id'";

 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible d'afficher ce fichier";
 }

 $fichier = mysqli_fetch_array($resultat);
 if (!$fichier) {
  $erreur = "Impossible d'afficher ce fichier";
  exit();
 }
 $nomfic = $fichier['nomfic'];
 $typemime = $fichier['typemime'];
 $contenu = $fichier['contenu'];
 $disposition = 'inline';
 if ($_GET['action'] == 'télécharger') {
  $typemime = 'application/octet-stream';
  $disposition = 'attachment';
 }
 header("Content-type : $typemime");
 header("Content-disposition: $disposition; filename=$nomfic");
 header("Content-length: "  . strlen($contenu));
 echo $contenu;
 exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'supprimer' and isset($_POST['id'])) {
 $id = mysqli_real_escape_string($lien, $_POST['id']);
 $query = "DELETE FROM fichiers WHERE id='$id'";
 if (!mysqli_query($lien, $query)) {
  $erruer = 'Erreur de suppression du fichier ';
  exit();
 }
 header('Location: .');
 exit();
}

$query = "SELECT id, nomfic, typemime, description FROM fichiers";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = 'Erreur de récupération du fichier dans la base';
 exit();
}
$fichiers = array();
while ($ligne = mysqli_fetch_array($resultat)) {
 $fichiers[] = array(
  'id' => $ligne['id'],
  'nomfic' => $ligne['nomfic'],
  'typemime' => $ligne['typemime'],
  'description' => $ligne['description']
 );
}
