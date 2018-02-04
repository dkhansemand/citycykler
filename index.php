<?php
    
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'init.php';
    //require_once __DIR__ . DIRECTORY_SEPARATOR . 'Guard-class.php';
  

    Router::SetDefaultRoute('/Forsiden');
    Router::SetViewFolder(__DIR__.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

    Router::AddEndpoint('/Forsiden','home.php', ['title' => 'Forsiden']);
    Router::AddEndpoint('/Kategori/:CATEGORY','categories.php', ['title' => 'Kategorier']);
    Router::AddEndpoint('/Produkter/:CATEGORY/:CATEGORYNAME/:PAGE','products.php', ['title' => 'Produkter']);
    Router::AddEndpoint('/Produkt/:CATEGORY/:CATEGORYNAME/:ID', 'productView.php', ['title' => 'Vis produkt']);
    Router::AddEndpoint('/Soegning/:QPAGE', 'search.php', ['title' => 'Advanceret søgning']);

    Router::Init($_SERVER['REQUEST_URI']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City Cykler | <?=Router::ViewTitle()?></title>
    <link rel="stylesheet" href="<?=Router::$BASE?>assets/css/style.css">
</head>
<body>
    <div id="headerLayout">
        </div>
        <div id="container">
                <header id="topHeader">
                    <div>
                        <h1>City Cykler</h1>
                        <h2>cykler i alle prisklasser</h2>
                    </div>
                    <div>
                        <form action="<?=Router::Link('/Soegning')?>" method="post" id="headerSearch">
                            <input type="text" name="searchVal" id="searchVal"><br>
                            <button>Søg</button>
                            <a href="<?=Router::Link('/Soegning')?>">Advanceret søg</a>
                        </form>
                    </div>
                </header>

    
    <section id="mainContainer">
        <header>
            <nav>
                <a href="<?=Router::Link('/Forsiden')?>" class="<?=Router::IsActive(['/Forsiden'])?>">Forsiden</a>
                <a href="<?=Router::Link('/Kategori/Cykler')?>" class="<?=Router::IsActive(['/Kategori/Cykler', '/Produkter/Cykler/', '/Produkt/Cykler/'])?>">Cykler</a>
                <a href="<?=Router::Link('/Kategori/Udstyr')?>" class="<?=Router::IsActive(['/Kategori/Udstyr', '/Produkter/Udstyr/', '/Produkt/Udstyr/'])?>">Udstyr</a>
                <a href="#">Kontakt</a>
                <a href="#">Nyheder</a>
            </nav>
        </header>
        <section id="mainContent">
            <article id="content">
                <?php require_once Router::GetView(); ?> 
            </article>
            <span id="split"></span>
            <section id="offersPanel">
                <h3>Tilbud</h3>
                <div class="offers-list">
                    <div class="product-item">
                        <h4>Mærke model</h4>
                        <img src="<?=Router::$BASE?>assets/media/homePicture.png" alt="" height="48" width="69">
                        <p class="price-before">Før: <span class="line"><?=number_format(9999, 0, '.', '.')?></span> kr.</p>
                        <p class="price-after">Nu kun 999 kr.</p>
                    </div>
                    <div class="product-item">
                        <h4>Mærke model</h4>
                        <img src="<?=Router::$BASE?>assets/media/homePicture.png" alt="" height="48" width="69">
                        <p class="price-before">Før: <span class="line">9999</span> kr.</p>
                        <p class="price-after">Nu kun 999 kr.</p>
                    </div>
                    <div class="product-item">
                        <h4>Mærke model</h4>
                        <img src="<?=Router::$BASE?>assets/media/homePicture.png" alt="" height="48" width="69">
                        <p class="price-before">Før: <span class="line">9999</span> kr.</p>
                        <p class="price-after">Nu kun 999 kr.</p>
                    </div>
                </div>
            </section>
        </section>
        <footer>
        </footer>
    </section>
</div>
</body>
</html>