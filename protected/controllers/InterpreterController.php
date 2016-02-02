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

    public function actionIndex($id,$task)
    {
        $lecture = Lecture::model()->findByPk($id);
        $editMode = PayModules::checkEditMode($lecture->idModule, Yii::app()->user->getId());
        if (!$editMode) {
            throw new CHttpException(403, 'У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном автора модуля.');
        }
        $this->render('index',array('idTask'=>$task));
    }
}