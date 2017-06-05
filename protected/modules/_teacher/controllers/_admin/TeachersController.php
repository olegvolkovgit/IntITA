<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:05
 */

class TeachersController extends TeacherCabinetController{

    public function hasRole(){
        $allowedCMActions = ['getTeacherDataList'];
        $denyActions=['updateTeacherProfileForm','teachersLinks','getTeacherProfile','updateProfile'];
        $action = Yii::app()->controller->action->id;
        return (Yii::app()->user->model->isAdmin() || 
        (Yii::app()->user->model->isContentManager() && in_array($action, $allowedCMActions)) && !in_array($action, $denyActions)) ||
        (Yii::app()->user->model->isTeacher() && in_array($action, $denyActions));
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacher-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionIndex()
    {
        $model = new Teacher('search');
        $model->unsetAttributes();

        if (isset($_GET['Teacher']))
            $model->attributes = $_GET['Teacher'];

        $this->renderPartial('index', array(
            'model' => $model,
        ),false,true);
    }

    public function actionCreateForm()
    {
        $this->renderPartial('create', array(),false,true);
    }

    public function actionUpdateTeacherProfileForm()
    {
        $this->renderPartial('teacherProfile', array(),false,true);
    }

    public function actionTeachersLinks()
    {
        $this->renderPartial('teachersLinks', array(),false,true);
    }

    public function actionCreate()
    {
        $id=Yii::app()->request->getParam('userId');
        $user = StudentReg::model()->findByPk($id);
        $organizationId = Yii::app()->session['organization'];
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $this->initTeacher($id);
            $criteria = new CDbCriteria();
            $criteria->condition = "id_user=".$id." and id_organization=".$organizationId." and end_date IS NOT NULL";
            $teacher=TeacherOrganization::model()->find($criteria);
            if($teacher){
                $teacher->start_date=new CDbExpression('NOW()');
                $teacher->end_date=null;
                $teacher->assigned_by=Yii::app()->user->getId();
            }else{
                $teacher = new TeacherOrganization();
                $teacher->id_user=$id;
                $teacher->id_organization=Yii::app()->session['organization'];
                $teacher->assigned_by=Yii::app()->user->getId();
            }
            $teacher->save();
            $this->activeTeacher($id);
            $transaction->commit();
            Teacher::model()->notifyAssignCoworker($user,$organizationId);
            echo $teacher->id_user;
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Виникла помилка. ".$teacher->getValidationErrors());
        }
    }

    public function initTeacher($id)
    {
        $exists = Teacher::model()->exists('user_id = :id',array(':id'=> $id));
        if(!$exists){
            $model= new Teacher();
            $model->user_id=$id;
            if($model->save()) return true;
            else throw new \application\components\Exceptions\IntItaException(500, $model->getValidationErrors());
        }
        return true;
    }

    public function activeTeacher($id)
    {
        $model= Teacher::model()->findByPk($id);
        if($model->isDeleted() && TeacherOrganization::model()->resetScope()->exists('id_user='.$id.' and end_date IS NULL')){
            $model->setActive();
        }
    }

    public function inactiveTeacher($id)
    {
        $exists = TeacherOrganization::model()->resetScope()->exists('id_user='.$id.' and end_date IS NULL');
        if(!$exists){
            $model= Teacher::model()->findByPk($id);
            $model->setInactive();
        }
    }

