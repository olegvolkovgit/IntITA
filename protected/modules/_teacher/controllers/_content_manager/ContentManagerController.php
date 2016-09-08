<?php

class ContentManagerController extends TeacherCabinetController
{

    public function hasRole()
    {
        return Yii::app()->user->model->isContentManager();
    }

    public function actionAuthors()
    {
        $this->renderPartial('/_content_manager/authors');
    }

    public function actionConsultants()
    {
        $this->renderPartial('/_content_manager/consultants');
    }

    public function actionTeacherConsultants()
    {
        $this->renderPartial('/_content_manager/teacherConsultants', array(), false, true);
    }
    public function actionStatusOfModules($id)
    {
        $this->renderPartial('/_content_manager/statusOfModules', array('id' => $id), false, true);
    }

    public function actionStatusOfCourses()
    {
        $this->renderPartial('/_content_manager/statusOfCourses', array(), false, true);
    }

    public function actionAddConsultantModuleForm()
    {
        $this->renderPartial('/_content_manager/addForms/_addConsultantModule', array(), false, true);
    }

    public function actionAddTeacherConsultantForm()
    {
        $this->renderPartial('/_content_manager/addForms/_addTeacherConsultantModule', array(), false, true);
    }

    public function actionAddTeacherModuleForm()
    {
        $this->renderPartial('/_content_manager/addForms/_addTeacherAccess', array(), false, true);
    }

