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
    public $course_id;
    //put your code here
    protected function beforeValidate() {
        $this->course_id = 1;
        if(!isset($this->course_id)) return false;
        return parent::beforeValidate();
    }
    public function beforeSave() 
    {
        var_dump($this->course_id);
        $courseService = CourseService::model()->findByAttributes(array('course_id'=>$this->course_id));
        

        if(!isset($courseService))
        {
                      
            $courseService = new CourseService();
            $courseService->course_id = $this->course_id;
            echo '[Echo COURSE PayMENT] before save <br>';
            $courseService->save();
            if(!$courseService->save())
            {
                var_dump($courseService->errors);
                Yii::app()->end();
            }
            $this->service = $courseService->service;
            $this->service_id = $courseService->service_id;
        }
        else 
        {
            $this->service = $courseService->service;
            $this->service_id = $courseService->service_id;
        }
        return parent::beforeSave();
    }
    
    public function relations() {
        $resultarray = parent::relations();
        $resultarray['service'] = array(self::BELONGS_TO, 'CourseService', 'service_id');
        return $resultarray;
    }
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
}
