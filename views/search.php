<h3 class="view-title">Advanceret søgning</h3>
<section id="searchForm">
    <form action="" method="post">
            <div class="input-col">
                <div class="input-field">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" required>
                        <option value="0" <?= isset($POST['category']) ? '' : 'selected'?> disabled>-- Vælg --</option>
                        <?php
                            foreach(Category::GetCategories() as $Category)
                            {
                        ?>
                                <option value="<?=$Category->categoryId?>" <?= (@$POST['category'] == $Category->categoryId) ? 'selected' : ''?> ><?=$Category->categoryName?></option>
                        <?php
                            }          
                        ?>
                    </select>    
                    <?= isset($error['category']) ? '<p class="error">'.$error['category'].'</p>' : ''?>
                </div>
                <div class="input-field">
                    <label for="brand">Mærke</label>
                    <select name="brand" id="brand" required>
                        <option value="0" <?= isset($POST['brand']) ? '' : 'selected'?> disabled>-- Vælg --</option>
                        <?php
                            foreach(Brands::GetBrands() as $brand)
                            {
                        ?>
                                <option value="<?=$brand->brandId?>" <?= (@$POST['brand'] == $brand->brandId) ? 'selected' : ''?> ><?=$brand->brandName?></option>
                        <?php
                            }          
                        ?>
                    </select>    
                    <?= isset($error['brand']) ? '<p class="error">'.$error['brand'].'</p>' : ''?>
                </div>
            </div>
            <div class="input-col">
                <div class="input-field">
                    <label for="maxPrice">Max pris</label>
                    <input type="number" name="maxPrice" id="maxPrixe" value="<?=@$POST['maxPrice']?>">
                </div>
                <div class="input-field">
                    <label for="query">Søgeord</label>
                    <input type="text" name="query" id="query" value="<?=@$POST['searchVal'] ?? @$POST['query']?>">
                </div>
            </div>
            <div class="input-col">
                <div class="input-field"></div>
                <div class="input-field">
                    <button>Søg</button>
                </div>
            </div>
        
    </form>
</section>
<section id="products">
<?php
 $currentPage = !empty(Router::GetParam(':QPAGE')) ? Router::GetParam(':QPAGE') : 1;
Pagination::Init(Product::GetProductsByCategory('Damecykler'));
Pagination::$limit = 2;
foreach(Pagination::Items($currentPage) as $product){
?>
<article>
    <div class="product-item">
        <h3><?=$product->brandName . ' ' . $product->productModel?></h3>
        <p><?= (strlen($product->productDesc) > 185) ? substr($product->productDesc, 0, 181) . ' ...' : $product->productDesc ?></p>
        <div class="product-info">
            <p>Pris: <?=round($product->productPrice)?> kr.</p>
            <a href="<?=Router::Link('/Produkt/'.$product->productId)?>">Mere info</a>
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
        <a href="<?=Router::Link('/Soegning/'.$page)?>" class="<?= ($page == $currentPage) ? 'currentPage' : ''?>"><?=$page?></a>
    <?php } ?>
</div>
</section>
