<?php

class ConsultantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isConsultant();
    }

    public function actionModules($id)
    {
        $consultant = RegisteredUser::userById($id);
        $role = new Consultant();
        $modules = $role->activeModules($consultant->registrationData);

        $this->renderPartial('/_consultant/_modules', array(
            'modules' => $modules,
            'user' => $consultant
        ), false, true);
    }

    public function actionConsultations()
    {
        $this->renderPartial('/_consultant/_consultations', array(), false, true);
    }

    public function actionGetTodayConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addBetweenCondition('date_cons',date_format($currentDate, "Y-m-d"),date_format($currentDate, "Y-m-d"));
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
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
        //echo Consultationscalendar::todayConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetPastConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addCondition('date_cons < "'.date_format($currentDate, "Y-m-d").'" ');
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
        //echo Consultationscalendar::pastConsultationsList(Yii::app()->user->getId());
    }


    public function actionGetCancelConsultationsList(){
        date_default_timezone_set('Europe/Kiev');
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NOT NULL');
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
       // echo Consultationscalendar::cancelConsultationsList(Yii::app()->user->getId());
    }

    public function actionGetPlannedConsultationsList(){
        $params = $_GET;
        $currentDate = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->with = ['user','teacher','lecture'];
        $criteria->addCondition('date_cancelled IS NULL');
        $criteria->addCondition('date_cons > "'.date_format($currentDate, "Y-m-d").'" ');
        $criteria->compare('t.teacher_id',Yii::app()->user->getId());
        $adapter = new NgTableAdapter('Consultationscalendar',$params,['user','teacher','lecture']);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
       // echo Consultationscalendar::plannedConsultationsList(Yii::app()->user->getId());
    }

    public function actionConsultation($id){
        $model = Consultationscalendar::model()->findByPk($id);

        if($model) {
            $this->renderPartial('/_consultant/_viewConsultation', array(
                'model' => $model
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400, 'Такої консультації не існує.');
        }
    }

    public function actionCancelConsultation($id)
    {
        $model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
        if ($model->deleteConsultation($user))
            echo 'success';
    }
}