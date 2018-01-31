<?php

class Category extends Database
{
    public static function GetCategoryTypes()
    {
        try
        {
            return (new self)->query("SELECT categoryTypeId, categoryTypeName FROM categorytypes")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function GetCategories()
    {
        try
        {
            return (new self)->query("SELECT categoryId, categoryName, categoryType, categoryTypeName,`filename` FROM category
                                        INNER JOIN categorytypes ON categoryType = categoryTypeId
                                        INNER JOIN media ON categoryImage = mediaId")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function GetCategoriesByType($categoryType)
    {
        try
        {
            return (new self)->query("SELECT categoryId, categoryName, categoryType, categoryTypeName,`filename` FROM categorytypes
                                        INNER JOIN category ON categoryType = categoryTypeId
                                        INNER JOIN media ON categoryImage = mediaId
                                        WHERE categoryTypeName = LOWER(:CNAME)", [':CNAME' => $categoryType])->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function GetCategory($categoryId)
    {
        try
        {
            return (new self)->query("SELECT categoryId, categoryName, categoryType, categoryTypeName,`filename` FROM category
                                        INNER JOIN categorytypes ON categoryType = categoryTypeId
                                        INNER JOIN media ON categoryImage = mediaId
                                        WHERE categoryId = :ID", [':ID' => $categoryId])->fetch();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function New($categoryType, $categoryName, $categoryImage)
    {
        try
        {
            return (new self)->query("INSERT INTO category (categoryName, categoryImage, categoryType)
                                        VALUES(:CNAME, :CIMG, :CTYPE)",
                                        [
                                            ':CNAME' => $categoryName,
                                            ':CIMG' => $categoryImage,
                                            ':CTYPE' => $categoryType 
                                        ]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function Edit($categoryId, $categoryType, $categoryName, $categoryImage = false)
    {
        try
        {
            if(!$categoryImage){
                return (new self)->query("UPDATE category SET categoryName = :CNAME, 
                                                              categoryType = :CTYPE 
                                                              WHERE categoryId = :ID",
                                            [
                                                ':CNAME' => $categoryName,
                                                ':CTYPE' => $categoryType, 
                                                ':ID' => $categoryId
                                            ]);
            }else{
                return (new self)->query("UPDATE category SET categoryName = :CNAME, 
                                                              categoryType = :CTYPE, 
                                                              categoryImage = :CIMG 
                                                              WHERE categoryId = :ID",
                                            [
                                                ':CNAME' => $categoryName,
                                                ':CIMG' => $categoryImage,
                                                ':CTYPE' => $categoryType,
                                                ':ID' => $categoryId
                                            ]);
            }
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function Delete($categoryId)
    {
        try
        {
            $mediaInfo = (new self)->query("SELECT categoryImage, `filename` FROM category 
                                                INNER JOIN media ON categoryImage = mediaId 
                                                WHERE categoryId = :ID", [':ID' => $categoryId])->fetch();
            if(unlink(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . $mediaInfo->filename)){
                (new self)->query("DELETE FROM category WHERE categoryId = :ID", [':ID' => $categoryId]);
                (new self)->query("DELETE FROM media WHERE mediaId = :ID", [':ID' => $mediaInfo->categoryImage]);
                return true;
            }
            return false;
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }
}
