<?php

class Offer extends Database
{
    public static function New($productId, $offerPrice)
    {
        try
        {
            return (new self)->query("INSERT INTO offers (fkProductId, offerPrice)VALUES(:PID, :OPRICE)", [':PID' => $productId, ':OPRICE' => $offerPrice]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Offer-class.php]: " . $err->getMessage());
        }
    }

    public static function GetOffersLimit()
    {
        try
        {
            return (new self)->query("SELECT productId, productModel, productPrice, brandName, offerPrice, `filename` FROM offers
                                        INNER JOIN products ON fkProductId = productId
                                        INNER JOIN brands ON productBrand = brandId
                                        INNER JOIN media ON productImage = mediaId
                                        ORDER BY RAND() LIMIT 3")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Offer-class.php]: " . $err->getMessage());
        } 
    }
}
