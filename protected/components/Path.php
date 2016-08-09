<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 15.09.2015
 * Time: 14:02
 */

abstract class Path
{
    public $pathArray;

    function __construct($pathArray) {
        $app = Yii::app();
        isset($app->session['lg'])?$app->language = $app->session['lg']:$app->language = 'ua';
        
        $this->pathArray = $pathArray;
        $this->type = $this->getType();
    }

    //return parsed object as CoursePath, ModulePath etc.
    abstract public function parseUrl();

    abstract public function getType();
}