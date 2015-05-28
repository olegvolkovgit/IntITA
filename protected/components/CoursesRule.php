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

    public function createUrl($manager,$route,$params=array(),$ampersand)
    {
        if ($route==='course/index') {
            if (isset($params['id'])) {
                $alias = Course::model()->findByPk($params['id'])->alias;
                $params['id'] = $alias;
                return $alias;
            }
            return parent::createUrl($manager,$route, $params, $ampersand);
        }
        return false;  // не применяем правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
        {
            // совпадают ли $matches[1] и $matches[3] с
            // производителем и моделью в базе?
            // если да, выставляем $_GET['manufacturer'] и/или $_GET['model']
            // и возвращаем 'car/index'
            $alias = Course::model()->findByAttributes(array('alias' => $matches[1]))->course_ID;
            if($alias){
                $_GET['id'] = $alias;
                return 'course/index';
            }
        }
        return false;  // не применяем правило
    }
}