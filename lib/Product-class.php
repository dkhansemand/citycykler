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

    public static function Edit($productId, $category, $brand, $model, $price, $productDesc, $productImage = false)
    {
        try
        {
            if(!$productImage){
               return (new self)->query("UPDATE products SET productDesc = :PDESC, 
                                                             productPrice = :PRICE, 
                                                             productCategory = :PCAT,
                                                             productModel = :PMODEL,
                                                             productBrand = :PBRAND
                                                         WHERE productId = :ID
                                                                ",
                                        [
                                            ':ID' => $productId,
                                            ':PDESC' => $productDesc,
                                            ':PRICE' => $price,
                                            ':PCAT' => $category,
                                            ':PMODEL' => $model,
                                            ':PBRAND' => $brand
                                        ]);

            }else{
                return (new self)->query("UPDATE products SET productDesc = :PDESC, 
                                                                productPrice = :PRICE, 
                                                                productCategory = :PCAT,
                                                                productImage = :PIMG,
                                                                productModel = :PMODEL,
                                                                productBrand = :PBRAND
                                                            WHERE productId = :ID
                                                                ",
                                                [
                                                ':ID' => $productId,
                                                ':PDESC' => $productDesc,
                                                ':PRICE' => $price,
                                                ':PCAT' => $category,
                                                ':PIMG' => $productImage,
                                                ':PMODEL' => $model,
                                                ':PBRAND' => $brand
                                                ]);
            }
            
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }

    public static function Delete($productId)
    {
        try
        {
            $mediaInfo = (new self)->query("SELECT productImage, `filename` FROM products
                                                INNER JOIN media ON productImage = mediaId 
                                                WHERE productId = :ID", [':ID' => $productId])->fetch();
            if(unlink(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . $mediaInfo->filename)){
                (new self)->query("DELETE FROM productColors WHERE fkProductId = :ID", [':ID' => $productId]);
                (new self)->query("DELETE FROM media WHERE mediaId = :ID", [':ID' => $mediaInfo->productImage]);
                (new self)->query("DELETE FROM products WHERE productId = :ID", [':ID' => $productId]);
                return true;
            }
            return false;
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
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

    public static function EditProductColors($productId, array $colors)
    {
        try
        {
            if(sizeof($colors) > 0){
                (new self)->query("DELETE FROM productColors WHERE fkProductId = :ID", [':ID' => $productId]);
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

    public static function GetColorsByProductId($productId) : array
    {
        try
        {
            return (new self)->query("SELECT fkProductId, fkColorId FROM productColors WHERE fkProductId = :ID", [':ID' => $productId])->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessages());
        }
    }

    public static function GetProductById($productId)
    {
        try
        {
            return (new self)->query("SELECT productId, productCategory, productBrand, brandName, `filename`, productDesc, productModel, productPrice FROM products
                                        INNER JOIN brands ON productBrand = brandId
                                        INNER JOIN category ON productCategory = categoryId
                                        INNER JOIN categorytypes ON categoryType = categoryTypeId
                                        INNER JOIN media ON productImage = mediaId
                                        WHERE productId = :ID", [':ID' => $productId])->fetch();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessages());
        }
    }

    public static function GetProductsByCategory($categoryName)
    {
        try
        {
            return (new self)->query("SELECT productId, productCategory, productBrand, brandName, categoryName, `filename`, productDesc, productModel, productPrice FROM category
                                        INNER JOIN products ON productCategory = categoryId
                                        INNER JOIN brands ON productBrand = brandId
                                        INNER JOIN media ON productImage = mediaId
                                        WHERE categoryName = LOWER(:CNAME)", [':CNAME' => $categoryName])->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessages());
        }
    }
}
