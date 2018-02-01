<?php

class Brands extends Database
{
    public static function GetBrands()
    {
        try
        {
            return (new self)->query("SELECT brandId, brandName FROM brands")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Brands-class.php]: " . $err->getMessage());
        }
    }
}
