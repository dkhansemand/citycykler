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

    public static function UpdatePageContent($pageId, $pageContent)
    {
        try
        {
            return (new self)->query("UPDATE pageContent SET pageText = :PTEXT WHERE pageId = :PID", [':PID' => $pageId, ':PTEXT' => $pageContent]);
        }catch(Exception $e)
        {
            throw new Exception("Fejl [PageContent-class]: " . $e->getMessage());
            return false;
        }
    }

    public static function GetContentByName($pageName)
    {
        try
        {
            return (new self)->query("SELECT `pageId`, `pageName`, `pageText`, `filename` FROM pageContent
                                        LEFT JOIN media ON pageImage = mediaId
                                        WHERE pageName = :PNAME", [':PNAME' => $pageName])->fetch();
        }catch(Exception $e)
        {
            throw new Exception("Fejl [PageContent-class]: " . $e->getMessage());
            return false;
        }
    }
}
