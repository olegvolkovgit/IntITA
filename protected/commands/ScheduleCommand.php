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

        date_default_timezone_set('Europe/Kiev');
        $time = (new DateTime('now'))->format('Y-m-d H:i:s');
        $criteria = new CDbCriteria();
        $criteria->addCondition('id = 155');
//        $criteria->addCondition('start_time <= :time');
//        $criteria->addCondition('status = :status');
//        $criteria->params = [':time'=>$time, ':status' => SchedulerTasks::STATUSNEW];
        $tasks = SchedulerTasks::model()->findAll($criteria);
        foreach ($tasks as $task)
        {
            $weekdays = $task->parameters;
            if ($weekdays)
            {
                $dayOfWeek =  (new DateTime('now'))->format('N');
                if (in_array($dayOfWeek,$weekdays) && (new DateTime($task->end_time))->format('N') !=$dayOfWeek || !$task->end_time){
                    $this->startTask($task);
                }
            }
            else{
                $this->startTask($task);
            }
        }

    }

    private function startTask($task){
        date_default_timezone_set('Europe/Kiev');
        $task->status = SchedulerTasks::STATUSPROGRESS;
        $task->save();
        $scheduleTask = TaskFactory::getInstance($task->type,$task->related_model_id);
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
            case 6:
                $task->status = SchedulerTasks::STATUSNEW;
                $task->save();
                break;
        }
    }

    private function repeatTask(SchedulerTasks $task, $repeatPeriod){
        $newTimeStamp = strtotime("+".$repeatPeriod, (new DateTime($task->start_time))->getTimestamp());
        $newTask = new SchedulerTasks;
        $newTask->attributes = $task->attributes;
        $newTask->start_time =  (new DateTime())->setTimestamp($newTimeStamp)->format('Y-m-d H:i:s');
        $newTask->status = SchedulerTasks::STATUSNEW;
        $newTask->end_time = null;
        $newTask->save();
    }

    public function actionCheckBirthdays(){
        $trainers = UserTrainer::model()->with('idUser')->findAll("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        foreach ($trainers as $trainer){
            $students = TrainerStudent::model()->with(['trainer0','trainerStudent'])->findAll('trainer0.user_id='.$trainer->id_user.' AND DATE_FORMAT(trainerStudent.birthday, "%d-%m")=DATE_FORMAT(NOW(),"%d-%m")');
            if(count($students)>0){
                $user = StudentReg::model()->findByPk($trainer->id_user);
                    $message = new UserMessages();
                    $receiverId = $trainer->id_user;
                    if ($receiverId == 0) {
                        throw new \application\components\Exceptions\IntItaException(400, 'Неправильно вибраний адресат повідомлення.');
                    }
                    $receiver = StudentReg::model()->findByPk($receiverId);
                    $subject = 'Оповіщення про День народження';
                    $text = "Сьогодні День народження у: \r\n" ;
                    foreach ($students as $student){
                        $model = StudentReg::model()->findByPk($student->student);
                        $text .= "\r\n".$model->fullName.' ('.$model->email.');';
                    }
                    $message->build($subject, $text, array($receiver), $user);
                    $msg = $message->create();
                    Yii::app()->db->createCommand()->insert('message_receiver', array(
                    'id_message' => $msg->id_message,
                    'id_receiver' => $receiverId,
                    ));
            }
        }


    }


}