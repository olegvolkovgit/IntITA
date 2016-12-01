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
        $criteria->params = [':time'=>$time, ':status' => SchedulerTasks::STATUSNEW];
        $tasks = SchedulerTasks::model()->findAll($criteria);
        foreach ($tasks as $task)
        {
            $this->startTask($task);
        }

    }

    private function startTask($task){
        date_default_timezone_set(Config::getServerTimezone());
        $task->status = SchedulerTasks::STATUSPROGRESS;
        $task->save();
        $scheduleTask = TaskFactory::getInstance($task->type,$task->parameters);
        try {
            $scheduleTask->run();
        } catch (Exception $e) {
         $task->status = SchedulerTasks::STATUSERROR;
         $task->end_time  = (new DateTime('now'))->format('Y-m-d H:i:s');
         $task->error = $e->getMessage();
         $task->save();
         Yii::app()->end();
        }
        $task->status = SchedulerTasks::STATUSOK;
        $task->end_time  = (new DateTime('now'))->format('Y-m-d H:i:s');
        $task->save();
        switch ($task->repeat_type){
            case 2:
                $this->repeatTask($task,'1 day');
                break;
            case 3:
                $this->repeatTask($task,'1 week');
                break;
            case 4:
                $this->repeatTask($task,'1 month');
                break;
            case 5:
                $this->repeatTask($task,'1 year');
                break;
        }
    }

    private function repeatTask(SchedulerTasks $task, $repeatPeriod){
        $newTimeStamp = strtotime("+".$repeatPeriod, (new DateTime($task->start_time))->getTimestamp());
        $newTask = new SchedulerTasks();
        $newTask = $task;
        $newTask->start_date =  (new DateTime())->setTimestamp($newTimeStamp)->format('Y-m-d H:i:s');;
        $newTask->enf_date = '';
        $newTask->save();
    }
}