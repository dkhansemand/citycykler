<?php
    $pageData = PageContent::GetContentByName('Forsiden');
?>
<h3 class="view-title"><?=Router::ViewTitle()?></h3>
<section id="home">
    <article>
        <?php
            if(isset($pageData->filename)){
        ?>
                <img src="<?=Router::$BASE?>assets/media/<?=$pageData->filename?>" alt="City cykler">
        <?php } ?>
        <p><?=htmlspecialchars_decode($pageData->pageText)?></p>
    </article>

</section>