<?php

/**
 * Created by PhpStorm.
 * User: ����
 * Date: 16.11.2015
 * Time: 14:35
 */
class InterpreterController extends Controller
{
    public $layout = 'lessonlayout';

    public function initialize($idLecture, $idTask)
    {
        $lecture = Lecture::model()->findByPk($idLecture);
        $task = Task::model()->findByPk($idTask);
        if(!$lecture || !$task){
            throw new \application\components\Exceptions\IntItaException('404', 'Запитувана сторінка не існує.');
        }
        if($idLecture!=Task::getTaskLecture(($idTask))){
            throw new \application\components\Exceptions\IntItaException('404', 'Запитувана сторінка не існує.');
        }
        $editMode = Teacher::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule);
        if (!$editMode) {
            throw new \application\components\Exceptions\IntItaException('403', 'У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном автора модуля.');
           }
    }

    public function actionIndex($id,$task)
    {
        $this->initialize($id,$task);

        $this->render('index',array('idTask'=>$task));
    }
}