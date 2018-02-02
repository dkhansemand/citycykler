<pre>
    <?php //var_dump($POST) ?>
</pre>
<?php

    if(isset($POST['btnSubmit'])){
        $error = [];
        $colorName = Validate::stringBetween($POST['colorName'], 2 , 15) ? $POST['colorName'] : $error['colorName'] = 'Kategori navn skal udfyldes og være mellem 2 og 15 tegn. <br>Samt må det kun indholde bogstaver og tal.';
        $colorImage = !empty($_FILES['colorImage']['name']) ? 'colorImage' : $error['colorImage'] = 'Billede skal tilføjes.';

        if(sizeof($error) === 0){
            $upload = MediaUpload::Image2Blob($colorImage, $colorName);
            //var_dump($upload);
            if($upload['err'] == false)
            {
                $success = 'Farve er nu blevet tilføjet';
                unset($POST);
            }else{
                $addError = 'Der skete den fejl! ' . $upload['data'];
            }
        }else{
            $addError = 'Der skete en fejl.';
        }   
    }
?>
<form action="" method="post" enctype="multipart/form-data">
<p>Dette er en hemmelig side til at oprette farver via billed upload. <br>BLOB data af billede ville blive indsat og billede vil ikke blive gemt på serveren</p>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <?= isset($success) ? '<h5 class="success">'.$success.'</h5>' : ''?>
            <?= isset($addError) ? '<h5 class="error">'.$addError.'</h5>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="colorName" name="colorName" value="<?=@$POST['colorName']?>" required>
                <label class="mdl-textfield__label" for="colorName">Farve navn</label>
            </div>
            <?= isset($error['colorName']) ? '<p class="error">'.$error['colorName'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <label for="pageImg">Vælg et billede: </label>
            <input type="file" id="colorImage" name="colorImage">
            <?= isset($error['colorImage']) ? '<p class="error">'.$error['colorImage'].'</p>' : ''?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <button name="btnSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Tilføj
            </button>
        </div>
    </div>
</form>