<?php
    $productData = Product::GetProductById(Router::GetParam(':ID'));
    if(isset($POST['btnYes'])){
        if(Product::Delete($productData->productId)){
            Router::Redirect('/Products');
            exit;
        }
    }elseif(isset($POST['btnCancel'])){
        Router::Redirect('/Products');
        exit;
    }

?>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
    <h3>
        Er du sikker på at Produktet '<?=$productData->brandName . ' ' . $productData->productModel?>' skal slettes?
    </h3>
    </div>
    <div class="mdl-cell mdl-cell--12-col">
        <form action="" method="post">
            <button name="btnYes" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            <i class="material-icons">done</i>Ja
            </button>
            <button name="btnCancel" class="mdl-button mdl-js-button mdl-button--raised btn-red">
            <i class="material-icons">clear</i>Anullér
            </button>
        </form>
    </div>
</div>
