
<?php 

if(isset($POST['btnSubmit'])){
    $error = [];
    $pageText = isset($POST['pageText']) ? $POST['pageText'] : $error['pageText'] = 'Side tekst skal være min. 2 tagn og max. 999.';
    
    if(sizeof($error) === 0)
    {
        PageContent::UpdatePageContent($POST['btnSubmit'], $pageText);
        $success = 'Side teksten er nu blevet opdateret!';
    }
}
$pagesData = PageContent::GetPagesWithContent();
?>
<?= isset($success) ? '<h5>'.$success.'</h5>' : ''?>
<?= isset($error['pageText']) ? '<h5>'.$error['pageText'].'</h5>' : ''?>
<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-tabs__tab-bar">
      <?php
        foreach($pagesData as $idx => $page)
        {
        ?>
            <a href="#<?=$page->pageName?>" class="mdl-tabs__tab <?= $idx === 0 ? 'is-active' : ''?>"><?=$page->pageName?></a>
        <?php
        }
      ?>
  </div>

  <?php
        foreach($pagesData as $idx => $page)
        {
    ?>
        <div class="mdl-tabs__panel <?= $idx === 0 ? 'is-active' : ''?>" id="<?=$page->pageName?>">
            <form action="" method="post" enctype="multipart/form-data">
                <textarea name="pageText" rows="20" style="background-color:#fff; width:100%;" id="pageText"><?=$page->pageText?></textarea>               
                <br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" name="btnSubmit" value="<?=$page->pageId?>">
                    <i class="material-icons">save</i> Gem
                </button>
            </form>
        </div>
    <?php 
        } 
    ?>
</div>