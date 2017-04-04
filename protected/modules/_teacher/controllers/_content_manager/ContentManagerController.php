<?php

class ContentManagerController extends TeacherCabinetController
{

    public function hasRole()
    {
        $allowedAdminActions=['getAuthorsList'];
        return Yii::app()->user->model->isContentManager() || (Yii::app()->user->model->isAdmin() && in_array(Yii::app()->controller->action->id,$allowedAdminActions));
    }

    public function actionAuthors()
    {
        $this->renderPartial('/_content_manager/authors');
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

    public function actionSetTeacherRoleAttribute($userId,$role,$attribute,$attributeValue)
    {
        $user = RegisteredUser::userById($userId);
        $result=array();
        if ($userId && $attribute && $attributeValue && $role) {
            $response=$user->setRoleAttribute(new UserRoles($role), $attribute, $attributeValue);
            if($response===true){
                $result['data']="success";
            } else {
                $result['data']=$response;
            }
        } else {
            $result['data']='Введені не вірні дані';
        }
        echo json_encode($result);
    }
    public function actionUnsetTeacherRoleAttribute($userId,$role,$attribute,$attributeValue)
    {
        $user = RegisteredUser::userById($userId);
        $result=array();
        if ($userId && $attribute && $attributeValue && $role) {
            $response=$user->unsetRoleAttribute(new UserRoles($role), $attribute, $attributeValue);
            if($response===true){
                $result['data']="success";
            } else {
                $result['data']=$response;
            }
        } else {
            $result['data']='Введені не вірні дані';
        }
        echo json_encode($result);
    }

    public function actionGetTeacherConsultantsList()
    {
        echo UserTeacherConsultant::teacherConsultantsListCM();
    }
    public function actionGetModulesList()
    {
        $adapter = new NgTableStatisticAdapter($_GET,'module');
        $test = $adapter->returnData();
        echo json_encode($test);
    }
    
    public function actionGetCoursesList()
    {
        $adapter = new NgTableStatisticAdapter($_GET,'course');
        $test = $adapter->returnData();
        echo json_encode($test);
    }

    public function actionGetAuthorsList()
    {
        $params = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $adapter = new NgTableAdapter('UserAuthor',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
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

    public function actionRenderAddForm($role)
    {
        if ($role == "") {
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильна роль.');
        }
        $view = "/_content_manager/addForms/_add" . ucfirst($role);
        $this->renderPartial($view, array(), false, true);
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
        $user = Yii::app()->user->getId();

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

    public function actionUserAttributesList($id,$role)
    {
        $user = RegisteredUser::userById($id);
        $role = new UserRoles($role);
        $attributes = $user->getAttributesByRole($role);

        $this->renderPartial('/_content_manager/_moduleList', array(
            'model' => $user->registrationData,
            'role' => $role,
            'attributes' => $attributes
        ),false,true);
    }
}