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
    public function actionGetModulesList($id,$filter_id)
    {
        //PREPARE TO NGTABLES

//        $criteria = new CDbCriteria();
//        $criteria->with = array('lectures','lectures.lectureEl','revisions');
//        $criteria->addCondition('lectures.id IS NULL');
//        $criteria->addNotInCondition('lectureEl.id_type',array('2'),'OR');
//        $rows= Module::model()->findAll($criteria);
//        $command = null;
//        if ($filter_id==0) {
//            $command = Yii::app()->db->createCommand()
//                ->select('module_ID, module.title_ru AS title , lectures.id AS lecture')
//                ->from('module')
//                ->leftJoin('lectures', 'lectures.idModule=module.module_ID')
//                ->leftJoin('lecture_element', 'lectures.id=lecture_element.id_lecture')
//                ->group('module_ID')
//                ->queryAll();
//        }
//        if ($filter_id==1) {
//            $command = Yii::app()->db->createCommand()
//                ->select('module_ID, module.title_ru AS title , lectures.id AS lecture')
//                ->from('module')
//                ->leftJoin('lectures', 'lectures.idModule=module.module_ID')
//                ->leftJoin('lecture_element', 'lectures.id=lecture_element.id_lecture')
//                ->where('lectures.id IS NULL OR lecture_element.id_type NOT IN (2)')
//                ->group('module_ID')
//                ->queryAll();
//        }
//        if ($filter_id==2) {
//            $command = Yii::app()->db->createCommand()
//                ->select('module_ID, module.title_ru AS title , lectures.id AS lecture')
//                ->from('module')
//                ->leftJoin('lectures', 'lectures.idModule=module.module_ID')
//                ->leftJoin('lecture_element', 'lectures.id=lecture_element.id_lecture')
//                ->where('lectures.id IS NULL OR lecture_element.id_type NOT IN (5,6,9,12,13)')
//                ->group('module_ID')
//                ->queryAll();
//        }
//        if ($filter_id==3) {
//            $command = Yii::app()->db->createCommand()
//                ->select('module_ID, module.title_ru AS title , lectures.id AS lecture')
//                ->from('module')
//                ->leftJoin('lectures', 'lectures.idModule=module.module_ID')
//                ->leftJoin('lecture_element', 'lectures.id=lecture_element.id_lecture')
//                ->where('lectures.id IS NULL OR lecture_element.id_type NOT IN (2,5,6,9,12,13)')
//                ->group('module_ID')
//                ->queryAll();
//        }

        echo UserContentManager::listOfModules($id,$filter_id);
    }

    public function actionGetCoursesList($filter_id)
    {

      echo UserContentManager::listOfCourses($filter_id);
    }

    public function actionGetAuthorsList()

    {
        $ngTable = new NgTableAdapter('UserAuthor',['page'=>'1','count'=>'10','filter[authorActive.firstName]'=>'ta']);
        $test = $ngTable->getData();
        $criteria = new CDbCriteria();
        $test['count'] =  count(UserAuthor::model()->with('authorActive')->findAll($criteria));
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