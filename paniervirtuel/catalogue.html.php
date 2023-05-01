<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/auxiliaires.inc.php');
?>
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
 <title>Catalogue des produits</title>
</head>

<body>
 <div class="container container-fluid">
  <p class="text-center">Voir votre panier <?php echo count($_SESSION['panier']); ?> articles</p>
  <p><a href="?panier">Votre panier</a></p>
  <table class="table table-dark table-striped">
   <thead>
    <tr>
     <th>Description</th>
     <th>Prix</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($articles as $article) : ?>
     <tr>
      <td><?php print_html($article['desc']); ?></td>
      <td>
       <?php print_html($article['prix'], 2, ",", " "); ?> &euro;
      </td>
      <td>
       <form action="" method="post">
        <div>
         <input type="hidden" name="id" value="<?php print_html($article['id']); ?>">
         <input type="submit" name="action" value="Acheter" />
        </div>
       </form>
      </td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>
  <p>
   Tous les prix sont en euros imaginaires.
  </p>
 </div>
</body>

</html>