<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 13.11.2016
 * Time: 22:41
 */

class NewsletterController extends TeacherCabinetController
{

    public function hasRole(){
        return (!Yii::app()->user->model->isStudent() || !Yii::app()->user->model->isTenant());
    }

    public function actionIndex()
    {
        $this->renderPartial('index');
    }

    public function actionView()
    {
        $this->renderPartial('view');
    }

    public function actionGetRoles(){
        $roles = AllRolesDataSource::roles();
        $result = [];
        foreach ($roles as $role)
        {
            array_push($result,['id' =>$role, 'name'=>Role::getInstance($role)->title()]);
        }
        echo json_encode($result);
    }

    public function actionSendLetter(){
        $task = new SchedulerTasks();
        $task->type = TaskFactory::NEWSLETTER;
        $task->name = 'Розсилка';
        $task->status = SchedulerTasks::STATUSNEW;
        $task->parameters = json_encode($_POST['parameters']);
        $task->repeat_type = $_POST['taskRepeat'];
        date_default_timezone_set('Europe/Kiev');
        ($_POST['taskType'] = 1)?$date = DateTime::createFromFormat('d-m-Y H:i', $_POST['date']):$date = new DateTime('now');
        $task->start_time = $date->format('Y-m-d H:i:s');
        $task->save();
    }

    public function actionGetUserEmail(){
        $models = TypeAheadHelper::getTypeahead($_GET['query'],'StudentReg',['email','firstName','middleName','secondName']);
        $result = [];
        if (isset($models)){
            foreach ($models as $model){
                array_push($result,['name'=>$model->firstName.' '.$model->middleName.' '.$model->secondName,'email'=>$model->email ]);
            }
        }
        echo json_encode($result);
    }

    public function actionGetGroups(){
        $models = TypeAheadHelper::getTypeahead($_GET['query'],'OfflineGroups',['id','name']);
        $result = [];
        if (isset($models)){
            foreach ($models as $model){
                array_push($result,['id'=>$model->id,'name'=>$model->name ]);
            }
        }
        echo json_encode($result);
    }
    public function actionGetSubGroups(){
        $criteria = new CDbCriteria(['limit' => '10']);
        $criteria->with = array('groupName');
        $criteria->compare('LOWER(t.name)',mb_strtolower($_GET['query'], 'UTF-8'), true, 'OR');
        $criteria->compare('LOWER(groupName.name)', mb_strtolower($_GET['query'], 'UTF-8'), true, 'OR');
        $models = OfflineSubgroups::model()->findAll($criteria);
        $result = [];
        if (isset($models)){
            foreach ($models as $model){
                array_push($result,['id'=>$model->id,'name'=>$model->name, 'groupName' =>$model->groupName->name ]);
            }
        }
        echo json_encode($result);
    }

    public function actionGetGroupsById(){
        if (isset($_POST['groups'])){
        $models = OfflineGroups::model()->findAllByPk($_POST['groups']);
        $result = [];
        if (isset($models)){
            foreach ($models as $model){
                array_push($result,['id'=>$model->id,'name'=>$model->name]);
            }
        }
        echo json_encode($result);
        }
    }

    public function actionGetSubGroupsById(){
        if (isset($_POST['subGroups'])){
            $models = OfflineSubgroups::model()->with(['groupName'])->findAllByPk($_POST['subGroups']);
            $result = [];
            if (isset($models)){
                foreach ($models as $model){
                    array_push($result,['id'=>$model->id,'name'=>$model->name, 'groupName' =>$model->groupName->name ]);
                }
            }
            echo json_encode($result);
        }
    }

    public function actionGetRolesById(){
        if (isset($_POST['roles'])){
            $roles = $_POST['roles'];
            $result = [];
            foreach ($roles as $role)
            {
                array_push($result,['id' =>$role, 'name'=>Role::getInstance($role)->title()]);
            }
            echo json_encode($result);
        }
    }
}