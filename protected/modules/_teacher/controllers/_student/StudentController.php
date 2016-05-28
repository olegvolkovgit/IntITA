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

    public function actionPayCourse($course){
        $type = isset(Yii::app()->request->cookies['agreementType']) ? Yii::app()->request->cookies['agreementType']->value
            : 'Online';
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

            $this->renderPartial('/_student/agreement/payCourse', array(
                'course' => $courseModel,
                //'schema' => $schema,
                'type' => $type,
                'offerScenario' => Config::offerScenario()
            ), false, true);
        }
    }

    public function actionPayModule($course, $module, $type = 'Online'){

        if(UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)){
            $agreement = UserAgreements::moduleAgreement(Yii::app()->user->getId(), $module, 1, $type);
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

    public function actionSignAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $educationForm = Yii::app()->request->getPost('educationForm', 'online');
        $schemaNum = Yii::app()->request->getPost('payment', '0');
        $type = Yii::app()->request->getPost('scenario', '');
        $offerScenario = Yii::app()->request->getPost('offerScenario', '');

        $agreementId = 0;
        switch($offerScenario){
            case "default":
            case "onlyCheck":
                //$this->actionPublicOffer($type, $course, $module, $schemaNum, $educationForm);
                break;
            case "credit":
                //$this->actionPublicOfferLoanSchema($type, $course, $module, $schemaNum, $educationForm);
                break;
            case "noOffer":
                switch($type) {
                    case 'module':
                        $agreementId = UserAgreements::agreementByParams('Module', $user, $module, $course, 1, $educationForm)->id;
                        break;
                    case 'course':
                        $agreementId = UserAgreements::agreementByParams('Course', $user, 0, $course, $schemaNum, $educationForm)->id;
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        echo $agreementId;
    }

    public function actionPublicOffer($course, $module, $type, $form, $schema){
        if($schema >= 1 && $schema <= 4){
            $offerScenario = "onlyCheck";
        } else {
            $offerScenario = "credit";
        }

        $this->renderPartial('/_student/agreement/publicOffer', array(
            'course' => $course,
            'module' => $module,
            'educationForm' => $form,
            'schemaNum' => $schema,
            'type' => $type,
            'offerScenario' => $offerScenario
        ));
    }

    public function actionCreditSchemaForm($course, $module, $type, $form, $schema){

        $this->renderPartial('/_student/agreement/_userDataForm', array(
            'course' => $course,
            'module' => $module,
            'educationForm' => $form,
            'schemaNum' => $schema,
            'type' => $type
        ));
    }

    public function actionNewAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $educationForm = Yii::app()->request->getPost('educationForm', 'online');
        $module = Yii::app()->request->getPost('module', 0);
        $schemaNum = Yii::app()->request->getPost('payment', '0');
        $type = Yii::app()->request->getPost('type', '');

        $agreement = null;
        switch($type) {
            case 'module':
                $agreement = UserAgreements::agreementByParams('Module', $user, $module, $course, 1, $educationForm);
                break;
            case 'course':
                $agreement = UserAgreements::agreementByParams('Course', $user, 0, $course, $schemaNum, $educationForm);
                break;
            default:
                break;
        }

        echo ($agreement)?$agreement->id:0;
    }

    public function actionGetInvoicesByAgreement($id){
        echo Invoice::invoicesListByAgreement($id);
    }

    public function actionSaveUserData(){
        $model = Yii::app()->user->model;
        $passport = Yii::app()->request->getPost('passport', '');
        $inn = Yii::app()->request->getPost('inn', '');
        $documentType = Yii::app()->request->getPost('document_type', '');
        $issuedDate = Yii::app()->request->getPost('document_issued_date', '');
        $passportIssued = Yii::app()->request->getPost('passport_issued', '');

       if($model->updatePassportData($passport, $inn, $documentType, $issuedDate, $passportIssued)){
           echo "success";
       } else {
           echo "Не вдалося оновити інформацію про користувача. Зверніться до адміністратора ".Config::getAdminEmail();
       }
    }
}