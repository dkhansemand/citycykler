<pre>
    <?php var_dump($POST); //var_dump(Router::GetParams()); ?>
</pre>
<?php

    if(isset($POST['btnSubmit'])){
        $error = [];
        $brand = (isset($POST['brand']) && $POST['brand'] != 0) ? $POST['brand'] : $error['brand'] = 'Der skal vælges et mærke.';
        $productId = (isset($POST['productModel']) && $POST['productModel'] != 0) ? $POST['productModel'] : $error['productModel'] = 'Der skal vælges en produkt model.';
        $offerPrice = is_numeric($POST['offerPrice']) ? $POST['offerPrice'] : $error['offerPrice'] = 'Produkt prisen er ikke angivet korrekt';

        if(sizeof($error) === 0){
            Offer::New($productId, $offerPrice);
            $success = 'Tilbud er blevet oprettet!';
            unset($POST);
        }else{
            $addError = 'Der skete en fejl.';
        }
    }
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="url" id="siteUrl" value="<?=Router::Link('/OfferAdd')?>">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="brands">Vælg produkt mærke</label>
            <select name="brand" id="brands" autofocus required>
            <option value="0" <?= isset($POST['brand']) ? '' : 'selected'?> disabled>Vælg mærke...</option>
            <?php
                foreach(Brands::GetBrands() as $brand)
                {
            ?>
                    <option value="<?=$brand->brandId?>" <?= (@$POST['brand'] || Router::GetParam(':OBRAND')  == $brand->brandName) ? 'selected' : ''?> ><?=$brand->brandName?></option>
            <?php
                }          
            ?>
            </select>    
            <?= isset($error['brand']) ? '<p class="error">'.$error['brand'].'</p>' : ''?>
        </div>
        <?php
            if(!empty(Router::GetParam(':OBRAND'))){

            
        ?>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="productModel">Vælg et produktmodel</label>
            <select name="productModel" id="productModel" required>
            <option value="0" <?= isset($POST['productModel']) ? '' : 'selected'?> disabled>Vælg produktmodel...</option>
            <?php
                foreach(Product::GetProductModels(Router::GetParam(':OBRAND')) as $model)
                {
            ?>
                    <option value="<?=$model->productId?>" <?= (@$POST['productModel'] == $model->productModel) ? 'selected' : ''?> ><?=$model->productModel?></option>
            <?php
                }          
            ?>
            </select>    
            <?= isset($error['productModel']) ? '<p class="error">'.$error['productModel'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" name="offerPrice" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="offerPrice"  value="<?=@$POST['offerPrice']?>" required>
                <label class="mdl-textfield__label" for="offerPrice">Tilbudspris</label>
                <span class="mdl-textfield__error">Tilbudspris er ikke i korrekt format!</span>
            </div>
            <?= isset($error['offerPrice']) ? '<p class="error">'.$error['offerPrice'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Opret tilbud
            </button>
        </div>
            <?php }?>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('#brands').addEventListener('change', (e) =>{
            let url = document.getElementById('siteUrl').value
            window.location.href = url + '/' +  e.target[e.target.selectedIndex].innerHTML
        })
    })
</script>