<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:06
 */

class PayController extends Controller{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionPayNow(){
        if (!isset($_POST['module']) ) {
            Yii::app()->user->setFlash('error', "<br>Будь-ласка, оберіть курс та модуль для оплати.");
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $permission = new Permissions();
        $lectures = Yii::app()->db->createCommand(array(
            'select' => array('id'),
            'from' => 'lectures',
            'where' => 'idModule=:id',
            'params' => array(':id'=>$_POST["module"]),
        ))->queryAll();
        $count = count($lectures);
        for($i = 0; $i < $count; $i++){
            $permission->setRead($_POST['user'], $lectures[$i]["id"]);
        }
        Yii::app()->user->setFlash('pay', '<br /><h4>Вітаємо!</h4> Модуль <strong>'.
            Module::model()->findByPk($_POST["module"])->module_name.'</strong> курса <strong>'.
            Course::model()->findByPk($_POST['course'])->course_name.'</strong> оплачено.
            <br />Тепер у Вас є доступ до усіх лекцій цього модуля. <h4>Enjoy it!</h4>');
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}