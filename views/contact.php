<h3 class="view-title">Konakt</h3>
<section id="contact">
    <div class="contact-info">
        <h3><?=$siteInfo->siteTitle?></h3>
        <p><?=$siteInfo->street?></p>
        <p><?=$siteInfo->zipcode?> <?=$siteInfo->city?></p>
        <br>
        <p>Tlf.: (+45) <?=chunk_split($siteInfo->phone, 2)?></p>
        <p>Fax: (+45) <?=chunk_split($siteInfo->fax, 2)?></p>
        <br>
        <p>Mail: <?=$siteInfo->email?></p>
    </div>
    <img src="<?=Router::$BASE?>assets/media/contactMap.jpg" alt="City cykler placering">
</section>