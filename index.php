<?php
    
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'init.php';
    //require_once __DIR__ . DIRECTORY_SEPARATOR . 'Guard-class.php';
  

    Router::SetDefaultRoute('/Forsiden');
    Router::SetViewFolder(__DIR__.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

    Router::AddEndpoint('/Forsiden','home.php', ['title' => 'Forsiden']);
    Router::AddEndpoint('/Kategori/:CATEGORY','categories.php', ['title' => 'Kategorier']);
    Router::AddEndpoint('/Produkter/:CATEGORY/:CATEGORYNAME','products.php', ['title' => 'Produkter']);


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
                        <form action="#search" method="post" id="headerSearch">
                            <input type="text" name="searchVal" id="searchVal"><br>
                            <button>Søg</button>
                            <a href="#">Advanceret søg</a>
                        </form>
                    </div>
                </header>

    
    <section id="mainContainer">
        <header>
            <nav>
                <a href="<?=Router::Link('/Forsiden')?>" class="<?=Router::IsActive(['/Forsiden'])?>">Forsiden</a>
                <a href="<?=Router::Link('/Kategori/Cykler')?>" class="<?=Router::IsActive(['/Kategori/Cykler', '/Produkter/Cykler/'])?>">Cykler</a>
                <a href="<?=Router::Link('/Kategori/Udstyr')?>" class="<?=Router::IsActive(['/Kategori/Udstyr', '/Produkter/Udstyr/'])?>">Udstyr</a>
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
            </section>
        </section>
        <footer>
        </footer>
    </section>
</div>
</body>
</html>