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

    public static function Edit($offerId, $productId, $offerPrice)
    {
        try
        {
            return (new self)->query("UPDATE offers SET fkProductId = :PID, offerPrice = :OPRICE WHERE offerId = :ID", [':ID' => $offerId, ':PID' => $productId, ':OPRICE' => $offerPrice]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Offer-class.php]: " . $err->getMessage());
        }
    }

    public static function Delete($offertId)
    {
        try
        {
            return (new self)->query("DELETE FROM offers WHERE offerId = :ID", [':ID' => $offertId]);
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

    public static function GetOffersList()
    {
        try
        {
            return (new self)->query("SELECT offerId, productId, productModel, productPrice, brandName, offerPrice, `filename` FROM offers
                                        INNER JOIN products ON fkProductId = productId
                                        INNER JOIN brands ON productBrand = brandId
                                        INNER JOIN media ON productImage = mediaId
                                        ")->fetchAll();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Offer-class.php]: " . $err->getMessage());
        } 
    }

    public static function GetOfferById($offerId)
    {
        try
        {
            return (new self)->query("SELECT productId, productModel, productPrice, brandName, offerPrice FROM offers
                                        INNER JOIN products ON fkProductId = productId
                                        INNER JOIN brands ON productBrand = brandId
                                        WHERE offerId = :ID", [':ID' => $offerId])->fetch();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Offer-class.php]: " . $err->getMessage());
        } 
    }
}
