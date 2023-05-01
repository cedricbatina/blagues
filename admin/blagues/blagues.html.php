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
      <!-- Include the Font Awesome CSS file -->

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="stylefile.css" />
      <title>Gestion des blagues : résultat de la recherche</title>
</head>

<body>
      <div class="container container-fluid">
            <h1 class="text-center">Résultat de la recherche</h1>
            <?php if (isset($blagues)) : ?>
                  <table>
                        <tr>
                              <th>
                                    Texte de la blague
                              </th>
                              <th>
                                    Options
                              </th>

                        </tr> <?php
                              var_dump($blagues);
                              foreach ($blagues as $blague) : ?>
                              <tr valign="top">
                                    <td><?php print_html($blague['texte_blague'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                          <?php print_html($blague['texte_texte']); ?>
                                    </td>
                                    <td>
                                          <form action="" method="post">
                                                <div><input type="hidden" name="id" value="<?php print_html($blague['id']); ?>"><input type="submit" name="action" value="Modifier">
                                                      <input type="submit" name="action" value="Supprimer">
                                                </div>
                                          </form>
                                    </td>
                              </tr>
                        <?php endforeach; ?>
                  </table> <?php endif; ?>
            <p><a href="?">Nouvelle recherche</a></p>
            <p><a href="#">Retour à l'accueil du SGB</a></p>
            <?php include './admin/deconnexion.html.php'; ?>
      </div>
</body>

</html>