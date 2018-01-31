<form action="" method="post">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <select name="categoryType" selectedIndex="1" autofocus required>
                <option value="0" selected disabled>Vælg hovedkategori...</option>
                <?php
                    foreach(Category::GetCategoryTypes() as $mainCategory)
                    {
                ?>
                        <option value="<?=$mainCategory->categoryTypeId?>"><?=$mainCategory->categoryTypeName?></option>
                <?php
                    }          
                ?>
            </select>    
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="categoryName" name="categoryName" required>
                <label class="mdl-textfield__label" for="sample3">Kategori navn</label>
            </div>
            
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="pageImg">Vælg andet billede: </label>
            <input type="file" id="pageImg" name="pageImage">
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Tilføj
            </button>
        </div>
    </div>
</form>