<?php

class Category extends Database
{
    public static function GetCategoryTypes()
    {
        try
        {
            return (new self)->query("SELECT categoryTypeId, categoryTypeName FROM categorytype")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }

    public static function GetCategories()
    {
        try
        {
            return (new self)->query("SELECT categoryId, categoryName, `filename` FROM categorytype
                                        LEFT JOIN media ON categoryImage = mediaId")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Category-class]: " . $err->getMessage());
        }
    }
}
