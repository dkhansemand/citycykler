<pre>
    <?php

if(isset($POST['btnSubmit'])){
    $error = [];
    $categoryType = (isset($POST['categoryType']) && $POST['categoryType'] != 0) ? $POST['categoryType'] : $error['categoryType'] = 'Der skal vælges en hovedkategori.';
    $categoryName = Validate::stringBetween($POST['categoryName'], 2 , 15) ? $POST['categoryName'] : $error['categoryName'] = 'Kategori navn skal udfyldes og være mellem 2 og 15 tegn. <br>Samt må det kun indholde bogstaver og tal.';
    if(!empty($_FILES['categoryImage']['name'])){
        $categoryImage = !empty($_FILES['categoryImage']['name']) ? 'categoryImage' : $error['categoryImage'] = 'Billede kunne ikke tilføjes.';
    }
    
    if(sizeof($error) === 0){
        //var_dump($upload);
        if(isset($categoryImage)){
            $upload = MediaUpload::UploadImage($categoryImage, ['116x80']);
            if($upload['err'] == false)
            {
                Category::Edit(Router::GetParam(':ID'), $categoryType, $categoryName, $upload['data'][0]);
                $success = 'Kategori er nu blevet rettet';
                unset($POST);
            }else{
                $addError = 'Der skete den fejl! ' . $upload['data'];
            }
        }else{
            Category::Edit(Router::GetParam(':ID'), $categoryType, $categoryName);
            $success = 'Kategori er nu blevet rettet';
            unset($POST);
        }
    }else{
        $addError = 'Der skete en fejl.';
    }   
}
    $categoryData = Category::GetCategory(Router::GetParam(':ID'));
    //var_dump($POST);
    ?>
</pre>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <select name="categoryType" autofocus required>
                <option value="0" <?= isset($POST['categoryType']) ? '' : 'selected'?> disabled>Vælg hovedkategori...</option>
                <?php
                    $type = $POST['categoryType'] ?? $categoryData->categoryType;
                    foreach(Category::GetCategoryTypes() as $mainCategory)
                    {
                ?>
                        <option value="<?=$mainCategory->categoryTypeId?>" <?= ($type == $mainCategory->categoryTypeId) ? 'selected' : ''?> ><?=$mainCategory->categoryTypeName?></option>
                <?php
                    }          
                ?>
            </select>    
            <?= isset($error['categoryType']) ? '<p class="error">'.$error['categoryType'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="categoryName" name="categoryName" value="<?=@$POST['categoryName'] ?? $categoryData->categoryName?>" required>
                <label class="mdl-textfield__label" for="sample3">Kategori navn</label>
            </div>
            <?= isset($error['categoryName']) ? '<p class="error">'.$error['categoryName'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
        <?php
            if(isset($categoryData->categoryName))
            {
        ?>
            <img src="<?=str_replace('admin/', '',Router::$BASE)?>assets/media/<?=$categoryData->filename?>" height="80" width="116">
        <?php
            }else{
        ?>
        <p>Der er ikke noget billede tilknyttet til '<?=$categoryData->categoryName?>'</p>
        <?php
            }
        ?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="pageImg">Skift billede (valgfrit) </label><br>
            <input type="file" id="categoryImage" name="categoryImage">
            <?= isset($error['categoryImage']) ? '<p class="error">'.$error['categoryImage'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">edit</i> Ret
            </button>
        </div>
    </div>
</form>