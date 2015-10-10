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
                if (isset($pathParts[1])) {
                    $pathObject = new CoursePath($pathParts);
                } else{
                    $pathObject = new CourseListPath($pathParts);
                }
                 break;
            case 'module':
                if (isset($pathParts[1])) {
                    if (in_array($pathParts[1], array('ru', 'ua', 'en'))) {
                        $pathObject = new ModulePath($pathParts);
                    } else {
                        $pathObject = null;
                    }
                } else {
                    $pathObject = new ModuleListPath($pathParts);
                }
                break;
            default:
                $pathObject = null;
                break;
        }
        return $pathObject;
    }
}