<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 15.09.2015
 * Time: 14:30
 */

class PathFactory {
    //for url manager
    public static function factory($pathInfo){

        $pathParts = explode('/', $pathInfo);
        //var_dump($pathParts);die();

        switch($pathParts[0]){
            case 'course':
                $pathObject = new CoursePath($pathParts);
                 break;
            case 'module':
                if(in_array($pathParts[1], array('ru', 'ua', 'en'))) {
                    $pathObject = new ModulePath($pathParts);
                } else {
                    return null;
                }
                break;
            default:
                $pathObject = null;
                break;
        }
        return $pathObject;
    }
}