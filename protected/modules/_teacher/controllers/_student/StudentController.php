<?php

class StudentController extends TeacherCabinetController
{

    public function hasRole()
    {
        $allowedUserActions=['payCourse','payModule','publicOffer','newCourseAgreement','newModuleAgreement'];
        return Yii::app()->user->model->isStudent() || (!Yii::app()->user->isGuest && in_array(Yii::app()->controller->action->id,$allowedUserActions));
    }

    public function actionIndex($id = 0)
    {
        $student = RegisteredUser::userById($id);
        $role = new Student();
        $teachersByModule = $role->getTeachersForModules($student->registrationData);
        
        $this->renderPartial('/_student/index', array(
            'student' => $student,
            'teachersByModule' => $teachersByModule,
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
        foreach ($records['rows'] as &$record){
            $module=Module::model()->findByPk($record['lecture']["idModule"]);
            $access=$module->checkPaidAccess(Yii::app()->user->getId());
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
        $criteria->addCondition('userId=' . Yii::app()->user->getId());
        $adapter = new NgTableAdapter('UserServiceAccess',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode(array_merge($adapter->getData(),['usd'=> Config::getDollarRate()]));
    }

    public function actionGetPayModulesList()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('userId=' . Yii::app()->user->getId());
        $adapter = new NgTableAdapter('UserServiceAccess',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode(array_merge($adapter->getData(),['usd'=> Config::getDollarRate()]));
    }

    public function actionGetAgreementsList()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('user_id=' . Yii::app()->user->getId());
        $adapter = new NgTableAdapter('UserAgreements',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
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

            $this->renderPartial('/_student/agreement/payModuleForm', array(
                'module' => $model,
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

    public function actionPlainTasks()
    {
        $this->renderPartial('/_student/plainTasks', array());
    }

    public function actionPlainTask($id)
    {
        $this->renderPartial('/_student/plainTaskView', array($id));
    }
    
    public function actionGetInvoicesByAgreement()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('Invoice', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = "agreement_id= ".$_GET['id'];
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetStudentPlainTasksAnswers()
    {
        $requestParams = $_GET;
        $untested=false;

        if(isset($requestParams['filter']['plainTaskMark.mark']) && $requestParams['filter']['plainTaskMark.mark']=='null'){
            unset($requestParams['filter']['plainTaskMark.mark']);
            $untested=true;
        }
        $ngTable = new NgTableAdapter('PlainTaskAnswer', $requestParams);


        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 't';
        if($untested){
            $criteria->join = ' LEFT JOIN plain_task_marks ptm ON t.id = ptm.id_answer';
            $criteria->addCondition('ptm.id_answer IS NULL');
        }
        if(isset($requestParams['id'])){
            $criteria->join = ' LEFT JOIN plain_task_marks ptm ON t.id = ptm.id_answer';
            $criteria->addCondition('t.id='.$requestParams['id']);
        }

        $criteria->addCondition('t.id_student =:id');
        $criteria->params = array(':id' => Yii::app()->user->getId());
        $criteria->group = 't.id DESC';
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionNewCourseAgreement(){
        $user = Yii::app()->user->getId();
        $course = Yii::app()->request->getPost('course', 0);
        $educationForm = Yii::app()->request->getPost('educationForm');
        $courseModel=Course::model()->findByPk($course);
        if(!Yii::app()->user->model->isStudent($courseModel->organization->id)){
            $roleObj = Role::getInstance(UserRoles::STUDENT);
            $roleObj->setRole(Yii::app()->user->model->registrationData, $courseModel->organization->id);
        }

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

        $moduleModel=Module::model()->findByPk($module);
        if(!Yii::app()->user->model->isStudent($moduleModel->organization->id)){
            $roleObj = Role::getInstance(UserRoles::STUDENT);
            $roleObj->setRole(Yii::app()->user->model->registrationData, $moduleModel->organization->id);
        }

        if($educationForm=='online') $educationForm=EducationForm::ONLINE;
        else if($educationForm=='offline') $educationForm=EducationForm::OFFLINE;
        else $educationForm=EducationForm::ONLINE;

        $schemaNum = Yii::app()->request->getPost('payment', '0');

        $agreement = UserAgreements::agreementByParams('Module', $user, $module, $course, $schemaNum, $educationForm);

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
            $subgroups[$key]['journal']=$subgroup->subgroupName->journal;
            $subgroups[$key]['link']=$subgroup->subgroupName->link;
            $subgroups[$key]['groupCurator']=$subgroup->group->userChatAuthor->userNameWithEmail();
            $subgroups[$key]['groupCuratorEmail']=$subgroup->group->userChatAuthor->email;
            $subgroups[$key]['groupCuratorId']=$subgroup->group->userChatAuthor->id;

            if($subgroup->trainer){
                $subgroups[$key]['trainer']=trim($subgroup->trainer->trainer0->getLastFirstName().' '.($subgroup->trainer->trainer0->user->email));
                $subgroups[$key]['trainerEmail']=$subgroup->trainer->trainer0->user->email;
                $subgroups[$key]['trainerId']=$subgroup->trainer->trainer0->user_id;
                $subgroups[$key]['trainerLink']=Yii::app()->createUrl('studentreg/profile', array('idUser' => $subgroup->trainer->trainer0->user_id));
            }
        }

        echo json_encode($subgroups);
    }

    public function actionGetNewPlainTasksMarksCount()
    {
        $model=PlainTaskMarks::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->getId(),'read_mark'=>false));
        $result=array('data'=>count($model));
        echo json_encode($result);
    }

    public function actionReadNewPlainTasksMarks()
    {
        PlainTaskMarks::model()->updateAll(array('read_mark'=>true), 'read_mark = 0');
    }

    public function actionContacts()
    {
        $student = RegisteredUser::userById(Yii::app()->user->getId());
        $trainers=$student->registrationData->trainer?$student->registrationData->trainer:null;
        $this->renderPartial('/_student/contacts', array('trainers' => $trainers), false, true);
    }
}