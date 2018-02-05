<?php

    if(isset($POST['btnSubmit'])){
        $error = [];
        $siteTitle = Validate::stringBetween($POST['title'], 2, 25) ? $POST['title'] : $error['tItle'] = 'Side titel må kun være mellen 2 og 25 tegn.';
        $street = Validate::stringBetween($POST['street'], 2, 25) ? $POST['street'] : $error['street'] = 'Adresse må kun være mellen 2 og 25 tegn.';
        $zipcode = Validate::intBetween($POST['zipcode'],4,4) ? $POST['zipcode'] : $error['zipcode'] = 'Post nr. er ikke i korrekt format';
        $city = Validate::stringBetween($POST['city'], 2, 25) ? $POST['city'] : $error['city'] = 'Adresse må kun være mellen 2 og 25 tegn.';
        $phone = Validate::phone($POST['phone']) ? Validate::$phoneFormatted : $error['phone'] = 'Telefon nr er ikke i korrekt format';
        $fax = Validate::phone($POST['fax']) ? Validate::$phoneFormatted : $error['fax'] = 'Fax nr er ikke i korrekt format';
        $email = Validate::email($POST['email']) ? $POST['email'] : $error['email'] = 'E-mail er ikke i korrekt format';

        if(sizeof($error) === 0){ 
            SiteSettings::EditSiteInfo($POST['btnSubmit'], $siteTitle, $street, $zipcode, $city, $phone, $fax, $email);
            $success = 'Informationerne er nu blevet ændret!';
            unset($POST);
        }else{
            $addError = 'Der skete en fejl.';
        }   
    }
    
    $settingsData = SiteSettings::GetSiteInfo();
?>
<form action="" method="post">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="title" name="title" value="<?=@$POST['title'] ?? $settingsData->siteTitle?>" required>
                <label class="mdl-textfield__label" for="siteTitle">Side titel</label>
            </div>
            <?= isset($error['title']) ? '<p class="error">'.$error['title'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="street" name="street" value="<?=@$POST['street'] ?? $settingsData->street?>" required>
                <label class="mdl-textfield__label" for="street">Adresse</label>
            </div>
            <?= isset($error['street']) ? '<p class="error">'.$error['street'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" id="zipcode" name="zipcode" value="<?=@$POST['zipcode'] ?? $settingsData->zipcode?>" required>
                <label class="mdl-textfield__label" for="zipcode">Post nr.</label>
            </div>
            <?= isset($error['zipcode']) ? '<p class="error">'.$error['zipcode'].'</p>' : ''?>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="city" name="city" value="<?=@$POST['city'] ?? $settingsData->city?>" required>
                <label class="mdl-textfield__label" for="city">By</label>
            </div>
            <?= isset($error['city']) ? '<p class="error">'.$error['city'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" id="phone" name="phone" value="<?=@$POST['phone'] ?? $settingsData->phone?>" required>
                <label class="mdl-textfield__label" for="phone">Tlf: (+45)</label>
            </div>
            <?= isset($error['phone']) ? '<p class="error">'.$error['phone'].'</p>' : ''?>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" id="fax" name="fax" value="<?=@$POST['fax'] ?? $settingsData->fax?>" required>
                <label class="mdl-textfield__label" for="fax">Fax: (+45)</label>
            </div>
            <?= isset($error['fax']) ? '<p class="error">'.$error['fax'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="email" id="email" name="email" value="<?=@$POST['email'] ?? $settingsData->email?>" required>
                <label class="mdl-textfield__label" for="email">E-mail</label>
            </div>
            <?= isset($error['email']) ? '<p class="error">'.$error['email'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="<?=$settingsData->siteSettingsId?>">
                <i class="material-icons">edit</i> Ret
            </button>
        </div>
    </div>
</form>