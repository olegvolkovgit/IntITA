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

        $resultText = '';
        $moduleId = Yii::app()->request->getPost('module');
        $userId = Yii::app()->request->getPost('user');
        $courseId = Yii::app()->request->getPost('course');
        $userName = StudentReg::model()->findByPk($userId)->getNameOrEmail();
        $module = Module::model()->findByPk($moduleId);

        $exist = PayModules::model()->findByAttributes(array('id_user' => $userId,'id_module' => $moduleId));
        if(!empty($exist))
        {
            $resultText = PayModules::getExistPayModuleText($userName);

        }else{
        $permission = new PayModules();
        $permission->setModuleRead($userId, $module->module_ID);

        if(Mail::sendPayLetter($userId,$module)){
            $resultText = PayModules::getConfirmText($module->title_ua,$courseId,$userName);
        }
        else{
            $resultText = Mail::getErrorText();
        }
        }
        echo $resultText;
    }


    public function actionPayCourse(){

        $resultText = '';
        $courseId = Yii::app()->request->getPost('course');
        $userId = Yii::app()->request->getPost('user');
        $userName = StudentReg::model()->findByPk($userId)->getNameOrEmail();

        $payCourse = PayCourses::model()->findByAttributes(array('id_user' => $userId, 'id_course' => $courseId));
        if(!empty($payCourse))
        {
            $resultText = 'У '.$userName.' вже <strong>Є</strong> доступ до цього курсу';

        }
        else{
        $permission = new PayCourses();
        $course = Course::model()->findByPk($courseId);
        $permission->setCourseRead($userId, $course->course_ID);

        if(Mail::sendPayLetter($userId,$course)){
            $resultText = PayCourses::getConfirmText($courseId,$userName);

        }
        else{
            $resultText = Mail::getErrorText();
        }
        }
        echo $resultText;

    }

    public function actionCancelCourseModule()
    {
        $users = StudentReg::generateUsersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('index',
            array('cancelMode' => true,
                'users' => $users,
                'courses' => $courses
                ),false,true);
    }

    public function actionCancelModule()
    {
        if(isset($_POST['user']) && isset($_POST['module'])){
        $resultText = '';
        $userId = Yii::app()->request->getPost('user');
        $courseId = Yii::app()->request->getPost('course');
        $moduleId = Yii::app()->request->getPost('module');
        $moduleName = Module::model()->findByPk($moduleId)->title_ua;
        $userName = StudentReg::model()->findByPk($userId)->getNameOrEmail();

        $payModule = PayModules::model()->findByAttributes(array('id_user' => $userId,'id_module' => $moduleId));
        if($payModule){
            $resultText = PayModules::getCancelText($moduleName,$courseId,$userName);
            $payModule->delete();
        }
        else{
            $resultText = PayModules::getCancelErrorText($userName,$moduleName);

            }
            echo $resultText;
        }

    }

    public function actionCancelCourse()
    {
        if(isset($_POST['user']) && isset($_POST['course'])){
            $resultText = '';
            $userId = Yii::app()->request->getPost('user');
            $courseId = Yii::app()->request->getPost('course');
            $userName = StudentReg::model()->findByPk($userId)->getNameOrEmail();

            $payCourse = PayCourses::model()->findByAttributes(array('id_user' => $userId, 'id_course' => $courseId));

                if($payCourse){
                    $resultText = PayCourses::getCancelText($courseId,$userName);

                    $payCourse->delete();
                }
                else{
                    $resultText = PayCourses::getCancelErrorText($userName,$courseId);
                }
                echo $resultText;
        }
    }

}