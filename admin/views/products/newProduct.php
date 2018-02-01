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
                <option value="0" <?= isset($POST['categoryType']) ? '' : 'selected'?> disabled>Vælg hovedkategori...</option>
                <?php
                    foreach(Category::GetCategoryTypes() as $mainCategory)
                    {
                ?>
                        <option value="<?=$mainCategory->categoryTypeId?>" <?= (@$POST['categoryType'] == $mainCategory->categoryTypeId) ? 'selected' : ''?> ><?=$mainCategory->categoryTypeName?></option>
                <?php
                    }          
                ?>
            </select>    
            <?= isset($error['categoryType']) ? '<p class="error">'.$error['categoryType'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="categoryName" name="categoryName" value="<?=@$POST['categoryName']?>" required>
                <label class="mdl-textfield__label" for="categoryName">Kategori navn</label>
            </div>
            <?= isset($error['categoryName']) ? '<p class="error">'.$error['categoryName'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="pageImg">Vælg et billede: </label>
            <input type="file" id="categoryImage" name="categoryImage">
            <?= isset($error['categoryImage']) ? '<p class="error">'.$error['categoryImage'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Tilføj
            </button>
        </div>
    </div>
</form>