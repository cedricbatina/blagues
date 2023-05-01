<?php
///////////supprime les affectations des blague à cette catégorie
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');

include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/acces.inc.php');


/*$query = "DELETE FROM categories WHERE id = '$id'";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Impossible de supprimer cette catégorie";
 die();
}*/
if (!utilisateurEstConnecte()) {
 include '../connexion.html.php';
 exit();
}
////
if (!roleUtilisateur('Administrateur du site')) {
 $erreur = 'Seuls les administrateurs du site peuvent accéder à cette page.';
 include '../accesrefuse.html.php';
 exit();
}



if (isset($_GET['ajout'])) {
 $titre_page = 'Nouvelle catégorie';
 $action = 'ajoutfom';
 $nom = '';
 $id = '';
 $bouton = 'Ajouter catégorie';
 include_once './admin/categories/form.html.php';
 //exit();
}
if (isset($_GET['ajoutform'])) {

 $nom = mysqli_real_escape_string($lien, $_POST['nom']);
 $query = "INSERT INTO categories SET nom = '$nom'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = 'Impossible d\'ajouter la catégorie';
  exit();
 }
 exit();
 header(
  'Location : .'
 );
 exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Modifier') {
 $id = mysqli_real_escape_string($lien, $_POST['id']);
 $query = "SELECT id, nom FROM categories WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = 'Erreur de récupération des détails de la catégorie.';
  exit();
 }
 $ligne = mysqli_fetch_array($resultat);
 $titre_page = 'Modification d\'une catégorie';
 $action = 'modiform';
 $nom = $ligne['nom'];
 $id = $ligne['id'];
 $bouton = 'Modifier catégorie';
 include 'form.html.php';
 exit();
}
if (isset($_GET['modiform'])) {
 $id = mysqli_real_escape_string($lien, $_POST['id']);
 $nom = mysqli_real_escape_string($lien, $_POST['nom']);
 $query = "UPDATE categories SET nom = '$nom' WHERE id = '$id'  ";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = 'Impossible de modifier la catégorie';
  exit();
 }
 header('Location : .');
 die();
}
if (isset($_POST['action']) and $_POST['action'] == 'Supprimer') {
 $query = "DELETE FROM blague_categ WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible de supprimer les blagues de cette catégorie.";
  die();
 }
 //// suppression de la catégorie 
 $quey = "DELETE FROM categories WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible de supprimer la catégorie";
  die();
 }
 header('Location : . ');
 die();
}
////affiche la liste des catégories
$query = "SELECT id, nom FROM categories";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Impossible d'afficher les catégories";
 die();
}
$ligne = mysqli_fetch_array($resultat);
if (mysqli_num_rows($resultat) > 0) {
 $categories = array();
 while ($ligne = mysqli_fetch_array($resultat)) {
  $categories[] = array('id' => $ligne['id'], 'nom' => $ligne['nom']);
 }
}
include 'categories.html.php';
