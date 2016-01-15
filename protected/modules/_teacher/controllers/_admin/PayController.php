<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:06
 */

class PayController extends TeacherCabinetController
{

    public function actionIndex()
    {
        $users = StudentReg::generateUsersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('index',array(
            'users' => $users,
            'courses' => $courses,
        ),false,true);
    }

    public function actionPayModule(){

        $moduleId = Yii::app()->request->getPost('module');
        $userId = Yii::app()->request->getPost('user');
        $courseId = Yii::app()->request->getPost('course');
        $userName = StudentReg::model()->getNameOrEmail();

        $permission = new PayModules();
        $module = Module::model()->findByPk($moduleId);
        $name = Module::getModuleTitleParam($module->module_ID);
        $permission->setModuleRead($userId, $module->module_ID);


        if(Mail::sendPayLetter($userId,$module)){

            $result = '<br /><h4>Вітаємо!</h4> Модуль <strong>'.
                $module->$name.'</strong> курса <strong>'.

                Course::getCourseName($courseId).'</strong> оплачено.
            <br />Тепер у '.$userName.' є доступ до усіх занять цього модуля.';

            echo $result;
        }

    }


    public function actionPayCourse(){

        $courseId = Yii::app()->request->getPost('course');
        $userId = Yii::app()->request->getPost('user');
        $userName = StudentReg::model()->getNameOrEmail();

        $permission = new PayCourses();
        $course = Course::model()->findByPk($courseId);
        $permission->setCourseRead($userId, $course->course_ID);

        if(Mail::sendPayLetter($userId,$course)){
            $result = '<br /><h4>Вітаємо!</h4> Курс '.
                Course::getCourseName($course->course_ID).'</strong> оплачено.
            <br />Тепер у '.$userName.' є доступ до усіх занять цього курсу.';
        }
        else{
            $result = '<br /><h4>Щось пішло не так</h4> Лист не був відправлений <strong>';
        }

        echo $result;
        }

    public function actionCancelCourseModule()
    {
        $users = StudentReg::generateUsersList();
        $courses = Course::generateCoursesList();

        $this->render('index',
            array('cancelMode' => true,
                'users' => $users,
                'courses' => $courses
                ));
    }

    public function actionCancelModule()
    {
        if(isset($_POST['user']) && isset($_POST['module'])){
        $userId = Yii::app()->request->getPost('user');
        $courseId = Yii::app()->request->getPost('course');
        $moduleId = Yii::app()->request->getPost('module');
        $moduleName = Module::model()->findByPk($moduleId)->title_ua;
        $userName = StudentReg::model()->getNameOrEmail();

            $payModule = PayModules::model()->findByAttributes(array('id_user' => $userId,'id_module' => $moduleId));
        if($payModule){
            $result = '<br />Модуль <strong>'.
                $moduleName.'</strong> курса <strong>'.
                Course::getCourseName($courseId).'</strong> скасовано.
            <br />Тепер у '.$userName.' НЕМАЄ доступу до усіх занять цього модуля.';

        $payModule->delete();
        }
        else{

            $result = '<br /> В користувача'. $userName. '<strong> в модулі '.
                $moduleName.'</strong> не було доступу до цього модуля <strong>';

            }
            echo $result;
        }

    }

    public function actionCancelCourse()
    {
        if(isset($_POST['user']) && isset($_POST['course'])){
        $userId = Yii::app()->request->getPost('user');
        $courseId = Yii::app()->request->getPost('course');
        $userName = StudentReg::model()->getNameOrEmail();

        $payCourse = PayCourses::model()->findByAttributes(array('id_user' => $userId, 'id_course' => $courseId));

            if($payCourse){
                $result = '<strong> Доступ до курсу '.
                    Course::getCourseName($courseId).'</strong> скасовано.
                    <br />Тепер у '.$userName.' НЕМАЄ доступу до усіх занять цього курсу.';

                $payCourse->delete();
            }
            else{
                $result = '<br /> В користувача'. $userName. '<strong> не було доступу до курсу  '.
                    Course::getCourseName($courseId).'</strong>';
            }
            echo $result;
        }
    }

}