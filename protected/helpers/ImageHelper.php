<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 27.08.2015
 * Time: 11:01
 */
class ImageHelper
{
    /*Upload images and change the resolution. $originalImg - the path to the original image, $newImg - the path to the new image,
    $minSize - minimum resolution height or width*/
    public static function uploadAndResizeImg($originalImg, $newImg,$minSize){
        $file = $originalImg;
        $fileResize = $newImg;
        $sizeImage = getimagesize ($file);
        if ($sizeImage[0]>=$sizeImage[1])
        {
            $heightImg = $minSize;
            $width = null;
        }
        else{
            $heightImg = null;
            $width = $minSize;
        }
        $image = Yii::app()->image->load($file);
        $image->resize($width, $heightImg);
        $image->save($fileResize);
    }
    /*$pathToFile - the path to images, $basePartName - base part of file name, $id - id file, $defaultName -default file name */
    public static function setOpenGraphImage($pathToFile,$basePartName, $id, $defaultName){
        $filePNG=$pathToFile.$basePartName.$id.'.png';
        $fileJPG=$pathToFile.$basePartName.$id.'.jpg';
        $fileGIF=$pathToFile.$basePartName.$id.'.gif';
        if (is_file($filePNG))
            return $basePartName.$id.'.png';
        if (is_file($fileJPG))
            return $basePartName.$id.'.jpg';
        if (is_file($fileGIF))
            return $basePartName.$id.'.gif';

        return $defaultName;
    }
}