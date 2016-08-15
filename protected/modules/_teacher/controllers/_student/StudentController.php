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
        $this->renderPartial('/_student/consultations/index', array(), false, true);
    }

    public function actionCancelConsultation($id)
    {
        $model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
        if ($model->deleteConsultation($user))
            echo 'success';
    }

    public function actionGetTodayConsultationsList(){
        echo Consultationscalendar::studentTodayConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetPastConsultationsList(){
        echo Consultationscalendar::studentPastConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetCancelConsultationsList(){
        echo Consultationscalendar::studentCancelConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetPlannedConsultationsList(){
        echo Consultationscalendar::studentPlannedConsultationsList(Yii::app()->user->getId());
    }

    public function actionConsultation($id){
        $model = Consultationscalendar::model()->findByPk($id);

        $this->renderPartial('/_student/consultations/_viewConsultation', array(
            'model' => $model
        ), false, true);
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

    public function actionPayCourse($course)
    {
        if(!Yii::app()->user->model->isStudent()){
            Yii::app()->user->model->setRole(UserRoles::STUDENT);
        }
        $type = isset(Yii::app()->request->cookies['agreementType']) ? Yii::app()->request->cookies['agreementType']->value
            : 'Online';
        $educForm = ($type == 'Offline')?EducationForm::OFFLINE:EducationForm::ONLINE;
        if (UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $course, $educForm)) {
            $agreement = UserAgreements::courseAgreement(Yii::app()->user->getId(), $course, 1, $educForm);
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            $courseModel = Course::model()->findByPk($course);
            if (!$courseModel) {
                throw new \application\components\Exceptions\IntItaException(400);
            }

            $this->renderPartial('/_student/agreement/payCourse', array(
                'course' => $courseModel,
                'type' => $type,
                'offerScenario' => Config::offerScenario()
            ), false, true);
        }
    }

    public function actionPayModule($course, $module)
    {
        if(!Yii::app()->user->model->isStudent()){
            Yii::app()->user->model->setRole(UserRoles::STUDENT);
        }
        $type = isset(Yii::app()->request->cookies['agreementType']) ? Yii::app()->request->cookies['agreementType']->value : 'Online';
        $educForm = ($type == 'Offline') ? EducationForm::OFFLINE : EducationForm::ONLINE;
        if (UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module, $educForm)) {
            $agreement = UserAgreements::moduleAgreement(Yii::app()->user->getId(), $module, 1, $educForm);
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            $model = Module::model()->findByPk($module);
            if (!$model) {
                throw new \application\components\Exceptions\IntItaException(400);
            }

            $this->renderPartial('/_student/agreement/_payModule', array(
                'model' => $model,
                'course' => $course,
                'offerScenario' => Config::offerScenario()
            ));
        }
    }

    public function actionPublicOffer($course, $module, $type, $form, $schema)
    {

        $this->renderPartial('/_student/agreement/publicOffer', array(
            'course' => $course,
            'module' => $module,
            'educationForm' => $form,
            'schemaNum' => $schema,
            'type' => $type
        ));
    }

    public function actionCreditSchemaForm($course, $module, $type, $form, $schema)
    {

        $this->renderPartial('/_student/agreement/_userDataForm', array(
            'course' => $course,
            'module' => $module,
            'educationForm' => $form,
            'schemaNum' => $schema,
            'type' => $type
        ));
    }

    public function actionGetInvoicesByAgreement($id)
    {
        echo Invoice::invoicesListByAgreement($id);
    }

    public function actionNewCourseAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $educationForm = Yii::app()->request->getPost('educationForm', EducationForm::ONLINE);
        $schemaNum = Yii::app()->request->getPost('payment', '0');

        $agreement = UserAgreements::agreementByParams('Course', $user, 0, $course, $schemaNum, $educationForm);

        echo ($agreement)?$agreement->id:0;
    }

    public function actionNewModuleAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $educationForm = Yii::app()->request->getPost('educationForm', EducationForm::ONLINE);

        $agreement = UserAgreements::agreementByParams('Module', $user, $module, $course, 1, $educationForm);

        echo ($agreement)?$agreement->id:0;
    }
}