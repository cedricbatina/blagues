<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/acces.inc.php');

if (!utilisateurEstConnecte()) {
 $erreur = '../connexion.html.php';
 exit();
}
if (!roleUtilisateur('Éditeur de contenu')) {
 $erreur =  'Seuls les éditeurs de contenu peuvent accéder à cette page.';
 include '../connexion.html.php';
 exit();
}



$query = "SELECT id, nom FROM auteurs";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Impossible d'afficher les auteurs";
 //

}
$ligne = mysqli_fetch_array($resultat);
if (mysqli_num_rows($resultat) > 0) {
 $categories = array();

 while ($ligne = mysqli_fetch_array($resultat)) {
  $categories[] = array('id' => $ligne['id'], 'nom' => $ligne['nom']);
 }
} else {
 $erreur = "Impossible d'afficher la liste ";
}
include 'form_recherche.html.php';




if (isset($_GET['action']) && $_GET['action'] == 'Rechercher') {
 $select = 'SELECT id, texte_blague';
 $from = 'FROM blagues';
 $where = 'WHERE TRUE';
 $id_auteur = mysqli_real_escape_string($lien, $_GET['auteur']);
 if ($id_auteur != '') {
  $where .= " && id_auteur = '$id_auteur'";
 }
}

$id_categ = mysqli_real_escape_string($lien, $_GET['categorie']);
if ($id_categ != '') {
 $from .= 'INNER JOIN blague_categ ON id = id_blague';
 $where .= " && id_categ= '$id_categ'";
}
$texte = mysqli_real_escape_string($lien, $_GET['texte']);
if ($texte != '') {
 $where .= " && texte_blague LIKE '%$texte%'";
}
$query = ($select . $from . $where);
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Impossible d'afficher les blagues";
 exit();
}
$ligne = mysqli_fetch_array($resultat);
if (mysqli_num_rows($ligne) > 0) {
 while ($ligne) {
  $blagues[] = array('id' => $ligne['id'], 'texte_blage' => $ligne['texte_blague']);
 }
} else {
 $erreur = "Impossible d'afficher les blagues";
}
include 'blagues.html.php';

if (isset($_GET['ajout'])) {
 $titre_page = 'Nouvelle blague';
 $action = 'ajoutform';
 $texte = '';
 $id_auteur = '';
 $bouton = 'Ajouter blague';
}


if (isset($_POST['action']) && $_POST['action'] == 'Modifier') {
 $id = mysqli_real_escape_string($lien, $_POST['id']);
 $query = "SELECT id, texte_blague, id_auteur FROM blagues WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Erreur de récupération de la liste des auteurs.";
  //exit()
 }
 $ligne = mysqli_fetch_array($resultat);
 $titre_page = "Modification d\une blague";
 $action = 'modiform';
 $texte = $ligne['texte_blague'];
 $id_auteur = $ligne['id_auteur'];
 $id = $ligne['id'];
 $bouton = 'Modifier blague';
}
/////construction de la liste des auteurs
$query = "SELECT id, nom FROM auteurs";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Erreur de récupération de la liste des auteurs.";
 //exit();
}
$ligne = mysqli_fetch_array($resultat);
if (mysqli_num_rows($ligne) > 0) {
 while ($ligne) {
  $auteurs[] = array('id' => $ligne['id'], 'nom' => $ligne['nom']);
 }
} else {
 $erreur = "Impossible de récupérer la liste des auteurs"; // die();
}

/////Récupération de la liste des catégories contenant cette blague
$query = "SELECT id_categ FROM blague_categ WHERE id_blague= '$id'";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Erreur de récupération de la liste des auteurs.";
 exit();
}
$ligne = mysqli_fetch_array($resultat);
if (mysqli_num_rows($ligne) > 0) {
 while ($ligne) {
  $categSelectionnees[] = $ligne['id_categ'];
 }
} else {
 $erreur = "Impossible de lire la liste des auteurs"; //die();
}


////construction de liste de toutes les  catégories
$query = "SELECT id , nom FROM categories";
$resultat = mysqli_query($lien, $query);
if (!$resultat) {
 $erreur = "Erreur de récupération de la liste des auteurs.";
 exit();
}
$ligne = mysqli_fetch_array($resultat);
$ligne = mysqli_fetch_array($resultat);
if (mysqli_num_rows($ligne) > 0) {
 while ($ligne) {
  while ($ligne) {
   $categories[] = array('id' => $ligne['id'], 'nom' => $ligne['nom'], 'selected' => in_array($ligne['id'], $categSelectionnees));
  }
 }
} else {
 $erreur = "Impossible de lire la liste des auteurs"; // die();
}
////////
//////////
include 'form.html.php';
//die();
if (isset($_GET['ajoutform'])) {
 $texte = mysqli_real_escape_string($lien, $_POST['texte']);
 $auteur = mysqli_real_escape_string($lien, $_post['auteur']);
 $date_blague = date();
 $id_auteur = $auteur;
 $query = "INSERT INTO blagues  (texte_blague, date_blague, id_auteur) VALUES ('$texte', '$date_blague', '$auteur') ";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible d'ajouter une blague."; // die();
 }
 $id_blague = mysqli_insert_id($lien);
}
if (isset($_post['categories'])) {
 foreach ($_POST['categories'] as $categorie);
 $id_categ = mysqli_real_escape_string($lien, $categorie);
 $query = "INSERT INTO blague_categ SET id_blague = '$id_blague'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = 'Impossible d\'insérer la blague dans la catégorie';
  exit();
 }
 header('Location: .');
 //die();
}
if (isset($_GET['modifform'])) {
 $texte = mysqli_real_escape_string($lien, $_POST['$texte']);
 $auteur = mysqli_real_escape_string($lien, $_POST['$auteur']);
 $id = mysqli_real_escape_string($lien, $_POST['$id']);
 if ($auteur == '') {
  $erreur = 'Il faut un auteur pour cette blague';
  die();
  $query = "UPDATE blagues SET texte_blague = '$texte', id_auteur = '$auteur' WHERE id='$id'";

  if (!mysqli_query($lien, $query)) {
   $erreur = 'Erreur de modification de la blague';
   die();
  }
  header('Location: . ');
  die();
 }
 $query = "DELETE FROM blague_categ WHERE id_blague='$id'";
 if (!mysqli_query($lien, $query)) {
  $erreur = "Impossible de supprimer la blague dans les catégories";
  exit();
 }
 if (isset($_Post['categories'])) {
  foreach ($_POST['categories'] as $categorie) {
   $id_categ = mysqli_real_escape_string($lien, $categorie);
   $query = "INSERT INTO blague_categ SET id_blague='$id', id_categ= '$id_categ'";
   if (!mysqli_query($lien, $query)) {
    $erreur = "Impossible d'insérer la blague dans la catégorie choisie";
    exit();
   }
  }
 }
 header('Location: .');
 die();
}
