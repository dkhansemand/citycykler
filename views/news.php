<h3 class="view-title">Nyheder</h3>
<section id="newsProducts">
    <?php
    if(!empty(Router::GetParam(':OPT')) && Router::GetParam(':OPT') === 'Alle'){
        $currentPage = !empty(Router::GetParam(':NPAGE')) ? Router::GetParam(':NPAGE') : 1;
        Pagination::Init(Product::GetLatestProducts(20));
        Pagination::$limit = 2;
        foreach(Pagination::Items($currentPage) as $product){
        ?>
        <article>
            <div class="product-item">
                <h3><?=$product->brandName . ' ' . $product->productModel?></h3>
                <p><?= (strlen($product->productDesc) > 185) ? substr($product->productDesc, 0, 181) . ' ...' : $product->productDesc ?></p>
                <p><?=$product->addDate?></p>
                <div class="product-info">
                    <p>Pris: <?=number_format($product->productPrice, 0, '.', '.')?> kr.</p>
                    <a href="<?=Router::Link('/Produkt/'.ucfirst($product->categoryTypeName).'/'.$product->categoryName.'/'.$product->productId)?>">Mere info</a>
                </div>
            </div>
            <div class="product-img">
                <img src="<?=Router::$BASE?>assets/media/<?=$product->filename?>" width="116" height="80" alt="<?=$product->brandName . ' ' . $product->productModel?>">
            </div>
        </article>
        <?php
        }
        ?>
        <div class="pages">
            <p>Side</p>
            <?php
                for($page = 1; $page <= Pagination::Pages(); $page++){
            ?>
                <a href="<?=Router::Link('/Nyheder/Alle/'.$page)?>" class="<?= ($page == $currentPage) ? 'currentPage' : ''?>"><?=$page?></a>
            <?php } ?>
        </div>
    <?php
    }else{
        foreach(Product::GetLatestProducts(2) as $product){
        ?>
        <article>
            <div class="product-item">
                <h3><?=$product->brandName . ' ' . $product->productModel?></h3>
                <p><?= (strlen($product->productDesc) > 185) ? substr($product->productDesc, 0, 181) . ' ...' : $product->productDesc ?></p>
                <p><?=$product->addDate?></p>
                <div class="product-info">
                    <p>Pris: <?=number_format($product->productPrice, 0, '.', '.')?> kr.</p>
                    <a href="<?=Router::Link('/Produkt/'.ucfirst($product->categoryTypeName).'/'.$product->categoryName.'/'.$product->productId)?>">Mere info</a>
                </div>
            </div>
            <div class="product-img">
                <img src="<?=Router::$BASE?>assets/media/<?=$product->filename?>" width="116" height="80" alt="<?=$product->brandName . ' ' . $product->productModel?>">
            </div>
        </article>
        <?php
        }
        ?>
        <div class="pages">
            <a class="news-link" href="<?=Router::Link('/Nyheder/Alle')?>">Se flere nyheder</a>
        </div>
    <?php
    }
    ?>
</section>
