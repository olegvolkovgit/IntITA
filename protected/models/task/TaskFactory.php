<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 28.11.2016
 * Time: 18:42
 */



class TaskFactory
{
    const NEWSLETTER = 1;
    const CHANGEMODULEREVISION = 2;
    const CHANGECOURCEREVISION = 3;

    public static function getInstance($taskType, $relatedModelId){
        switch($taskType) {
            case TaskFactory::NEWSLETTER:
                return $newsLetter = Newsletters::model()->findByPk($relatedModelId);
            case TaskFactory::CHANGEMODULEREVISION:
                return $newsLetter = RevisionModule::model()->findByPk($relatedModelId);
            case TaskFactory::CHANGECOURCEREVISION:
                return $newsLetter = RevisionCourse::model()->findByPk($relatedModelId);
        }
        return null;
    }
}