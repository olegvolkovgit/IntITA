<?php

class SuperVisorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isSuperVisor();
    }

    public function actionOfflineGroups()
    {
        $this->renderPartial('/_supervisor/index', array(), false, true);
    }
    
    public function actionOfflineGroup()
    {
        $this->renderPartial('/_supervisor/offlineGroup', array(), false, true);
    }


    public function actionAddNewOfflineGroupForm()
    {
        $this->renderPartial('/_supervisor/forms/_offlineGroupForm', array('scenario'=>'new'), false, true);
    }

    public function actionEditOfflineGroupForm()
    {
        $this->renderPartial('/_supervisor/forms/_offlineGroupForm', array('scenario'=>'update'), false, true);
    }
    
    public function actionOfflineSubgroups()
    {
        $this->renderPartial('/_supervisor/tables/offlineSubgroups', array(), false, true);
    }
    
    public function actionOfflineSubgroup()
    {
        $this->renderPartial('/_supervisor/offlineSubgroup', array(), false, true);
    }

    public function actionAddSubgroupForm()
    {
        $this->renderPartial('/_supervisor/forms/_subgroupForm', array('scenario'=>'new'), false, true);
    }
    
    public function actionEditSubgroupForm()
    {
        $this->renderPartial('/_supervisor/forms/_subgroupForm', array('scenario'=>'update'), false, true);
    }

    public function actionOfflineStudents()
    {
        $this->renderPartial('/_supervisor/tables/_offlineStudents', array(), false, true);
    }

    public function actionStudentsWithoutGroup()
    {
        $this->renderPartial('/_supervisor/tables/_studentsWithoutGroup', array(), false, true);
    }

    public function actionSpecializations()
    {
        $this->renderPartial('/_supervisor/tables/specializations', array(), false, true);
    }

    public function actionSpecializationCreate()
    {
        $this->renderPartial('/_supervisor/forms/specializationCreate', array(), false, true);
    }
    
    public function actionSpecializationUpdate()
    {
        $this->renderPartial('/_supervisor/forms/specializationUpdate', array(), false, true);
    }

    public function actionUserProfile($id)
    {
        $model = RegisteredUser::userById($id);
        $trainer = TrainerStudent::getTrainerByStudent($id);
        
        $this->renderPartial('/_supervisor/userProfile', array(
            'model' => $model,
            'trainer' => $trainer
        ), false, true);
    }

    public function actionUsers()
    {
        $this->renderPartial('/_supervisor/tables/users', array(), false, true);
    }

    public function actionStudents()
    {
        $this->renderPartial('/_supervisor/tables/students', array(), false, true);
    }

    public function actionAddOfflineStudent($id)
    {
        $model=RegisteredUser::userById($id);
        $user = $model->registrationData->getAttributes();
//        todo
        if($user===null)
            throw new CHttpException(404,'The requested page does not exist.');

        $this->renderPartial('/_supervisor/forms/addOfflineStudent', array(), false, true);
    }

    public function actionEditOfflineStudent($id)
    {
        $offlineStudent = OfflineStudents::model()->findByPk($id);
//        todo
        if($offlineStudent===null)
            throw new CHttpException(404,'The requested page does not exist.');

        $this->renderPartial('/_supervisor/forms/updateOfflineStudent', array(), false, true);
    }

    public function actionGroupAccess($type, $scenario)
    {
        if($type=='course'){
            $view='groupAccessToCourse';
        } else if($type=='module'){
            $view='groupAccessToModule';
        }
        $this->renderPartial('/_supervisor/forms/'.$view, array('scenario'=>$scenario), false, true);
    }
    
    public function actionGetOfflineGroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineGroups', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetOfflineSubgroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineSubgroups', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetOfflineStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineStudents', $requestParams);

        if(isset($requestParams['idGroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->join .= ' LEFT JOIN offline_groups g ON sg.group = g.id';
            $criteria->condition = 'g.id='.$requestParams['idGroup'];
            $ngTable->mergeCriteriaWith($criteria);
        }
        if(isset($requestParams['idSubgroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->condition = 'sg.id='.$requestParams['idSubgroup'];
            $ngTable->mergeCriteriaWith($criteria);
        }

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetStudentsWithoutGroupList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);

        $criteria =  new CDbCriteria();

        $criteria->alias = 't';
        $criteria->distinct = true;
        $criteria->join = 'left join user_student us on t.id = us.id_user';
        $criteria->join .= ' left JOIN offline_students os ON t.id = os.id_user';
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE.' 
        and us.end_date IS NULL and t.educform="Онлайн/Офлайн" 
        and os.id_user IS NULL';
        $criteria->group = 't.id';

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetGroupsOfflineSubgroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineSubgroups', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = 't.group='.$requestParams['id'];
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetUsersList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE;
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);

        $criteria =  new CDbCriteria();

        $criteria->alias = 't';
        $criteria->join = 'inner join user_student us on t.id = us.id_user';
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE.' and us.end_date IS NULL';
        $criteria->group = 't.id';
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $startDate=$_GET['startDate'];
            $endDate=$_GET['endDate'];
            $criteria->condition = "TIMESTAMP(us.start_date) BETWEEN " . "'$startDate'" . " AND " . "'$endDate'";
        }

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
    
    public function actionGetSpecializationsList()
    {
        echo SpecializationsGroup::specializationsList();
    }

    public function actionGetGroupData()
    {
        echo CJSON::encode(OfflineGroups::model()->findByPk(Yii::app()->request->getParam('id')));
    }

    public function actionGetOfflineStudentModel()
    {
        echo  CJSON::encode(OfflineStudents::studentModel(Yii::app()->request->getParam('id')));
    }
    
    public function actionGetSubgroupData()
    {
        echo CJSON::encode(OfflineSubgroups::model()->findByPk(Yii::app()->request->getParam('id')));
    }

    public function actionGetSpecializationData()
    {
        echo CJSON::encode(SpecializationsGroup::model()->findByPk(Yii::app()->request->getParam('id')));
    }

    public function actionGetCityById($id)
    {
        echo AddressCity::model()->findByPk($id)->title_ua;
    }

    public function actionGetCuratorById($id)
    {
        $id=$id?$id:Yii::app()->user->getId();
        echo json_encode(StudentReg::model()->findByPk($id)->userIdFullName());
    }

    public function actionGetGroupAccess()
    {
        $result=array();
        $groupAccess=GroupAccess::model()->findByPk(array('group_id'=>Yii::app()->request->getParam('groupId'),'service_id'=>Yii::app()->request->getParam('serviceId')));
        $result['group']=$groupAccess->group->name;
        $result['service']=$groupAccess->service->description;
        $result['endDate']=$groupAccess->end_date;
        
        echo CJSON::encode($result);
    }
    
    public function actionGetCourseAccessList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('GroupAccess', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->join = ' LEFT JOIN acc_course_service cs ON t.service_id = cs.service_id';
        $criteria->join .= ' LEFT JOIN course c ON cs.course_id = c.course_ID';
        $criteria->condition = 't.group_id='.$requestParams['idGroup'].' and cs.course_id IS NOT NULL';
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetModuleAccessList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('GroupAccess', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->join = ' LEFT JOIN acc_module_service ms ON t.service_id = ms.service_id';
        $criteria->join .= ' LEFT JOIN module m ON ms.module_id = m.module_ID';
        $criteria->condition = 't.group_id='.$requestParams['idGroup'].' and ms.module_id IS NOT NULL';
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }
    
    public function actionCreateOfflineGroup()
    {
        $name=Yii::app()->request->getParam('name');
        $startDate=Yii::app()->request->getParam('date');
        $specializationId=Yii::app()->request->getParam('specialization');
        $city=Yii::app()->request->getParam('city');
        $curatorId=Yii::app()->request->getParam('curator');

        $group= new OfflineGroups();
        $group->name=$name;
        $group->start_date=$startDate;
        $group->specialization=$specializationId;
        $group->city=$city;
        $group->id_user_created=Yii::app()->user->getId();
        $group->id_user_curator=$curatorId;
        if($group->validate()){
            $group->save();
            echo 'Офлайн групу успішно створено';
        }else{
            echo $group->getValidationErrors();
        }
    }

    public function actionAddSubgroup()
    {
        $name=Yii::app()->request->getParam('name');
        $group=Yii::app()->request->getParam('group');
        $data=Yii::app()->request->getParam('data');
        $curatorId=Yii::app()->request->getParam('curator');
        
        $subgroup= new OfflineSubgroups();
        $subgroup->name=$name;
        $subgroup->group=$group;
        $subgroup->data=$data;
        $subgroup->id_user_created=Yii::app()->user->getId();
        $subgroup->id_user_curator=$curatorId;

        if($subgroup->save()){
            echo 'Підгрупу успішно додано';
        }else{
            echo 'Створити підгрупу не вдалося. Введені не вірні дані';
        }

    }

    public function actionUpdateOfflineGroup()
    {
        $id=Yii::app()->request->getPost('id');
        $name=Yii::app()->request->getPost('name');
        $startDate=Yii::app()->request->getPost('date');
        $specializationId=Yii::app()->request->getPost('specialization');
        $city=Yii::app()->request->getParam('city');
        $curatorId=Yii::app()->request->getParam('curator');

        $group=OfflineGroups::model()->findByPk($id);
        $group->name=$name;
        $group->start_date=$startDate;
        $group->specialization=$specializationId;
        $group->city=$city;
        $group->id_user_curator=$curatorId;

        if($group->validate()){
            $group->update();
            echo 'Офлайн групу успішно оновлено';
        }else{
            echo $group->getValidationErrors();
        }
    }

    public function actionUpdateSubgroup()
    {
        $id=Yii::app()->request->getPost('id');
        $name=Yii::app()->request->getPost('name');
        $data=Yii::app()->request->getPost('data');
        $curatorId=Yii::app()->request->getParam('curator');

        $subgroup=OfflineSubgroups::model()->findByPk($id);
        $subgroup->name=$name;
        $subgroup->data=$data;
        $subgroup->id_user_curator=$curatorId;

        if($subgroup->update()){
            echo 'Підгрупу успішно оновлено';
        }else{
            echo 'Оновити підгрупу не вдалося. Введені не вірні дані';
        }

    }

    public function actionCreateSpecialization()
    {
        $name=Yii::app()->request->getPost('name');

        $specialization=new SpecializationsGroup();
        $specialization->name=$name;

        if($specialization->save()){
            echo 'Спеціалізацію створено';
        }else{
            echo 'Створити спеціалізацію не вдалося. Введені не вірні дані';
        }

    }

    public function actionUpdateSpecialization()
    {
        $id=Yii::app()->request->getPost('id');
        $name=Yii::app()->request->getPost('name');

        $specialization=SpecializationsGroup::model()->findByPk($id);
        $specialization->name=$name;

        if($specialization->update()){
            echo 'Спеціалізацію оновлено';
        }else{
            echo 'Оновити спеціалізацію не вдалося. Введені не вірні дані';
        }

    }

    public function actionCitiesByQuery($query){
        echo AddressCity::citiesByQuery($query);
    }

    public function actionCuratorsByQuery($query){
        echo SuperVisor::addCuratorsList($query);
    }

    public function actionSetTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');
        $trainer = RegisteredUser::userById($trainerId);

        if ($trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)===true) echo "success";
        else echo $trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
    }

    public function actionGroupsByQuery($query)
    {
        if ($query) {
            $groups = OfflineGroups::groupsByQuery($query);
            echo $groups;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionAddStudentToSubgroup()
    {
        $userId = Yii::app()->request->getPost('userId');
        $subgroupId = Yii::app()->request->getPost('subgroupId');
        $startDate = Yii::app()->request->getPost('startDate');

        $student=new OfflineStudents();
        $student->id_user=$userId;
        $student->start_date=$startDate;
        $student->id_subgroup=$subgroupId;
        $student->assigned_by=Yii::app()->user->getId();

        if(OfflineStudents::model()->findByAttributes(array('id_user'=>$student->id_user, 'end_date'=>null,'id_subgroup'=>$subgroupId))){
            echo 'Студент уже входить в дану підгрупу';
        }else{
            if($student->save()){
                echo 'Студента додано в підгрупу';
            }else{
                echo 'Додати студента не вдалося';
            }
        }
    }

    public function actionUpdateOfflineStudent()
    {
        $modelId = Yii::app()->request->getPost('modelId');
        $userId = Yii::app()->request->getPost('userId');
        $subgroupId = Yii::app()->request->getPost('subgroupId');
        $startDate = Yii::app()->request->getPost('startDate');
        $graduateDate = Yii::app()->request->getPost('graduateDate');
        $newSubgroupId = Yii::app()->request->getPost('newSubgroupId');

        $student=OfflineStudents::model()->findByPk($modelId);
        if($student){
            if($subgroupId!=$newSubgroupId){
                $student->id_subgroup=$newSubgroupId;
                if(OfflineStudents::model()->findByAttributes(array('id_user'=>$userId, 'end_date'=>null,'id_subgroup'=>$newSubgroupId))){
                    echo 'Студент уже входить в дану підгрупу';
                    return;
                }
            }
            $student->start_date=$startDate;
            if($graduateDate) $student->graduate_date=$graduateDate;
            else $student->graduate_date=null;
            if($student->update()){
                echo 'Дані оновлено';
            }else{
                echo 'Оновити дані не вдалося';
            }
        }else{
            echo 'Студента в даній підгрупі не знайдено';
        }
    }

    public function actionCancelStudentFromSubgroup()
    {
        $userId = Yii::app()->request->getPost('userId');
        $subgroupId = Yii::app()->request->getPost('subgroupId');

        $student=OfflineStudents::model()->findByAttributes(array('id_user'=>$userId, 'id_subgroup'=>$subgroupId,'end_date'=>null));
        if($student){
            $student->end_date=date("Y-m-d H:i:s");
            if($student->update()){
                echo 'Студента скасовано';
            }else{
                echo 'Скасувати студента не вдалося';
            }
        }else{
            echo 'Студента в даній підгрупі не знайдено';
        }
    }

    public function actionSetGroupAccessToService()
    {
        $idGroup=Yii::app()->request->getParam('idGroup');
        $idContent=Yii::app()->request->getParam('idContent');
        $endDate=Yii::app()->request->getParam('endDate');
        $serviceType=Yii::app()->request->getParam('serviceType');

        $educFormModel = EducationForm::model()->findByPk(EducationForm::OFFLINE);
        if($serviceType=='course') 
            $service = CourseService::model()->getService($idContent, $educFormModel);
        else if($serviceType=='module')
            $service = ModuleService::model()->getService($idContent, $educFormModel);

        $groupAccess= new GroupAccess();
        $groupAccess->group_id=$idGroup;
        $groupAccess->service_id=$service->service_id;
        $groupAccess->start_date=date('Y-m-d');
        $groupAccess->end_date=$endDate;

        if(GroupAccess::model()->findAllByAttributes(array('group_id'=>$groupAccess->group_id,'service_id'=>$groupAccess->service_id))){
            echo 'Дана група вже має доступ до даного контента';
        }else{
            if($groupAccess->validate()){
                $groupAccess->save();
                echo 'Групі успішно надано права';
            }else{
                echo $groupAccess->getValidationErrors();
            }
        }
    }

    public function actionUpdateGroupAccessToService()
    {
        $idGroup=Yii::app()->request->getParam('idGroup');
        $idService=Yii::app()->request->getParam('idService');
        $endDate=Yii::app()->request->getParam('endDate');

        $groupAccess= GroupAccess::model()->findByPk(array('group_id'=>$idGroup,'service_id'=>$idService));
        $groupAccess->end_date=$endDate;

        if($groupAccess->validate()){
            if($groupAccess->save())
                echo 'Дані оновлено';
        }else{
            echo $groupAccess->getValidationErrors();
        }
    }

    public function actionCancelGroupAccess()
    {
        $idGroup=Yii::app()->request->getParam('idGroup');
        $idService=Yii::app()->request->getParam('idService');

        $groupAccess = GroupAccess::model()->findByPk(array('group_id'=>$idGroup,'service_id'=>$idService));
        $groupAccess->end_date=date('Y-m-d');
        if($groupAccess->save()) return true;
        else  throw new \application\components\Exceptions\IntItaException('500');
    }
}