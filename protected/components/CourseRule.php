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
        $pathParts = explode('/', $pathInfo);

        if ($pathParts[0] == 'course') {
            if ($pathParts[1] == 'ru' || $pathParts[1] == 'en' || $pathParts[1] == 'ua') {
                $course = Course::model()->find(array(
                    'condition' => 'alias = :alias',
                    'params' => array('alias' => $pathParts[2]),
                ));

                if (isset($pathParts[3])) {
                    $module = Module::getModuleByAlias($pathParts[3], $course->course_ID);

                    if (isset($pathParts[4])) {
                        $lecture = Lecture::getLectureIdByModuleOrder($module->module_ID, $pathParts[4]);
                        if (isset($pathParts[5])) {
                            $_GET['page'] = $pathParts[5];
                        }
                    }


                }
            } else {
                $course = Course::model()->find(array(
                    'condition' => 'alias = :alias',
                    'params' => array('alias' => $pathParts[1]),
                ));
                if (isset($pathParts[2])) {
                    $module = Module::getModuleByAlias($pathParts[2], $course->course_ID);

                    if (isset($pathParts[3])) {
                        $lecture = Lecture::getLectureIdByModuleOrder($module->module_ID, $pathParts[3]);

                        if (isset($pathParts[4])) {
                            $_GET['page'] = $pathParts[4];
                        }
                    }
                }
            }

            if ($course !== null) {
                if ($module !== null) {
                    if ($lecture != null) {
                        $_GET['id'] = $lecture->getPrimaryKey();
                        $_GET['idCourse'] = $course->getPrimaryKey();
                        if (!isset($_GET['page'])) {
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
        if ($route == 'lesson/index') {
            if (!empty($params['id'])) {
                if ($lecture = Lecture::model()->findByPk($params['id'])) {
                    $course = Course::model()->findByPk($params['idCourse']);
                    if (!isset($params['page'])) {
                        $pageString = '';
                    } else {
                        $pageString = 'page=' . $params['page'];
                    }

                    return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias($lecture->idModule, $course->course_ID)
                    . '/' . $lecture->order . '?' . $pageString;

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