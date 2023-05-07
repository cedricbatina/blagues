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
 <title>Document</title>
</head>

<body>
 <div class="container container-fluid">
  <h1 class="text-center"><?php print_html($titre_page); ?></h1>
  <form action="<?php print_html($action); ?>" method="post">
   <div>
    <label for="nom">Nom :<input type="text" name="nom" id="nom" value="<?php print_html($nom); ?>" /></label>

   </div>
   <div>
    <label for="mail">Mail : <input type="text" name="mail" id="mail" value="<?php print_html($mail); ?>"> </label>

   </div>
   <div>
    <label for="mdp">Configurer le mot de passe : <input type="password" name="mdp" id="mdp" /> </label>
   </div>
   <fieldset>
    <legend>Rôles : </legend>
    <?php for ($i = 0; $i < count($roles); $i++) : ?>
     <div>
      <label for="role<?php echo $i; ?>">
       <input type="checkbox" name="roles[]" id="role<?php echo $i; ?>" value="<?php print_html($roles[$i]['id']); ?>" <?php if ($roles[$i]['selected']) {
                                                                                                                       echo 'checked = checked';
                                                                                                                      }; ?> /><?php print_html($roles[$i]['id']); ?></label>
      <?php print_html($roles[$i]['description']); ?>
     </div> <?php endfor; ?>
   </fieldset>


   <div><input type="hidden" name="id" value="<?php print_html($id); ?>">
    <input type="submit" value="<?php print_html($bouton); ?>">
   </div>
  </form>
 </div>
</body>

</html>