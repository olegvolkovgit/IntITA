<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 15.09.2015
 * Time: 10:42
 */
class FileUploadHelper
{
    public static function getFileName($file){
        $fileExtension = new SplFileInfo($file);
        $fileName=uniqid().'.'.$fileExtension->getExtension();
        return $fileName;
    }
    public static function getFileNameForBase64(){
        return uniqid().'.jpg';
    }
}