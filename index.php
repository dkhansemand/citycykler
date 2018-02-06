<?php
    
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'init.php';
    
    Router::SetDefaultRoute('/Forsiden');
    Router::SetViewFolder(__DIR__.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

    Router::AddEndpoint('/Forsiden','home.php', ['title' => 'Forsiden']);
    Router::AddEndpoint('/Kategori/:CATEGORY','categories.php', ['title' => 'Kategorier']);
    Router::AddEndpoint('/Produkter/:CATEGORY/:CATEGORYNAME/:PAGE','products.php', ['title' => 'Produkter']);
    Router::AddEndpoint('/Produkt/:CATEGORY/:CATEGORYNAME/:ID', 'productView.php', ['title' => 'Vis produkt']);
    Router::AddEndpoint('/Soegning/:QPAGE', 'search.php', ['title' => 'Advanceret søgning']);
    Router::AddEndpoint('/Nyheder/:OPT/:NPAGE', 'news.php', ['title' => 'Nyheder']);
    Router::AddEndpoint('/Kontakt', 'contact.php', ['title' => 'Kontakt']);

    Router::Init($_SERVER['REQUEST_URI']);

    $siteInfo = SiteSettings::GetSiteInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$siteInfo->siteTitle?> | <?=Router::ViewTitle()?></title>
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
                            <input type="text" name="searchVal" id="searchVal" required><br>
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
                <a href="<?=Router::Link('/Kontakt')?>" class="<?=Router::IsActive(['/Kontakt'])?>">Kontakt</a>
                <a href="<?=Router::Link('/Nyheder')?>" class="<?=Router::IsActive(['/Nyheder'])?>">Nyheder</a>
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
                    <?php
                    $offerList = Offer::GetOffersLimit();
                    if(sizeof($offerList) > 0){
                        foreach($offerList as $offer)
                        {
                    ?>
                        <a href="<?=Router::Link('/Produkt/'.$offer->categoryTypeName.'/'.$offer->categoryName.'/'.$offer->productId)?>">
                            <div class="product-item">
                                <h4><?=$offer->brandName . ' ' . $offer->productModel?></h4>
                                <img src="<?=Router::$BASE?>assets/media/<?=$offer->filename?>" alt="<?=$offer->brandName . ' ' . $offer->productModel?>" height="48" width="69">
                                <p class="price-before">Før: <span class="line"><?=number_format($offer->productPrice, 0, '.', '.')?></span> kr.</p>
                                <p class="price-after">Nu kun <?=number_format($offer->offerPrice, 0, '.', '.')?> kr.</p>
                            </div>
                        </a>
                    <?php
                        }
                    }else{
                        echo '<p>Vi har desværre ingen varer på tilbud i øjeblikket.</p>';
                    }
                    ?>
                </div>
            </section>
        </section>
        <footer>
            <p><?=$siteInfo->siteTitle?>, <?=$siteInfo->street?>, <?=$siteInfo->zipcode?> <?=$siteInfo->city?>, ( +45 ) <?=$siteInfo->phone?>, <?=$siteInfo->email?></p>
        </footer>
    </section>
</div>
</body>
</html>