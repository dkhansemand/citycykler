<?php
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php';
    //require_once __DIR__ . DIRECTORY_SEPARATOR . 'Guard-class.php';

    Router::SetDefaultRoute('/Dashboard');
    Router::SetViewFolder(__DIR__.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

    Router::AddEndpoint('/Login', 'login.php', ['title' => 'Login']);
    Router::AddEndpoint('/Logout', 'logout.php');
    Router::AddEndpoint('/Dashboard','dashboard.php', ['guard' => new Guard(), 'title' => 'Dashboard']);
    Router::AddEndpoint('/EditPages','editpages.php', ['guard' => new Guard(), 'title' => 'Ret sidetekster']);
    Router::AddEndpoint('/Categories','category/categories.php', ['guard' => new Guard(), 'title' => 'Kategorier']);
    Router::AddEndpoint('/Category/Add','category/newCategory.php', ['guard' => new Guard(), 'title' => 'Tilføj ny kategori']);
    Router::AddEndpoint('/Category/Edit/:ID','category/editCategory.php', ['guard' => new Guard(), 'title' => 'Ret kategori']);
    Router::AddEndpoint('/Category/Delete/:ID','category/deleteCategory.php', ['guard' => new Guard(), 'title' => 'Slet kategori']);
    Router::AddEndpoint('/Brands','brands/brands.php', ['guard' => new Guard(), 'title' => 'Mærker']);
    Router::AddEndpoint('/Brand/Add','brands/newBrand.php', ['guard' => new Guard(), 'title' => 'Tilføj mærke']);
    Router::AddEndpoint('/Brand/Edit/:ID','brands/editBrand.php', ['guard' => new Guard(), 'title' => 'Ret mærke']);
    Router::AddEndpoint('/Brand/Delete/:ID','brands/deleteBrand.php', ['guard' => new Guard(), 'title' => 'Slet mærke']);
    Router::AddEndpoint('/Products','products/productlist.php', ['guard' => new Guard(), 'title' => 'Produkter']);
    Router::AddEndpoint('/Product/Add/:CTYPE','products/newProduct.php', ['guard' => new Guard(), 'title' => 'Tilføj produkt']);
    Router::AddEndpoint('/Product/Edit/:CATEGORYTYPE/:ID','products/editProduct.php', ['guard' => new Guard(), 'title' => 'Ret produkt']);
    Router::AddEndpoint('/Product/Delete/:ID','products/deleteProduct.php', ['guard' => new Guard(), 'title' => 'Slet produkt']);
    Router::AddEndpoint('/ProductColorSecret', 'products/colors.php', ['guard' => new Guard(), 'title' => 'Opret farve']);
    Router::AddEndpoint('/Offers', 'offer/offersList.php', ['guard' => new Guard(), 'title' => 'Tilbuds liste']);
    Router::AddEndpoint('/Offer/Add/:NOBRAND', 'offer/newOffer.php', ['guard' => new Guard(), 'title' => 'Nyt tilbud']);
    Router::AddEndpoint('/Offer/Edit/:OBRAND/:OID', 'offer/editOffer.php', ['guard' => new Guard(), 'title' => 'Ret tilbud']);
    Router::AddEndpoint('/Offer/Delete/:OID', 'offer/deleteOffer.php', ['guard' => new Guard(), 'title' => 'Slet tilbud']);
    Router::AddEndpoint('/Settings', 'settings.php', ['guard' => new Guard(), 'title' => 'Side indstillinger']);

    Router::Init($_SERVER['REQUEST_URI']);
   
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Project adminitration site">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>City Cykler | Admin - <?=Router::ViewTitle()?></title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="<?=Router::$BASE?>images/favicon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="<?=Router::$BASE?>styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Admin - <small><?=Router::ViewTitle()?></small></span>
          <div class="mdl-layout-spacer"></div>
          
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
          <header class="demo-drawer-header">
            <?php if(isset($_SESSION['global'])){   ?>
            <img src="<?=Router::$BASE?>images/user.jpg" class="demo-avatar">
            <div class="demo-avatar-dropdown">
                <span><?= User::GetInfo()->email ?? ''?></span>
                <div class="mdl-layout-spacer"></div>
                <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons" role="presentation">arrow_drop_down</i>
                <span class="visuallyhidden">Context menu</span>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                
                <li class="mdl-menu__item"><a class="mdl-navigation__link" href="<?=Router::Link('/Logout');?>"><i class="material-icons">exit_to_app</i> Logout</a></li>
                <li class="mdl-menu__item"><a class="mdl-navigation__link" href="../"><i class="material-icons">keyboard_backspace</i>  Til forsiden</a></li>
                </ul>
            </div>
          <?php }?>
        </header>
        
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="<?=Router::Link('/Dashboard')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Dashboard</a>
          <a class="mdl-navigation__link" href="<?=Router::Link('/EditPages')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Ret sidetekster</a>
          <a class="mdl-navigation__link" href="<?=Router::Link('/Categories')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i>Kategorier</a>
          <a class="mdl-navigation__link" href="<?=Router::Link('/Brands')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">receipt</i>Mærker</a>
          <a class="mdl-navigation__link" href="<?=Router::Link('/Products')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">store</i>Produkter</a>
          <a class="mdl-navigation__link" href="<?=Router::Link('/Offers')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Tilbud</a>
          <a class="mdl-navigation__link" href="<?=Router::Link('/Settings')?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Indstillinger</a>
          <div class="mdl-layout-spacer"></div>
          
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid mdl-grid--no-spacing demo-content">
          <?php require_once Router::GetView(); ?>
        </div>
        
    </main>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer__right-section">
                <div class="mdl-logo">Admin</div>
                <ul class="mdl-mini-footer__link-list">
                    <li>City Cykler &copy; <?=date('Y')?></li>
                </ul>
            </div>
        </footer>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
