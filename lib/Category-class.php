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
}
