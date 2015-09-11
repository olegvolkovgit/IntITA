<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2015
 * Time: 15:08
 */
class CourseRule extends CBaseUrlRule
{
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        $module = null;
        $lecture = null;

        if (preg_match('#^([\w-]+)#i', $pathInfo, $matches)){
            $pathParts = explode('/', $pathInfo);
            if($pathParts[0] == 'site'){
                return false;
            }

            if($pathParts[0] == 'ru' || $pathParts[0] == 'en' || $pathParts[0] == 'ua') {
                $course = Course::model()->find(array(
                    'condition' => 'alias = :alias',
                    'params' => array('alias' => $pathParts[1]),
                ));

                if(isset($pathParts[2])){
                    $module = Module::getModuleByAlias($pathParts[2], $course->course_ID);

                    if(isset($pathParts[3])) {
                        $lecture = Lecture::getLectureIdByModuleOrder($module->module_ID, $pathParts[3]);
                    }
                }

            } else {
                $course = Course::model()->find(array(
                    'condition' => 'alias = :alias',
                    'params' => array('alias' => $pathParts[0]),
                ));
                if(isset($pathParts[1])){
                    $module = Module::getModuleByAlias($pathParts[1], $course->course_ID);

                    if(isset($pathParts[2])) {
                        $lecture = Lecture::getLectureIdByModuleOrder($module->module_ID, $pathParts[2]);
                    }
                }
            }

            if ($course !== null) {
                if ($module !== null) {
                    if($lecture != null){
                        $_GET['id'] = $lecture->getPrimaryKey();
                        $_GET['idCourse'] = $course->getPrimaryKey();
                        if(!isset($_GET['page'])){
                            $_GET['page'] = 1;
                        };

                        return 'lesson/index';
                    }

                    $_GET['idCourse'] = $course->getPrimaryKey();
                    $_GET['idModule'] = $module->getPrimaryKey();
                    return 'module/index';
                }



                $_GET['id'] = $course->getPrimaryKey();
                return 'course/index';
            }
        }
        return false;
    }

    public function createUrl($manager, $route, $params, $ampersand)
    {
        if ($route == 'lesson/index'){
            if (!empty($params['id'])){
                if ($lecture = Lecture::model()->findByPk($params['id'])) {
                    $course = Course::model()->findByPk($params['idCourse']);
                    if(!isset($params['page'])){
                        $params['page'] = 1;
                    }

                    return $course->language.'/'.$course->alias.'/'.Module::getModuleAlias($lecture->idModule, $course->course_ID)
                    .'/'.$lecture->order.
                    '/?page='.$params['page'];
                }
            }
        }
        if ($route == 'module/index'){
            if (!empty($params['idModule'])){
                if ($module = Module::model()->findByPk($params['idModule'])) {
                    $course = Course::model()->findByPk($params['idCourse']);

                    return $course->language.'/'.$course->alias.'/'.Module::getModuleAlias(
                        $params['idModule'],
                        $params['idCourse']
                    );
                }
            }
        }
        if ($route == 'course/index') {
            if (!empty($params['id'])) {
                if ($course = Course::model()->findByPk($params['id'])) {

                        return $course->language . '/' . $course->alias;

                }
            }
        }

            return false;
    }
}