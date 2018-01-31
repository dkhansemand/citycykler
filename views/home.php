<?php
    $pageData = PageContent::GetContentByName('Forsiden');
?>
<section id="home">
    <article>
        <img src="./assets/media/<?=$pageData->filename?>" alt="City cykler">
        <p><?=htmlspecialchars_decode($pageData->pageText)?></p>
    </article>

</section>