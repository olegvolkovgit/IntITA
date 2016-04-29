<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 09.05.2015
 * Time: 13:53
 */

class StaticFilesHelper {

    public static function createPath($category, $subcategory, $name){
        switch($category){
            case 'image':
                return StaticFilesHelper::createImagePath($subcategory, $name);
                break;
            case 'avatars':
                return StaticFilesHelper::createAvatarsPath($name);
                break;
            case 'common':
                return StaticFilesHelper::createCommonPath($subcategory, $name);
                break;
            case 'txt':
                return StaticFilesHelper::createTxtPath($subcategory, $name);
                break;
            default:
                return StaticFilesHelper::createCommonPath($subcategory, $name);
                break;
        }
    }

    public static function createImagePath($subcategory, $name){
        $path = Config::getImagesPath();
        return implode('/', array($path,$subcategory,$name));
    }

    public static function createLectureImagePath(){
        return '/images/lecture/';
    }

    public static function createTxtPath($name){
        return Config::getCommonPath().'/'.$name;
    }

    public static function createAvatarsPath($name){
        $path = Config::getAvatarsPath().'/'.$name;
        return $path;
    }

    public static function createCommonPath($name){
        return Config::getCommonPath().'/'.$name;
    }

    public static function fullPathTo($type, $name){
        switch($type){
            case 'js':
                return StaticFilesHelper::fullPathToJs($name);
                break;
            case 'css':
                return StaticFilesHelper::fullPathToCss($name);
                break;
            case 'angular':
                return StaticFilesHelper::fullPathToAngular($name);
                break;
            default:
                return StaticFilesHelper::fullPathToFiles($name);
                break;
        }
    }

    public static function pathToCourseSchema($name){
        return  'files/course_schemas/'.$name;
    }

    public static function fullPathToJs($name){
      return Config::getBaseUrl().'/scripts/'.$name;
    }

    public static function fullPathToCss($name){
        return Config::getBaseUrl().'/css/'.$name;
    }

    public static function fullPathToAngular($name){
        return Config::getBaseUrl().'/angular/'.$name;
    }

    public static function fullPathToFiles($name){
        return Config::getBaseUrl().'/files/'.$name;
    }

    public static function pathToLecturePageHtml($module, $lecture, $page, $lang, $type){
        return 'content/module_'.$module."/lecture_".$lecture."/page_".$page."_".$type."_".$lang.".html";
    }
    public static function pathToDeleteLecturePageHtml($module, $lecture){
        return 'content/module_'.$module."/lecture_".$lecture;
    }
    public static function pathToLectureImages($module, $lecture){
        return 'content/module_'.$module."/lecture_".$lecture."/images/";
    }
    public static function pathToLectureAudio($module, $lecture){
        return 'content/module_'.$module."/lecture_".$lecture."/audio/";
    }
    public static function pathToImagesContent($name){
        $subDir = substr($name, 0, 2);
        return 'content/images/'.$subDir.'/';
    }
    public static function pathToAudioContent($name){
        $subDir = substr($name, 0, 2);
        return 'content/audio/'.$subDir.'/';
    }
}