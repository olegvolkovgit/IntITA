<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2015
 * Time: 15:08
 */

class CoursesRule extends CBaseUrlRule
{

    public $connectionID = 'db';
    /*
    public function createUrl($manager,$route,$params,$ampersand) {
        if ($route==='catalog/index') {
            if (isset($params['mark'], $params['model']))
                return $params['mark'] . '/' . $params['model'];
            else if (isset($params['mark']))
                return $params['mark'];
        }
        return false;  // не применяем данное правило
    }*/
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='course/index')
        {
           if (isset($params['id']))
               return $params['id'];
        }
        return false;  // не применяем правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
        {
            // Проверяем $matches и $matches на предмет
            // соответствия производителю и модели в БД.
            // Если соответствуют, выставляем $_GET['manufacturer'] и/или $_GET['model']
            // и возвращаем строку с маршрутом 'car/index'.
            $course = Course::model()->find('alias=:alias', array(':alias' => $matches[1]));
            if ($course){
                $_GET['id'] = $course;
            }
            return 'course';
        }
        return false;  // не применяем данное правило
    }

//
//    public function createUrl($manager,$route,$params,$ampersand)
//    {
//        if ($route==='courses')
//        {
//            /*if (isset($params['courseID'], $params['moduleID'], $params['lectureID']))
//                return $params['courseID'] . '/' . $params['moduleID'] . '/' . $params['lectureID'];
//            else*/ if (isset($params['courseID'], $params['moduleID']))
//                return $params['courseID'] . '/' . $params['moduleID'];
//            else if (isset($params['courseID']))
//                return $params['courseID'];
//        }
//        return false;  // не применяем данное правило
//    }
//
//    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
//    {
//        /*if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) {
//            // Проверяем $matches[1] и $matches[3] на предмет
//            // соответствия производителю и модели в БД.
//            $mark = CatalogMark::model()->find('alias=:alias', array(':alias' => $matches[1]));
//            if ($mark !== null) {
//                $_GET['mark'] = $mark->id;
//                $model = CatalogModel::model()->getByAlias($matches[3], $mark->id);
//                if($model !== null) {
//                    $_GET['model'] = $model->id;
//                }
//                // Если соответствуют, выставляем $_GET и возвращаем строку с маршрутом 'catalog/index'.
//                return 'catalog/index';
//            }
//        }
//        return false;  // не применяем данное правило*/
//        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
//        {
//            // Проверяем $matches и $matches на предмет
//            // соответствия производителю и модели в БД.
//            // Если соответствуют, выставляем $_GET['manufacturer'] и/или $_GET['model']
//            // и возвращаем строку с маршрутом 'car/index'.
//            $course = Course::model()->find('alias=:alias', array(':alias' => $matches[1]));
//            if ($course){
//                $_GET['courseID'] = $course;
//                $module = Module::model()->getByAlias($matches[3], $course->course_ID);
//                if ($module){
//                    $_GET['moduleID'] = $module;
//                }
//            }
//
//
//
//            /*$lecture = Lesson::model()->getByAlias($matches[3], $course->course_ID);
//            if ($module){
//                $_GET['lectureID'] = $lecture;
//            }*/
//
//            return 'courses';
//        }
//        return false;  // не применяем данное правило
//    }
}