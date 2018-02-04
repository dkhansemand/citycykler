<h3 class="view-title"><?=ucfirst(Router::GetParam(':CATEGORYNAME'))?></h3>
    <?php
        //var_dump(Router::GetParams());
        $product = Product::GetProductById(Router::GetParam(':ID'));
    ?>
<section id="productView">
    <article>
        <h3 class="product-title"><?=$product->brandName . ' ' . $product->productModel?></h3>
        <img src="<?=Router::$BASE?>assets/media/<?=$product->filename?>" width="168" height="116" alt="<?=$product->brandName . ' ' . $product->productModel?>">
        <p class="product-desc"><?=$product->productDesc?></p>
        <p class="product-price">Pris: <?=number_format($product->productPrice, 0, '.', '.')?> Kr.</p>
        <div class="product-colors">
            <h3>Farver</h3>
        <?php
            if(Router::GetParam(':CATEGORY') === 'Cykler'){
                foreach(Product::GetColorsByProductId($product->productId) as $color){
        ?>
                    <img src="data:<?=$color->colorMime?>;base64,<?=base64_encode($color->colorSrc)?>" alt="<?=$color->colorName?>">
            <?php
                }
            }
            ?>
        </div>
    </article>
</section>