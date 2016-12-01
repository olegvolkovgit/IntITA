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
//        $tt = strtotime("+1 year", (new DateTime('now'))->getTimestamp());
//        $mm =  (new DateTime())->setTimestamp($tt)->format('Y-m-d H:i:s');
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
                $newTask = new SchedulerTasks();
                $newTask = $task;
                $newTask->start_date = strtotime("+1 day", $task->start_date);
                $newTask->enf_date = '';
                $newTask->save();
                break;
            case 2:
                $newTask = new SchedulerTasks();
                $newTask = $task;
                $newTask->start_date = strtotime("+1 week", $task->start_date);
                $newTask->enf_date = '';
                $newTask->save();
                break;
            case 3:
                $newTask = new SchedulerTasks();
                $newTask = $task;
                $newTask->start_date = strtotime("+1 month", $task->start_date);
                $newTask->enf_date = '';
                $newTask->save();
                break;
            case 3:
                $newTask = new SchedulerTasks();
                $newTask = $task;
                $newTask->start_date = strtotime("+1 year", $task->start_date);
                $newTask->enf_date = '';
                $newTask->save();
                break;
        }
    }


}