<style>

</style>
<?php 

if(isset($POST['btnSubmit'])){
    $error = [];
    $pageText = isset($POST['pageText']) && !empty($POST['pageText'])? $POST['pageText'] : $error['pageText'] = 'Side tekst skal være min. 2 tagn og max. 999.';
    
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
            <form action="" method="post" class="pageEdit" enctype="multipart/form-data">
            <br>
            
                
                <textarea name="pageText" id="editor1" style="background-color:#fff; ">
                    <?=htmlspecialchars_decode($page->pageText)?>              
        </textarea> 
                
                <br>
                <?php
                    if(isset($page->filename))
                    {
                ?>
                    <img src="../assets/media/<?=$page->filename?>" height="150" width="150">
                <?php
                    }else{
                ?>
                <p>Der er ikke noget billede tilknyttet til '<?=$page->pageName?>'</p>
                <?php
                    }
                ?>
                <br>
                <label for="pageImg">Vælg andet billede: </label>
                <input type="file" id="pageImg" name="pageImage">
                <br><br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" name="btnSubmit" value="<?=$page->pageId?>">
                    <i class="material-icons">save</i> Gem
                </button>
            </form>
        </div>
    <?php 
        } 
    ?>
</div>
<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=fh6esofusmwjepd4rbl7p8z8x9w8a62ss1bc5x1clu88ei7f"></script>

<script>
    document.addEventListener('mdl-componentupgraded', function(e){
  //In case other element are upgraded before the layout  
  if (typeof e.target.MaterialLayout !== 'undefined') {
    tinymce.init({
      selector: 'textarea',
      height: 300
    });
  }
});
</script>
