<?php

class PageContent extends Database
{
    public static function GetPagesWithContent()
    {
        try
        {
            return (new self)->query("SELECT `pageId`, `pageName`, `pageText`, `filename` FROM pageContent
                                        LEFT JOIN media ON pageImage = mediaId")->fetchAll();
        }catch(Exception $e)
        {
            throw new Exception("Fejl [PageContent-class]: " . $e->getMessage());
        }
    }
}
