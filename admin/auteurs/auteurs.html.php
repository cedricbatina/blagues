<?php

include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/auxiliaires.inc.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Include the Font Awesome CSS file -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="stylefile.css" />
  <title>Document</title>
</head>

<body>
  <div class="container container-fluid">
    <h1 class="text-center">
      Gestion des auteurs

    </h1>
    <p><a href="?ajout">Ajouter un nouvel auteur</a></p>
    <ul>
      <?php if (isset($auteurs)) {
        var_dump($auteurs);
        foreach ($auteurs as $auteur) : ?>
          <li>
            <form action="" method="post">
              <div>
                <?php print_html($auteur['nom']); ?>
                <input type="hidden" name="id" value="<?php echo $auteur['id']; ?>">
                <input type="submit" name="action" value="Modifier" />
                <input type="submit" name="action" value="Supprimer" />
              </div>
            </form>
          </li>
      <?php endforeach;
      } ?>
    </ul>
    <p><a href="#">Retour à l'accueil du SGB</a></p>
    <?php include './admin/deconnexion.html.php'; ?>
  </div>
</body>

</html>