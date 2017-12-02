<?php


abstract class Rating
{
    public static function getInstance($service){
        switch($service){
            case Service::COURSE:
                $model = new RatingUserCourse();
                break;
            case Service::MODULE:
                $model = new RatingUserModule();
                break;
            default :
                $model = new RatingUserCourse();
        }
        return $model;
    }
}