<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:06
 */

class PayController extends AdminController
{

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
        $name = Module::getModuleTitleParam($module->module_ID);
        $permission->setModuleRead($_POST['user'], $module->module_ID);

        $userId = $_POST['user'];

        if(Mail::sendPayLetter($userId,$module)){

        Yii::app()->user->setFlash('payModule', '<br /><h4>Вітаємо!</h4> Модуль <strong>'.
            $module->$name.'</strong> курсу <strong>'.

            Course::getCourseName($_POST['course']).'</strong> оплачено.
            <br />Тепер у Вас є доступ до усіх занять цього модуля.');

            $this->redirect(Yii::app()->request->urlReferrer);
        }

        Yii::app()->user->setFlash('payModule', '<br /><h4>Щось пішло не так</h4> Лист не був відправлений <strong>');


    }


    public function actionPayCourse(){
        if (empty($_POST['course']) ) {
            Yii::app()->user->setFlash('errorCourse', "<br>Будь-ласка, оберіть курс для оплати.");
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $permission = new PayCourses();
        $course = Course::model()->findByPk($_POST['course']);
        $permission->setCourseRead($_POST['user'], $course->course_ID);
        $user = $_POST['user'];

        if(Mail::sendPayLetter($user,$course)){
            Yii::app()->user->setFlash('payCourse', '<br /><h4>Вітаємо!</h4> Курс '.
                Course::getCourseName($course->course_ID).'</strong> оплачено.
            <br />Тепер у Вас є доступ до усіх занять цього курсу.');

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        else{
            Yii::app()->user->setFlash('errorCourse', '<br /><h4>Щось пішло не так</h4> Лист не був відправлений <strong>');
        }

        }

    public function actionCancelCourseModule()
    {
        $this->render('index',array('cancelMode' => true));
    }

    public function actionCancelModule()
    {
        if(isset($_POST['user']) && isset($_POST['module'])){
        $user = $_POST['user'];
        $idModule = $_POST['module'];
        $moduleName = Module::model()->findByPk($idModule)->title_ua;

        $payModule = PayModules::model()->findByAttributes(array('id_user' => $user,'id_module' => $idModule));
        if($payModule){
            Yii::app()->user->setFlash('payModule', '<br />Модуль <strong>'.
                $moduleName.'</strong> курсу <strong>'.
                Course::getCourseName($_POST['course']).'</strong> скасовано.
            <br />Тепер у Вас НЕМАЄ доступу до усіх занять цього модуля.');

        $payModule->delete();
        }
        else{
            $userName = StudentReg::model()->findByPk($user)->email;
            Yii::app()->user->setFlash('payModule', '<br /> В користувача'. $userName. '<strong> в модулі '.
                $moduleName.'</strong> не було доступу до цього модуля <strong>');

        }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCancelCourse()
    {
        if(isset($_POST['user']) && isset($_POST['course'])){
        $user = $_POST['user'];
        $course = $_POST['course'];

        $payCourse = PayCourses::model()->findByAttributes(array('id_user' => $user, 'id_course' => $course));

            if($payCourse){
                Yii::app()->user->setFlash('payCourse', '<strong> Доступ до курсу '.
                    Course::getCourseName($_POST['course']).'</strong> скасовано.
            <br />Тепер у Вас НЕМАЄ доступу до усіх занять цього курсу.');

                $payCourse->delete();
            }
            else{
                $userName = StudentReg::model()->findByPk($user)->email;
                Yii::app()->user->setFlash('payCourse', '<br /> В користувача'. $userName. '<strong> не було доступу до курсу  '.
                    Course::getCourseName($_POST['course']).'</strong>');
            }
            $this->redirect(Yii::app()->request->urlReferrer);
        }

    }

}