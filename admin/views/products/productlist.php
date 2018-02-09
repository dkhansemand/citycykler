<div class="mdl-grid">
  <?php
    
    $categoryTypes = Category::GetCategoryTypes();
  ?>
  <div class="mdl-cell mdl-cell--12-col">
      <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-tabs__tab-bar">
        <?php
        $idx = 0;
            foreach($categoryTypes as $categoryType){
        ?>
            <a href="#<?=$categoryType->categoryTypeName?>" class="mdl-tabs__tab <?= $idx == 0 ? 'is-active' : ''?>"><?=$categoryType->categoryTypeName?></a>
        <?php $idx++; } ?>
        </div>
      
        <?php
            $idx = 0;
            foreach($categoryTypes as $categoryType){
        ?>
            <div class="mdl-tabs__panel <?= $idx == 0 ? 'is-active' : ''?>" id="<?=$categoryType->categoryTypeName?>">
                <div class="mdl-cell mdl-cell--12-col">
                    <a href="<?=Router::Link('/Product/Add/' . ucfirst($categoryType->categoryTypeName));?>" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                        <i class="material-icons">add</i>
                    </a>
                </div>
                <table class="mdl-data-table mdl-js-data-table">
                    <thead>
                        <tr>
                        <th class="mdl-data-table__cell--non-numeric">Hovedkategori</th>
                        <th class="mdl-data-table__cell--non-numeric">Kategori</th>
                        <th class="mdl-data-table__cell--non-numeric">Mærke</th>
                        <th class="mdl-data-table__cell--non-numeric">Model</th>
                        <th>Pris</th>
                        <th class="mdl-data-table__cell--non-numeric">Produktbillede</th>
                        <th class="mdl-data-table__cell--non-numeric">Handlinger</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach(Product::GetAll() as $product){
                            if($product->categoryType == $categoryType->categoryTypeId){
                    ?>
                        <tr>
                        <td class="mdl-data-table__cell--non-numeric"><?=$product->categoryTypeName?></td>
                        <td class="mdl-data-table__cell--non-numeric"><?=$product->categoryName?></td>
                        <td class="mdl-data-table__cell--non-numeric"><?=$product->brandName?></td>
                        <td class="mdl-data-table__cell--non-numeric"><?=$product->productModel?></td>
                        <td class="mdl-data-table__cell--non-numeric"><?=$product->productPrice?></td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <img src="../assets/media/<?=$product->filename?>" alt="<?=$product->productName?>">
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="<?=Router::Link('/ProductEdit/'.$product->productId . '/'.ucfirst($product->categoryTypeName))?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="<?=Router::Link('/ProductDelete/'.$product->productId)?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect btn-red">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                        </tr>
                    <?php } }?>
                    </tbody>
                </table>
            </div>
        <?php
            $idx++;
            }
        ?>
        
        
      </div>
  </div>
  
</div>
