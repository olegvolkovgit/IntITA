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
//      NEXT ITERATION
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addBetweenCondition('date_cons',date_format($currentDate, "Y-m-d"),date_format($currentDate, "Y-m-d"));
        $criteria->compare('t.user_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        $records = $adapter->getData();
        //$access ="";
        foreach ($records['rows'] as &$record){
            $access=PayModules::model()->checkModulePermission(Yii::app()->user->getId(), $record['lecture']["idModule"], array('read'));
            if ($access){
                if(date('H:i')< date('H:i',strtotime($record["start_cons"]))){
                    $record['status'] = 'очікування';
                }
                elseif(date('H:i') > date('H:i',strtotime($record["end_cons"]))){
                    $record['status'] = 'закінчена';
                }
                else{
                    $record['status'] = 'start';
                }
            }
            else{
                $record['lecture']['title_ua'].=" (Доступ до заняття обмежений)";
            }

            unset($record);
        }

        echo json_encode($records);

      // echo Consultationscalendar::studentTodayConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetPastConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addCondition('date_cons < "'.date_format($currentDate, "Y-m-d").'" ');
        $criteria->compare('t.user_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
      //  echo Consultationscalendar::studentPastConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetCancelConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NOT NULL');
        $criteria->compare('t.user_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
     // echo Consultationscalendar::studentCancelConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetPlannedConsultationsList(){
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addCondition('date_cons > "'.date_format($currentDate, "Y-m-d").'" ');
        $criteria->compare('t.user_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
        //echo Consultationscalendar::studentPlannedConsultationsList(Yii::app()->user->getId());
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
        $criteria = new CDbCriteria;
        $criteria->addCondition('id_user=' . Yii::app()->user->getId());
        $adapter = new NgTableAdapter('PayCourses',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode(array_merge($adapter->getData(),['usd'=> Config::getDollarRate()]));
        //echo PayCourses::getPayCoursesListByUser();
    }

    public function actionGetPayModulesList()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('id_user=' . Yii::app()->user->getId());
        $adapter = new NgTableAdapter('PayModules',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode(array_merge($adapter->getData(),['usd'=> Config::getDollarRate()]));

        //echo PayModules::getPayModulesListByUser();
    }

    public function actionGetAgreementsList()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('user_id=' . Yii::app()->user->getId());
        $adapter = new NgTableAdapter('UserAgreements',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
        //echo UserAgreements::agreementsListByUser();
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
    
    public function actionPayCourse($id,$form,$schemeId)
    {
        if(!Yii::app()->user->model->isStudent()){
            Yii::app()->user->model->setRole(UserRoles::STUDENT);
        }

        if($form=='online') $educForm=EducationForm::ONLINE;
        else if($form=='offline') $educForm=EducationForm::OFFLINE;
        else throw new \application\components\Exceptions\IntItaException(400);

        if (UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $id, $educForm)) {
            $agreement = UserAgreements::courseAgreement(Yii::app()->user->getId(), $id, 1, $educForm);
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            $courseModel = Course::model()->findByPk($id);
            if (!$courseModel) {
                throw new \application\components\Exceptions\IntItaException(400);
            }

            $this->renderPartial('/_student/agreement/payCourseForm', array(
                'course' => $courseModel,
                'offerScenario' => Config::offerScenario()
            ), false, true);
        }
    }

    public function actionPayModule($id,$form,$schemeId)
    {
        if(!Yii::app()->user->model->isStudent()){
            Yii::app()->user->model->setRole(UserRoles::STUDENT);
        }
        if($form=='online') $educForm=EducationForm::ONLINE;
        else if($form=='offline') $educForm=EducationForm::OFFLINE;
        else throw new \application\components\Exceptions\IntItaException(400);

        if (UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $id, $educForm)) {
            $agreement = UserAgreements::moduleAgreement(Yii::app()->user->getId(), $id, 1, $educForm);
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $agreement,
            ));
        } else {
            $model = Module::model()->findByPk($id);
            if (!$model) {
                throw new \application\components\Exceptions\IntItaException(400);
            }

            $this->renderPartial('/_student/agreement/_payModuleForm', array(
                'model' => $model,
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
        $educationForm = Yii::app()->request->getPost('educationForm');

        if($educationForm=='online') $educationForm=EducationForm::ONLINE;
        else if($educationForm=='offline') $educationForm=EducationForm::OFFLINE;
        else $educationForm=EducationForm::ONLINE;

        $schemaNum = Yii::app()->request->getPost('payment', '0');

        $agreement = UserAgreements::agreementByParams('Course', $user, 0, $course, $schemaNum, $educationForm);

        echo ($agreement)?$agreement->id:0;
    }

    public function actionNewModuleAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $educationForm = Yii::app()->request->getPost('educationForm', EducationForm::ONLINE);

        if($educationForm=='online') $educationForm=EducationForm::ONLINE;
        else if($educationForm=='offline') $educationForm=EducationForm::OFFLINE;
        else $educationForm=EducationForm::ONLINE;

        $agreement = UserAgreements::agreementByParams('Module', $user, $module, $course, 1, $educationForm);

        echo ($agreement)?$agreement->id:0;
    }

    public function actionOfflineEducation()
    {
        $this->renderPartial('/_student/_offlineEducation', array(), false, true);
    }

    public function actionGetOfflineEducationData()
    {
        $students = OfflineStudents::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->getId(),'end_date'=>null));
        $subgroups=[];
        foreach ($students as $key=>$subgroup){
            $subgroups[$key]['group']=$subgroup->group->name;
            $subgroups[$key]['subgroup']=$subgroup->subgroupName->name;
            $subgroups[$key]['info']=$subgroup->subgroupName->data;
            $subgroups[$key]['groupCurator']=$subgroup->group->userCurator->userNameWithEmail();
            $subgroups[$key]['groupCuratorEmail']=$subgroup->group->userCurator->email;
            $subgroups[$key]['groupCuratorId']=$subgroup->group->userCurator->id;
            $subgroups[$key]['subgroupCurator']=$subgroup->subgroupName->userCurator->userNameWithEmail();
            $subgroups[$key]['subgroupCuratorEmail']=$subgroup->subgroupName->userCurator->email;
            $subgroups[$key]['subgroupCuratorId']=$subgroup->subgroupName->userCurator->id;

            if($subgroup->trainer){
                $subgroups[$key]['trainer']=trim($subgroup->trainer->trainer0->getLastFirstName().($subgroup->trainer->trainer0->user->email));
                $subgroups[$key]['trainerEmail']=$subgroup->trainer->trainer0->user->email;
                $subgroups[$key]['trainerId']=$subgroup->trainer->trainer0->user_id;
                $subgroups[$key]['trainerLink']=Yii::app()->createUrl('studentreg/profile', array('idUser' => $subgroup->trainer->trainer0->user_id));
            }
        }

        echo json_encode($subgroups);
    }
}