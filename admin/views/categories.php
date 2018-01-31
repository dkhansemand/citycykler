<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <a href="<?=Router::Link('/Category/Add');?>" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
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
                <table class="mdl-data-table mdl-js-data-table">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Kategorinavn</th>
                            <th class="mdl-data-table__cell--non-numeric">Kategoribillede</th>
                            <th class="mdl-data-table__cell--non-numeric">Handlinger</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach(Category::GetCategories() as $category){
                            if($category->categoryType == $categoryType->categoryTypeId){
                    ?>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric"><?=$category->categoryName?></td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <img src="../assets/media/<?=$category->filename?>" alt="<?=$category->categoryName?>">
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <a href="#<?=$category->categoryId?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="#<?=$category->categoryId?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
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
