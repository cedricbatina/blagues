<?php
function roleUtilisateur()
{
 include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
 $mail = mysqli_real_escape_string($lien, $_SESSION['mail']);
 $role = mysqli_real_escape_string($lien, $_SESSION[$role]);
 $query = "SELECT COUNT (*) FROM auteurs INNER JOIN auteurs_roles ON auteurs.id = id_auteur INNER JOIN roles ON id_role = roles.id WHERE mail = '$smail' AND roles.id='$role'";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = "Erreur lors de la recherche des rôles de l'auteur ..";
  include 'erreur.html.php';
  exit();
 }
 $ligne = mysqli_fetch_array($resultat);
 if ($ligne[0] > 0) {
  return TRUE;
 } else {
  return FALSE;
 }
}




function utilisateurEstConnecte()
{
 if (isset($_POST['action']) && $_POST['action'] == 'connexion') {
  if (!isset($_POST['mail']) || $_POST['mail'] = ''  || (!isset($_POST['mdp']) || $_POST['mdp'] = '')) {
   $GLOBALS['erreurConnexion'] = 'Vous devez remplir ces deux champs.';
   return FALSE;
  }
  $mdp = md5($_POST['mdp'] . 'bdi');


  if (baseContientAuteur($_POST['mail'], $mdp)) {
   session_start();
   $_SESSION['connecté'] = TRUE;
   $_SESSION['mail'] = $_POST['mail'];
   $_SESSION['mdp'] = $_POST['mdp'];
   return TRUE;
  } else {
   session_start();
   unset($_SESSION['connecté']);
   unset($_SESSION['mail']);
   unset($_SESSION['mdp']);
   $GLOBALS['erreurConnexion'] = "L'adresse indiquée ou le mot de passe est incorrect";
   return FALSE;
  }
 }
 if (isset($_POST['action']) && $_POST['action'] == 'deconnexion') {
  session_start();
  unset($_SESSION['connecté']);
  unset($_SESSION['mail']);
  unset($_SESSION['mdp']);
  header('Location : ' . $_POST['goto']);
  exit();
 }
 session_start();
 if (isset($_SESSION['connecté'])) {
  return baseContientAuteur($_SESSION['mail'], $_SESSION['mdp']);
 }
}
////

///






////
function baseContientAuteur($mail, $mdp)
{
 include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
 $mail =  mysqli_real_escape_string($lien, $mail);
 $mdp =  mysqli_real_escape_string($lien, $mdp);
 $query = "SELECT COUNT(*) FROM auteurs WHERE mail = '$mail' AND mdp = '$mdp' ";
 $resultat = mysqli_query($lien, $query);
 if (!$resultat) {
  $erreur = 'Erreur lors de la recherche de l\'auteur';
  include './admin/erreur.html.php';
  exit();
 }
 $ligne = mysqli_fetch_array($resultat);
 if ($ligne[0] > 0) {
  return TRUE;
 } else {
  return FALSE;
 }
}
