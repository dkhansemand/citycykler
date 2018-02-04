<h3 class="view-title"><?=ucfirst(Router::GetParam(':CATEGORYNAME'))?></h3>
<!-- <pre>
    <?php //var_dump(Product::GetProductsByCategory(Router::GetParam(':CATEGORYNAME'))) ?>
</pre> -->
<section id="products">
    <?php
    foreach(Product::GetProductsByCategory(Router::GetParam(':CATEGORYNAME')) as $product){
    ?>
    <article>
        <div class="product-item">
            <h3><?=$product->brandName . ' ' . $product->productModel?></h3>
            <p><?= (strlen($product->productDesc) > 185) ? substr($product->productDesc, 0, 181) . ' ...' : $product->productDesc ?></p>
            <div class="product-info">
                <p>Pris: <?=round($product->productPrice)?> kr.</p>
                <a href="#">Mere info</a>
            </div>
        </div>
        <div class="product-img">
            <img src="<?=Router::$BASE?>assets/media/<?=$product->filename?>" width="116" height="80" alt="">
        </div>
    </article>
    <?php
    }
    ?>
    <div class="pages">
        <p>Side</p>
        <a href="#" class="currentPage">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
    </div>
</section>