<?php
include './includes/auxiliaires.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Include the Font Awesome CSS file -->

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="stylefile.css" />

 <title>Document</title>
</head>

<body>
 <div class="container container-fluid">
  <p><a href="?ajoutblague">Ajouter une blague</a></p>
  <h1 class="text-center">
   Voici toutes les blagues
  </h1>
  <?php
  if (isset($blagues)) {
   foreach ($blagues as $blague) : ?>

    <div>
     <form action="?supprblague" method="POST">
      <blockquote>
       <p>
        <?php print_html($blague['texte_blague']); ?>
        <input type="hidden" name="id" value="<?php echo $blague['id']; ?>">
        <input type="submit" value="SUPPRIMER">
       </p>
      </blockquote>
     </form>
    </div>

  <?php
   endforeach;
  }  ?>
 </div>
 </div>
 <?php include './includes/pied_page_statique.inc.html.php'; ?>
</body>

</html>