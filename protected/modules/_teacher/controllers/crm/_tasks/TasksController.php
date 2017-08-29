<?php

class TasksController extends TeacherCabinetController {
    public function hasRole() {
        return Yii::app()->user->model->isTeacher() || Yii::app()->user->model->isDirector()
            || Yii::app()->user->model->isSuperAdmin()
            || Yii::app()->user->model->isAuditor()
            || Yii::app()->user->model->isAdmin();
    }

    public function actionIndex($id = 0) {
        $this->renderPartial('/crm/_tasks/index', array(), false, true);
    }

    public function actionMyTasks() {
        $this->renderPartial('/crm/_tasks/myTasks', array(), false, true);
    }

    public function actionHelpsTasks() {
        $this->renderPartial('/crm/_tasks/helpsTasks', array(), false, true);
    }

    public function actionEntrustTasks() {
        $this->renderPartial('/crm/_tasks/entrustTasks', array(), false, true);
    }

    public function actionWatchTasks() {
        $this->renderPartial('/crm/_tasks/watchTasks', array(), false, true);
    }

    public function actionGetUsers($query, $category, $multiple){
        if ($query) {
            switch ($category) {
                case 'coworkers':
                    $models = TeacherOrganization::model()->coworkersList($query,Yii::app()->user->model->getCurrentOrganizationId());
                    break;
                case 'students':
                    $models = UserStudent::model()->studentsList($query,Yii::app()->user->model->getCurrentOrganizationId());
                    break;
                case 'all':
                    $models = StudentReg::model()->usersList($query);
                    break;
                default:
                    $models = StudentReg::model()->usersList($query);
                    break;
            }
            $result = [];
            if (isset($models)){
                foreach ($models as $model){
                    array_push($result,['id'=>$model->id,'name'=>$model->fullName,'url'=>$model->avatarPath()]);
                }
            }

            if(!$multiple) $result['results']=$result;

            echo json_encode($result);
        }
    }

    public function actionGetRoles(){
        echo CJSON::encode(CrmRoles::model()->findAll());
    }

    public function actionSendTask(){
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $params =json_decode($_POST['crmTask'], true);
            if(isset($params['id'])){
                $task=CrmTasks::model()->findByPk($params['id']);
                $task->attributes=$params;
                $task->saveCheck();
            }else{
                $task=new CrmTasks();
                $task->initialize($params);;
            }

            $task->setRoles($params['roles']);

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetTasks(){
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->with=['idTask.taskState'];
        $criteria->condition="t.id_user=".Yii::app()->user->getId().' and t.role='.$params['id'].' and t.cancelled_date is null';
        if(isset($params['filter']['crmStates.id'])){
            $criteria->join = 'LEFT JOIN crm_tasks ct ON ct.id = t.id_task';
            $criteria->join .= ' LEFT JOIN crm_task_status cts ON ct.id_state=cts.id';
            $criteria->addCondition("cts.id=".$params['filter']['crmStates.id']);
            unset($params['filter']['crmStates.id']);
        }
        $adapter = new NgTableAdapter('CrmRolesTasks',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetCrmTask($id){
        $data=[];
        $executant=[];
        $collaborator=[];
        $observer=[];

        $crmTask=CrmTasks::model()->findByPk($id);

        $data['task']=ActiveRecordToJSON::toAssocArray($crmTask);

        foreach ($crmTask->executants as $item){
            array_push($executant,['id'=>$item->id_user,'name'=>$item->idUser->fullName,'url'=>$item->idUser->avatarPath()]);
        }

        $producer['id']=$crmTask->producer->id_user;
        $producer['name']=$crmTask->producer->idUser->fullName;
        $producer['url']=$crmTask->producer->idUser->avatarPath();

        foreach ($crmTask->collaborators as $item){
            array_push($collaborator,['id'=>$item->id_user,'name'=>$item->idUser->fullName,'url'=>$item->idUser->avatarPath()]);
        }
        foreach ($crmTask->observers as $item){
            array_push($observer,['id'=>$item->id_user,'name'=>$item->idUser->fullName,'url'=>$item->idUser->avatarPath()]);
        }
        $data['roles']['executant']=$executant;
        $data['roles']['producer']=$producer;
        $data['roles']['collaborator']=$collaborator;
        $data['roles']['observer']=$observer;

        echo json_encode($data);
    }

    public function actionChangeTaskState(){
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $task=CrmTasks::model()->findByPk($_POST['id']);
            $task->state->changeTo($task->getStringState($_POST['state']), Yii::app()->user);

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetTasksHistory(){
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.id_task=".$params['id']);
        $adapter = new NgTableAdapter('CrmTaskStateHistory',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetTaskComments(){
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.id_task=".$params['id']);
        $adapter = new NgTableAdapter('CrmTaskComments',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionAddTaskComment(){
        $params = array_filter($_POST['comment']);
        if($params['message']){
            $taskComment= new CrmTaskComments();
            $taskComment->attributes = $params;
            $taskComment->id_user = Yii::app()->user->getId();
            $taskComment->save();
        }
    }

    public function actionRemoveTaskComment(){
        $comment=CrmTaskComments::model()->findByPk($_POST['commentId']);
        $comment->delete();
    }

    public function actionEditTaskComment(){
        $commentId = $_POST['commentId'];
        $message = $_POST['comment'];
        if($message){
            $taskComment= CrmTaskComments::model()->findByPk($commentId);
            $taskComment->message = $message;
            $taskComment->change_date =  new CDbExpression('NOW()');;
            $taskComment->save();
        }
    }

    public function actionGetCrmStatesList()
    {
        echo  CJSON::encode(CrmTaskStatus::model()->findAll());
    }

    public function actionGetActiveCrmTasksCount()
    {
        $counters = [];
        $result=[];

        $counters["executant"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=".CrmTaskStatus::COMPLETED." AND role=".CrmTasks::EXECUTANT." AND id_user=".Yii::app()->user->getId()." and t.cancelled_date IS NULL");
        $counters["producer"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=".CrmTaskStatus::COMPLETED." AND role=".CrmTasks::PRODUCER." AND id_user=".Yii::app()->user->getId()." and t.cancelled_date IS NULL");
        $counters["collaborator"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=".CrmTaskStatus::COMPLETED." AND role=".CrmTasks::COLLABORATOR." AND id_user=".Yii::app()->user->getId()." and t.cancelled_date IS NULL");
        $counters["observer"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=".CrmTaskStatus::COMPLETED." AND role=".CrmTasks::OBSERVER." AND id_user=".Yii::app()->user->getId()." and t.cancelled_date IS NULL");

        $i=0;
        foreach ($counters as $key=>$counter){
            $result[$i]['role']=$key;
            $result[$i]['count']=$counter;
            $i++;
        }
        echo json_encode($result);
    }
}