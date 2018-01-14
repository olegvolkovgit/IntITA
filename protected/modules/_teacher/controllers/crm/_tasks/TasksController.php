<?php

class TasksController extends TeacherCabinetController
{
    use NotifySubscribedUsers;

    public function hasRole()
    {
        return true;
    }

    public function actionIndex($id = 0)
    {
        $this->renderPartial('/crm/_tasks/index', array(), false, true);
    }

    public function actionView($id)
    {
        if (!CrmRolesTasks::model()->find('id_task=:taskID and id_user=:userID and cancelled_by is NULL',
            array(':taskID' => $id, ':userID' => Yii::app()->user->getId()))) {
            throw new CException("У тебе немає доступу до завдання");
        }
        $this->renderPartial('/crm/_tasks/view', array(), false, true);
    }

    public function actionTasks()
    {
        $this->renderPartial('/crm/_tasks/tasks', array(), false, true);
    }

    public function actionViewClone($id) {
        if(!CrmRolesTasks::model()->find('id_task=:taskID and id_user=:userID and cancelled_by is NULL',
            array(':taskID'=>$id,':userID'=>Yii::app()->user->getId()))){
            throw new CException("У тебе немає доступу до завдання");
        }
        $this->renderPartial('/crm/_tasks/view_clone', array(), false, true);
    }

    public function actionManager()
    {
        $this->renderPartial('/crm/_manager/manager', array(), false, true);
    }

    public function actionCreatedEvents()
    {
        $this->renderPartial('/crm/_manager/createdEvents', array(), false, true);
    }

    public function actionUpdatedEvents()
    {
        $this->renderPartial('/crm/_manager/updatedEvents', array(), false, true);
    }
    public function actionChangedEvents()
    {
        $this->renderPartial('/crm/_manager/changedEvents', array(), false, true);
    }
    public function actionCommentedEvents()
    {
        $this->renderPartial('/crm/_manager/commentedEvents', array(), false, true);
    }
    public function actionSetRoleEvents()
    {
        $this->renderPartial('/crm/_manager/setRoleEvents', array(), false, true);
    }
    public function actionAllEvents()
    {
        $this->renderPartial('/crm/_manager/allEvents', array(), false, true);
    }


    public function actionGetUsers($query, $category, $multiple)
    {
        if ($query) {
            switch ($category) {
                case 'coworkers':
                    $models = TeacherOrganization::model()->coworkersList($query, Yii::app()->user->model->getCurrentOrganizationId());
                    break;
                case 'students':
                    $models = UserStudent::model()->studentsList($query, Yii::app()->user->model->getCurrentOrganizationId());
                    break;
                case 'all':
                    $models = StudentReg::model()->usersList($query);
                    break;
                default:
                    $models = StudentReg::model()->usersList($query);
                    break;
            }
            $result = [];
            if (isset($models)) {
                foreach ($models as $model) {
                    array_push($result, ['id' => $model->id, 'name' => $model->fullName, 'url' => $model->avatarPath()]);
                }
            }

            if (!$multiple) $result['results'] = $result;

            echo json_encode($result);
        }
    }

    public function actionGetSubTasks($query)
    {
        if ($query) {
            $result = [];
            $models = CrmTasks::model()->subTasksList($query);
            if (isset($models)) {
                foreach ($models as $model) {
                    array_push($result, ['id' => $model->id, 'name' => $model->name]);
                }
            }

            echo json_encode($result);
        }
    }

    public function actionGetRoles()
    {
        echo CJSON::encode(CrmRoles::model()->findAll());
    }

    public function actionSendTask()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $params = json_decode($_POST['crmTask'], true);

            if (isset($params['id'])) {
                $task = CrmTasks::model()->findByPk($params['id']);
                $task->attributes = $params;
                $task->change_date = new CDbExpression('NOW()');
                $task->changed_by =  Yii::app()->user->getId();
                $task->saveCheck();
            } else {
                $task = new CrmTasks();
                $task->initialize($params);
                $criteria = new CDbCriteria;
                if (isset($_POST['subTasks'])) {
                    $criteria->addInCondition("id", $_POST['subTasks']);
                    CrmTasks::model()->updateAll(['id_parent' => $task->id], $criteria);
                }
            }

