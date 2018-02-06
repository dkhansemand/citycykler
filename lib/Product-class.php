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
            return (new self)->query("SELECT fkProductId, fkColorId, colorId, colorName, colorSrc, colorMime FROM productColors 
                                        INNER JOIN colors ON colorId = fkColorId
                                        WHERE fkProductId = :ID", [':ID' => $productId])->fetchAll();
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

    public static function Search(string $query = '', $category = null, $brand = null, $maxPrice = null)
    {
        try
        {
            $params = [];
            $sql = "SELECT productId, productCategory, productBrand, brandName, categoryName, categoryTypeName, `filename`, productDesc, productModel, productPrice FROM products
                            INNER JOIN category ON productCategory = categoryId
                            INNER JOIN categorytypes ON categoryTypeId = categoryType
                            INNER JOIN brands ON productBrand = brandId
                            INNER JOIN media ON productImage = mediaId
                            WHERE ";
            if(!empty($query)){
                $sql .= " productModel LIKE CONCAT('%', :SQ, '%') OR productDesc LIKE CONCAT('%', :SQ, '%') ";
                $params[':SQ'] = $query;
            }
            if((sizeof($params) === 0) && !is_null($category) && is_numeric($category)){
                $sql .= " productCategory = :PCAT ";
                $params[':PCAT'] = $category;
            }elseif(!is_null($category) && is_numeric($category)){
                $sql .= " OR productCategory = :PCAT ";
                $params[':PCAT'] = $category;
            }

            if((sizeof($params) === 0) && !is_null($brand) && is_numeric($brand)){
                $sql .= " productBrand = :PBRAND ";
                $params[':PBRAND'] = $brand;
            }elseif(!is_null($brand) && is_numeric($brand)){
                $sql .= " OR productBrand = :PBRAND ";
                $params[':PCAT'] = $category;
            }

            if((sizeof($params) === 0) && !is_null($maxPrice) && is_numeric($maxPrice)){
                $sql .= " productPrice <= :PRICEMAX ";
                $params[':PRICEMAX'] = $maxPrice;
            }elseif(!is_null($maxPrice) && is_numeric($maxPrice)){
                $sql .= " AND productPrice <= :PRICEMAX ";
                $params[':PRICEMAX'] = $maxPrice;
            }

            if(sizeof($params) > 0){
                return (new self)->query($sql, $params)->fetchAll();
            }else{
                return [];
            }
            
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }

    public static function GetProductModels($brandName)
    {
        try
        {
            return (new self)->query("SELECT productId, productModel FROM brands INNER JOIN products ON productBrand = brandId WHERE brandName = LOWER(:BRAND) ORDER BY productModel ASC", [':BRAND' => $brandName])->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }

    public static function GetLatestProducts(int $limit = 2)
    {
        try
        {
            $queryLatest = (new self)->prepare("SELECT categoryTypeName, categoryName, productId, productCategory, productBrand, DATE_FORMAT(productDateAdded, '%d/%m-%Y') AS addDate, brandName, `filename`, productDesc, productModel, productPrice FROM products
                                                    INNER JOIN brands ON productBrand = brandId
                                                    INNER JOIN category ON productCategory = categoryId
                                                    INNER JOIN categorytypes ON categoryType = categoryTypeId
                                                    INNER JOIN media ON productImage = mediaId
                                                    ORDER BY productDateAdded DESC LIMIT :L");
            $queryLatest->bindParam(':L', $limit, PDO::PARAM_INT);
            $queryLatest->execute();
            return $queryLatest->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Product-class.php]: " . $err->getMessage());
        }
    }
}
