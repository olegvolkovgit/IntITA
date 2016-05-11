<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:06
 */
class PayController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $users = StudentReg::generateUsersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('index', array(
            'users' => $users,
            'courses' => $courses,
        ), false, true);
    }

    public function actionPayModule()
    {
        $moduleId = Yii::app()->request->getPost('module');
        $userId = Yii::app()->request->getPost('user');

        $user = StudentReg::model()->findByPk($userId);
        $userName = $user->getNameOrEmail();
        $module = Module::model()->findByPk($moduleId);

        $exist = PayModules::model()->findByAttributes(array('id_user' => $userId, 'id_module' => $moduleId));
        if (!empty($exist)) {
            $resultText = PayModules::getExistPayModuleText($userName);

        } else {
            $permission = new PayModules();
            $permission->setModuleRead($userId, $module->module_ID);
            if(!UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module->module_ID)) {
               UserAgreements::agreementByParams('Module', $user->id, $module->module_ID, 0, 1, 'Online');
            }
            $message = new MessagesPayment();
            $message->build(null, $user, $module);
            $message->create();

            $sender = new MailTransport();
            if ($message->send($sender)) {
                $resultText = PayModules::getConfirmText($module, $userName);
            } else {
                $resultText = Mail::getErrorText();
            }
        }
        echo $resultText;
    }


    public function actionPayCourse()
    {
        $courseId = Yii::app()->request->getPost('course');
        $userId = Yii::app()->request->getPost('user');

        $user = StudentReg::model()->findByPk($userId);
        $userName = $user->getNameOrEmail();

        $payCourse = PayCourses::model()->findByAttributes(array('id_user' => $userId, 'id_course' => $courseId));
        if (!empty($payCourse)) {
            $resultText = 'У ' . $userName . ' вже <strong>Є</strong> доступ до цього курсу';

        } else {
            $permission = new PayCourses();
            $course = Course::model()->findByPk($courseId);
            $permission->setCourseRead($userId, $course->course_ID);
            if(!UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $course->course_ID)) {
                UserAgreements::agreementByParams('Course', $user->id, 0, $course->course_ID, 1, 'Online');
            }
            $message = new MessagesPayment();
            $message->build(null, $user, $course);
            $message->create();

            $sender = new MailTransport();
            if ($message->send($sender)) {
                $resultText = PayCourses::getConfirmText($course, $userName);

            } else {
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
            ), false, true);
    }

    public function actionCancelModule()
    {
        if (isset($_POST['user']) && isset($_POST['module'])) {
            $resultText = '';
            $userId = Yii::app()->request->getPost('user');
            $moduleId = Yii::app()->request->getPost('module');
            $user = StudentReg::model()->findByPk($userId);
            $userName = $user->getNameOrEmail();

            $payModule = PayModules::model()->findByAttributes(array('id_user' => $userId, 'id_module' => $moduleId));
            if ($payModule) {
                $resultText = PayModules::getCancelText($payModule->module, $userName);
                //if ($payModule->delete()){
                    $this->notify($user, 'Скасовано доступ до модуля',
                        '_payModuleCancelledNotification', array($payModule->module, $user->trainer->trainer0));
              //  }
            } else {
                $resultText = PayModules::getCancelErrorText($userName);

            }
            echo $resultText;
        }

    }

    public function actionCancelCourse()
    {
        if (isset($_POST['user']) && isset($_POST['course'])) {
            $resultText = '';
            $userId = Yii::app()->request->getPost('user');
            $courseId = Yii::app()->request->getPost('course');
            $student = StudentReg::model()->findByPk($userId);
            $userName = $student->getNameOrEmail();

            $payCourse = PayCourses::model()->findByAttributes(array('id_user' => $userId, 'id_course' => $courseId));

            if ($payCourse) {
                $resultText = PayCourses::getCancelText($payCourse->course, $userName);

                if($payCourse->delete()){
                    $this->notify($student, 'Скасовано доступ до курса',
                        '_payCourseCancelledNotification', array($payCourse->course, $student->trainer->trainer0));
                }
            } else {
                $resultText = PayCourses::getCancelErrorText($userName);
            }
            echo $resultText;
        }
    }

    public function actionCoursesByQuery($query){
        echo Course::readyCoursesList($query);
    }

    public function notify(StudentReg $student, $subject, $template, $params){
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $message = new NotificationMessages();
            $sender = new MailTransport();
            $sender->renderBodyTemplate($template, $params);
            $message->build($subject, $sender->template(), array($student), Yii::app()->user->model->registrationData);
            $message->create();

            $message->send($sender);
            $transaction->commit();
        } catch (Exception $e){
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
    }
}