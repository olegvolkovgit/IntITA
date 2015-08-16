<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoursePayment
 *
 * @author alterego4
 */
class CoursePayment extends InternalPays
{
    protected $service_model = 'CourseService';
    protected $service_id_param = 'course_id';
    
    public $course_id;
    
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
}