            $task->setRoles($params['roles']);
            $result = ['message' => 'OK', 'id' => $task->id];
            if ($transaction) {
                $transaction->commit();
            }
            if (isset($params['notification']['notify'])) {
                $notificationParams = $params['notification'];
                $notificationErrors = $task->notifyByEmail($notificationParams, $task->id);
                if ($notificationErrors) {
                    $statusCode = 500;
                    $result = ['message' => 'error', 'reason' => $notificationErrors, 'id' => $task->id];
                }
            }
        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
            if ($transaction) {
                $transaction->rollback();
            }
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionUpdateBody()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $params = json_decode($_POST['crmTask'], true);

            $task = CrmTasks::model()->findByPk($params['id']);
            $task->body = $params['body'];
            $task->change_date = new CDbExpression('NOW()');
            $task->saveCheck();

            $transaction->commit();

        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetTasks()
    {
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->with = ['idTask.taskState', 'idTask.priorityModel', 'idTask.taskType'];
        if ($params['id']) {
            $criteria->condition = "t.id_user=" . Yii::app()->user->getId() . ' and t.role=' . $params['id'] . ' and t.cancelled_date is null';
        } else {
            $criteria->condition = "t.id_user=" . Yii::app()->user->getId() . ' and t.cancelled_date is null';
        }
        $criteria->group = 't.id_task';
        if (isset($params['filter']['crmStates.id'])) {
            $criteria->join = 'LEFT JOIN crm_tasks ct ON ct.id = t.id_task';
            $criteria->join .= ' LEFT JOIN crm_task_status cts ON ct.id_state=cts.id';
            $criteria->addCondition("cts.id=" . $params['filter']['crmStates.id']);
            unset($params['filter']['crmStates.id']);
        }
        if (isset($params['filter']['crmPriority.id'])) {
            $criteria->join = 'LEFT JOIN crm_tasks ct ON ct.id = t.id_task';
            $criteria->addCondition("ct.priority=" . $params['filter']['crmPriority.id']);
            unset($params['filter']['crmPriority.id']);
        }
        if (isset($params['filter']['crmType.id'])) {
            $criteria->join = 'LEFT JOIN crm_tasks ct ON ct.id = t.id_task';
            $criteria->addCondition("ct.type=" . $params['filter']['crmType.id']);
            unset($params['filter']['crmType.id']);
        }
        $criteria->addCondition("idTask.cancelled_date is NULL");

        $adapter = new NgTableAdapter('CrmRolesTasks', $params);
        $adapter->mergeCriteriaWith($criteria);
        $rows = $adapter->getData();


        $date_now = new DateTime('now', new DateTimeZone(Config::getServerTimezone()));
        foreach ($rows['rows'] as $k => $row) {
            $models = CrmTaskStateHistory::model()->findAllByAttributes(array('id_task' => $row['id_task']), array('order' => 'change_date asc'));
            $lastIndex = count($models) - 1;
            $interval = 0;
            foreach ($models as $key => $model) {
                if ($model->id_state == CrmTaskStatus::EXECUTED && isset($models[$key + 1])) {
                    $start_time = strtotime($model->change_date);
                    $end_time = strtotime($models[$key + 1]->change_date);
                    $interval = $interval + ($end_time - $start_time);
                } else if ($model->id_state == CrmTaskStatus::EXECUTED && !isset($models[$key + 1])) {
                    $start_time = strtotime($model->change_date);
                    $interval = $interval + ($date_now->getTimestamp() + $date_now->getOffset() - $start_time);
                }
            }

            $rows['rows'][$k]['spent_time'] = $interval;
            if (!empty($models)) {
                $rows['rows'][$k]['lastChangeBy'] = $models[$lastIndex]->idUser->fullName;
                $rows['rows'][$k]['lastChangeByAvatar'] = StaticFilesHelper::createPath('image', 'avatars', $models[$lastIndex]->idUser->avatar);
                $rows['rows'][$k]['lastChangeDate'] = $models[$lastIndex]->change_date;
            }
        }
        echo json_encode($rows);
    }

