<?php
    $pageData = PageContent::GetContentByName('Forsiden');
?>
<section id="home">
    <article>
        <?php
            if(isset($pageData->filename)){
        ?>
                <img src="./assets/media/<?=$pageData->filename?>" alt="City cykler">
        <?php } ?>
        <p><?=htmlspecialchars_decode($pageData->pageText)?></p>
    </article>

</section>