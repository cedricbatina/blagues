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
 <title>Connexion</title>
</head>

<body>
 <div class="container container-fluid">
  <h1 class="text-center">Connexion</h1>
  <p>
   Vous devez vous connecter pour consulter la page que vous avez demandée.
  </p><?php if (isset($erreurConnexion)) : ?>
   <p><?php echo print_html($erreurConnexion); ?></p>
  <?php endif; ?>
  <form action="" method="post">
   <div>
    <div>
     <label for="mail">Mail : <input type="mail" name="mail" id="mail"></label>
    </div>

    <label for="mdp">Mot de passe : <input type="password" name="mdp" id="mdp"> </label>
   </div>
   <div>
    <input type="hidden" name="action" value="connexion" />
    <input type="submit" value="Connexion" />
   </div>
  </form>
  <p>
   <a href="/admin/">Retour à la page d'accueil de SGB</a>
  </p>
 </div>
</body>

</html>