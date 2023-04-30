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
 <title>Gestion des catégories</title>
</head>

<body>
 <div class="container container-fluid">
  <h1 class="text-centet">Gestion des catégories</h1>
  <p><a href="?add">Ajouter une nouvelle catégorie</a></p>
  <ul>
   <?php foreach ($categories as $categorie) : ?>
    <li>
     <form action="" method="post">
      <div>
       <?php print_html($categorie['nom']); ?>
       <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>" />
       <input type="submit" value="Modifier" name="action" />
       <input type="submit" value="Supprimer" name="action" />

      </div>
     </form>
    </li>
   <?php endforeach; ?>
  </ul>
 </div>
</body>

</html>