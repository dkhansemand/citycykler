<pre>
    <?php //var_dump(Router::GetParams()) ?>
</pre>
<?php

    if(isset($POST['btnSubmit'])){
        $error = [];
        $categoryType = (isset($POST['categoryType']) && $POST['categoryType'] != 0) ? $POST['categoryType'] : $error['categoryType'] = 'Der skal vælges en kategori.';
        $brand = (isset($POST['brand']) && $POST['brand'] != 0) ? $POST['brand'] : $error['brand'] = 'Der skal vælges et mærke.';
        $productModel = Validate::stringBetween($POST['productModel'], 2 , 30) ? $POST['productModel'] : $error['productModel'] = 'Produkt model skal udfyldes og være mellem 2 og 30 tegn. <br>Samt må det kun indholde bogstaver og tal.';
        $productPrice = is_numeric($POST['productPrice']) ? $POST['productPrice'] : $error['productPrice'] = 'Produkt prisen er ikke angivet korrekt';
        $productDesc = Validate::stringBetween($POST['productDesc'], 2 , 999) ? $POST['productDesc'] : $error['productDesc'] = 'Produkt beskrivelse skal udfyldes og være mellem 2 og 999 tegn. <br>Samt må det kun indholde bogstaver og tal.';
        $productImage = !empty($_FILES['productImage']['name']) ? 'productImage' : $error['productImage'] = 'Billede skal tilføjes.';
        if(Router::GetParam(':CATEGORYTYPE') === 'Cykler'){
            $productColors = isset($POST['colors']) && (sizeof($POST['colors']) > 0) ? $POST['colors'] : $error['colors'] = 'Der skal min vælges en farve.';
        }
        if(sizeof($error) === 0){
            $upload = MediaUpload::UploadImage($productImage, ['168x116', '116x80', '69x48']);
            //var_dump($upload);
            if($upload['err'] == false)
            {
                //Category::New($categoryType, $categoryName, $upload['data'][0]);
                $productId = Product::New($categoryType, $brand, $productModel, $productPrice, $productDesc, $upload['data'][0]);
                if(isset($productColors) && !empty($productColors)){
                    Product::AddProductColors($productId, $productColors);
                }
                $success = 'Produkt er nu blevet tilføjet';
                unset($POST);
            }else{
                $addError = 'Der skete den fejl! ' . $upload['data'];
            }
        }else{
            $addError = 'Der skete en fejl.';
        }
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--2-col">
            <select name="categoryType" autofocus required>
                <option value="0" <?= isset($POST['categoryType']) ? '' : 'selected'?> disabled>Vælg kategori...</option>
                <?php
                    foreach(Category::GetCategoriesByType(Router::GetParam(':CTYPE')) as $Category)
                    {
                ?>
                        <option value="<?=$Category->categoryId?>" <?= (@$POST['categoryType'] == $Category->categoryId) ? 'selected' : ''?> ><?=$Category->categoryName?></option>
                <?php
                    }          
                ?>
            </select>    
            <?= isset($error['categoryType']) ? '<p class="error">'.$error['categoryType'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--1-col">
            <select name="brand" autofocus required>
                <option value="0" <?= isset($POST['brand']) ? '' : 'selected'?> disabled>Vælg mærke...</option>
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
        <div class="mdl-cell mdl-cell--6-col"></div>
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="productModel" name="productModel" value="<?=@$POST['productModel']?>" required>
                <label class="mdl-textfield__label" for="productModel">Model</label>
            </div>
            <?= isset($error['productModel']) ? '<p class="error">'.$error['productModel'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" name="productPrice" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="productPrice"  value="<?=@$POST['productPrice']?>" required>
                <label class="mdl-textfield__label" for="productPrice">Pris</label>
                <span class="mdl-textfield__error">Pris er ikke i korrekt format!</span>
            </div>
            <?= isset($error['productprice']) ? '<p class="error">'.$error['productPrice'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col"></div>
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-textfield mdl-js-textfield">
                <textarea class="mdl-textfield__input" type="text" rows= "5" id="productDesc" name="productDesc" required><?=@$POST['productDesc']?></textarea>
                <label class="mdl-textfield__label" for="productDesc">Produkt beskrivelse</label>
            </div>
            <?= isset($error['productDesc']) ? '<p class="error">'.$error['productDesc'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--8-col">
            <div id="colorsList"> 
            <?php
            if(Router::GetParam(':CTYPE') === 'Cykler'){
                foreach(Product::GetColors() as $color){
            ?>
                <span>
                    <label for="color<?=$color->colorId?>">
                        <img src="data:<?=$color->colorMime?>;base64,<?=base64_encode($color->colorSrc)?>" alt="<?=$color->colorName?>">
                    </label>
                    <input type="checkbox" name="colors[]" id="color<?=$color->colorId?>" value="<?=$color->colorId?>">
                </span>
            <?php
                }}
            ?>
            </div>
            <?= isset($error['colors']) ? '<p class="error">'.$error['colors'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="productImage">Vælg et billede: </label>
            <input type="file" id="productImage" name="productImage">
            <?= isset($error['productImage']) ? '<p class="error">'.$error['productImage'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Tilføj
            </button>
        </div>

    </div>
</form>