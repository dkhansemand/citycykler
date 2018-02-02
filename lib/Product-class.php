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

    public static function New($category, $brand, $model, $price, $productDesc, $productImage)
    {
        try
        {
            (new self)->query("INSERT INTO products (productDesc, productPrice, productCategory, productImage, productModel, productBrand)
                                    VALUES(:PDESC, :PRICE, :PCAT, :PIMG, :PMODEL, :PBRAND)",
                                    [
                                        ':PDESC' => $productDesc,
                                        ':PRICE' => $price,
                                        ':PCAT' => $category,
                                        ':PIMG' => $productImage,
                                        ':PMODEL' => $model,
                                        ':PBRAND' => $brand
                                    ]);
            return (new self)->query("SELECT productId FROM products ORDER BY productDateAdded DESC LIMIT 1")->fetch()->productId;
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }

    public static function GetLastInsertedProduct()
    {
        try
        {
            
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }

    public static function AddProductColors($productId, array $colors)
    {
        try
        {
            if(sizeof($colors) > 0){
                foreach($colors as $color){
                    (new self)->query("INSERT INTO productColors (fkProductId, fkColorId)VALUES(:PID, :CID)",[':PID' => $productId, ':CID' => $color]);
                }
                return true;
            }else{
                return false;
            }
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }

    public static function GetColors() : array
    {
        try
        {
            return (new self)->query("SELECT colorId, colorName, colorSrc, colorMime FROM colors")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessages());
        }
    }
}
