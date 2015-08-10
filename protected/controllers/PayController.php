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

    public function actionPayModule(){
        if (empty($_POST['module']) ) {
            Yii::app()->user->setFlash('errorModule', "<br>Будь-ласка, оберіть курс та модуль для оплати.");
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $permission = new PayModules();
        $module = Module::model()->findByPk($_POST["module"]);
        $name=ModuleHelper::getModuleTitleParam($module->module_ID);
        $permission->setModuleRead($_POST['user'], $module->module_ID);

        Yii::app()->user->setFlash('payModule', '<br /><h4>Вітаємо!</h4> Модуль <strong>'.
            $module->$name.'</strong> курса <strong>'.

            CourseHelper::getCourseName($_POST['course']).'</strong> оплачено.
            <br />Тепер у Вас є доступ до усіх занять цього модуля.');
        $this->redirect(Yii::app()->request->urlReferrer);
    }


    public function actionPayCourse(){
        if (empty($_POST['course']) ) {
            Yii::app()->user->setFlash('errorCourse', "<br>Будь-ласка, оберіть курс для оплати.");
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $permission = new PayCourses();
        $course = Course::model()->findByPk($_POST['course']);
        $permission->setCourseRead($_POST['user'], $course->course_ID);

        Yii::app()->user->setFlash('payCourse', '<br /><h4>Вітаємо!</h4> Курс '.
            CourseHelper::getCourseName($course->course_ID).'</strong> оплачено.
            <br />Тепер у Вас є доступ до усіх занять цього курсу.');
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}