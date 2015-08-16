<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CourseAgreement
 *
 * @author alterego4
 */
class CourseAgreement extends UserAgreements
{
    public $course_id;
    //put your code here
    public static function getByCourse($user_id, $course_id)
    {
        $service = CourseService::model()->findByAttributes(array('course_id'=>$course_id));
        if(!isset($service))
        {
            $service = CourseService::createCourseService();
        }
        
        $model = CourseAgreement::model()->findByAttributes(array('service_id'=>$service->service_id, 'user_id' => $user_id));
        if(!isset($model))
        {

            $model = new CourseAgreement();
            $model->service_id = $service->service_id;
            $model->user_id    = $user_id;
            $model->payment_scheme = 1;
            $model->save();
        }
        return $model;
    }
   
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

}
