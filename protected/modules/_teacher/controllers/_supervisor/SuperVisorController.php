<?php

class SuperVisorController extends TeacherCabinetController
{
    public function hasRole()
    {

        $allowedGroupsActions = ['getOfflineGroupsList', 'getSpecializationsList', 'getOfflineStudentsList',
            'getCourseAccessList', 'getModuleAccessList', 'getGroupData', 'getCuratorById', 'getCityById',
            'getGroupsOfflineSubgroupsList','getSubgroupData'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isSuperVisor() || (Yii::app()->user->model->isAccountant() ||
                Yii::app()->user->model->isTeacherConsultant() || Yii::app()->user->model->isTrainer() &&
                in_array($action, $allowedGroupsActions));
    }

    public function actionOfflineGroups()
    {
        $this->renderPartial('/_supervisor/index', array(), false, true);
    }

    public function actionOfflineGroup($id)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(OfflineGroups::model()->findByPk($id));
        $this->renderPartial('/_supervisor/offlineGroup', array(), false, true);
    }


    public function actionAddNewOfflineGroupForm()
    {
        $this->renderPartial('/_supervisor/forms/_offlineGroupForm', array('scenario' => 'new'), false, true);
    }

    public function actionEditOfflineGroupForm($id)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(OfflineGroups::model()->findByPk($id));
        $this->renderPartial('/_supervisor/forms/_offlineGroupForm', array('scenario' => 'update'), false, true);
    }

    public function actionOfflineSubgroups()
    {
        $this->renderPartial('/_supervisor/tables/offlineSubgroups', array(), false, true);
    }

    public function actionOfflineSubgroup($id)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(OfflineSubgroups::model()->findByPk($id)->groupName);
        $this->renderPartial('/_supervisor/offlineSubgroup', array(), false, true);
    }

    public function actionAddSubgroupForm($id)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(OfflineGroups::model()->findByPk($id));
        $this->renderPartial('/_supervisor/forms/_subgroupForm', array('scenario' => 'new'), false, true);
    }

    public function actionEditSubgroupForm($id)
    {
        Yii::app()->user->model->hasAccessToOrganizationModel(OfflineSubgroups::model()->findByPk($id)->groupName);
        $this->renderPartial('/_supervisor/forms/_subgroupForm', array('scenario' => 'update'), false, true);
    }

    public function actionOfflineStudents()
    {
        $this->renderPartial('/_supervisor/tables/_offlineStudents', array(), false, true);
    }

    public function actionStudentsWithoutGroup()
    {
        $this->renderPartial('/_supervisor/tables/_studentsWithoutGroup', array(), false, true);
    }

    public function actionUsers()
    {
        $this->renderPartial('/_supervisor/tables/users', array(), false, true);
    }

    public function actionStudents()
    {
        $this->renderPartial('/_supervisor/tables/students', array(), false, true);
    }

    public function actionAddOfflineStudentForm($id)
    {
        $model = RegisteredUser::userById($id);
        $user = $model->registrationData->getAttributes();
//        todo if student
        if ($user === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->renderPartial('/_supervisor/forms/offlineStudentSubgroup', array('scenario' => 'create'), false, true);
    }

    public function actionAddOfflineStudentToSubgroupForm($idSubgroup)
    {
        $subgroup = OfflineSubgroups::model()->findByPk($idSubgroup);
        if ($subgroup === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->renderPartial('/_supervisor/forms/offlineStudentSubgroup', array('scenario' => 'create'), false, true);
    }

    public function actionUpdateOfflineStudentForm($id)
    {
        $offlineStudent = OfflineStudents::model()->findByPk($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($offlineStudent->group);
        if ($offlineStudent === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->renderPartial('/_supervisor/forms/offlineStudentSubgroup', array('scenario' => 'update'), false, true);
    }

    public function actionGroupAccess($type, $scenario, $group = null, $service = null)
    {
        if ($type == 'course') {
            $view = 'groupAccessToCourse';
        } else if ($type == 'module') {
            $view = 'groupAccessToModule';
        }
        if ($group && $service) {
            $model = GroupAccess::model()->findByPk(array('group_id' => $group, 'service_id' => $service));
            $model->validate();
        } else if ($group && !$service) {
            Yii::app()->user->model->hasAccessToOrganizationModel(OfflineGroups::model()->findByPk($group));
        }
        $this->renderPartial('/_supervisor/forms/' . $view, array('scenario' => $scenario), false, true);
    }

    public function actionGetOfflineGroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineGroups', $requestParams);
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetOfflineSubgroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineSubgroups', $requestParams);
        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN offline_groups og ON og.id = t.group';
        $criteria->addCondition('og.id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id);
        $criteria->with = ['groupName'];
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        $this->renderPartial('//ajax/json', ['statusCode' => 200, 'body' => json_encode($result)]);
    }

    public function actionGetOfflineStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineStudents', $requestParams);
        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
        $criteria->join .= ' LEFT JOIN offline_groups g ON sg.group = g.id';
        if (isset($requestParams['idGroup'])) {
            $criteria->addCondition('g.id=' . $requestParams['idGroup'] . ' and t.end_date IS NULL');
        }
        if (isset($requestParams['idSubgroup'])) {
            $criteria->addCondition('sg.id=' . $requestParams['idSubgroup'] . ' and t.end_date IS NULL');
        }
        if (!isset($requestParams['idGroup']) && !isset($requestParams['idSubgroup'])) {
            $criteria->addCondition('t.end_date IS NULL');
        }
        $criteria->addCondition('g.id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetStudentsWithoutGroupList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);
        $sql = "select
            u.id
        from
            `user` u
        inner join user_student us on u.id = us.id_user
            left JOIN offline_students os ON u.id = os.id_user
        WHERE 
         u.cancelled=" . StudentReg::ACTIVE . " and os.id_user IS NULL and us.end_date IS NULL and u.educform=" . EducationForm::ONLINE_OFFLINE . "
        UNION
        SELECT
            os.id_user
        from
            `user` u
            inner join user_student us on u.id = us.id_user
            left JOIN offline_students os ON u.id = os.id_user
        WHERE 
         u.cancelled=" . StudentReg::ACTIVE . " and us.end_date IS NULL and u.educform=" . EducationForm::ONLINE_OFFLINE . "
            and  os.id_user IS not NULL
        GROUP BY os.id_user
        HAVING count(os.id_user)=sum(if(os.end_date,1,0));";

        $students = Yii::app()->db->createCommand($sql)->queryColumn();

        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->distinct = true;
        $criteria->addInCondition('t.id', $students);
        $criteria->group = 't.id';

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetGroupsOfflineSubgroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineSubgroups', $requestParams);

        $criteria = new CDbCriteria();
        $criteria->condition = 't.group=' . $requestParams['id'];
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetSpecializationsList()
    {
        echo SpecializationsGroup::specializationsList();
    }

    public function actionGetGroupData($id)
    {
        $result['group']=OfflineGroups::model()->findByPk($id);
        $result['services']['courses']=$result['group']->groupCourses();
        $result['services']['modules']=$result['group']->groupModules();
        echo CJSON::encode($result);
    }

    public function actionGetOfflineStudentModel()
    {
        echo CJSON::encode(OfflineStudents::studentModel(Yii::app()->request->getParam('id')));
    }

    public function actionGetSubgroupData($id)
    {
        $subgroup = OfflineSubgroups::model()->with('links')->findByPk($id);
        echo json_encode($subgroup->subgroupData());
    }

    public function actionGetCityById($id)
    {
        echo AddressCity::model()->findByPk($id)->title_ua;
    }

    public function actionGetCuratorById($id)
    {
        $id = $id ? $id : Yii::app()->user->getId();
        echo json_encode(StudentReg::model()->findByPk($id)->userIdFullName());
    }

    public function actionGetGroupAccess()
    {
        $result = array();
        $groupAccess = GroupAccess::model()->findByPk(array('group_id' => Yii::app()->request->getParam('groupId'), 'service_id' => Yii::app()->request->getParam('serviceId')));
        $result['group'] = $groupAccess->group->name;
        $result['service'] = $groupAccess->service->description;
        $result['endDate'] = $groupAccess->end_date;

        echo CJSON::encode($result);
    }

    public function actionGetCourseAccessList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('GroupAccess', $requestParams);

        $criteria = new CDbCriteria();
        $criteria->join = ' LEFT JOIN acc_course_service cs ON t.service_id = cs.service_id';
        $criteria->join .= ' LEFT JOIN course c ON cs.course_id = c.course_ID';
        $criteria->condition = 't.group_id=' . $requestParams['idGroup'] . ' and cs.course_id IS NOT NULL';
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetModuleAccessList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('GroupAccess', $requestParams);

        $criteria = new CDbCriteria();
        $criteria->join = ' LEFT JOIN acc_module_service ms ON t.service_id = ms.service_id';
        $criteria->join .= ' LEFT JOIN module m ON ms.module_id = m.module_ID';
        $criteria->condition = 't.group_id=' . $requestParams['idGroup'] . ' and ms.module_id IS NOT NULL';
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetCourseModuleAccessList()
    {
        $requestParams = $_GET;
        $data = array();

        $criteria_course = new CDbCriteria();
        $criteria_course->join = ' LEFT JOIN acc_course_service cs ON t.service_id = cs.service_id';
        $criteria_course->join .= ' LEFT JOIN course c ON cs.course_id = c.course_ID';
        $criteria_course->condition = 't.group_id=' . $requestParams['idGroup'] . ' and cs.course_id IS NOT NULL';
        $data['courses'] = ActiveRecordToJSON::toAssocArray(GroupAccess::model()->with('course', 'course.module.moduleInCourse')->findAll($criteria_course));
        foreach ($data['courses'] as $courseKey => $course) {
            foreach ($data['courses'][$courseKey]['course']['module'] as $moduleKey => $module) {
                $data['courses'][$courseKey]['course']['module'][$moduleKey]['groupModuleTeacher'] =
                    ActiveRecordToJSON::toAssocArray(OfflineGroupsTeacherConsultantModule::model()->with('teacher')->findByAttributes(
                        array('id_group' => $requestParams['idGroup'], 'id_module' => $module['id_module'], 'end_date' => null))
                    );
            }
        }

        $criteria_module = new CDbCriteria();
        $criteria_module->join = ' LEFT JOIN acc_module_service ms ON t.service_id = ms.service_id';
        $criteria_module->join .= ' LEFT JOIN module m ON ms.module_id = m.module_ID';
        $criteria_module->condition = 't.group_id=' . $requestParams['idGroup'] . ' and ms.module_id IS NOT NULL';
        $data['modules'] = ActiveRecordToJSON::toAssocArray(GroupAccess::model()->with('module')->findAll($criteria_module));
        foreach ($data['modules'] as $moduleKey => $module) {
            $data['modules'][$moduleKey]['groupModuleTeacher'] = ActiveRecordToJSON::toAssocArray(OfflineGroupsTeacherConsultantModule::model()->with('teacher')->findByAttributes(
                array('id_group' => $requestParams['idGroup'], 'id_module' => $module['module']['module_ID'], 'end_date' => null))
            );
        }

        echo json_encode($data);
    }

    public function actionCreateOfflineGroup()
    {
        $result = array();

        $name = Yii::app()->request->getParam('name');
        $startDate = Yii::app()->request->getParam('date');
        $specializationId = Yii::app()->request->getParam('specialization');
        $city = Yii::app()->request->getParam('city');
        $chatAuthorId = Yii::app()->request->getParam('chat_author');

        $group = new OfflineGroups();
        $group->name = $name;
        $group->start_date = $startDate;
        $group->specialization = $specializationId;
        $group->city = $city;
        $group->id_user_created = Yii::app()->user->getId();
        $group->chat_author_id = $chatAuthorId;
        $group->id_organization = Yii::app()->user->model->getCurrentOrganization()->id;

        if ($group->validate()) {
            $group->save();
            $result['message'] = 'Офлайн групу успішно створено';
            $result['idGroup'] = $group->getPrimaryKey();
        } else {
            $result['message'] = $group->getValidationErrors();
        }
        echo json_encode($result);
    }

    public function actionAddSubgroup()
    {
        $result = array();
        $name = Yii::app()->request->getParam('name');
        $group = Yii::app()->request->getParam('group');
        $data = Yii::app()->request->getParam('data');
        $journal = Yii::app()->request->getParam('journal');
        $trainerId = Yii::app()->request->getParam('trainer');

        $subgroup = new OfflineSubgroups();
        $subgroup->name = $name;
        $subgroup->group = $group;
        $subgroup->data = $data;
        $subgroup->journal = $journal;
        $subgroup->id_user_created = Yii::app()->user->getId();
        $subgroup->id_trainer = $trainerId;

        if ($subgroup->save()) {
            $result['message'] = 'Підгрупу успішно додано';
            $result['idSubgroup'] = $subgroup->getPrimaryKey();
        } else {
            $result['message'] = 'Створити підгрупу не вдалося. Введені не вірні дані';
        }
        echo json_encode($result);
    }

    public function actionUpdateOfflineGroup()
    {
        $id = Yii::app()->request->getPost('id');
        $name = Yii::app()->request->getPost('name');
        $startDate = Yii::app()->request->getPost('date');
        $specializationId = Yii::app()->request->getPost('specialization');
        $city = Yii::app()->request->getParam('city');
        $chatAuthorId = Yii::app()->request->getParam('chat_author');

        $group = OfflineGroups::model()->findByPk($id);
        $group->name = $name;
        $group->start_date = $startDate;
        $group->specialization = $specializationId;
        $group->city = $city;
        $group->chat_author_id = $chatAuthorId;

        if ($group->checkOrganization() && $group->validate()) {
            $group->save();
            echo 'Офлайн групу успішно оновлено';
        } else {
            echo $group->getValidationErrors();
        }
    }

    public function actionUpdateSubgroup()
    {
        $id = Yii::app()->request->getPost('id');
        $name = Yii::app()->request->getPost('name');
        $data = Yii::app()->request->getPost('data');
        $journal = Yii::app()->request->getParam('journal');
        $trainerId = Yii::app()->request->getParam('trainer');
        $subgroup = OfflineSubgroups::model()->findByPk($id);
        $oldTrainer = $subgroup->id_trainer;
        $subgroup->name = $name;
        $subgroup->data = $data;
        $subgroup->journal = $journal;
        $subgroup->id_trainer = $trainerId;

        if ($subgroup->save()) {
            if ($oldTrainer != $subgroup->id_trainer && $subgroup->id_trainer) {
                $subgroup->setTrainerForStudents();
            }
            echo 'Підгрупу успішно оновлено';
        } else {
            echo 'Оновити підгрупу не вдалося. Введені не вірні дані';
        }

    }

    public function actionCitiesByQuery($query)
    {
        echo AddressCity::citiesByQuery($query);
    }

    public function actionChatAuthorsByQuery($query)
    {
        echo SuperVisor::addChatAuthorsList($query);
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

        $student = new OfflineStudents();
        $student->id_user = $userId;
        $student->start_date = $startDate;
        $student->id_subgroup = $subgroupId;
        $student->assigned_by = Yii::app()->user->getId();

        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();

        try {
            if (OfflineStudents::model()->findByAttributes(array('id_user' => $student->id_user, 'end_date' => null, 'id_subgroup' => $subgroupId))) {
                echo 'Студент уже входить в дану підгрупу';
            } else {
                if ($student->checkOrganization() && $student->save()) {
                    $subgroup = OfflineSubgroups::model()->findByPk($subgroupId);

                    $offlineGroupsTeacherModule = OfflineGroupsTeacherConsultantModule::model()->findAllByAttributes(array(
                        'id_group' => $subgroup->group, 'end_date' => null));

                    //set trainer for student
                    if ($subgroup->id_trainer) {
                        $student->setTrainer($subgroup->id_trainer);
                    }

                    //set teacher for student for all groups modules
                    $role = new TeacherConsultant();
                    foreach ($offlineGroupsTeacherModule as $model) {
                        if (!$role->checkStudent($model->module->module_ID, $student->id_user)) {
                            $model->module->cancelTeacherStudentsForModule($student->id_user);
                        }
                        $role->setStudentAttribute($model->teacher, $student->id_user, $model->module->module_ID);
                    }
                    $callUrl = new CurlHelper();
                    $callUrl->callPageByCurl(Config::getFullChatPath() . "/sub_group_operations/update/" . $subgroupId);

                    echo 'Студента додано в підгрупу';
                } else {
                    echo 'Додати студента не вдалося';
                }
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function actionUpdateOfflineStudent()
    {
        $result = array();
        $modelId = Yii::app()->request->getPost('modelId');
        $userId = Yii::app()->request->getPost('userId');
        $subgroupId = Yii::app()->request->getPost('subgroupId');
        $startDate = Yii::app()->request->getPost('startDate');
        $graduateDate = Yii::app()->request->getPost('graduateDate');
        $services = Yii::app()->request->getPost('services');

        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();

        try {
            $student = OfflineStudents::model()->findByPk($modelId);
            if ($student) {
                if ($student->id_subgroup != $subgroupId) {
                    $newSubgroup = $subgroupId;
                    $result['oldSubgroup'] = $student->id_subgroup;
                    $student->id_subgroup = $subgroupId;
                    if (OfflineStudents::model()->findByAttributes(array('id_user' => $userId, 'end_date' => null, 'id_subgroup' => $subgroupId))) {
                        $result['message'] = 'Студент уже входить в дану підгрупу';
                        return;
                    }
                }
                $student->start_date = $startDate;
                if ($graduateDate) {
                    $student->graduate_date = $graduateDate;
                    $request['user']=$student->user;
                    $request['graduate_date']=$graduateDate;
                    $request['courses']=$services['courses'];
                    $request['modules']=$services['modules'];
                    if (!Graduate::model()->findByAttributes(array('id_user' => $request['user']['id'])))
                        Graduate::AddGraduate($request);
                } else $student->graduate_date = null;
                if ($student->checkOrganization() && $student->update()) {
                    if (isset($newSubgroup)) {
                        $subgroup = OfflineSubgroups::model()->findByPk($newSubgroup);
                        if ($subgroup->id_trainer) {
                            $student->setTrainer($subgroup->id_trainer);
                        }
                    }
                    $result['message'] = 'Дані оновлено';
                } else {
                    $result['message'] = 'Оновити дані не вдалося';
                }
            } else {
                $result['message'] = 'Студента в даній підгрупі не знайдено';
            }
            $transaction->commit();
            echo json_encode($result);
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function actionCancelStudentFromSubgroup()
    {
        $userId = Yii::app()->request->getPost('userId');
        $subgroupId = Yii::app()->request->getPost('subgroupId');
        $reasonId = Yii::app()->request->getPost('reasonId');
        $end_study_leave = Yii::app()->request->getPost('fullDate');
        $comment = Yii::app()->request->getPost('comment');

        $student = OfflineStudents::model()->findByAttributes(array('id_user' => $userId, 'id_subgroup' => $subgroupId, 'end_date' => null));

        if ($student) {
            $student->end_date = date("Y-m-d H:i:s");
            $student->cancel_type = $reasonId;
            $student->end_study_leave = $end_study_leave;
            if (!is_null($comment)) {
                $student->comment = $comment;
            }
            if ($student->update()) {
                $url = Config::getFullChatPath() . "/sub_group_operations/update/" . $subgroupId;
                $callUrl = new CurlHelper();
                $callUrl->callPageByCurl($url);
                echo 'Студента скасовано';
            } else {
                echo 'Скасувати студента не вдалося';
            }
        } else {
            echo 'Студента в даній підгрупі не знайдено';
        }
    }

    public function actionGetAllReasons()
    {
        $reasons = OfflineStudentCancelType::getAllCause();
        echo json_encode($reasons);
    }

    public function actionSetGroupAccessToService()
    {
        $idGroup = Yii::app()->request->getParam('idGroup');
        $idContent = Yii::app()->request->getParam('idContent');
        $endDate = Yii::app()->request->getParam('endDate');
        $serviceType = Yii::app()->request->getParam('serviceType');

        $educFormModel = EducationForm::model()->findByPk(EducationForm::OFFLINE);
        if ($serviceType == 'course')
            $service = CourseService::model()->getService($idContent, $educFormModel);
        else if ($serviceType == 'module')
            $service = ModuleService::model()->getService($idContent, $educFormModel);

        /* @TODO 02.12.16 Move this code into GroupAccessBehavior */
        $groupAccess = new GroupAccess();
        $groupAccess->group_id = $idGroup;
        $groupAccess->service_id = $service->service_id;
        $groupAccess->start_date = date('Y-m-d');
        $groupAccess->end_date = $endDate;

        if (GroupAccess::model()->findAllByAttributes(array('group_id' => $groupAccess->group_id, 'service_id' => $groupAccess->service_id))) {
            echo 'Дана група вже має доступ до даного контента';
        } else {
            if ($groupAccess->validate()) {
                $groupAccess->save();
                echo 'Групі успішно надано права';
            } else {
                echo $groupAccess->getValidationErrors();
            }
        }
    }

    public function actionUpdateGroupAccessToService()
    {
        $idGroup = Yii::app()->request->getParam('idGroup');
        $idService = Yii::app()->request->getParam('idService');
        $endDate = Yii::app()->request->getParam('endDate');

        $groupAccess = GroupAccess::model()->findByPk(array('group_id' => $idGroup, 'service_id' => $idService));
        $groupAccess->end_date = $endDate;

        if ($groupAccess->validate()) {
            if ($groupAccess->save())
                echo 'Дані оновлено';
        } else {
            echo $groupAccess->getValidationErrors();
        }
    }

    public function actionCancelGroupAccess()
    {
        $idGroup = Yii::app()->request->getParam('idGroup');
        $idService = Yii::app()->request->getParam('idService');

        $groupAccess = GroupAccess::model()->findByPk(array('group_id' => $idGroup, 'service_id' => $idService));
        $groupAccess->end_date = date('Y-m-d');
        if ($groupAccess->save()) return true;
        else  throw new \application\components\Exceptions\IntItaException('500');
    }

    public function actionAddTrainer($id)
    {
        $student = UserStudent::model()->findByAttributes(array(
            'id_user' => $id,
            'id_organization' => Yii::app()->user->model->getCurrentOrganization()->id,
            'end_date' => null));
        if (!$student)
            throw new CHttpException(404, 'Вказана сторінка не знайдена');

        $this->renderPartial('/users/addForms/addTrainer', array(), false, true);
    }

    public function actionSetTrainer()
    {
        $data = array();
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');
        $trainer = RegisteredUser::userById($trainerId);

        $cancelResult = '';
        $oldTrainerId = TrainerStudent::getTrainerByStudent($userId);

        if ($oldTrainerId) {
            $oldTrainer = RegisteredUser::userById($oldTrainerId->id);
            $oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
            $cancelResult = "Попереднього тренера скасовано.";
        }
        $result = $trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);

        if ($result === true) {
            $data['data'] = "success";
        } else {
            $data['data'] = $result;
        }
        $data['data'] = $cancelResult . $data['data'];
        echo json_encode($data);
    }

    public function actionRemoveTrainer()
    {
        $data = array();
        $userId = Yii::app()->request->getPost('userId');

        $trainer = TrainerStudent::getTrainerByStudent($userId);
        $oldTrainer = RegisteredUser::userById($trainer->id);

        if ($oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId))
            $data['data'] = "Операція прошла успішно";
        else $data['data'] = "Виникла помилка";
        echo json_encode($data);
    }

    public function actionTrainers()
    {
        $this->renderPartial('/_supervisor/tables/trainers', array(), false, true);
    }

    public function actionChangeTrainers()
    {
        $this->renderPartial('/_supervisor/changeTrainers', array(), false, true);
    }

    public function actionTrainersStudents($idTrainer)
    {
        if (!RegisteredUser::userById($idTrainer)->hasRole(UserRoles::TRAINER))
            throw new CHttpException(404, 'Вказана сторінка не знайдена');
        $this->renderPartial('/_supervisor/tables/trainersStudents', array('idTrainer' => $idTrainer), false, true);
    }

    public function actionGetTrainersStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('TrainerStudent', $requestParams);
        $criteria = new CDbCriteria();
        $criteria->condition = 't.trainer=' . $requestParams['trainer'] . ' and t.end_time is null 
        and id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id;
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionEditOfflineGroupTeacherModule($idGroup, $idModule)
    {
        $group = OfflineGroups::model()->findByPk($idGroup);
        $module = Module::model()->findByPk($idModule);

        Yii::app()->user->model->hasAccessToOrganizationModel($module);
        Yii::app()->user->model->hasAccessToOrganizationModel($group);

        if ($idGroup && $idModule) {
            $role = new TeacherConsultant();
            $isTeacherDefined = $role->checkOfflineGroupModule($idGroup, $idModule);
            if ($isTeacherDefined) {
                $model = OfflineGroupsTeacherConsultantModule::model()->findByAttributes(array('id_group' => $idGroup, 'id_module' => $idModule, 'end_date' => null));
                $teacher = $model->teacher;
            } else {
                $model = new OfflineGroupsTeacherConsultantModule();
                $teacher = null;
            }

            $this->renderPartial('/_supervisor/forms/_editOfflineGroupTeacherModule', array(
                'group' => $group,
                'module' => $module,
                'isTeacherDefined' => $isTeacherDefined,
                'teacher' => $teacher,
                'model' => $model,
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionAssignTeacherForGroupModule()
    {
        $teacher = Yii::app()->request->getPost('teacher');
        $module = Yii::app()->request->getPost('module');
        $group = Yii::app()->request->getPost('group');

        $user = RegisteredUser::userById($teacher);
        $model = $user->registrationData;

        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();

        try {
            if (!$user->isTeacherConsultant()) {
                echo "Даному співробітнику не призначена роль викладача.";
            } else {
                $groupModule = new OfflineGroupsTeacherConsultantModule();
                $groupModule->id_group = $group;
                $groupModule->id_teacher = $teacher;
                $groupModule->id_module = $module;
                $groupModule->assigned_by = Yii::app()->user->getId();
                if ($groupModule->checkGroupModule()) {
                    if ($groupModule->save()) {
                        $role = new TeacherConsultant();
                        $students = OfflineGroups::model()->findByPk($group)->students;
                        foreach ($students as $key => $student) {
                            $role->updateStudentTeacher($model, $module, $student->id);
                        }
                        echo "Викладача для модуля призначено. Студентам, які входять в групу, назначено данного викладача по данному модулю";
                    } else {
                        echo "Викладача для модуля призначити не вдалося";
                    }
                } else {
                    echo $groupModule->getErrorMessage();
                }
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

    }

    public function actionCancelTeacherForGroupModule()
    {
        $modelId = Yii::app()->request->getPost('id');
        $model = OfflineGroupsTeacherConsultantModule::model()->findByPk($modelId);

        if ($model->checkBeforeCancelTeacherForModule()) {
            if ($model->cancelTeacherForGroupModule()) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            echo "У тебе немає достатньо прав для виконання операції";
        }
    }


    public function actionLecturesRating()
    {
        $this->renderPartial('/_supervisor/tables/lecturesRating', array(), false, true);
    }

    public function actionGetLecturesRatingList()
    {
        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN lectures as l ON l.id = t.id_lecture';
        $criteria->join .= ' LEFT JOIN module as m ON m.module_ID = l.idModule';
        $criteria->condition = 'm.id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id;
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('LecturesRating', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);

    }

    public function actionModulesRating()
    {
        $this->renderPartial('/_supervisor/tables/modulesRating', array(), false, true);
    }

    public function actionGetModulesRatingList()
    {

        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN module m ON m.module_ID = t.id_module';
        $criteria->condition = 'm.id_organization=' . Yii::app()->user->model->getCurrentOrganization()->id;
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('ModuleRating', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();

        echo json_encode($result);
    }

    public function actionUpdateSubgroupLink()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        try {
            $params = array_filter($_POST);
            if (isset($params['id'])) {
                $subgroupLink = OfflineSubgroupsLinks::model()->findByPk($params['id']);
                $subgroupLink->attributes = $params;
                $subgroupLink->updated_by = Yii::app()->user->getId();
                $subgroupLink->updated_at = new CDbExpression('NOW()');
                $subgroupLink->update();
            } else {
                $subgroupLink = new OfflineSubgroupsLinks();
                $subgroupLink->attributes = $params;
                $subgroupLink->updated_by = Yii::app()->user->getId();
                $subgroupLink->save();
            }

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionRemoveSubgroupLink()
    {
        $result = ['message' => 'OK'];
        $statusCode = 201;

        try {
            $params = array_filter($_POST);
            $subgroupLink = OfflineSubgroupsLinks::model()->findByPk($params['id']);
            $subgroupLink->delete();

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }
}
