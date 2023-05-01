<?php
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
 <title><?php print_html($titre_page); ?></title>
</head>

<body>
 <div class="container container-fluid">
  <h1 class="text-center"><?php print_html($titre_page); ?></h1>
  <form action="?<?php print_html($action); ?>" method="post">
   <div>
    <label for="texte">Saisissez votre blague</label>
    <textarea name="texte" id="texte" cols="50" rows="20">
  <?php print_html($texte); ?>
 </textarea>
   </div>

   <div>
    <label for="auteur">Auteur : </label>
    <select name="auteur" id="auteur">
     <option value="">Choisir un auteur</option>
     <?php foreach ($auteurs as $auteur) : ?>
      <option value="<?php print_html($auteurs['id']); ?>">
       <?php if ($auteur['id'] == $id_auteur) echo 'selected ="selected"'; ?>
       <?php print_html($auteur['nom']); ?>
      </option>
     <?php endforeach; ?>
    </select>
   </div>
   <fieldset>
    <legend>Catégories : </legend>
    <?php foreach ($categories as $categorie) : ?>
     <div>
      <label for="categorie<?php print_html($id); ?>">
       <input type="checkbox" name="categories[]" id="categorie<?php print_html($categorie['id']); ?>" value="<?php print_html($categorie['id']); ?>" <?php if ($categorie['selected']) {
                                                                                                                                                       echo 'selected = "selected"';
                                                                                                                                                      }
                                                                                                                                                      ?> />
      </label>
     </div>
    <?php endforeach; ?>
   </fieldset>
   <div>
    <input type="hidden" name="id" value="<?php print_html($id); ?>">
    <input type="submit" value="<?php print_html($bouton); ?>" </div>
  </form>
 </div>
</body>

</html>
<div class="container container-fluid">

</div>