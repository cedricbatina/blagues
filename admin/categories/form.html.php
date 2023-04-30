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
  <h1 class="text-center">
   <?php print_html($titre_page); ?>
  </h1>
  <form action="?<?php print_html($action); ?>">
   <div>
    <label for="name">Nom: <input type="text" name="nom" id="nom" value="<?php print_html($nom); ?>"> </label>
   </div>
   <div>
    <input type="hidden" name="id" value="<?php print_html($id); ?>">
    <input type="submit" value="<?php print_html($bouton); ?>">
   </div>

  </form>
 </div>
</body>

</html>