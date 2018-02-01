<h3><?=ucfirst(Router::GetParam(':CATEGORY'))?></h3>
<section id="categories">
    <?php
        foreach(Category::GetCategoriesByType(Router::GetParam(':CATEGORY')) as $category){
    ?>
        <div id="category-item">
            <a href="<?=Router::Link('/Produkter/'.$category->categoryName)?>">
                <p><?=$category->categoryName?></p>
                <img src="<?=Router::$BASE?>assets/media/<?=$category->filename?>" alt="<?=$category->categoryName?>">
            </a>
        </div>
    <?php
        }
    ?>
</section>