    public function actionCancelTeacher($userId)
    {
        $organizationId = Yii::app()->session['organization'];
        $user = StudentReg::model()->findByPk($userId);
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $teacher = TeacherOrganization::model()->findByPk(array('id_user'=>$userId,'id_organization'=>$organizationId));
            $teacher->end_date=new CDbExpression('NOW()');
            $teacher->cancelled_by=Yii::app()->user->getId();
            $teacher->cancelTeacherRoles();
            $teacher->save();
            $this->inactiveTeacher($userId);
            $transaction->commit();
            Teacher::model()->notifyCancelCoworker($user,$organizationId);
            echo 'success';
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Виникла помилка. ".$teacher->getValidationErrors());
        }
    }

    public function actionGetTeacherProfile()
    {
        $result=array();
        $result['data']=Teacher::model()->findByPk(Yii::app()->user->getId());
        echo CJSON::encode($result);
    }
    
    public function actionUpdateProfile()
    {
        function valueNull($value) {
            return !$value?null:$value;
        }

        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_map("valueNull", $_POST);
            $teacher = Teacher::model()->findByPk($params['user_id']);
            $teacher->setAttributes($params);
            $teacher->save();

            if (count($teacher->getErrors())) {
                throw new Exception(json_encode($teacher->getErrors()));
            }

        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }
    
    public function loadModel($id)
    {
        $model = TeacherOrganization::model()->findByAttributes(array('id_user' => $id));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionDelete($id)
    {
        $model = TeacherOrganization::model()->findByPk(array('id_user'=>$id,'id_organization'=>Yii::app()->session['organization']));
        $model->setHideMode();
        if($model->isHide()) echo 'success';
        else echo "error";
    }

    public function actionRestore($id)
    {
        $model = TeacherOrganization::model()->findByPk(array('id_user'=>$id,'id_organization'=>Yii::app()->session['organization']));
        $model->setShowMode();
        if($model->isShow()) echo 'success';
        else echo "error";
    }

    public function actionUnsetTeacherRole()
    {
        $id = Yii::app()->request->getPost('teacher');
        $role = Yii::app()->request->getPost('role');

        $user = RegisteredUser::userById($id);
        if ($id && $role) {
            echo $user->cancelRoleMessage(new UserRoles($role));
        } else {
            throw new \application\components\Exceptions\IntItaException(400, "Неправильний запит.");
        }
    }

    public function actionSetTeacherRole()
    {
        $id = Yii::app()->request->getPost('teacher', 0);
        $role = Yii::app()->request->getPost('role', '');

        $user = RegisteredUser::userById($id);
        if(!$user->registrationData->isActive()){
            echo "Акаунт користувача заблокований. Заблокованому користувачу не можна призначити роль.";
            die;
        }
        if ($id && $role) {
            if($role != UserRoles::STUDENT){
                if(!$user->isTeacher()){
                    echo "Користувач не є співробітником, призначити йому вибрану роль неможливо.";
                    die;
                }
            }
            if ($user->setRole(new UserRoles($role))) {
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати.";
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400, "Неправильний запит.");
        }
    }

    public function actionChangeTeacherStatus(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = RegisteredUser::userById($user);
        $teacher = $model->getTeacher();
        if($teacher){
            if($teacher->changeVisibleStatus()){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }

    public function actionUsersByQuery($query)
    {
        if ($query) {
            $users = StudentReg::usersByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionUsersWithoutTrainers($query)
    {
        if ($query) {
            $users = StudentReg::usersWithoutAssignedTrainers($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
    
    public function actionShowAttributes()
    {
        $user = Yii::app()->request->getPost('user');
        $role = Yii::app()->request->getPost('role');

        $user = StudentReg::model()->findByPk($user);
        $attributes = Role::getInstance(new UserRoles($role))->attributes($user);

        $this->renderPartial('_showAttributes', array(
            'attributes' => $attributes
        ), false, true);
    }

    public function actionGetTeacherDataList($id, $currentRole)
    {
        $result = array();
        $user=RegisteredUser::userById($id);
        $userAttr = $user->registrationData->getAttributes();

        $result['user']=$userAttr;
        $result['user']['role']=$currentRole;
        foreach($user->getRoles() as $key=>$role){
            $result['user']['roles'][$role->__toString()]= $user->getAttributesByRole($role);
        }

        echo CJSON::encode($result);
    }

    public function actionLoadJsonTeacherModel($id)
    {
        $result = array();
        $model=RegisteredUser::userById($id);

        $user = $model->registrationData->getAttributes();
        $teacher = Teacher::model()->findByPk($id);
        
        if($user===null)
            throw new CHttpException(404,'The requested page does not exist.');

        $result['user']=$user;
        $result['user']['roles']=$model->getRoles();
        $result['user']['noroles']=array_diff(AllRolesDataSource::roles(), $model->getRoles());

        foreach($model->getRoles() as $key=>$role){
            $result['user']['roles'][$key]= $role->__toString();
        }
        $result['teacher']=(array)$teacher->getAttributes();
        $result['teacher']['modules']=$teacher->modulesActive;

        echo CJSON::encode($result);
    }

    public function actionGetTeacherData()
    {
        $id = Yii::app()->request->getPost('id');
        echo CJSON::encode($this->loadModel($id));
    }
}