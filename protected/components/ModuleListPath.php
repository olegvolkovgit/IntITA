<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.10.2015
 * Time: 2:16
 */

class ModuleListPath {
    public $url = 'modules/index';

    public function parseUrl(){
        return $this;
    }

    public function getType(){
        return 'modules_list';
    }
}