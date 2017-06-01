<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 01.06.2017
 * Time: 12:14
 */
class ImageResizer
{
    private $scale = 200;

    public function __construct($_scale)
    {
        $this->scale = $_scale;
    }

    public function resizeImage($imageFile, $quality)
    {
        $imageType = exif_imagetype($imageFile);
        switch ($imageType){
            case "2":
                $image = imagecreatefromjpeg($imageFile);
                break;
            case "3":
                $image = imagecreatefrompng($imageFile);
                break;
            default:
                return false;
        }
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        if ($imageWidth > (int)$this->scale || $imageHeight > (int)$this->scale)
        {
            $widthKoeficient = $this->scale/$imageWidth;
            $heightKoeficient = $this->scale/$imageHeight;
            $koeficient = $widthKoeficient<$heightKoeficient ? $widthKoeficient : $heightKoeficient;
            $newWidth = intval(imagesx($image)*$koeficient);
            $newHeigth = intval(imagesy($image)*$koeficient);
            $newImage = imagecreatetruecolor($newWidth,$newHeigth);
            imagecopyresampled($newImage,$image,0,0,0,0,$newWidth,$newHeigth,$imageWidth,$imageHeight);
            switch ($imageType){
                case "2":
                    imagejpeg($newImage,$imageFile,$quality);
                    break;
                case "3":
                    imagepng($newImage,$imageFile,round($quality/10));
                    break;
                default:
                    return false;
            }
            imagedestroy($image);
            imagedestroy($newImage);
        }

        return true;
    }

}