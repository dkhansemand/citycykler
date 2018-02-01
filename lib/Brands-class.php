<?php

class Brands extends Database
{
    public static function GetBrands() : array
    {
        try
        {
            return (new self)->query("SELECT brandId, brandName FROM brands")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }

    public static function GetBrand($brandId) 
    {
        try
        {
            return (new self)->query("SELECT brandId, brandName FROM brands WHERE brandId = :ID", [':ID' => $brandId])->fetch();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }

    public static function DoesExist(string $brand) : bool
    {
        try
        {
            return ( (new self)->query("SELECT brandId, brandName FROM brands WHERE brandName = :BNAME", [':BNAME' => $brand])
                    ->rowCount() === 1) ? true : false ;
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }

    public static function New(string $brandName)
    {
        try
        {
            return (new self)->query("INSERT INTO brands (brandName)VALUES(:BNAME)", [':BNAME' => $brandName]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }

    public static function Edit($brandId, string $brandName)
    {
        try
        {
            return (new self)->query("UPDATE brands SET brandName = :BNAME WHERE brandId = :ID", [':ID' => $brandId, ':BNAME' => $brandName]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }

    public static function Delete($brandId)
    {   
        try
        {
            return (new self)->query("DELETE FROM brands WHERE brandId = :ID", [':ID' => $brandId]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }
}
