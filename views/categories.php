<h3><?=ucfirst(Router::GetParam(':CATEGORY'))?></h3>
    <pre>
        <?php
            var_dump(Router::GetParams());
            var_dump(Category::GetCategoriesByType(Router::GetParam(':CATEGORY')));
            
        ?>
    </pre>