    public function actionGetCrmTask($id)
    {
        $data = [];
        $collaborator = [];
        $observer = [];

        $crmTask = CrmTasks::model()->with('parentTask')->findByPk($id);
        $data['task'] = ActiveRecordToJSON::toAssocArray($crmTask);

        if ($crmTask) {
            $notificationMessage = Newsletters::model()->find('related_model_id=:task', ['task' => $crmTask->id]);
            if ($notificationMessage) {
                $data['task']['notification']['notify'] = true;
                $data['task']['notification']['users'] = $notificationMessage->recipients;
                $data['task']['notification']['template'] = ActiveRecordToJSON::toAssocArray(MailTemplates::model()->findByPk($notificationMessage->template_id));
                $schedulerTask = SchedulerTasks::model()->find('related_model_id=:newsletterId AND type=:type',
                    ['newsletterId' => $notificationMessage->id, 'type' => TaskFactory::NEWSLETTER]);
                if ($schedulerTask) {
                    $data['task']['notification']['weekdays'] = $schedulerTask->parameters;
                    $data['task']['notification']['time'] = $schedulerTask->start_time;
                }
            }
        }


        $executant['id'] = $crmTask->executant->id_user;
        $executant['name'] = $crmTask->executant->idUser->fullName;
        $executant['url'] = $crmTask->executant->idUser->avatarPath();

        $producer['id'] = $crmTask->producer->id_user;
        $producer['name'] = $crmTask->producer->idUser->fullName;
        $producer['url'] = $crmTask->producer->idUser->avatarPath();

        foreach ($crmTask->collaborators as $item) {
            array_push($collaborator, ['id' => $item->id_user, 'name' => $item->idUser->fullName, 'url' => $item->idUser->avatarPath()]);
        }
        foreach ($crmTask->observers as $item) {
            array_push($observer, ['id' => $item->id_user, 'name' => $item->idUser->fullName, 'url' => $item->idUser->avatarPath()]);
        }
        $data['roles']['executant'] = $executant;
        $data['roles']['producer'] = $producer;
        $data['roles']['collaborator'] = $collaborator;
        $data['roles']['observer'] = $observer;

        echo json_encode($data);
    }

    public function actionGetCrmSubTasks($id)
    {
        $subTasks = CrmTasks::model()->findAllByAttributes(array('id_parent' => $id));
        echo CJSON::encode($subTasks);
    }

    public function actionGetCheckList($id)
    {
        $checkList = CrmCheckList::model()->with(['idTask', 'elements'])->findByAttributes(array('id_task' => $id));
        if ($checkList) {
            echo CJSON::encode(ActiveRecordToJSON::toAssocArrayWithRelations($checkList));
        } else {
            echo CJSON::encode((object)[]);
        }
    }

//    public function actionUpdateSubTasks(){
//        $result = ['message' => 'OK'];
//        $statusCode = 201;
//        $transaction = Yii::app()->db->beginTransaction();
//        try {
//            $taskId=$_POST['id'];
//            $subTasksIds = $_POST['subTasks'];
//
//            $oldSubtasks=CrmTasks::model()->findAllByAttributes(array('id_parent'=>$taskId));
//            foreach ($oldSubtasks as $old){
//                if(!in_array($old->id, $oldSubtasks)){
//                    $old->id_parent=null;
//                    $old->update();
//                }
//            }
//            $criteria = new CDbCriteria;
//            $criteria->addInCondition( "id" , $subTasksIds ) ;
//            CrmTasks::model()->updateAll(['id_parent'=>$taskId], $criteria);
//
//            $transaction->commit();
//        } catch (Exception $error) {
//            $transaction->rollback();
//            $statusCode = 500;
//            $result = ['message' => 'error', 'reason' => $error->getMessage()];
//        }
//        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
//    }

