<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<body>
<nav id="nav" class="navbar navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand" href="http://nathalie-mota.local/" rel="home"><img src="/wp-content/themes/Nathalie_Mota/assets/logo.png" alt="logo de la société" /></a>
  <button id="icons" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php 
    wp_nav_menu([
        'theme_location' => 'header',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto'
    ]) 
    ?>
  </div>
</nav>
  <div class="container">