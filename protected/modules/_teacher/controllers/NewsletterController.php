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
        return (Yii::app()->user->model->isAdmin()
                || Yii::app()->user->model->isAccountant()
                || Yii::app()->user->model->isTrainer()
                || Yii::app()->user->model->isAuthor()
                || Yii::app()->user->model->isContentManager()
                || Yii::app()->user->model->isTeacherConsultant()
                || Yii::app()->user->model->isSuperVisor()
        );
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
        $result = [['id'=>'Coworkers','name'=>'Всі співробітники організації']];
        foreach ($roles as $role)
        {
            array_push($result,['id' =>$role, 'name'=>Role::getInstance($role)->title()]);
        }
        echo json_encode($result);
    }

    public function actionSendLetter(){
        $newsLetter= new Newsletters();
        $newsLetter->loadModel($_POST['newsletter']);
        if ($newsLetter->save()){
            $task = new SchedulerTasks();
            $task->loadModel($_POST);
            $task->type = TaskFactory::NEWSLETTER;
            date_default_timezone_set('Europe/Kiev');
            ($_POST['repeat_type'] = 1)?$date = DateTime::createFromFormat('d-m-Y H:i', $_POST['date']):$date = new DateTime('now');
            $task->start_time = $date->format('Y-m-d H:i:s');
            $task->related_model_id = $newsLetter->id;
            $task->save();
            echo true;
            Yii::app()->end();
        }
        else{
            echo json_encode($newsLetter->getErrors());
            Yii::app()->end();
        }

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

    public function actionGetEmails(){

        $userEmails = [];
        array_push($userEmails,array('email'=>Config::getNewsletterMailAddress()));
        $mail = Teacher::model()->findByPk(Yii::app()->user->id)->corporate_mail;
        if ($mail)
            array_push($userEmails,array('email'=>$mail));
        echo json_encode($userEmails);

    }

    public function actionGetEmailsCategoryList()
    {
        echo  CJSON::encode(EmailsCategory::model()->findAll());
    }
}