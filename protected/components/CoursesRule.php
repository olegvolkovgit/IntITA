<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2015
 * Time: 15:08
 */
class CoursesRule extends CBaseUrlRule
{
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        if (preg_match('#^([\w-]+)#i', $pathInfo, $matches)) {
            $course = Course::model()->find(array(
                'condition' => 'alias = :alias',
                'params' => array('alias'=>$matches[1]),
            ));
            if ($course !== null) {
                $_GET['id'] = $course->getPrimaryKey();
                return 'course/index';
            }
        }
        return false;
    }

    public function createUrl($manager, $route, $params, $ampersand)
    {
        if ($route == 'course/index') {
            if (!empty($params['id'])) {
                if ($course = Course::model()->findByPk($params['id'])) {
                    return $course->alias;
                }
            }
        }
        return false;
    }
}