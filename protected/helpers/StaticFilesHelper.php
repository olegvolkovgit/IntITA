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
        $path = Yii::app()->params['imagesPath'];
        switch($subcategory){
            case "editor":
                $path = $path.'/editor/'.$name;
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
                $path = $path.'/profile/'.$name;
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

    public static function setTeachersModules($id){
        $criteria = new CDbCriteria();
        $criteria->alias = 'module';
        $criteria->join='JOIN teacher_module ON teacher_module.idModule = module.module_ID';
        $criteria->condition='teacher_module.idTeacher='.$id;
        $criteria->distinct = true;
        $modules = Module::model()->findAll($criteria);
        return $modules;
    }
}