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
        Yii::app()->user->model->hasAccessToOrganizationModel(PlainTaskAnswer::model()->findByPk($plainTaskId)->plainTaskModule);
        $mark = Yii::app()->request->getPost('mark');
        $comment = Yii::app()->request->getPost('comment');
        $userId = Yii::app()->request->getPost('userId');
        if (!PlainTaskMarks::saveMark($plainTaskId, $mark, $comment, $userId))
            throw new \application\components\Exceptions\IntItaException(503, 'Ваша оцінка не записана в базу даних.
            Спробуйте пізніше або повідомте адміністратора.');
        $rating = RatingUserModule::model()->find(['id_module=:idModule AND module_done=0 AND id_user=:idUser',[':idModule'=>PlainTaskAnswer::model()->findByPk($plainTaskId)->plainTaskModule->module_ID, ':idUser'=>$userId]]);
        if ($rating){
            $rating->rateUser($userId);
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
}