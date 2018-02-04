<h3 class="view-title"><?=ucfirst(Router::GetParam(':CATEGORYNAME'))?></h3>
<!-- <pre>
    <?php //var_dump(Product::GetProductsByCategory(Router::GetParam(':CATEGORYNAME'))) ?>
</pre> -->
<section id="products">
    <article>
        <div class="product-item">
            <h3>mærke model</h3>
            <p>productDesc</p>
            <div class="product-info">
                <p>Pris: xxx kr.</p>
                <a href="#">Mere info</a>
            </div>
        </div>
        <div class="product-img">
            <img src="<?=Router::$BASE?>assets/media/homePicture.png" width="116" height="80" alt="">
        </div>
    </article>
    <div class="pages">
        <p>Side</p>
        <a href="#" class="currentPage">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
    </div>
</section>