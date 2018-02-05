<?php

class SiteSettings extends Database
{
    public static function GetSiteInfo()
    {
        try
        {
            return (new self)->query("SELECT siteSettingsId, siteTitle, street, zipcode, city, phone, fax, email FROM sitesettings")->fetch();
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [SiteSettings-class.php]: " . $err->getMessage());
        }
    }

    public static function EditSiteInfo($id, $title, $street, $zip, $city, $phone, $fax, $email)
    {
        try
        {
            return (new self)->query("UPDATE sitesettings SET siteTitle = :TITLE, 
                                                                street = :STREET, 
                                                                zipcode = :ZIP, 
                                                                city = :CITY, 
                                                                phone = :PHONE, 
                                                                fax = :FAX, 
                                                                email = :EMAIL
                                                         WHERE siteSettingsId = :ID",
                                                         [
                                                            ':ID' => $id,
                                                            ':TITLE' => $title,
                                                            ':STREET' => $street,
                                                            ':ZIP' => $zip,
                                                            ':CITY' => $city,
                                                            ':PHONE' => $phone,
                                                            ':FAX' => $fax,
                                                            ':EMAIL' => $email
                                                         ]);
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [SiteSettings-class.php]: " . $err->getMessage());
        }
    }
}
