<?php

class StudentController extends TeacherCabinetController
{

    public function hasRole()
    {
        return Yii::app()->user->model->isStudent();
    }

    public function actionIndex($id)
    {
        $student = RegisteredUser::userById($id);

        $this->renderPartial('/_student/index', array(
            'student' => $student
        ), false, true);
    }

    public function actionConsultations()
    {
        $this->renderPartial('/_student/_consultations', array(), false, true);
    }

    public function actionCancelConsultation($id)
    {
        $model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
        if ($model->deleteConsultation($user))
            echo 'success';
    }

    public function actionGetConsultationsList()
    {
        echo Consultationscalendar::studentConsultationsList(Yii::app()->user->getId());
    }

    public function actionFinances()
    {
        $this->renderPartial('/_student/_finances', array(), false, true);
    }

    public function actionGetPayCoursesList()
    {
        echo PayCourses::getPayCoursesListByUser();
    }

    public function actionGetPayModulesList()
    {
        echo PayModules::getPayModulesListByUser();
    }

    public function actionGetAgreementsList()
    {
        echo UserAgreements::agreementsListByUser();
    }

    public function actionAgreement($id)
    {
        $agreement = UserAgreements::model()->findByPk($id);
        if (!isset($agreement)) {
            throw new \application\components\Exceptions\IntItaException(400, 'Договір не знайдено.');
        }
        if ($this->hasAccountAccess($agreement->user_id)) {
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            throw new \application\components\Exceptions\IntItaException(403, 'У вас немає доступу до цього рахунка.');
        }
    }

    public function hasAccountAccess($owner)
    {
        if (!Yii::app()->user->isGuest) {
            $user = Yii::app()->user->model;
            if ($user->id == $owner) {
                return true;
            }
            return $user->isAdmin() || $user->isAccountant();
        } else {
            return false;
        }
    }

    public function actionPayCourse($course, $schema = 1, $type = 'Online'){

        if(UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $course)){
            $agreement = UserAgreements::courseAgreement(Yii::app()->user->getId(), $course, $schema, $type);
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            $courseModel = Course::model()->findByPk($course);
            if (!$courseModel) {
                throw new \application\components\Exceptions\IntItaException(400);
            }

            $this->renderPartial('/_student/payCourse', array(
                'course' => $courseModel,
                'schema' => $schema,
                'type' => $type,
            ));
        }
    }

    public function actionPayModule($course, $module){

        if(UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)){
            $agreement = UserAgreements::moduleAgreement(Yii::app()->user->getId(), $module, 1, 'Online');
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            $model = Module::model()->findByPk($module);
            if (!$model) {
                throw new \application\components\Exceptions\IntItaException(400);
            }

            $this->renderPartial('/_student/_payModule', array(
                'model' => $model,
                'course' => $course
            ));
        }
    }

    public function actionNewCourseAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $educationForm = Yii::app()->request->getPost('educationForm', 'online');
        $schemaNum = Yii::app()->request->getPost('payment', '0');

        $agreement = UserAgreements::agreementByParams('Course', $user, 0, $course, $schemaNum, $educationForm);

        echo $agreement->id;
    }

    public function actionNewModuleAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $module = $_POST["module"];
        $educationForm = Yii::app()->request->getPost('educationForm', 'online');

        $agreement = UserAgreements::agreementByParams('Module', $user, $module, $course, 1, $educationForm);

        echo $agreement->id;
    }

    public function actionInvoice($id, $nolayout = false){
        $model = Invoice::model()->findByPk($id);

        if($model){
            if ($this->hasAccountAccess($model->user_created)) {
//                if ($nolayout) {
//                    $this->layout = false;
//                }
                $this->renderPartial('/_student/invoice', array('invoice' => $model));
            } else {
                echo 'У вас немає доступу до цього рахунка.';
            }
        } else {
            echo "Такого рахунка не існує.";
        }
    }

    public function actionGetInvoicesByAgreement($id){
        echo Invoice::invoicesListByAgreement($id);
    }
}