<?php
    $Categories = Category::GetCategoriesByType(Router::GetParam(':CATEGORY'));
    
?>
<h3><?=ucfirst(Router::GetParam(':CATEGORY'))?></h3>
<section id="categories">
    <div id="category-item">
        <a href="#Produkter">
            <p><?=$Categories[0]->categoryName?></p>
            <img src="<?=Router::$BASE?>assets/media/<?=$Categories[0]->filename?>" alt="<?=$Categories[0]->categoryName?>">
        </a>
    </div>
</section>