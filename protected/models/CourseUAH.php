<?php

class CourseUAH implements \IBillableObject
{
    //Original model
    private $course;
    private $basePrice;

    function CourseUAH(Course $course){
        $this->course = $course;
        $this->basePrice = $course->getBasePrice() * Config::getDollarRate();
    }

    public function getBasePrice(){
        return $this->basePrice;
    }

    public function getDuration(){
       return $this->course->getDuration();
    }

    public function getModelUAH(){
        return $this;
    }
}