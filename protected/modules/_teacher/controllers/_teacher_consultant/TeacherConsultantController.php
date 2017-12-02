<?php

class TeacherConsultantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isTeacherConsultant();
    }

    public function actionShowTeacherPlainTaskList()
    {
        return $this->renderPartial('/_teacher_consultant/teacherPlainTaskList',array());
    }

    public function actionModules($id){
        $user = RegisteredUser::userById($id);
        $role = new TeacherConsultant();
        $modules = $role->activeModules($user->registrationData);

        return $this->renderPartial('/_teacher_consultant/_modules', array(
            'modules' => $modules,
        ));
    }

    public function actionStudents($id){
        $user = StudentReg::model()->findByPk($id);
        if(!$user){
            throw new \application\components\Exceptions\IntItaException(400);
        }
        $role = new TeacherConsultant();
        $students = $role->activeStudentsModules($user);

        return $this->renderPartial('/_teacher_consultant/_students', array(
            'students' => $students,
        ));
    }

    public function actionShowPlainTask($idPlainTask)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(PlainTaskAnswer::model()->findByPk($idPlainTask)->plainTaskModule);
        if ($idPlainTask == 0) {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої задачі не знайдено.');
        }

        $plainTask = PlainTaskAnswer::model()->findByPk($idPlainTask);
        if (!$plainTask) {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої задачі не знайдено.');
        }

        $idModule=$plainTask->plainTask->lectureElement->lecture->idModule;
        $idStudent=$plainTask->id_student;
        $sqlModule="SELECT COUNT(*) FROM `teacher_consultant_module` where id_teacher=".Yii::app()->user->getId()." 
        and id_module=".$idModule." and end_date IS NULL";
        $sqlStudent="SELECT COUNT(*) FROM `teacher_consultant_student` where id_teacher=".Yii::app()->user->getId()." 
        and id_student=".$idStudent." and id_module=".$idModule." and end_date IS NULL";
        $module = Yii::app()->db->createCommand($sqlModule)->queryScalar();
        $student = Yii::app()->db->createCommand($sqlStudent)->queryScalar();

        if ($module==0 || $student==0) {
            throw new \application\components\Exceptions\IntItaException(403, 'Переглядати задачу заборонено');
        }
        return $this->renderPartial('/_teacher_consultant/showPlainTask', array(
            'plainTask' => $plainTask
        ), false, true);
    }

    public function actionMarkPlainTask()
    {
        $plainTaskId = Yii::app()->request->getPost('idPlainTask');
        $mark = Yii::app()->request->getPost('mark');
        $comment = Yii::app()->request->getPost('comment');
        $plainTaskAnswer=PlainTaskAnswer::model()->findByPk($plainTaskId);
        $plainTaskAnswer->setMark($mark, $comment);
    }

    public function actionMarkedPlainTasksArray()
    {
        $mark = Yii::app()->request->getPost('mark');
        $comment = Yii::app()->request->getPost('comment');
        $answersId = json_decode($_POST["answersIdArray"]);

        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $answersId);
        $plainTaskAnswers = PlainTaskAnswer::model()->findAll($criteria);

        foreach ($plainTaskAnswers as $answer){
            $answer->setMark($mark, $comment);
        }
    }

    public function actionConsultations()
    {
        $this->renderPartial('/_teacher_consultant/consultations/_consultations', array(), false, true);
    }

    public function actionConsultation($id){
        $model = Consultationscalendar::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($model->lecture->module);
        if($model) {
            $this->renderPartial('/_teacher_consultant/consultations/_viewConsultation', array(
                'model' => $model
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої консультації не існує.');
        }
    }
    
    public function actionGetTodayConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture','lecture.module'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addBetweenCondition('date_cons',date_format($currentDate, "Y-m-d"),date_format($currentDate, "Y-m-d"));
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $criteria->compare('module.id_organization' , Yii::app()->user->model->getCurrentOrganization()->id);
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        $records = $adapter->getData();
        foreach ($records['rows'] as &$record){
            {
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
            unset($record);
        }

        echo json_encode($records);
    }

    public function actionGetPastConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture','lecture.module'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addCondition('date_cons < "'.date_format($currentDate, "Y-m-d").'" ');
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $criteria->compare('module.id_organization' , Yii::app()->user->model->getCurrentOrganization()->id);
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }


    public function actionGetCancelConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture','lecture.module'];
        $criteria->addCondition('date_cancelled IS NOT NULL');
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $criteria->compare('module.id_organization' , Yii::app()->user->model->getCurrentOrganization()->id);
        $adapter = new NgTableAdapter('Consultationscalendar',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetPlannedConsultationsList(){
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture','lecture.module'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addCondition('date_cons > "'.date_format($currentDate, "Y-m-d").'" ');
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $criteria->compare('module.id_organization' , Yii::app()->user->model->getCurrentOrganization()->id);
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionCancelConsultation($id)
    {
        $model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
        if ($model->deleteConsultation($user))
            echo 'success';
    }

    public function actionGetNewPlainTasksAnswersCount()
    {
        $newAnswersCount = count(PlainTaskAnswer::newPlainTaskListByTeacher(Yii::app()->user->getId()));
        echo $newAnswersCount;
    }

    public function actionReadNewPlainTasksAnswers()
    {
        $newAnswers=PlainTaskAnswer::newPlainTaskListByTeacher(Yii::app()->user->getId());
        foreach ($newAnswers as $newAnswer){
            $newAnswer->read_answer=true;
            $newAnswer->update();
        }
    }

    public function actionPlainTaskListByTeacher()
    {
        echo PlainTaskAnswer::plainTaskListByTeacher();
    }

    public function actionGetTeacherConsultantsGroupList()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'og';
        $criteria->join = 'left join group_access_to_content ga on ga.group_id=og.id';
        $criteria->join .= ' left join acc_service s on s.service_id=ga.service_id';
        $criteria->join .= ' left join acc_module_service ms on ms.service_id=s.service_id';

        $criteria->join .= ' left join acc_course_service cs on cs.service_id=s.service_id';
        $criteria->join .= ' left join course_modules cm on cm.id_course=cs.course_id';

        $criteria->join .= ' left join teacher_consultant_module tcm on tcm.id_module=cm.id_module or tcm.id_module=ms.module_id';

        $criteria->addCondition('NOW() BETWEEN ga.start_date and ga.end_date');
        $criteria->addCondition('og.id_organization=:id_org');
        $criteria->addCondition('tcm.end_date is null and tcm.id_teacher=:id_t');

        $criteria->params = array(':id_org' => Yii::app()->user->model->getCurrentOrganization()->id,':id_t' => Yii::app()->user->getId());
        $criteria->distinct=true;

        echo  CJSON::encode(OfflineGroups::model()->findAll($criteria));
    }

    public function actionGetStudentsModulesByGroup(){
        $role = new TeacherConsultant();
        $students = $role->activeStudentsModulesByGroup(Yii::app()->request->getPost('groupId'));
        echo json_encode($students);
    }

    public function actionGetStudentsModulesWithoutGroup(){
        $role = new TeacherConsultant();
        $students = $role->activeStudentsModulesWithoutGroup();
        echo json_encode($students);
    }
}