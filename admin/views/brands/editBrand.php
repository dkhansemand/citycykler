<?php

    if(isset($POST['btnSubmit'])){
        $error = [];
        $brandName = Validate::stringBetween($POST['brandName'], 2 , 15) ? $POST['brandName'] : $error['brandName'] = 'Mærke navn skal udfyldes og være mellem 2 og 15 tegn. <br>Samt må det kun indholde bogstaver og tal.';
        
        if(sizeof($error) === 0){
            
            if(!Brands::DoesExist($brandName))
            {
                Brands::Edit(Router::GetParam(':ID'), $brandName);
                $success = 'Mærket er nu blevet rettet';
                unset($POST);
            }else{
                $addError = 'Mærket "' . $brandName . '" eksistere allerede.';
            }
        }else{
            $addError = 'Der skete en fejl.';
        }   
    }
    $brandData = Brands::GetBrand(Router::GetParam(':ID'));
?>
<form action="" method="post">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="brandName" name="brandName" value="<?=@$POST['brandName'] ?? $brandData->brandName?>" required>
                <label class="mdl-textfield__label" for="brandName">Mærke navn</label>
            </div>
            <?= isset($error['brandName']) ? '<p class="error">'.$error['brandName'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">edit</i> Ret
            </button>
        </div>
    </div>
</form>