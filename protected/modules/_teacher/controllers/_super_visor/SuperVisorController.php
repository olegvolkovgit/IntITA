<?php

class SuperVisorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isSuperVisor();
    }

    public function actionOfflineGroups()
    {
        $this->renderPartial('/_super_visor/index', array(), false, true);
    }
    
    public function actionOfflineGroup()
    {
        $this->renderPartial('/_super_visor/offlineGroup', array(), false, true);
    }


    public function actionAddNewOfflineGroupForm()
    {
        $this->renderPartial('/_super_visor/_offlineGroupForm', array('scenario'=>'new'), false, true);
    }

    public function actionEditOfflineGroupForm()
    {
        $this->renderPartial('/_super_visor/_offlineGroupForm', array('scenario'=>'update'), false, true);
    }
    
    public function actionOfflineSubgroups()
    {
        $this->renderPartial('/_super_visor/offlineSubgroups', array(), false, true);
    }
    
    public function actionOfflineSubgroup()
    {
        $this->renderPartial('/_super_visor/offlineSubgroup', array(), false, true);
    }

    public function actionAddSubgroupForm()
    {
        $this->renderPartial('/_super_visor/_subgroupForm', array('scenario'=>'new'), false, true);
    }
    
    public function actionEditSubgroupForm()
    {
        $this->renderPartial('/_super_visor/_subgroupForm', array('scenario'=>'update'), false, true);
    }

    public function actionOfflineStudents()
    {
        $this->renderPartial('/_super_visor/_offlineStudents', array(), false, true);
    }

    public function actionStudentsWithoutGroup()
    {
        $this->renderPartial('/_super_visor/_studentsWithoutGroup', array(), false, true);
    }

    public function actionSpecializations()
    {
        $this->renderPartial('/_super_visor/specializations', array(), false, true);
    }

    public function actionSpecializationCreate()
    {
        $this->renderPartial('/_super_visor/specializationCreate', array(), false, true);
    }
    
    public function actionSpecializationUpdate()
    {
        $this->renderPartial('/_super_visor/specializationUpdate', array(), false, true);
    }

    public function actionOfflineStudentProfile()
    {
        $this->renderPartial('/_super_visor/offlineStudentProfile', array(), false, true);
    }
    
    public function actionAddOfflineStudent($id)
    {
        $model=RegisteredUser::userById($id);
        $user = $model->registrationData->getAttributes();
//        todo
        if($user===null)
            throw new CHttpException(404,'The requested page does not exist.');

        $this->renderPartial('/_super_visor/addOfflineStudent', array(), false, true);
    }

    public function actionEditOfflineStudent($id)
    {
        $model=RegisteredUser::userById($id);
        $user = $model->registrationData->getAttributes();
//        todo
        if($user===null)
            throw new CHttpException(404,'The requested page does not exist.');

        $this->renderPartial('/_super_visor/updateOfflineStudent', array(), false, true);
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
        $criteria->join = 'inner join user_student us on t.id = us.id_user';
        $criteria->join .= ' left JOIN offline_students os ON t.id = os.id_user';
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE.' and (os.id_user IS NULL or os.end_date IS NOT NULL) and us.end_date IS NULL and t.educform="Онлайн/Офлайн"';
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
    
    public function actionGetSpecializationsList()
    {
        echo SpecializationsGroup::specializationsList();
    }

    public function actionGetGroupData()
    {
        echo CJSON::encode(OfflineGroups::model()->findByPk(Yii::app()->request->getParam('id')));
    }

    public function actionGetStudentData()
    {
        echo  CJSON::encode(StudentReg::userData(Yii::app()->request->getParam('id')));
    }

    public function actionGetOfflineStudentData()
    {
        echo  CJSON::encode(OfflineStudents::studentData(Yii::app()->request->getParam('id')));
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
    
    public function actionCreateOfflineGroup()
    {
        $name=Yii::app()->request->getParam('name');
        $startDate=Yii::app()->request->getParam('date');
        $specializationId=Yii::app()->request->getParam('specialization');
        $city=Yii::app()->request->getParam('city');

        $group= new OfflineGroups();
        $group->name=$name;
        $group->start_date=$startDate;
        $group->specialization=$specializationId;
        $group->city=$city;
        if($group->save()){
            echo 'Оффлайн групу успішно створено';
        }else{
            echo 'Створити групу не вдалося. Введені не вірні дані';
        }
    }

    public function actionAddSubgroup()
    {
        $name=Yii::app()->request->getParam('name');
        $group=Yii::app()->request->getParam('group');
        $data=Yii::app()->request->getParam('data');
        
        $subgroup= new OfflineSubgroups();
        $subgroup->name=$name;
        $subgroup->group=$group;
        $subgroup->data=$data;
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

        $group=OfflineGroups::model()->findByPk($id);
        $group->name=$name;
        $group->start_date=$startDate;
        $group->specialization=$specializationId;
        $group->city=$city;

        if($group->update()){
            echo 'Оффлайн групу успішно оновлено';
        }else{
            echo 'Оновити групу не вдалося. Введені не вірні дані';
        }

    }

    public function actionUpdateSubgroup()
    {
        $id=Yii::app()->request->getPost('id');
        $name=Yii::app()->request->getPost('name');
        $data=Yii::app()->request->getPost('data');
        
        $subgroup=OfflineSubgroups::model()->findByPk($id);
        $subgroup->name=$name;
        $subgroup->data=$data;

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

    public function actionAddTrainer($id)
    {
        $user = StudentReg::model()->findByPk($id);
        if (!$user)
            throw new CHttpException(404, 'Вказана сторінка не знайдена');

        $trainers = Teacher::getAllTrainers();

        $this->renderPartial('/_super_visor/addTrainer', array(
            'user' => $user,
            'trainers' => $trainers
        ), false, true);
    }

    public function actionSetTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');
        $trainer = RegisteredUser::userById($trainerId);

        if ($trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)===true) echo "success";
        else echo $trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
    }

    public function actionChangeTrainer($id)
    {
        $trainer = TrainerStudent::getTrainerByStudent($id);
        if($trainer){
            $oldTrainer = RegisteredUser::userById($trainer->id)->getTeacher();
        } else {
            $oldTrainer = null;
        }

        $user = StudentReg::model()->findByPk($id);

        $trainers = Teacher::getAllTrainers();

        $this->renderPartial('/_super_visor/changeTrainer', array(
            'user' => $user,
            'trainers' => $trainers,
            'oldTrainer' => $oldTrainer
        ), false, true);
    }
    public function actionEditTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');

        $trainer = RegisteredUser::userById($trainerId);
        $cancelResult='';
        $oldTrainerId = TrainerStudent::getTrainerByStudent($userId);
        if($oldTrainerId) {
            $oldTrainer = RegisteredUser::userById($oldTrainerId->id);
            $oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
            $cancelResult="Попереднього тренера скасовано.";
        }
        $result=$trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
        if ($result===true){
            $setResult="Нового тренера призначено.";
        } else{
            $setResult=$result;
        }
        echo $cancelResult.' '.$setResult;
    }

    public function actionRemoveTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');

        $trainer = TrainerStudent::getTrainerByStudent($userId);
        $oldTrainer = RegisteredUser::userById($trainer->id);

        if($oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
    }
    public function actionTrainers($query)
    {
        if ($query) {
            $users = Trainer::trainersByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
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

        if(OfflineStudents::model()->findByAttributes(array('id_user'=>$student->id_user, 'end_date'=>null))){
            echo 'Студент уже входить в одну з підгруп оффлайн групи';
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
        $userId = Yii::app()->request->getPost('userId');
        $subgroupId = Yii::app()->request->getPost('subgroupId');
        $startDate = Yii::app()->request->getPost('startDate');
        $graduateDate = Yii::app()->request->getPost('graduateDate');

        $student=OfflineStudents::model()->findByAttributes(array('id_user'=>$userId, 'id_subgroup'=>$subgroupId));
        if($student){
            $student->start_date=$startDate;
            $student->graduate_date=$graduateDate;
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

        $student=OfflineStudents::model()->findByAttributes(array('id_user'=>$userId, 'id_subgroup'=>$subgroupId));
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
}