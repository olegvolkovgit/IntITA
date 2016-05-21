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

        $path = PathFactory::factory($pathInfo);
        if (is_null($path)) {
            return false;
        }

        $path = $path->parseUrl();

        switch ($path->getType()) {
            case 'course':
                if ($path->course !== null) {
                    if ($path->module !== null) {
                        if ($path->lecture != null) {
                            $_GET['id'] = $path->lecture->getPrimaryKey();
                            $_GET['idCourse'] = $path->course->getPrimaryKey();

                            if (!isset($_GET['page']) && !isset($_GET['pageId'])) {
                                $_GET['page'] = 1;
                            };

                            if($path->isPageDefined) {
                                $_GET['page'] = $path->page;
                                if (isset($_GET['edit'])) {
                                    $_GET['pageId'] = $path->page;
                                    return 'lesson/editPage';
                                }
                                if (isset($_GET['editCKE'])) {
                                    $_GET['pageId'] = $path->page;
                                    $_GET['cke'] = true;
                                    return 'lesson/editPage';
                                }
                            } else {
                                if (isset($_GET['edit'])) {
                                    return 'lesson/showPagesList';
                                }
                            }
                            return 'lesson/index';
                        }
                        $_GET['idCourse'] = $path->course->getPrimaryKey();
                        $_GET['idModule'] = $path->module->getPrimaryKey();
                        return 'module/index';
                    }
                    $_GET['id'] = $path->course->getPrimaryKey();
                    return 'course/index';
                }
                break;
            case 'module':
                if ($path->lang) {
                    if ($path->module !== null) {
                        if ($path->lecture != null) {
                            $_GET['id'] = $path->lecture->getPrimaryKey();
                            if (!isset($_GET['page'])) {
                                $_GET['page'] = 1;
                            };

                            if($path->isPageDefined) {
                                $_GET['page'] = $path->page;
                                if (isset($_GET['edit'])) {
                                    return 'lesson/editPage';
                                }
                                if (isset($_GET['editCKE'])) {
                                    $_GET['cke'] = true;
                                    return 'lesson/editPage';
                                }
                            } else {
                                if (isset($_GET['edit'])) {
                                    return 'lesson/showPagesList';
                                }
                            }
                            return 'lesson/index';
                        } else {
                            $_GET['idModule'] = $path->module->module_ID;
                            return 'module/index';
                        }
                    }
                }
                break;
            case 'courses_list':
                return $path->url;
                break;
            case 'modules_list':
                return $path->url;
                break;
            default:
                return false;
        }
        return false;
    }

    public function createUrl($manager, $route, $params, $ampersand)
    {
        if ($route == 'lesson/index') {
            if (!empty($params['id'])) {
                if ($lecture = Lecture::model()->findByPk($params['id'])) {
                    if (!isset($params['page'])) {
                        $pageString = '';
                    } else {
                        $pageString = '?page=' . $params['page'];
                    }

                    if (!isset($params['template'])) {
                        $template = '';
                    } else {
                        $template = '?template=' . $params['template'];
                    }
                    if ($params['idCourse'] != 0) {
                        $course = Course::model()->findByPk($params['idCourse']);

                        return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias($lecture->idModule, $course->course_ID)
                        . '/' . $lecture->order . $pageString."/".$template;
                    } else {
                        return 'module/' . $lecture->module->language . '/' .Module::getModuleAlias($lecture->idModule, null)
                        . '/' . $lecture->order . $pageString."/".$template;
                    }
                }
            }
        }
        if ($route == 'lesson/editPage') {

            if (!empty($params['pageId'])) {
                $page = LecturePage::model()->findByPk($params['pageId']);
                if ($lecture = $page->lecture) {
                    if (isset($params['cke'])){
                        $cke = 'CKE';
                    } else {
                        $cke = '';
                    }

                      if ($params['idCourse'] != 0) {
                        $course = Course::model()->findByPk($params['idCourse']);


                        return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias($lecture->idModule, $course->course_ID)
                        . '/' . $lecture->order .'/'.$page->page_order.'?edit'.$cke;
                    } else {
                        return 'module/' . $lecture->module->language . '/' .Module::getModuleAlias($lecture->idModule, null)
                        . '/' . $lecture->order  .'/'.$page->page_order.'?edit'.$cke;
                    }
                }
            }
        }
        if ($route == 'lesson/showPagesList') {
            if (!empty($params['idLecture'])) {
                if ($lecture = Lecture::model()->findByPk($params['idLecture'])) {
                    if ($params['idCourse'] != 0) {
                        $course = Course::model()->findByPk($params['idCourse']);

                        return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias($lecture->idModule, $course->course_ID)
                        . '/' . $lecture->order .'?edit';
                    } else {
                        return 'module/' . $lecture->module->language . '/' .Module::getModuleAlias($lecture->idModule, null)
                        . '/' . $lecture->order  .'?edit';
                    }
                }
            }
        }
        if ($route == 'module/index') {
            if (isset($params['idModule'])) {
                if ($module = Module::model()->findByPk($params['idModule'])) {
                    if (isset($params['idCourse'])) {
                        $course = Course::model()->findByPk($params['idCourse']);

                        return 'course/' . $course->language . '/' . $course->alias . '/' . Module::getModuleAlias(
                            $params['idModule'],
                            $params['idCourse']
                        );
                    } else {
                        return 'module/' . $module->language . '/' . Module::getModuleAlias(
                            $params['idModule'], null
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