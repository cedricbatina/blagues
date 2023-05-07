<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/magicquotes.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/auxiliaires.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <link rel="canonical" />
</head>

<body>
 <div class="container container-fluid">
  <h1 class="text-center">Blagues récentes</h1>
  <p>Voici les blagues les plus récentes</p>
  <?php foreach ($blagues as $blague) : ?>
   <div>
    <?php print_bbcode($blague['texte']); ?>
    <?php print_bbcode($blague['auteur']); ?>
   </div>
  <?php endforeach; ?>
 </div>
 <div>
  <form action="index.php" enctype="multipart/form-data">
   <div>
    <label for="depot" id="depot">Choisissez le fichier à déposer:
     <input type="file" id="depot" name="depot"></label>
   </div>
   <div>
    <input type="hidden" name="action" value="depot">
    <input type="submit" value="Envoi">
   </div>
  </form>
 </div>

</body>

</html>