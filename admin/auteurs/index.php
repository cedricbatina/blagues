<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/acces.inc.php');

if (!utilisateurEstConnecte()) {
 include '../connexion.html.php';
 exit();
}
if (!roleUtilisateur('Administrateur de comptes')) {
 $erreur = 'Seuls les administrateurs de comptes peuvent accéder à cette page.';
 include '../accesrefuse.html.php';
 exit();
}



$query = 'SELECT id , nom FROM auteurs';
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = 'Impossible de lire la liste des auteurs' .  mysqli_error($lien);
 exit();
}
/////
if (mysqli_num_rows($resultat) > 0) {
 $auteurs = array();

 while ($ligne = mysqli_fetch_array($resultat)) {
  $auteurs[] = array('id' => $ligne['id'], 'nom' => $ligne['nom']);
 }
} else {
 $erreur = "Impossible d'afficher la liste ";
}
/////////

include 'auteurs.html.php';

////Suppression de l'auteur
if (isset($_POST['action']) and $_POST['action'] == 'Supprimer') {
 $query = "SELECT id FROM blagues WHERE id_auteur = '$id";
 $resultat = mysqli_query($lien, $query);
 $ligne = mysqli_fetch_array($resultat);
 if (!$resultat) {
  $erreur = 'Impossible de trouver les blagues';
  exit();
 }
 while ($ligne) {
  $id_blague = $ligne[0];
 }
 // suppression des entrées de blagues dans blague_categ
 $query = "DELETE FROM blague_categ WHERE id_blague = '$id_blague'";
 $resultat =  mysqli_query($lien, $query);
 if (!$resultat) {

  $erreur = 'Impossible de supprimer la blague dans blague_categ';
  exit();
 }

 ////suppression des blagues appartenant à l'auteur
 $query = "SELECT FROM blagues WHERE id_auteur = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible de supprimer les blagues de cet auteur";
  exit();
 }
 ///////suppression de l'auteur
 $query = "DELETE FROM auteurs WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible de supprimer l''auteur";
  exit();
 }
 header('Location: .');
 die();
}

if (isset($_GET['ajout'])) {
 $titre_page = 'Nouvel auteur';
 $action = 'ajoutform';
 $nom = '';
 $mail = '';
 $id = '';
 $bouton = 'Ajouter auteur';
 include 'form.html.php';
 exit();
}
if (isset($_GET['ajoutform'])) {
 $nom = mysqli_real_escape_string($lien, $_POST['nom']);
 $mail = mysqli_real_escape_string($lien, $_POST['mail']);
 $query = "INSERT INTO auteurs (nom, mail) VALUES ('$nom','$mail'  )";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible d''ajouter l'auteur";
  exit();
 }
 header('Location: .');
 die();
}
if (isset($_POST['action']) and $_POST['action'] == 'Modifier') {
 $id =
  mysqli_real_escape_string($lien, $_POST['id']);
 $query = "SELECT id, nom , mail FROM auteurs WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);

 if (!$resultat) {
  $erreur = "Impossible de trouver l''auteur.";
 }
 $ligne = mysqli_fetch_array($resultat);
 $titre_page = "Modification d'auteur";
 $action = 'modiform';
 $nom = $ligne['nom'];
 $mail = $ligne['mail'];
 $id = $ligne['id'];
 $bouton = 'Modifier auteur';
 include 'form.html.php';
}
