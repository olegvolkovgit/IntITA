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
        switch($pathParts[0]){
            case 'course':
                $pathObject = new CoursePath($pathParts);
                 break;
            case 'module':
                $pathObject = null;// ModulePath($pathParts);
                break;
            default:
                $pathObject = null;
                break;
        }
        return $pathObject;
    }
}