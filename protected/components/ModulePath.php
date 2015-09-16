<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 15.09.2015
 * Time: 14:41
 */

class ModulePath extends Path{

    public function parseUrl(){
        var_dump($this->pathArray);die();

    }

    public function getType(){
        return 'module';
    }
}