    public function actionAddSubTask()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $taskId = $_POST['id'];
            $subTaskId = $_POST['subTask'];
            CrmTasks::model()->updateByPk($subTaskId, array('id_parent' => $taskId));
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionRemoveSubTask()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $subTaskId = $_POST['subTask'];
            CrmTasks::model()->updateByPk($subTaskId, array('id_parent' => null));
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionCreateCrmCheckList()
    {
        $result = ['message' => 'OK'];
        $statusCode = 200;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model = CrmCheckList::model()->findByAttributes(array('id_task' => $_POST['id_task']));
            if (!$model) {
                $model = new CrmCheckList();
            }
            $model->attributes = $_POST;
            $model->save();
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionRemoveCrmCheckList()
    {
        $result = ['message' => 'OK'];
        $statusCode = 200;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model = CrmCheckList::model()->findByAttributes(array('id_task' => $_POST['id']));
            $model->delete();
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionCreateCrmCheckListElement()
    {
        $result = ['message' => 'OK'];
        $statusCode = 200;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model = new CrmCheckListElement();
            $model->attributes = $_POST;
            $model->save();
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionUpdateCheckListElement()
    {
        $result = ['message' => 'OK'];
        $statusCode = 200;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model = CrmCheckListElement::model()->findByPk($_POST['id']);
            $model->name = $_POST['name'];
            $model->save();
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionChangeCheckListElementStatus()
    {
        $result = ['message' => 'OK'];
        $statusCode = 200;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model = CrmCheckListElement::model()->findByPk($_POST['id']);
            $model->done = (int)(!(int)$model->done);
            $model->save();
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionDeleteCheckListElement()
    {
        $result = ['message' => 'OK'];
        $statusCode = 200;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model = CrmCheckListElement::model()->findByPk($_POST['id']);
            $model->delete();
            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionChangeTaskState()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $task = CrmTasks::model()->findByPk($_POST['id']);
            $task->state->changeTo($task->getStringState($_POST['state']), Yii::app()->user);

            $task->notifyUsers('changeTask', false);

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetTasksHistory()
    {
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.id_task=" . $params['id']);
        $adapter = new NgTableAdapter('CrmTaskStateHistory', $params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetTaskComments()
    {
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.id_task=" . $params['id']);
        $adapter = new NgTableAdapter('CrmTaskComments', $params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionAddTaskComment()
    {
        $params = array_filter($_POST['comment']);
        if ($params['message']) {
            $taskComment = new CrmTaskComments();
            $taskComment->attributes = $params;
            $taskComment->id_user = Yii::app()->user->getId();
            $taskComment->save();
            $taskComment->idTask->notifyUsers('changeTaskManager', true);
        }
    }

    public function actionRemoveTaskComment()
    {
        $comment = CrmTaskComments::model()->findByPk($_POST['commentId']);
        $comment->delete();
    }

    public function actionEditTaskComment()
    {
        $commentId = $_POST['commentId'];
        $message = $_POST['comment'];
        if ($message) {
            $taskComment = CrmTaskComments::model()->findByPk($commentId);
            $taskComment->message = $message;
            $taskComment->change_date = new CDbExpression('NOW()');
            $taskComment->save();
        }
    }

    public function actionGetCrmStatesList()
    {
        echo CJSON::encode(CrmTaskStatus::model()->findAll());
    }

    public function actionGetActiveCrmTasksCount()
    {
        $counters = [];
        $result = [];

        $counters["executant"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=" . CrmTaskStatus::COMPLETED . " AND role=" . CrmTasks::EXECUTANT . " AND id_user=" . Yii::app()->user->getId() . " and t.cancelled_date IS NULL and idTask.cancelled_date IS NULL");
        $counters["producer"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=" . CrmTaskStatus::COMPLETED . " AND role=" . CrmTasks::PRODUCER . " AND id_user=" . Yii::app()->user->getId() . " and t.cancelled_date IS NULL and idTask.cancelled_date IS NULL");
        $counters["collaborator"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=" . CrmTaskStatus::COMPLETED . " AND role=" . CrmTasks::COLLABORATOR . " AND id_user=" . Yii::app()->user->getId() . " and t.cancelled_date IS NULL and idTask.cancelled_date IS NULL");
        $counters["observer"] = CrmRolesTasks::model()->with('idTask')->count("idTask.id_state!=" . CrmTaskStatus::COMPLETED . " AND role=" . CrmTasks::OBSERVER . " AND id_user=" . Yii::app()->user->getId() . " and t.cancelled_date IS NULL and idTask.cancelled_date IS NULL");
        $counters["all"] = CrmRolesTasks::model()->with('idTask')->count(
            array(
                'condition' => "idTask.id_state!=" . CrmTaskStatus::COMPLETED . " AND id_user=" . Yii::app()->user->getId() . " and t.cancelled_date IS NULL and idTask.cancelled_date IS NULL",
                'group' => 't.id_task'
            )
        );

        $i = 0;
        foreach ($counters as $key => $counter) {
            $result[$i]['role'] = $key;
            $result[$i]['count'] = $counter;
            $i++;
        }
        echo json_encode($result);
    }

    public function actionCancelCrmTask()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $task = CrmTasks::model()->findByPk($_POST['id']);
            $task->cancelled_date = new CDbExpression('NOW()');
            $task->cancelled_by = Yii::app()->user->getId();
            $task->save();

            $transaction->commit();
        } catch (Exception $error) {
            $transaction->rollback();
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetSpentTimeTask()
    {
        $models = CrmTaskStateHistory::model()->findAllByAttributes(array('id_task' => $_GET['id']), array('order' => 'change_date asc'));
        $interval = 0;
        $data = [];
        $date_now = new DateTime('now', new DateTimeZone(Config::getServerTimezone()));
        foreach ($models as $key => $model) {
            if ($model->id_state == CrmTaskStatus::EXECUTED && isset($models[$key + 1])) {
                $start_time = strtotime($model->change_date);
                $end_time = strtotime($models[$key + 1]->change_date);
                $data[$model->id_user]['id'] = $model->id_user;
                $data[$model->id_user]['name'] = $model->idUser->fullName;
                $data[$model->id_user]['detailed'][$key]['start'] = $model->change_date;
                $data[$model->id_user]['detailed'][$key]['end'] = $models[$key + 1]->change_date;
                $data[$model->id_user]['spent_time'] = isset($data[$model->id_user]['spent_time']) ?
                    $data[$model->id_user]['spent_time'] + ($end_time - $start_time) : $end_time - $start_time;
            } else if ($model->id_state == CrmTaskStatus::EXECUTED && !isset($models[$key + 1])) {
                $start_time = strtotime($model->change_date);
                $interval = $interval + (time() - $start_time);
                $data[$model->id_user]['id'] = $model->id_user;
                $data[$model->id_user]['name'] = $model->idUser->fullName;
                $data[$model->id_user]['spent_time'] = isset($data[$model->id_user]['spent_time']) ?
                    $data[$model->id_user]['spent_time'] + ($date_now->getTimestamp() + $date_now->getOffset() - $start_time) : $date_now->getTimestamp() + $date_now->getOffset() - $start_time;
            }
        }

        $result['rows'] = $data;
        echo json_encode($result);
    }

    public function actionGetTimeList()
    {
        $models = CrmTaskStateHistory::model()->with('idUser')->findAllByAttributes(array('id_task' => $_GET['id'], 'id_user' => $_GET['id_user']), array('order' => 'change_date asc'));
        echo CJSON::encode(ActiveRecordToJSON::toAssocArrayWithRelations($models));
    }

    public function actionTasksManagerList()
    {
        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());

        $result = [];
        //        tasks changed
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->with = ['idTask.createdBy', 'assignedBy', 'cancelledBy', 'role0', 'idUser', 'producer', 'producerName'];
        $criteria->condition = "t.id_user=" . Yii::app()->user->getId() . ' and idTask.created_by!=' . Yii::app()->user->getId();
        $criteria->group = 't.id_task';
        $tasksChanged = ActiveRecordToJSON::toAssocArrayWithRelations(CrmRolesTasks::model()->findAll($criteria));

        foreach ($tasksChanged as $key => $task):
            $tasksChanged[$key]['event'] = 'task';
        endforeach;

        //        comments changed
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->with = ['idTask', 'idUser'];
        $criteria->condition = 't.id_user!=' . Yii::app()->user->getId();
        $criteria->addInCondition('id_task', $ids);
        $commentsChanged = ActiveRecordToJSON::toAssocArrayWithRelations(CrmTaskComments::model()->findAll($criteria));

        foreach ($commentsChanged as $key => $comment):
            $commentsChanged[$key]['event'] = 'comment';
        endforeach;

        //        roles changed
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->with = ['idTask.createdBy', 'assignedBy', 'cancelledBy', 'role0', 'idUser', 'producer', 'producerName'];
        $criteria->condition = "t.id_user=" . Yii::app()->user->getId() . ' and t.assigned_by!=' . Yii::app()->user->getId();
        $rolesChanged = ActiveRecordToJSON::toAssocArrayWithRelations(CrmRolesTasks::model()->findAll($criteria));

        foreach ($rolesChanged as $key => $task):
            $rolesChanged[$key]['event'] = 'role';
        endforeach;

        //        state changed
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->with = ['idTask.createdBy', 'idState', 'idUser'];
        $criteria->condition = "t.id_user!=" . Yii::app()->user->getId();
        $criteria->addInCondition('id_task', $ids);
        $statesChanged = ActiveRecordToJSON::toAssocArrayWithRelations(CrmTaskStateHistory::model()->findAll($criteria));

        foreach ($statesChanged as $key => $state):
            $statesChanged[$key]['event'] = 'state';
        endforeach;

        $result = array_merge($tasksChanged, $commentsChanged, $rolesChanged, $statesChanged);

        function sortByTime($a, $b)
        {
            if ($a['event'] == 'task') {
                $a_time = $a['idTask']['change_date'] ? $a['idTask']['change_date'] : $a['idTask']['created_date'];
            } else if ($a['event'] == 'comment') {
                $a_time = $a['create_date'];
            } else if ($a['event'] == 'role') {
                $a_time = $a['assigned_date'];
            } else if ($a['event'] == 'state') {
                $a_time = $a['change_date'];
            }

            if ($b['event'] == 'task') {
                $b_time = $b['idTask']['change_date'] ? $b['idTask']['change_date'] : $b['idTask']['created_date'];
            } else if ($b['event'] == 'comment') {
                $b_time = $b['create_date'];

            } else if ($b['event'] == 'role') {
                $b_time = $b['assigned_date'];
            } else if ($b['event'] == 'state') {
                $b_time = $b['change_date'];
            }

            if ($a_time == $b_time) {
                return 0;
            }
            return ($a_time < $b_time) ? 1 : -1;
        }

        usort($result, "sortByTime");

        echo json_encode($result);
    }

    public function actionVisitedTasksManager()
    {
        $model = CrmTaskManagerVisited::model()->findByAttributes(array('id_user' => Yii::app()->user->getId()));
        if ($model) {
            $model->date_of_visit = new CDbExpression('NOW()');
            $model->save();
        } else {
            $model = new CrmTaskManagerVisited();
            $model->id_user = Yii::app()->user->getId();
            $model->date_of_visit = new CDbExpression('NOW()');
            $model->save();
        }
        $this->notifyUser('changeTaskManager-' . Yii::app()->user->getId(), false);
    }

    public function actionGetTaskManagerCounter()
    {
        $lastVisitModel = CrmTaskManagerVisited::model()->findByAttributes(array('id_user' => Yii::app()->user->getId()));
        $date_now = new DateTime(strtotime(new CDbExpression("NOW()")));
        $last_visit = $lastVisitModel ? $lastVisitModel->date_of_visit : $date_now->format('Y-m-d H:i:s');

        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());
        $in='('.implode(',',$ids).')';
        $commentsAdded=0;
        $statesAdded=0;

        //created tasks
        $sql_created_task="SELECT COUNT('t.id') FROM crm_tasks as t WHERE t.id in ".$in." and t.created_by!=".Yii::app()->user->getId()." and t.created_date > '".$last_visit."'";
        $tasksCreated=Yii::app()->db->createCommand($sql_created_task)->queryScalar();
        //updated tasks
        $sql_changed_task="SELECT COUNT('t.id') FROM crm_tasks as t WHERE t.id in ".$in." and t.changed_by!=".Yii::app()->user->getId()." and t.change_date > '".$last_visit."'";
        $tasksUpdated=Yii::app()->db->createCommand($sql_changed_task)->queryScalar();
        if(!empty($ids)){
            //        comments
            $sql_added_comments = "SELECT COUNT('tc.id_task') FROM crm_task_comments as tc WHERE tc.id_task in " . $in . " and tc.id_user!=" . Yii::app()->user->getId() . " and tc.create_date > '" . $last_visit . "'";
            $commentsAdded = Yii::app()->db->createCommand($sql_added_comments)->queryScalar();
            //        states
            $sql_added_states = "SELECT COUNT('t.id') FROM crm_task_state_history as t WHERE t.id_task in " . $in . " and t.id_user!=" . Yii::app()->user->getId() . " and t.change_date > '" . $last_visit . "'";
            $statesAdded = Yii::app()->db->createCommand($sql_added_states)->queryScalar();
        }

        //        roles
        $sql_changed_role = "SELECT COUNT('rt.id_task') FROM crm_roles_tasks as rt left join crm_tasks as t on t.id=rt.id_task 
        WHERE rt.id_user=" . Yii::app()->user->getId() . " and rt.cancelled_date is null 
        and (rt.assigned_date > '" . $last_visit . "' or rt.cancelled_date > '" . $last_visit . "') and rt.assigned_by!=" . Yii::app()->user->getId();
        $rolesAdded = Yii::app()->db->createCommand($sql_changed_role)->queryScalar();

        $result['created_count']=$tasksCreated;
        $result['updated_count']=$tasksUpdated;
        $result['comments_count']=$commentsAdded;
        $result['roles_count']=$rolesAdded;
        $result['states_count']=$statesAdded;
        echo json_encode($result);
    }

    public function actionGetCreatedEvents(){
        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());

        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias="t";
        $criteria->with=['createdBy'];
        $criteria->condition="t.created_by!=".Yii::app()->user->getId();
        $criteria->addInCondition('t.id', $ids);
        $adapter = new NgTableAdapter('CrmTasks',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetUpdatedEvents(){
        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());

        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias="t";
        $criteria->with=['changedBy'];
        $criteria->condition="t.changed_by!=".Yii::app()->user->getId().' and t.changed_by IS NOT NULL';
        $criteria->addInCondition('t.id', $ids);
        $adapter = new NgTableAdapter('CrmTasks',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetChangedEvents(){
        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());

        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->with=['idState','idUser'];
        $criteria->condition="t.id_user!=".Yii::app()->user->getId();
        $criteria->addInCondition('t.id_task', $ids);
        $adapter = new NgTableAdapter('CrmTaskStateHistory',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetCommentedEvents(){
        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());

        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->with=['idTask','idUser'];
        $criteria->condition='t.id_user!='.Yii::app()->user->getId();
        $criteria->addInCondition('t.id_task', $ids);

        $adapter = new NgTableAdapter('CrmTaskComments',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetSetRoleEvents(){
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->with=['assignedBy','cancelledBy','role0','idTask'];
        $criteria->condition="t.id_user=".Yii::app()->user->getId().' and t.assigned_by!='.Yii::app()->user->getId();
        $adapter = new NgTableAdapter('CrmRolesTasks',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetTasksList(){
        $ids=CrmHelper::getUsersCrmTasks(Yii::app()->user->getId());
        $data=[];
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->addInCondition('t.id', $ids);
        $models = CrmTasks::model()->findAll($criteria);
        foreach ($models as $index=>$model)
        {
            $data[$index] = array('id'=>$model['id'], 'name'=>$model['name']);
        }
        echo json_encode($data);
    }

    public function actionGetUsersList(){
        $data=[];
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $models = StudentReg::model()->findAll($criteria);
        foreach ($models as $index=>$model)
        {
            $data[$index] = array('id'=>$model['id'], 'name'=>$model->fullName);
        }
        echo json_encode($data);
    }

    public function actionGetTaskDocuments()
    {
        echo CJSON::encode(CrmTaskDocuments::model()->findAllByAttributes(array('id_task'=>Yii::app()->request->getPost('id'))));
    }

    public function actionUploadTaskDocuments($task)
    {
        CrmTaskDocuments::model()->uploadDocument($task);
    }

    public function actionRemoveTaskFile()
    {
        $idFile=Yii::app()->request->getPost('id');
        $model=CrmTaskDocuments::model()->findByPk($idFile);
        $file=Yii::getpathOfAlias('webroot').'/files/crm/tasks/'.$model->id_task.'/'.$model->file_name;
        if (is_file($file))
            unlink($file);
        $model->delete();
    }
}