<?php

class MediaResizer
{
    private static $image;
    private static $imageX;
    private static $imageY;
    private static $imageType;

    private static function PrepareImage($file)
    {
        $imageData = getimagesize($file);
        self::$imageX = $imageData[0];
        self::$imageY = $imageData[1];
        self::$imageType = $imageData[2];
        if(self::$imageType === IMAGETYPE_JPEG)
        {
            self::$image = imagecreatefromjpeg($file);
        }
        elseif(self::$imageType === IMAGETYPE_GIF)
        {
            self::$image = imagecreatefromgif($file);
        }
        elseif(self::$imageType === IMAGETYPE_PNG)
        {
            self::$image = imagecreatefrompng($file);
        }
    }

    private static function Resize(int $width, int $height)
    {
        $newFile = imagecreatetruecolor($width, $height);
        imagecopyresampled($newFile, self::$image, 0,0,0,0, $width, $height, self::$imageX, self::$imageY);
        self::$image = $newFile;
    }

    public static function Generate(string $srcImage, string $dstImage, int $width = 200, int $height = 150)
    {
        self::PrepareImage($srcImage);   
        self::Resize($width, $height);
        if(self::$imageType === IMAGETYPE_JPEG)
        {
            imagejpeg(self::$image, $dstImage, 75);
        }
        elseif(self::$imageType === IMAGETYPE_GIF)
        {
            imagegif(self::$image, $dstImage);
        }
        elseif(self::$imageType === IMAGETYPE_PNG)
        {
            imagepng(self::$image, $dstImage);
        }else{
            return false;
        }
        imagedestroy(self::$image);
        return true;
    }
}
