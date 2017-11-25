<?php

class TrainerController extends TeacherCabinetController
{

    public function hasRole()
    {
        return Yii::app()->user->model->isTrainer();
    }

    public function actionStudents()
    {
        $this->renderPartial('/_trainer/trainerStudents', array(), false, true);
    }

    public function actionAttachStudents()
    {
        $this->renderPartial('/_trainer/tables/_students', array(), false, true);
    }

    public function actionEditTeacherModule($id, $idModule)
    {
        $student = RegisteredUser::userById($id);
        $module = Module::model()->findByPk($idModule);

        Yii::app()->user->model->hasAccessToOrganizationModel($module);
        Yii::app()->user->model->hasAccessToOrganizationModel(TrainerStudent::model()->findByAttributes(
            array(
                'student'=>$id,
                'trainer'=>Yii::app()->user->getId(),
                'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                'end_time'=>null,
            )
        ));

        if ($id && $idModule) {
            $role = new TeacherConsultant();
            $isTeacherDefined = !$role->checkStudent($idModule, $id);
            if ($isTeacherDefined) {
                $role = new Student();
                $teacher = $role->getTeacherForModuleDefined($id, $idModule);
            } else {
                $teacher = null;
            }

            $this->renderPartial('/_trainer/_editTeacherModule', array(
                'student' => $student->registrationData,
                'module' => $module,
                'isTeacherDefined' => $isTeacherDefined,
                'teacher' => $teacher
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionAssignTeacherForStudent()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $student = Yii::app()->request->getPost('student', 0);

        $user = RegisteredUser::userById($teacher);
        $model = $user->registrationData;

        $role = new TeacherConsultant();
        if (!$user->isTeacherConsultant()) {
            echo "Даному співробітнику не призначена роль викладача.";
        } else {
            if ($role->checkModule($teacher, $module)) {
                if ($role->checkStudent($module, $student)) {
                    if ($role->setStudentAttribute($model, $student, $module)) {
                        echo "Операцію успішно виконано.";
                    } else {
                        echo "Операцію не вдалося виконати.";
                    }
                } else {
                    echo "Даного викладача-консультанта вже призначено для цього студента.";
                }
            } else {
                echo "Даний викладач не має прав викладача для обраного модуля.";
            }
        }
    }

    public function actionCancelTeacherForStudent()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $module = Yii::app()->request->getPost('module', 0);
        $student = Yii::app()->request->getPost('student', 0);

        $model = StudentReg::model()->findByPk($teacher);

        $role = new TeacherConsultant();
        if ($role->checkCancelStudent($model->id, $module, $student)) {
            if ($role->cancelStudentAttribute($model, $student, $module)) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            echo "Даному викладача-консультанту не було призначено цього студента.";
        }
    }

    public function actionViewStudent($id)
    {
        $student = RegisteredUser::userById($id);
        $role = new Student();
        $teachersByModule = $role->getTeachersForModules($student->registrationData);

        Yii::app()->user->model->hasAccessToOrganizationModel(TrainerStudent::model()->findByAttributes(
            array(
                'student'=>$id,
                'trainer'=>Yii::app()->user->getId(),
                'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id,
                'end_time'=>null,
            )
        ));

        $this->renderPartial('/_trainer/_viewStudent', array(
            'student' => $student,
            'teachersByModule' => $teachersByModule
        ), false, true);
    }

    public function actionAllTeachersByQuery($query)
    {
        echo Teacher::teachersByQuery($query);
    }

    public function actionTeachersByQuery($query, $module)
    {
        echo Teacher::teachersByQueryAndModule($query, $module);
    }

    public function actionSendResponseConsultantModule($idModule)
    {
        $module = Module::model()->findByPk($idModule);
        if ($module) {
            $this->renderPartial('/_trainer/_sendResponseAssignConsultant', array(
                'module' => $module
            ));
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionSendRequest()
    {
        $teacher = Yii::app()->request->getPost('teacher', 0);
        $user = Yii::app()->request->getPost('user', 0);
        $module = Yii::app()->request->getPost('module', 0);

        $teacherModel = StudentReg::model()->findByPk($teacher);
        $moduleModel = Module::model()->findByPk($module);
        $userModel = StudentReg::model()->findByPk($user);

        if ($teacherModel && $moduleModel && $userModel) {
            $message = new MessagesTeacherConsultantRequest();
            if ($message->isRequestOpen(array($moduleModel->module_ID, $teacherModel->id))) {
                echo "Такий запит вже надіслано. Ви не можете надіслати запит на призначення викладача-консультанта для модуля двічі.";
            } else {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $message->build($moduleModel, $userModel, $teacherModel);
                    $message->create();
                    $sender = new MailTransport();

                    $message->send($sender);
                    $transaction->commit();
                    echo "Запит на призначення викладача-консультанта модуля успішно відправлено. Зачекайте, поки адміністратор сайта підтвердить запит.";
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw new \application\components\Exceptions\IntItaException(500, "Запит на редагування модуля не вдалося надіслати.");
                }
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionGetTrainersStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('TrainerStudent', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->condition = 't.trainer='.Yii::app()->user->getId().' and t.end_time is null 
        and id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
    
    public function actionRenderTrainerUsersAgreements() {
        $this->renderPartial('/_trainer/trainerUsersAgreements');
    }

    public function actionGetTrainerUsersAgreementsList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAgreements', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->alias = 't';
        $criteria->join = 'left join acc_course_service cs on cs.service_id=t.service_id';
        $criteria->join .= ' left join course c on c.course_ID=cs.course_id';
        $criteria->join .= ' left join acc_module_service ms on ms.service_id=t.service_id';
        $criteria->join .= ' left join module m on m.module_ID=ms.module_id';
        $criteria->join .= ' left join trainer_student ts on ts.student=t.user_id';
        $criteria->addCondition('ts.trainer='.Yii::app()->user->getId().' and end_time is null 
        and (m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
        or c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.')');
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionPersonalInfo()
    {
        $this->renderPartial('/_trainer/tables/_personalInfo', array(), false, true);
    }

    public function actionGetPersonalInfo()
    {
        $requestParams = $_GET;

        $ngTable = new NgTableAdapter('StudentInfo', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->join = 'left join trainer_student as ts on t.id_student=ts.student';
        $criteria->condition = 'ts.trainer='.Yii::app()->user->getId().' and ts.end_time is null
        and ts.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $criteria->order = 'ts.start_time DESC';
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionUpdateStudent(){
        $id_student = $_GET['id_student'];
        $attr = $_GET['attr'];
        $data = $_GET['data'];
        $student = StudentInfo::model()->findByAttributes(array('id_student'=>$id_student));
        $student[$attr] = $data;
        $student->save();
    }


    public function actionCareerInfo()
    {
        $this->renderPartial('/_trainer/tables/_career', array(), false, true);
    }

    public function actionGetCareerInfo()
    {
        $requestParams = $_GET;
        $specialization_id = 0;

        if(isset($requestParams['filter']['specializations.id'])){
            $specialization_id = $requestParams['filter']['specializations.id'];
            unset($requestParams['filter']['specializations.id']);
        }

        $ngTable = new NgTableAdapter('StudentInfo', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->with=array('specializations');
        $criteria->join = 'left join trainer_student as ts on t.id_student=ts.student';
        $criteria->join .= ' left join user_specialization_organization as uso on t.id=uso.id_student_info';
        $criteria->join .= ' left join specializations_group as sg on uso.id_specialization=sg.id';
        $criteria->condition = 'ts.trainer='.Yii::app()->user->getId().' and ts.end_time is null
        and ts.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        if($specialization_id != 0){
           $criteria->addCondition('sg.id='.$specialization_id);
        }
        $criteria->order = 'ts.start_time DESC';
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionChangeFormStudy(){
        $id_student = $_GET['id_student'];
        $id_form_study = $_GET['id_study_form'];
        $student = StudentInfo::model()->findByAttributes(['id_student'=>$id_student]);
        $student->rather_form_study = $id_form_study;
        $student->save();
    }

    public function actionChangeTimeStudy(){
        $id_student = $_GET['id_student'];
        $id_time_study = $_GET['id_time_form'];
        $student = StudentInfo::model()->findByAttributes(['id_student'=>$id_student]);
        $student->rather_time_study = $id_time_study;
        $student->save();
    }

    public function actionUpdateSpecialization(){
        $id_organization = Yii::app()->user->model->getCurrentOrganization()->id;
        $data = $_GET["data"];
        preg_match_all("/\d+/", $data, $matches);
        $num = $matches[0];
        $id_stud_info = $num[0];
        $del_student_spec = UserSpecializationOrganization::model()->deleteAllByAttributes(
            array(
                'id_student_info' => $id_stud_info,
                'id_organization' => $id_organization)
        );
        $length = count($num);
        if($length > 1){
            for($i = 1; $i<$length; $i++){
                $new_save = new UserSpecializationOrganization();
                $new_save['id_student_info'] = $id_stud_info;
                $new_save['id_specialization'] = $num[$i];
                $new_save['id_organization'] = $id_organization;
                $new_save->save();
            }
        }
    }

    public function actionGetSpecializationGroup(){
        $results = SpecializationsGroup::model()->findAll();

        $res = array();
        $temp = array();
        foreach($results as $item){
            $temp["id"] = $item->id;
            $temp["title"] = $item->title_ua;
            array_push($res, $temp);
        }

        echo json_encode($res);
    }

    public function actionGetEducationForm(){
        $result = EducationForm::model()->findAll();

        $res = array();
        $temp = array();
        foreach($result as $item){
            $temp['id'] = $item->id;
            $temp['title'] = $item->title_ua;
            array_push($res, $temp);
        }

        echo json_encode($res);
    }

    public function actionGetEducationTime(){
        $result = EducationShift::model()->findAll();

        $res = array();
        $temp = array();
        foreach($result as $item){
            $temp['id'] = $item->id;
            $temp['title'] = $item->title_ua;
            array_push($res, $temp);
        }

        echo json_encode($res);
    }

    public function actionGetPayForm(){
        $result = SchemesName::model()->findAll();

        $res = array();
        $temp = array();
        foreach($result as $item){
            $temp['id'] = $item->pay_count;
            $temp['title'] = $item->title_ua;
            array_push($res, $temp);
        }

        echo json_encode($res);
    }

    public function actionChangePayForm(){
        $id_student = $_GET['id_student'];
        $id_pay = $_GET['id_pay'];
        $student = StudentInfo::model()->findByAttributes(['id_student'=>$id_student]);
        $student['pay_form'] = $id_pay;
        $student->save();
    }


    public function actionContractInfo()
    {
        $this->renderPartial('/_trainer/tables/_contract', array(), false, true);
    }

    public function actionGetContractInfo()
    {
        $requestParams = $_GET;

        $ngTable = new NgTableAdapter('StudentInfo', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->join = 'left join trainer_student as ts on t.id_student=ts.student';
        $criteria->condition = 'ts.trainer='.Yii::app()->user->getId().' and ts.end_time is null
        and ts.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $criteria->order = 'ts.start_time DESC';
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();

        echo json_encode($result);
    }


    public function actionVisitInfo()
    {
        $this->renderPartial('/_trainer/tables/_visit', array(), false, true);
    }

    public function actionGetVisitInfo()
    {
        $requestParams = $_GET;
        $group_name_id = 0;
        $reason_id = 0;

        if(isset($requestParams['filter']['group_name.id'])){
            $group_name_id = $requestParams['filter']['group_name.id'];
            unset($requestParams['filter']['group_name.id']);
        }

        if(isset($requestParams['filter']['reason.id'])){
            $reason_id = $requestParams['filter']['reason.id'];
            unset($requestParams['filter']['reason.id']);
        }

        $ngTable = new NgTableAdapter('StudentInfo', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->join = 'left join trainer_student as ts on t.id_student=ts.student';
        $criteria->join .= ' left join offline_students as os ON t.id_student=os.id_user';
        $criteria->join .= ' left join offline_subgroups as osbgr ON os.id_subgroup=osbgr.id';
        $criteria->join .= ' left join offline_groups as ogr ON osbgr.group=ogr.id';
        $criteria->join .= ' left join offline_student_cancel_type as osct ON os.cancel_type=osct.id';
        $criteria->condition = 'ts.trainer='.Yii::app()->user->getId().' and ts.end_time is null
        and ts.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        if($group_name_id != 0){
            $criteria->addCondition('ogr.id='.$group_name_id);
        }
        if($reason_id != 0){
            $criteria->addCondition('osct.id='.$reason_id);
        }
        $criteria->order = 'ts.start_time DESC';
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionGetGroupNumber(){

        $groups = OfflineGroups::model()->findAll();
        $res = array();
        $result = array();

        foreach($groups as $group){
            $res['id'] = $group->id;
            $res['title'] = $group->name;
            array_push($result, $res);
        }

        echo json_encode($result);
    }

    public function actionGetCancelType(){
        $reason = OfflineStudentCancelType::model()->findAll();
        $res = array();
        $result = array();

        foreach($reason as $item){
            $res['id'] = $item->id;
            $res['title'] = $item->description;
            array_push($result, $res);
        }

        echo json_encode($result);
    }

    public function actionStudentsProjects()
    {
        $this->renderPartial('/_trainer/tables/_studentsProjects', array(), false, true);
    }

    public function actionGetStudentsProjectList(){

        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentsProjects', $requestParams);
        $criteria =  new CDbCriteria();

       // $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionViewStudentProject(){
        $projectId =  Yii::app()->request->getPost('id');
        $project = StudentsProjects::model()->findByPk($projectId);
        $project->pullProject();
        echo json_encode(['data'=>1,'msg'=>'Проект затведжено' ]);
        Yii::app()->end();
    }

    public function actionApproveStudentProject(){
        $projectId =  Yii::app()->request->getPost('id');
        $project = StudentsProjects::model()->findByPk($projectId);
        if ($project){
            $project->approveProject();
            echo json_encode(['data'=>1,'msg'=>'Проект затведжено' ]);
            Yii::app()->end();
        }
        else{
            echo  json_encode(['data'=>1,'msg'=>'Помилка' ]);
            Yii::app()->end();
        }

    }

    public function actionShowFiles(){
        $this->renderPartial('/_trainer/viewFiles');
    }

    public function actionGetProjectFiles($projectId){
        $project = StudentsProjects::model()->findByPk($projectId);
        echo json_encode($project->showFiles());
        Yii::app()->end();
    }

    public function actionGetFileContent($path, $fileName){
        echo file_get_contents($path.'/'.$fileName);
        Yii::app()->end();

    }

}