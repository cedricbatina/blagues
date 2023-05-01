<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/bdi.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');

$articles = array(
 array('id' => '1', 'desc' => 'Concevez un site avec HTML & CSS', 'prix' => 49.95), array('id' => '2', 'desc' => 'Programmation de 7 projets - coaching  (Nouvelle offre)', 'prix' => 1000), array('id' => '3', 'desc' => 'Les bases de Photoshop (2CD)', 'prix' => 49.99), array('id' => '4', 'desc' => 'Simply JavaScript (SitePoint)', 'prix' => 39.95)
);
session_start();
if (!isset($_SESSION['panier'])) {
 $_SESSION['panier'] = array();
}
////
if (isset($_POST['action']) && $_POST['action'] == 'Acheter') {
 //Ajout de l'élément 
 $_SESSION['panier'][] = $_POST['id'];
 header('Location: .');
 exit();
}
////
if (isset($_POST['action']) && $_POST['action'] == 'Vider le panier') {
 // vide le panier $_SESSION['panier]
 unset($_SESSION['panier']);
 header('Location: ?panier');
 exit();
}
////
if (isset($_GET['panier'])) {
 $panier = array();
 $total = 0;
 foreach ($_SESSION['panier'] as $id) {
  foreach ($articles as $produit) {
   if ($produit['id'] == $id) {
    $panier[] = $produit;
    $total += $produit['prix'];
    break;
   }
  }
 }
 include 'panier.html.php';
 exit();
}
include 'catalogue.html.php';
