<pre>
    <?php //var_dump($POST) ?>
</pre>
<?php

    if(isset($POST['btnSubmit'])){
         
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <select name="category" autofocus required>
                <option value="0" <?= isset($POST['categoryType']) ? '' : 'selected'?> disabled>Vælg kategori...</option>
                <?php
                    foreach(Category::GetCategoriesByType(Router::GetParam(':CATEGORYTYPE')) as $Category)
                    {
                ?>
                        <option value="<?=$Category->categoryId?>" <?= (@$POST['categoryType'] == $Category->categoryId) ? 'selected' : ''?> ><?=$Category->categoryName?></option>
                <?php
                    }          
                ?>
            </select>    
            <?= isset($error['categoryType']) ? '<p class="error">'.$error['categoryType'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
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
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="productModel" name="productModel" value="<?=@$POST['productModel']?>" required>
                <label class="mdl-textfield__label" for="productModel">Model</label>
            </div>
            <?= isset($error['productModel']) ? '<p class="error">'.$error['productModel'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" name="productPrice" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="productPrice" required>
                <label class="mdl-textfield__label" for="productPrice">Pris</label>
                <span class="mdl-textfield__error">Pris er ikke i korrekt format!</span>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield">
                <textarea class="mdl-textfield__input" type="text" rows= "5" id="productDesc" name="productDesc" required></textarea>
                <label class="mdl-textfield__label" for="productDesc">Produkt beskrivelse</label>
            </div>
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