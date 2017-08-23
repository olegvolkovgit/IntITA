<?php

class UserController extends TeacherCabinetController {

    public function hasRole(){
        $allowedUserDataActions=['loadJsonUserProfile','loadJsonUserOfflineEducation','loadUserName',
            'loadJsonTeacherProfile','loadJsonUserRoles','loadJsonStudentAttributes','getRolesHistory','index','loadUserOrganizationTrainer'];
        return Yii::app()->user->model->isAdmin() ||
        Yii::app()->user->model->isTrainer() ||
        Yii::app()->user->model->isDirector() ||
        Yii::app()->user->model->isSuperAdmin() ||
        Yii::app()->user->model->isAuditor() ||
        (in_array(Yii::app()->controller->action->id,$allowedUserDataActions) &&
            (Yii::app()->user->model->isContentManager() || Yii::app()->user->model->isSuperVisor() || Yii::app()->user->model->isAccountant()
            || Yii::app()->user->model->isTeacher()));
    }

    public function actionIndex($id)
    {
        $model = RegisteredUser::userById($id);
        $this->renderPartial('index', array(
            'model' => $model,
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

    public function actionLoadJsonUserProfile($userId)
    {
        $model = StudentReg::model()->with(array('student','student.organization'=>array('alias'=>'trainerOrganization'),
                'student.studentTrainer','student.studentTrainer.trainerModel',
                'startCareers','startCareers.career','preferSpecializations', 'preferSpecializations.specialization'
            )
        )->findByPk($userId);
        echo CJSON::encode(ActiveRecordToJSON::toAssocArrayWithRelations($model));
    }
    public function actionLoadJsonUserOfflineEducation($userId)
    {
        $model = StudentReg::model()->with(array('offlineStudents', 'offlineStudents.subgroupName', 'offlineStudents.subgroupName.groupName',
                'offlineStudents.subgroupName.groupName.specializationName', 'offlineStudents.subgroupName.organization')
        )->findByPk($userId);
        echo CJSON::encode(ActiveRecordToJSON::toAssocArrayWithRelations($model));
    }
    public function actionLoadJsonTeacherProfile($userId)
    {
        $model = StudentReg::model()->with(array('teacher','teacher.modulesActive'))->findByPk($userId);
        echo CJSON::encode(ActiveRecordToJSON::toAssocArrayWithRelations($model));
    }
    public function actionLoadJsonUserRoles($userId)
    {
        $model=RegisteredUser::userById($userId);
        $result=[];
        foreach ($model->getRoles() as $key=>$role){
            $result['actual_roles'][$key]['role']=$role->__toString();
            $result['actual_roles'][$key]['name']=Role::getInstance($role)->title();
        }
        $editableRoles=$model->isTeacherOrganization()?AllRolesDataSource::teacherRoles():array();
        array_push($editableRoles,'student');
        $noroles=array_diff($editableRoles, $model->getRoles());
        foreach ($noroles as $key=>$role){
            $result['no_roles'][$key]['role']=$role;
            $result['no_roles'][$key]['name']=Role::getInstance($role)->title();
        }
        echo json_encode($result);
    }
    public function actionLoadJsonStudentAttributes($userId)
    {
        $model=RegisteredUser::userById($userId);
        $result=array('courses'=>array(),'modules'=>array());
        if($model->isStudent()) {
            $result['courses'] = $model->getAttributesByRole(UserRoles::STUDENT)[1]["value"];
            $result['modules'] = $model->getAttributesByRole(UserRoles::STUDENT)[0]["value"];

            foreach ($result['courses'] as $key => $course) {
                $result['courses'][$key]['modules'] = CourseModules::modulesInfoByCourse($course["id"], $userId);
                foreach ($result['courses'][$key]['modules'] as $index => $module) {
                    $result['courses'][$key]['modules'][$index] += ['link' => Yii::app()->createUrl("module/index", array("idModule" => $module["id"], "idCourse" => $course["id"]))];
                }
            }
            foreach ($result['modules'] as $key => $module) {
                $result['modules'][$key] += ['link' => Yii::app()->createUrl("module/index", array("idModule" => $module["id"]))];
            }
        }

        echo json_encode($result);
    }
    public function actionLoadUserOrganizationTrainer($userId)
    {
        $model=UserStudent::model()->with('idUser','studentTrainer','studentTrainer.trainerModel','studentTrainer.studentModel')->findByAttributes(array(
            'id_user'=>$userId,'id_organization'=>Yii::app()->user->model->getCurrentOrganizationId(),'end_date'=>null
        ));
        echo CJSON::encode(ActiveRecordToJSON::toAssocArrayWithRelations($model));
    }

    public function actionLoadUserName()
    {
        $model=StudentReg::model()->findByPk(Yii::app()->request->getParam('userId'));
        $name=trim($model->secondName . " " . $model->firstName . " " . $model->email);
        echo $name;
    }
    
    public function actionGetRolesHistory($userId){
        $organization=Yii::app()->user->model->getCurrentOrganizationId();
        if($organization){
            $historyAdmin =  UserAdmin::model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historyAccountant = UserAccountant::model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historyStudent = UserStudent::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id', array(':id'=>$userId));
            $historyTenant = UserTenant::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('(select id from chat_user where intita_user_id=:id) and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historyTrainer = UserTrainer::model()->model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historyContentManager = UserContentManager::model()->with('assigned_by_user','cancelled_by_user')->model()->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historyTeacherConsultant = UserTeacherConsultant::model()->with('assigned_by_user','cancelled_by_user')->model()->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historyAuthor = UserAuthor::model()->with('assigned_by_user','cancelled_by_user')->model()->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $historySuperVisor = UserSuperVisor::model()->with('assigned_by_user','cancelled_by_user')->findAll('id_user=:id and id_organization=:id_org', array(':id'=>$userId,':id_org'=>$organization));
            $array = array_merge($historyAdmin,$historyAccountant,$historyStudent,$historyTenant,$historyTrainer,$historyContentManager,$historyTeacherConsultant,$historyAuthor,$historySuperVisor);
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
                $message = new MessagesNotifications();
                $text = $this->renderPartial('//mail/templates/_createMail',array('mail'=>$mailBox->username),true);
                $message->build('Надано корпоративну електронну адресу',$text,StudentReg::model()->findByPk(Yii::app()->user->id),StudentReg::model()->findByPk($_POST['userId']));
                $msg = $message->create();
                Yii::app()->db->createCommand()->insert('message_receiver', array(
                    'id_message' => $msg->id_message,
                    'id_receiver' => $_POST['userId'],
                ));
                echo json_encode(array('mailbox' => $mailBox->username));
            }
            else

                echo json_encode(array('error'=>$mailBox->getErrors()));
        }
        else
            return http_response_code(400);
    }
}