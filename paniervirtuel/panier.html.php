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
 <title>Votre panier</title>
</head>

<body>
 <div class="container container-fluid">
  <h1 class="text-center">Votre panier</h1>
  <?php if (count($panier) > 0) : ?>
   <table class="table table-dark table-striped">
    <thead>
     <tr>
      <th>
       Description
      </th>
      <th>
       Prix
      </th>
     </tr>
    </thead>
    <tfoot>
     <tr>
      <td>Total :</td>
      <td><?php echo number_format($total, 2, ',', ' '); ?> &euro;</td>
     </tr>
    </tfoot>
    <tbody>
     <?php foreach ($panier as $produit) : ?>
      <tr>
       <td>
        <?php print_html($produit['desc']); ?>
       </td>
       <td><?php echo number_format($produit['prix'], 2, ',', ' '); ?></td>
      </tr>
     <?php endforeach; ?>
    </tbody>
   </table><?php else : ?>
   <p>Votre panier est vide</p>
  <?php endif; ?>
  <form action="?" method="post
  ">

   <a href="?">Continuez vos achats</a> ou <input type="submit" name="action" value="Vider panier">
  </form>
 </div>
</body>

</html>