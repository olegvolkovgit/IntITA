<?php

class UserController extends TeacherCabinetController {

    public function hasRole(){
        $allowedAccountantActions=['loadJsonUserModel','getRolesHistory','index'];
        $allowedContentManagerActions=['loadJsonUserModel','getRolesHistory','index'];
        $allowedSupervisorActions=['loadJsonUserModel','getRolesHistory','setStudentEducForm', 'setStudentShift'];
        return Yii::app()->user->model->isAdmin() ||
        Yii::app()->user->model->isTrainer() ||
        (Yii::app()->user->model->isContentManager() && in_array(Yii::app()->controller->action->id,$allowedContentManagerActions)) ||
        (Yii::app()->user->model->isSuperVisor() && in_array(Yii::app()->controller->action->id,$allowedSupervisorActions)) ||
        (Yii::app()->user->model->isAccountant() && in_array(Yii::app()->controller->action->id,$allowedAccountantActions));
    }

    public function actionIndex($id)
    {
        $model = RegisteredUser::userById($id);
        $trainer = TrainerStudent::getTrainerByStudent($id);

        $this->renderPartial('index', array(
            'model' => $model,
            'trainer' => $trainer
        ), false, true);
    }

    public function actionAddRole($id){
        $model = RegisteredUser::userById($id);
        $roles = array_diff(AllRolesDataSource::roles(), $model->getRoles());

        $this->renderPartial('addUserRole', array(
            'model' => $model,
            'roles' => $roles
        ), false, true);
    }

    public function actionChangeAccountStatus(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        if($model){
            if($model->changeAccountStatus()){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }

    public function actionChangeUserStatus(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        if($model){
            if($model->changeUserStatus()){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }

    public function actionSetStudentEducForm(){
        $user = Yii::app()->request->getPost('user');
        $form = Yii::app()->request->getPost('form');
        $model = StudentReg::model()->findByPk($user);

        if($model){
            if($model->setUserForm($form)){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }

    public function actionSetStudentShift(){
        $user = Yii::app()->request->getPost('user');
        $shift = Yii::app()->request->getPost('shift');
        $model = StudentReg::model()->findByPk($user);

        if($model){
            if($model->setUserShift($shift)){
                echo "Операцію успішно виконано.";
            } else {
                echo "Операцію не вдалося виконати. Зверніться до адміністратора ".Config::getAdminEmail();
            }
        } else {
            echo "Неправильний запит. Такого користувача не існує.";
        }
    }
    
    public function actionCancelRole($userId, $role)
    {
        $result=array();

        $model = RegisteredUser::userById($userId);
        $response=$model->cancelRoleMessage(new UserRoles($role));
        if($response===true){
            $result['data']="success";
        } else {
            $result['data']=$response;
        }

        echo json_encode($result);
    }

    public function actionAgreement($user, $param, $type){
        switch($type){
            case "module":
                $model = UserAgreements::moduleAgreement($user, $param, 1, EducationForm::ONLINE);
                break;
            case "course":
                $model = UserAgreements::courseAgreement($user, $param, 1, EducationForm::ONLINE);
                break;
            default:
                throw new \application\components\Exceptions\IntItaException(400);
        }
        if($model){
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $model,
            ));
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }
    
    public function actionLoadJsonUserModel($id)
    {
        echo  CJSON::encode(StudentReg::userData($id));
    }

    public function actionGetRolesHistory($id){

        $historyAdmin =  UserAdmin::model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$id));
        $historyAccountant = UserAccountant::model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$id));
        $historyStudent = UserStudent::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$id));
        $historyTenant = UserTenant::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('chat_user_id=:id', array(':id'=>$id));
        $historyTrainer = UserTrainer::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$id));
        $historyConsultant = UserConsultant::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$id));
        $historyContentManager = UserContentManager::model()->with('assigned_by_user','cancelled_by_user')->model()->findAll('id_user=:id', array(':id'=>$id));
        $historyTeacherConsultant = UserTeacherConsultant::model()->with('assigned_by_user','cancelled_by_user')->model()->findAll('id_user=:id', array(':id'=>$id));
        $historyAuthor = UserAuthor::model()->with('assigned_by_user','cancelled_by_user')->model()->findAll('id_user=:id', array(':id'=>$id));
        $historySuperVisor = UserSuperVisor::model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$id));
        $array = array_merge($historyAuthor,$historyAdmin,$historyAccountant,$historyTenant,$historyStudent,$historyTrainer,$historyConsultant,$historyContentManager,$historyTeacherConsultant,$historySuperVisor);
        $history = [];
        foreach ($array as $value)
        {
            $role = $value->getAttributes();
            $role['role'] = $value->getRoleName();
            
            $relation = $value->getRelated('assigned_by_user');
            if (isset($relation)){
                $role['assigned_by_user'] = $value->getRelated('assigned_by_user')->getAttributes(['firstName','middleName','secondName']);
            }
            $relation = $value->getRelated('cancelled_by_user');
            if (isset($relation)){
                $role['cancelled_by_user'] = $value->getRelated('cancelled_by_user')->getAttributes(['firstName','middleName','secondName']);
            }
            array_push($history,$role);
        }
        usort($history,function($a,$b){
            if (strtotime ($a['start_date']) == strtotime ($b['start_date'])) {
                return 0;
            }
            return (strtotime ($a['start_date']) > strtotime ($b['start_date'])) ? -1 : 1;
        });
        echo CJSON::encode($history);

    }

    public function actionAddCorpMail(){
        if (isset($_POST['userId']) && isset($_POST['address'])){
            $model = Teacher::model()->findByPk($_POST['userId']);
            $mailBox = new Mailbox();
            $mailBox->username = $_POST['address'].'@'.Config::getBaseUrlWithoutSchema();
            $mailBox->name = $_POST['address'];
            $mailBox->maildir = Config::getBaseUrlWithoutSchema().'/'.$_POST['address'];
            $mailBox->domain = Config::getBaseUrlWithoutSchema();
            $mailBox->active = 0;
            if ($mailBox->validate()){
                $mailBox->save();
                $model->corporate_mail = $mailBox->username;
                $model->save();
                $message = new UserMessages();
                $text = $this->renderPartial('//mail/templates/_createMail',array('mail'=>$mailBox->username),true);
                $message->build('Надано корпоративну електронну адресу',$text,StudentReg::model()->findByPk(Yii::app()->user->id),StudentReg::model()->findByPk($_POST['userId']));
                $msg = $message->create();
                Yii::app()->db->createCommand()->insert('message_receiver', array(
                    'id_message' => $msg->id_message,
                    'id_receiver' => $_POST['userId'],
                ));
                echo $mailBox->username;
            }
            else
                echo json_encode($mailBox->getErrors());
        }
        else
            return http_response_code(400);
    }
}