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
                return taticFilesHelper::createCommonPath($subcategory, $name);
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
        $path = Yii::app()->params['imagesPath'];
        switch($subcategory){
            case "editor":
                $path = $path.'/editor/'.$name;
                break;
            case "avatars":
                $path = $path.'/avatars/'.$name;
                break;
            case 'mainpage':
                $path = $path.'/mainpage/'.$name;
                break;
            case 'courses':
                $path = $path.'/courses/'.$name;
                break;
            case 'course':
                $path = $path.'/course/'.$name;
                break;
            case 'module':
                $path = $path.'/module/'.$name;
                break;
            case 'lecture':
                $path = $path.'/lecture/'.$name;
                break;
            case 'aboutus':
                $path = $path.'/aboutus/'.$name;
                break;
            case 'profile':
                $path = $path.'/student/'.$name;
                break;
            case 'teachers':
                $path = $path.'/teachers/'.$name;
                break;
            case 'graduates':
                $path = $path.'/graduates/'.$name;
                break;
            case 'register':
                $path = $path.'/register/'.$name;
                break;
            case 'common':
                $path = $path.'/common/'.$name;
                break;
            case 'icons':
                $path = $path.'/icons/'.$name;
                break;
            case 'rating':
                $path = $path.'/rating/'.$name;
                break;
            case 'signin':
                $path = $path.'/signin/'.$name;
                break;
            default:
                break;
        }
        return $path;
    }


    public static function createTxtPath($name){
        return Yii::app()->params['commonPath'].'/'.$name;
    }

    public static function createAvatarsPath($name){
        $path = Yii::app()->params['avatarsPath'];
        return $path;
    }

    public static function createCommonPath($name){
        return Yii::app()->params['commonPath'].'/'.$name;
    }

}