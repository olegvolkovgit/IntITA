<?php

/**
 * Created by PhpStorm.
 * User: ����
 * Date: 16.11.2015
 * Time: 14:35
 */
class InterpreterController extends Controller
{
    public $layout = 'interpreterlayout';

    public function initialize($idRevision, $task)
    {
        $revision = RevisionLecture::model()->findByPk($idRevision);

        if(!$revision || !$task){
            throw new \application\components\Exceptions\IntItaException('404', 'Запитувана сторінка не існує.');
        }

        if ($revision->properties->id_user_created!=Yii::app()->user->getId()) {
            throw new \application\components\Exceptions\IntItaException('403', 'У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном автора ревізії.');
        }
        if (!$revision->isEditable()) {
            throw new \application\components\Exceptions\IntItaException('403', 'Ревізія знаходиться в статусі недоступному для редагування');
        }
    }

    public function actionIndex($id,$task)
    {
        $task = RevisionTask::model()->findByPk(array($task));
        $this->initialize($id,$task);

        $this->render('index',array('task'=>$task));
    }

    public function actionEditTask()
    {
        $idTask = Yii::app()->request->getPost('idTask');
        $json=Yii::app()->request->getPost('json');
        $task=RevisionTask::model()->findByPk($idTask);

        $taskArray=RevisionTask::model()->findAllByAttributes(array('uid'=>$task->uid));
        if($taskArray[0]->lectureElement->page->revision->id_revision!=$task->lectureElement->page->revision->id_revision){
            echo $task->editTaskWithNewUID($json);
        }else{
            echo false;
        }
    }
}