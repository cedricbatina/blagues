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
  <h1 class="tex-center">Gestion des blagues</h1>
  <p><a href="?ajout">Ajouter une nouvelle blague</a></p>
  <form action="" method="get">
   <p>Voir les blagues qui correspondent aux critères suivants:</p>
   <div>
    <label for="auteur">Par auteur</label>
    <select name="auteur" id="auteur">
     <option value="">Tous les auteurs</option>
     <?php foreach ($auteurs as $auteur) : ?>
      <option value="<?php print_html($auteur['id']); ?><?php print_html($auteur['nom']); ?> "></option>
     <?php endforeach; ?>
    </select>
   </div>
   <div class="container container-fluid">
    <label for="categorie">Par categorie : </label>
    <option value="">Toutes les catégories</option>
    <?php foreach ($categories as $categorie) : ?>
     <option value="<?php print_html($categorie['id']); ?>"><?php print_html($categorie['nom']); ?></option>
    <?php endforeach; ?>
   </div>
   <div class="container container-fluid">
    <label for="categorie">Contenant le texte : </label>
    <input type="text" name="texte" id="texte">
   </div>
   <div>
    <input type="hidden" name="action" value="Rechercher" />
    <input type="submit" value="Rechercher" />

   </div>
  </form>
  <p><a href="#">Retour à l'accueil du SGB</a></p>
 </div>


 </h1>

</body>

</html>