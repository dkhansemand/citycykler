<?php

class Product extends Database
{
    public static function GetAll() : array
    {
        try
        {
            return (new self)->query("SELECT productId, brandName, categoryName, categoryType, categoryTypeName, `filename`, productModel, productPrice FROM products
                                        INNER JOIN brands ON productBrand = brandId
                                        INNER JOIN category ON productCategory = categoryId
                                        INNER JOIN categorytypes ON categoryType = categoryTypeId
                                        INNER JOIN media ON productImage = mediaId    
                                    ")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }
}