    public function actionSetTeacherRoleAttribute()
    {
        $request = Yii::app()->request;
        $userId = $request->getPost('user', 0);
        $role = $request->getPost('role', '');
        $attribute = $request->getPost('attribute', '');
        $value = $request->getPost('attributeValue', 0);
        $user = RegisteredUser::userById($userId);

        if ($userId && $attribute && $value && $role) {
            if ($user->setRoleAttribute(new UserRoles($role), $attribute, $value)) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('user', '0');
        $module = Yii::app()->request->getPost('module', '0');

        $user = RegisteredUser::userById($teacher);
        if ($user->unsetRoleAttribute(UserRoles::AUTHOR, 'module', $module)) {
            $permission = new PayModules();
            $permission->unsetModulePermission($teacher, $module, array('read', 'edit'));
            echo "success";
        } else {
            echo "error";
        }
    }

    public function actionGetTeacherConsultantsList()
    {
        echo UserTeacherConsultant::teacherConsultantsListCM();
    }
    public function actionGetModulesList()
    {


//        $allModules = Yii::app()->db->createCommand()
//            ->select(' `module_ID` as mid, module.`title_ua` as mit, (SELECT COUNT(*) FROM lectures WHERE module.module_ID = lectures.idModule) AS countOfLectures, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type = 2) AS videos, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type IN (5,6,9,12,13)) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture) AS parts, (SELECT COUNT(*) FROM vc_lecture WHERE module.module_ID = vc_lecture.id_module) as revisions FROM `module` ORDER BY mit')
//            ->queryAll();

        $allModules = Yii::app()->db->createCommand()
            ->select(' `module_ID` as mid, module.`title_ua` as mit, (SELECT COUNT(*) FROM lectures WHERE module.module_ID = lectures.idModule) AS countOfLectures, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type = 2) AS videos, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type IN (5,6,9,12,13)) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture) AS parts, (SELECT COUNT(*) FROM vc_lecture WHERE module.module_ID = vc_lecture.id_module) as revisions FROM `module` ORDER BY mit')
            ->queryAll();
        $videos = array_filter($allModules, function($value){
                if ($value['videos']==0)
            return $value;
        });
        $tests = array_filter($allModules, function($value){
            if ($value['tests']==0)
                return $value;
        });
        $videodAndTests = array_filter($allModules, function($value){
            if ($value['tests']==0 && $value['videos']==0)
                return $value;
        });

        echo json_encode(array_merge(['allModules'=>['count'=>count($allModules),'rows'=>$allModules]],
                        ['withoutTests'=>['count'=>count($tests),'rows'=>array_values($tests)]],
                        ['withoutVideos'=>['count'=>count($videos),'rows'=>array_values($videos)]],
                        ['withoutVideosAndTests'=>['count'=>count($videodAndTests),'rows'=>array_values($videodAndTests)]]));
        //echo UserContentManager::listOfModules($id,$filter_id);
    }
        private  function prepareData(){
        $rows =  Yii::app()->db->createCommand()
            ->select(' `module_ID` as mid, module.`title_ua` as mit, (SELECT COUNT(*) FROM lectures WHERE module.module_ID = lectures.idModule) AS countOfLectures, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type = 2) AS videos, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type IN (5,6,9,12,13)) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture) AS parts, (SELECT COUNT(*) FROM vc_lecture WHERE module.module_ID = vc_lecture.id_module) as revisions FROM `module` ')
            ->queryAll();
        return $rows;
    }

    public function actionGetCoursesList($filter_id)
    {

      echo UserContentManager::listOfCourses($filter_id);
    }

    public function actionGetAuthorsList()

    {
        $params = $_GET;
        $page = $_GET['page'];
        $count = $_GET['count'];
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_time IS NULL');
        $countOfRows = count(UserAuthor::model()->with('user')->findAll($criteria));
        $criteria->offset = $page*$count -$count;
        $criteria->limit = $count;

        $test = JsonForNgDatatablesHelper::returnJson(UserAuthor::model()->with('user')->findAll($criteria),null,$countOfRows,['user']);
        echo $test;
        //echo TeacherModule::authorsList();
    }

    public function actionGetConsultantsList()
    {
        echo UserConsultant::consultantsList();
    }

    public function actionCancelRole()
    {
        $user = Yii::app()->request->getPost('userId', '0');
        $role = Yii::app()->request->getPost('role', '');
        if($user && $role){
            $model = RegisteredUser::userById($user);
            echo $model->cancelRoleMessage(new UserRoles($role));
        } else {
            echo "Неправильний запит. Зверніться до адміністратора ".Config::getAdminEmail();
        }
    }

    public function actionDashboard()
    {
        $this->renderPartial('/_content_manager/_dashboard', array(), false, true);
    }

    public function actionShowTeacher($id)
    {
        $user = RegisteredUser::userById($id);
        if ($user) {
            $this->renderPartial('/_content_manager/_showTeacher', array(
                'user' => $user
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionRenderAddForm($role)
    {
        if ($role == "") {
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильна роль.');
        }
        $view = "/_content_manager/addForms/_add" . ucfirst($role);
        $this->renderPartial($view, array(), false, true);
    }

    public function actionUsersAddForm($role, $query)
    {
        $roleModel = Role::getInstance(new UserRoles($role));
        if ($query && $roleModel) {
            echo $roleModel->addRoleFormList($query);
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionSendCoworkerRequest()
    {
        $this->renderPartial('/_content_manager/_sendResponseAssignCoworker', array(), false, true);
    }

    public function actionUsersWithoutCoworkersByQuery($query)
    {
        echo Teacher::usersWithoutCoworkersByQuery($query);
    }

    public function actionSendRequest()
    {
        $userToAssign = Yii::app()->request->getPost('user', 0);
        $user = Yii::app()->request->getPost('sender', 0);

        $teacherModel = StudentReg::model()->findByPk($userToAssign);
        $userModel = StudentReg::model()->findByPk($user);

        if ($teacherModel && $userModel) {
            $message = new MessagesCoworkerRequest();
            if ($message->isRequestOpen(array($teacherModel->id))) {
                echo "Такий запит вже надіслано. Ви не можете надіслати запит на призначення співробітника двічі.";
            } else {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $message->build($userModel, $teacherModel);
                    $message->create();
                    $sender = new MailTransport();

                    if ($message->send($sender)) {
                        $transaction->commit();
                        echo "Запит на призначення співробітника успішно відправлено. Зачекайте, поки адміністратор сайта підтвердить запит.";
                    } else {
                        echo "Запит на призначення співробітника не вдалося надіслати.";
                    }
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw new \application\components\Exceptions\IntItaException(500, "Запит на призначення співробітника не вдалося надіслати.");
                }
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionAssignRole(){
        $userId = Yii::app()->request->getPost('userId');
        $role = Yii::app()->request->getPost('role');
        $user = RegisteredUser::userById($userId);

        if ($user->hasRole($role)) {
            echo "Користувач ".$user->registrationData->userNameWithEmail()." уже має цю роль";
            return;
        }
        if ($user->setRole($role))
            echo "Користувачу ".$user->registrationData->userNameWithEmail()." призначена обрана роль ".$role;
        else echo "Користувачу ".$user->registrationData->userNameWithEmail()." не вдалося призначити роль ".$role.".
        Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
    }

    public function actionGetLessonsList($idModule) {
        echo UserContentManager::listOfLessons($idModule);
    }

    public function actionGetPartsList($idLesson) {
        echo UserContentManager::listOfParts($idLesson);
    }

    public function actionShowLessonsList($idModule) {
        $this->renderPartial('/_content_manager/_listOfLessons', array('idModule' => $idModule), false, true);

    }

    public function actionShowPartsList($idLesson) {
        $this->renderPartial('/_content_manager/_listOfParts', array('idLesson' => $idLesson), false, true);

    }

}