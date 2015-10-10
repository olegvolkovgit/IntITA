<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.10.2015
 * Time: 2:00
 */

class CourseListPath extends Path{

    public $url = 'courses/index';

    public function parseUrl(){
        return $this;
    }

    public function getType(){
        return 'courses_list';
    }

}