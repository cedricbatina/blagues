<?php
include($_SERVER['DOCUMENT_ROOT'] . '/blagues/includes/auxiliaires.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Dépot de fichiers</title>
</head>

<body>
 <div class="container container-fluid">
  <form action="" method="post" enctype="multipart/form-data">
   <div>
    <label for="depot">Choisissez le fichier à déposer :
     <input type="file" name="depot" id="depot">
    </label>
   </div>
   <div><label for="desc">Description du fichier:
     <input type="text" id="desc" name="desc" maxlength="255">

    </label></div>
   <div>
    <input type="hidden" name="action" value="depot">
    <input type="submit" value="Envoi">
   </div>
  </form>
  <?php if (count($fichiers) > 0) : ?>
   <div>
    <p>La base de données comprend les fichiers suivants: </p>
    <table>
     <thead>
      <tr>
       <th>Nom</th>
       <th>Type</th>
       <th>Description</th>
      </tr>
     </thead>
     <tbody>
      <?php foreach ($fichiers as $fichier) : ?>
       <tr valign="top">
        <td>
         <a href="?action=voir&amp;id=<?php print_html($f['id']); ?>">
          <?php print_html($f['nomfic']); ?></a>
        </td>
        <td><?php print_html($f['typemime']); ?></td>
        <td><?php print_html($f['description']); ?></td>
        <td>
         <form action="" method="post">
          <div>
           <input type="hidden" name="action" value="télécharger">
           <input type="hidden" name="id" value="<?php print_html($f['id']); ?>">
           <input type="submit" value="Télécharger">
          </div>
         </form>
        </td>
        <td>
         <form action="" method="post">
          <input type="hidden" name="action" value="supprimer">
          <input type="hidden" name="id" value="<?php print_html($f['id']); ?>">
          <input type="submit" value="Supprimer">

         </form>
        </td>
       <?php endforeach; ?>
     </tbody>
    </table>
   </div>
  <?php endif; ?>

 </div>

</body>

</html>