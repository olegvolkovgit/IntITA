<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2015
 * Time: 15:08
 */
class CourseRule extends CBaseUrlRule
{
    public $path;

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        $module = null;
        $lecture = null;
        $path = PathFactory::factory($pathInfo);
        if(is_null($path)){
            return false;
        }

        $path = $path->parseUrl();

        if ($path->getType() == 'course') {
            if ($path->course !== null) {
                if ($path->module !== null) {
                    if ($path->lecture != null) {
                        $_GET['id'] = $path->lecture->getPrimaryKey();
                        $_GET['idCourse'] = $path->course->getPrimaryKey();
                        if (!isset($_GET['page'])) {
                            $_GET['page'] = 1;
                        };

                        return 'lesson/index';
                    }

                    $_GET['idCourse'] = $path->course->getPrimaryKey();
                    $_GET['idModule'] = $path->module->getPrimaryKey();
                    return 'module/index';
                }


                $_GET['id'] = $path->course->getPrimaryKey();
                return 'course/index';
            }
        }
        return false;
    }

    public function createUrl($manager, $route, $params, $ampersand)
    {
        if ($route == 'lesson/index') {
            if (!empty($params['id'])) {
                if ($lecture = Lecture::model()->findByPk($params['id'])) {
                    $course = Course::model()->findByPk($params['idCourse']);
                    if (!isset($params['page'])) {
                        $pageString = '';
                    } else {
                        $pageString = '?page=' . $params['page'];
                    }

                    return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias($lecture->idModule, $course->course_ID)
                    . '/' . $lecture->order . $pageString;

                }
            }
        }
        if ($route == 'module/index') {
            if (!empty($params['idModule'])) {
                if ($module = Module::model()->findByPk($params['idModule'])) {
                    $course = Course::model()->findByPk($params['idCourse']);

                    if (!empty($params['idCourse'])) {
                        return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias(
                            $params['idModule'],
                            $params['idCourse']
                        );
                    }
                }
            }
        }
        if ($route == 'course/index') {
            if (!empty($params['id'])) {
                if ($course = Course::model()->findByPk($params['id'])) {

                    return 'course/' . $course->language . '/' . $course->alias;

                }
            }
        }
        return false;
    }
}