<?php
    if(isset($POST['btnSearch'])){
        $category = (isset($POST['category']) && $POST['category'] != 0) ? $POST['category'] : null;
        $brand = (isset($POST['brand']) && $POST['brand'] != 0) ? $POST['brand'] : null;
        $maxPrice = (isset($POST['maxPrice']) && is_numeric($POST['maxPrice'])) ? $POST['maxPrice'] : null;
        $query = filter_var($POST['query'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $searchResult = Product::Search($query, $category, $brand, $maxPrice);
        $_SESSION['searchResult'] = $searchResult;
    }elseif(isset($POST['searchVal']))
    {
        $searchResult = Product::Search($POST['searchVal']);
        $_SESSION['searchResult'] = $searchResult;
    }elseif(isset($_SESSION['searchResult']) && sizeof($_SESSION['searchResult']) > 0){
        $searchResult = $_SESSION['searchResult'];
    }
?>
<h3 class="view-title">Advanceret søgning</h3>
<section id="searchForm">
    <form action="<?=Router::Link('/Soegning')?>" method="post">
            <div class="input-col">
                <div class="input-field">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" required>
                        <option value="0" <?= isset($POST['category']) ? '' : 'selected'?> >-- Vælg --</option>
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
                        <option value="0" <?= isset($POST['brand']) ? '' : 'selected'?> >-- Vælg --</option>
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
                    <?= !empty($POST['maxPrice']) && !is_numeric($POST['maxPrice']) ? '<p class="error">Pris må kun indholde tal.</p>' : ''?>
                </div>
                <div class="input-field">
                    <label for="query">Søgeord</label>
                    <input type="text" name="query" id="query" value="<?=@$POST['searchVal'] ?? @$POST['query']?>">
                </div>
            </div>
            <div class="input-col">
                <div class="input-field"></div>
                <div class="input-field">
                    <button name="btnSearch">Søg</button>
                </div>
            </div>
        
    </form>
</section>
<?php
if(isset($searchResult)){
?>

<section id="products">
<?php
if(sizeof($searchResult) > 0){

 $currentPage = !empty(Router::GetParam(':QPAGE')) ? Router::GetParam(':QPAGE') : 1;
Pagination::Init($searchResult);
Pagination::$limit = 2;
foreach(Pagination::Items($currentPage) as $product){
?>
<article>
    <div class="product-item">
        <h3><?=$product->brandName . ' ' . $product->productModel?></h3>
        <p><?= (strlen($product->productDesc) > 185) ? substr($product->productDesc, 0, 181) . ' ...' : $product->productDesc ?></p>
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
    <?php //var_dump(Pagination::Pages()) ?>
    <p>Side</p>
    <?php
        for($page = 1; $page <= Pagination::Pages(); $page++){
    ?>
        <a href="<?=Router::Link('/Soegning/'.$page)?>" class="<?= ($page == $currentPage) ? 'currentPage' : ''?>"><?=$page?></a>
    <?php } ?>
</div>
</section>
<?php
}else{
    ?>
    <p>Der er desværre ikke nogen emner,
der matcher dine søgekriterier. Vi
anbefaler, at du udvider din søgning
og prøver igen.</p>
    <?php
}
}
?>
