<?php

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
