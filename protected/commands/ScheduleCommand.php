<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 28.11.2016
 * Time: 13:03
 */
class ScheduleCommand extends CConsoleCommand
{

    public function actionCheckTask(){

        date_default_timezone_set(Config::getServerTimezone());
        $time = (new DateTime('now'))->format('Y-m-d H:i:s');
        $criteria = new CDbCriteria();
        $criteria->addCondition('start_time <= :time');
        $criteria->addCondition('status = :status');
        $criteria->params = [':time'=>$time, ':status' => Tasks::STATUSNEW];
        $tasks = Tasks::model()->findAll($criteria);
        foreach ($tasks as $task)
        {
            $this->startTask($task);
        }

    }

    private function startTask($task){
        date_default_timezone_set(Config::getServerTimezone());
        $task->status = Tasks::STATUSPROGRESS;
        $task->save();
        $scheduleTask = TaskFactory::getInstance($task->type,$task->parameters);
        try {
            $scheduleTask->run();
        } catch (Exception $e) {
         $task->status = Tasks::STATUSERROR;
         $task->end_time  = (new DateTime('now'))->format('Y-m-d H:i:s');
         $task->error = $e->getMessage();
         $task->save();
         Yii::app()->end();
        }
        $task->status = Tasks::STATUSOK;
        $task->end_time  = (new DateTime('now'))->format('Y-m-d H:i:s');
        $task->save();
    }


}