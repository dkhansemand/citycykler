<?php
    $currentPage = !empty(Router::GetParam(':PAGE')) ? Router::GetParam(':PAGE') : 1;
?>
<h3 class="view-title"><?=ucfirst(Router::GetParam(':CATEGORYNAME'))?></h3>
<!-- <pre>
    <?php //var_dump(Product::GetProductsByCategory(Router::GetParam(':CATEGORYNAME'))) ?>
</pre> -->
<section id="products">
    <?php
    Pagination::Init(Product::GetProductsByCategory(Router::GetParam(':CATEGORYNAME')));
    foreach(Pagination::Items($currentPage) as $product){
    ?>
    <article>
        <div class="product-item">
            <h3><?=$product->brandName . ' ' . $product->productModel?></h3>
            <p><?= (strlen($product->productDesc) > 185) ? substr($product->productDesc, 0, 181) . ' ...' : $product->productDesc ?></p>
            <div class="product-info">
                <p>Pris: <?=round($product->productPrice)?> kr.</p>
                <a href="<?=Router::Link('/Produkt/'.Router::GetParam(':CATEGORY').'/'.Router::GetParam(':CATEGORYNAME').'/'.$product->productId)?>">Mere info</a>
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
        <?php //var_dump(Pagination::Pages()) ?>
        <p>Side</p>
        <?php
            for($page = 1; $page <= Pagination::Pages(); $page++){
        ?>
            <a href="<?=Router::Link('/Produkter/'.Router::GetParam(':CATEGORY').'/'.Router::GetParam(':CATEGORYNAME').'/'.$page)?>" class="<?= ($page == $currentPage) ? 'currentPage' : ''?>"><?=$page?></a>
        <?php } ?>
    </div>
</section>
