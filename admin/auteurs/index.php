<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/acces.inc.php');
///////
if (!utilisateurEstConnecte()) {
 include '../connexion.html.php';
 exit();
}
////////
if (!roleUtilisateur('Administrateur de comptes')) {
 $erreur = 'Seuls les administrateurs de comptes peuvent accéder à cette page.';
 include '../accesrefuse.html.php';
 exit();
}
//////
if (isset($_GET['ajout'])) {
 include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');

 $titre_page = 'Nouvel auteur';
 $action = 'ajoutform';
 $nom = '';
 $mail = '';
 $id = '';
 $bouton = 'Ajouter auteur';
 //construction de la liste des rôles
 $query = "SELECT id, description FROM roles";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Erreur de récupération de la liste des rôles";
  include 'erreur.html.php';
  exit();
 }
 $roles = array();
 while ($ligne = mysqli_fetch_array(($resultat))) {
  $roles[] = array('id' => $ligne['id'], 'description' => $ligne['description'], 'selected' => false);
 }
 include 'form.html.php';
 exit();
}
/////
if (isset($_GET['ajoutform'])) {
 $nom = mysqli_real_escape_string($lien, $_POST['nom']);
 $mail = mysqli_real_escape_string($lien, $_POST['mail']);
 $query = "INSERT INTO auteurs (nom, mail) VALUES ('$nom','$mail'  )";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible d''ajouter l'auteur";
  exit();
 }

 $id_auteur = mysqli_insert_id($lien);
 if ($_POST['mdp'] != '') {
  $mdp = md5($_POST['mdp'] . 'ijdb');
  $mdp = mysqli_real_escape_string($lien, $mdp);
  $query = "UPDATE auteurs SET mdp = '$mdp' WHERE id = '$id_auteur' ";
  if (isset($_POST['roles'])) {
   foreach ($_POST['roles'] as $role) {
    $id_role = mysqli_real_escape_string($lien, $role);
    $query = "INSERT INTO roles_auteurs SET id_auteur = '$id_auteur' , id_role = '$id_role'";
    if (!mysqli_query($lien, $query)) {
     $erreur = "Erreur d'affectation du role à l'auteur";
     include 'erreur.html.php';
     exit();
    }
   }
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
  $action = 'modifform';
  $nom = $ligne['nom'];
  $mail = $ligne['mail'];
  $id = $ligne['id'];
  $bouton = 'Modifier auteur';
  ////Récupération de la liste des rôles affectés à cet auteur
  $query = "SELECT id_role FROM auteurs_roles WHERE id_auteur = '$id'";
  $resultat = mysqli_query($lien, $query);
  if (!$resultat) {
   $erreur = 'Erreur de récupération des rôles affectés.';
   include 'erreur.html.php';
   exit();
  }
  $rolesChoisis = array();
  while ($ligne = mysqli_fetch_array($resultat)) {
   $rolesChoisis[] = $ligne['id_role'];
  }
  ///construction de la liste de tous les rôles 
  $query = "SELECT id, description FROM roles";
  $resultat = mysqli_query($lien, $query);
  if (!$resultat) {
   $erreur =  "Impossible d'afficher les roles";
   include 'erreur.html.php';
   exit();
  }
  $roles = array();
  while ($ligne = mysqli_fetch_array($resultat)) {
   $roles[] = array('id' => $ligne['id'], 'description' => $ligne['description'], 'selected' => in_array($ligne['id'], $rolesChoisis));
  }
  include 'form.html.php';
  exit();
 }
}
////
if (isset($_GET['modifform'])) {
 include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
 $id =  mysqli_real_escape_string($lien, $_POST['id']);
 $nom =  mysqli_real_escape_string($lien, $_POST['nom']);
 $mail =  mysqli_real_escape_string($lien, $_POST['mail']);
 $query = "UPDATE auteurs SET nom = '$nom' , mail = '$mail' WHERE id = '$id'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Impossible de modifier les coordonnées de l'auteur";
  include 'erreur.html.code';
  exit();
 }
 if ($_POST['mdp'] != '') {
  $mdp = md5($_POST['mdp'] . 'bdbi');
  $mdp =  mysqli_real_escape_string($lien, $mdp);
  $query = "UPDATE auteurs SET mdp = '$mdp' WHERE id = $'id'";
  $resultat = mysqli_query($lien, $query);
  if (!$resultat) {
   $erreur = "Impossible de modifier les coordonnées de l'auteur";
   include 'erreur.html.code';
   exit();
  }
 }
 $query = "DELETE FROM auteurs_roles WHERE id_auteur =  '$id'";
 if (!mysqli_query($lien, $query)) {
  $erreur = "Impossible de supprimer le rôle de l'auteur";
  include 'erreur.html.code';
  exit();
 }
 if (isset($_POST['roles'])) {
  foreach ($_POST['roles'] as $role) {
   $id_role = mysqli_real_escape_string($lien, $role);
   $query = "INSERT INTO auteurs_roles SET id_auteur = '$id', id_role = '$id_role'";
   if (!mysqli_query($lien, $query)) {
    $erreur = "Impossible de supprimer le rôle de l'auteur";
    include 'erreur.html.code';
    exit();
   }
  }
  $id_role = mysqli_real_escape_string($lien, $role);
  $query = "INSERT INTO auteurs_roles SET id_auteur = '$id', id_role='$id_role'";
  if (!mysqli_query($lien, $query)) {
   $erreur = "Impossible d'affecter le rôle de l'auteur";
   include 'erreur.html.code';
   exit();
  }
 }
 header('Location : .');
 exit();
}


/////////

include 'auteurs.html.php';

////Suppression de l'auteur
if (isset($_POST['action']) and $_POST['action'] == 'Supprimer') {
 $id = mysqli_real_escape_string($lien, $_POST['id']);
 ////suppression des rôles affectés à cet auteur
 $query = "DELETE FROM auteurs_roles WHERE id_auteur =  '$id'";
 if (!mysqli_query($lien, $query)) {
  $erreur = "Impossible de supprimer le rôle de l'auteur";
  include 'erreur.html.code';
  exit();
 }

 ////////on reécupère les blagues de cet auteur
 $query = "SELECT id FROM blagues WHERE id_auteur = '$id";
 $resultat = mysqli_query($lien, $query);
 $ligne = mysqli_fetch_array($resultat);
 if (!$resultat) {
  $erreur = 'Impossible de trouver les blagues';
  exit();
 }
 while ($ligne = mysqli_fetch_array($resultat)) {
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
/////
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
