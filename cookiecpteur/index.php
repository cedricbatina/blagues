<?php
if (!isset($_COOKIE['visites'])) {
 $_COOKIE['visites'] = 0;
}

$visites = $_COOKIE['visites'] + 1;


setcookie('visites', $visites, time() + 3600 * 24 * 365);
include 'bienvenue.html.php';
