<?php

class Pagination
{
    public static $items = [];
    public static $limit = 3;
    public static $offset = 1;

    public static function Init(array $items)
    {
        try
        {
            self::$items = $items;
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Pagination-class.php]: " . $err->getMessage());
        }
    }

    public static function Items($offset = 1)
    {
        try
        {
            $itemsCount = count(self::$items);
            $itemOffset = (int)(ceil(self::$limit * $offset));
            $currentItem = $itemOffset - self::$limit;
            $output = [];
            for($currentItem; $currentItem < $itemOffset; $currentItem++){
                if(isset(self::$items[$currentItem])){
                    $output[] = self::$items[$currentItem];
                }
            }
            return $output;
           
        }catch(Exception $err)
        {
            throw new Exception("Fejl! [Pagination-class.php]: " . $err->getMessage());
        }
    }

    public static function Pages() 
    {
        return (int)(ceil(count(self::$items) / self::$limit));
    }
}
