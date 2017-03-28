<?php

class UsersController extends TeacherCabinetController
{
    public function hasRole()
    {
        $allowedDenySetActions = ['addAdmin', 'createAccountant', 'addTrainer', 'setTrainer', 'removeTrainer'];
        $action = Yii::app()->controller->action->id;
        return (Yii::app()->user->model->isDirector() || Yii::app()->user->model->isSuperAdmin() && !in_array($action, $allowedDenySetActions)) ||
        Yii::app()->user->model->isAdmin() ||
        (Yii::app()->user->model->isContentManager()) ||
        (Yii::app()->user->model->isSuperVisor());
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionGetUsersCount()
    {
        $counters = [];
        $result=[];

        $counters["admins"] = UserAdmin::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["accountants"] = UserAccountant::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["coworkers"] = TeacherOrganization::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE."  AND end_date IS NULL");
        $counters["contentAuthors"] = UserAuthor::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["students"] = UserStudent::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["offlineStudents"] = OfflineStudents::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["registeredUsers"] = StudentReg::model()->count('cancelled='.StudentReg::ACTIVE);
        $counters["tenants"] = UserTenant::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["trainers"] = UserTrainer::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["contentManagers"] = UserContentManager::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["teacherConsultants"] = UserTeacherConsultant::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["withoutRole"] = StudentReg::countUsersWithoutRoles();
        $counters["blockedUsers"] = StudentReg::model()->count('cancelled='.StudentReg::DELETED);
        $counters["supervisors"] = UserSuperVisor::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["superAdmins"] = UserSuperAdmin::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["directors"] = UserDirector::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["auditors"] = UserAuditor::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");

        $i=0;
        foreach ($counters as $key=>$counter){
            $result[$i]['role']=$key;
            $result[$i]['count']=$counter;
            $i++;
        }
        echo json_encode($result);
    }
    
    public function actionUsers()
    {
        $this->renderPartial('tables/_usersTable', array(), false, true);
    }

    public function actionStudents()
    {
        $this->renderPartial('tables/_studentsTable', array(), false, true);
    }

    public function actionOfflineStudents()
    {
        $this->renderPartial('tables/_offlineStudentsTable', array(), false, true);
    }

    public function actionCoworkers()
    {
        $this->renderPartial('tables/_teachersTable', array(), false, true);
    }

    public function actionContentAuthors()
    {
        $this->renderPartial('tables/_authorsTable', array(), false, true);
    }

    public function actionUsersWithoutRoles()
    {
        $this->renderPartial('tables/_withoutRolesTable', array(), false, true);
    }

    public function actionAdmins()
    {
        $this->renderPartial('tables/_adminsTable', array(), false, true);
    }

    public function actionAccountants()
    {
        $this->renderPartial('tables/_accountantsTable', array(), false, true);
    }

    public function actionContentManagers()
    {
        $this->renderPartial('tables/_contentManagersTable', array(), false, true);
    }

    public function actionTrainers()
    {
        $this->renderPartial('tables/_trainersTable', array(), false, true);
    }

    public function actionTenants()
    {
        $this->renderPartial('tables/_tenantsTable', array(), false, true);
    }

    public function actionSupervisors()
    {
        $this->renderPartial('tables/_superVisorsTable', array(), false, true);
    }

    public function actionBlockedUsers()
    {
        $this->renderPartial('tables/_blockedUsersTable', array(), false, true);
    }

    public function actionAuditors()
    {
        $this->renderPartial('tables/_auditorsTable', array(), false, true);
    }

    public function actionSuperAdmins()
    {
        $this->renderPartial('tables/_superAdminsTable', array(), false, true);
    }

    public function actionDirectors()
    {
        $this->renderPartial('tables/_directorsTable', array(), false, true);
    }

    public function actionTeacherConsultants()
    {
        $this->renderPartial('tables/_teacherConsultantsTable', array(), false, true);
    }
    
    public function actionUsersEmail()
    {
        $this->renderPartial('usersEmail', array(), false, true);
    }

    public function actionEmailsCategory()
    {
        $this->renderPartial('emailsCategory', array(), false, true);
    }
    public function actionEmailsCategoryCreate()
    {
        $this->renderPartial('emailCategoryForm', array('scenario'=>'new'), false, true);
    }
    public function actionEmailsCategoryUpdate()
    {
        $this->renderPartial('emailCategoryForm', array('scenario'=>'update'), false, true);
    }

    public function actionAddAdmin()
    {
        $userId = Yii::app()->request->getPost('userId');
        $user = RegisteredUser::userById($userId);

        if ($user->setRole(new UserRoles("admin"))) echo "Користувач ".$user->registrationData->userNameWithEmail()." призначений адміністратором.";
        else echo "Користувача ".$user->registrationData->userNameWithEmail()." не вдалося призначити адміністратором.
        Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
    }

    public function actionCreateAccountant()
    {
        $userId = Yii::app()->request->getPost('userId');
        $user = RegisteredUser::userById($userId);

        if ($user->setRole(new UserRoles("accountant"))) echo "Користувач ".$user->registrationData->userNameWithEmail()." призначений бухгалтером.";
        else echo "Користувача ".$user->registrationData->userNameWithEmail()." не вдалося призначити бухгалтером.
        Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
    }
    
    public function actionGetStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);

        $criteria =  new CDbCriteria();

        $criteria->alias = 't';
        $criteria->join = 'inner join user_student us on t.id = us.id_user';
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE.' and us.end_date IS NULL';
        $criteria->group = 't.id';
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $startDate=$_GET['startDate'];
            $endDate=$_GET['endDate'];
            $criteria->condition = "TIMESTAMP(us.start_date) BETWEEN " . "'$startDate'" . " AND " . "'$endDate'";
        }

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetOfflineStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineStudents', $requestParams);

        if(isset($requestParams['idGroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->join .= ' LEFT JOIN offline_groups g ON sg.group = g.id';
            $criteria->condition = 'g.id='.$requestParams['idGroup'].' and t.end_date IS NULL';
            $ngTable->mergeCriteriaWith($criteria);
        }
        if(isset($requestParams['idSubgroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->condition = 'sg.id='.$requestParams['idSubgroup'].' and t.end_date IS NULL';
            $ngTable->mergeCriteriaWith($criteria);
        }
        if(!isset($requestParams['idGroup']) && !isset($requestParams['idSubgroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->condition = 't.end_date IS NULL';
            $ngTable->mergeCriteriaWith($criteria);
        }

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetUsersList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE;
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetWithoutRolesUsersList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams,array(
            'country0'=>true,
            'city0'=>true
        ));
        
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->join = 'left join user_student us on us.id_user=t.id';
        $criteria->join .= ' left join teacher tt on tt.user_id=t.id';
        $criteria->addCondition('t.cancelled='.StudentReg::ACTIVE);
        $criteria->addCondition('us.id_user IS NULL and tt.user_id IS NULL');
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTenantsList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserTenant', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetContentManagersList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserContentManager', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTeacherConsultantsList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserTeacherConsultant', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTeachersList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->join = 'left join user u on u.id=t.id_user';
        $criteria->addCondition('u.cancelled='.StudentReg::ACTIVE.' and t.end_date IS NULL');
        $ngTable = new NgTableAdapter('TeacherOrganization', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetAdminsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAdmin', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetAccountantsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAccountant', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTrainersList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserTrainer', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetBlockedUsersList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('unlocked_by IS NULL and unlocked_date IS NULL');
        $ngTable = new NgTableAdapter('UserBlocked', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        echo json_encode($ngTable->getData());
    }
    
    public function actionGetSuperVisorsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserSuperVisor', $requestParams);

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetDirectorsList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserDirector', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetAuditorsList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserAuditor', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetSuperAdminsList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserSuperAdmin', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
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
    
    public function actionAddTrainer($id)
    {
        $user = StudentReg::model()->findByPk($id);
        if (!$user)
            throw new CHttpException(404, 'Вказана сторінка не знайдена');

        $this->renderPartial('addForms/addTrainer', array(), false, true);
    }
   
    public function actionSetTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');
        $trainer = RegisteredUser::userById($trainerId);
        
        $cancelResult='';
        $oldTrainerId = TrainerStudent::getTrainerByStudent($userId);
        if($oldTrainerId) {
            $oldTrainer = RegisteredUser::userById($oldTrainerId->id);
            $oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
            $cancelResult="Попереднього тренера скасовано.";
        }

        $result=$trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
        if ($result===true){
            $setResult="Нового тренера призначено.";
        } else{
            $setResult=$result;
        }
        echo $cancelResult.' '.$setResult;
    }

    public function actionRemoveTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');

        $trainer = TrainerStudent::getTrainerByStudent($userId);
        $oldTrainer = RegisteredUser::userById($trainer->id);

        if($oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
    }

    public function actionExport($type)
    {
        $phpExcelPath = Yii::getPathOfAlias('ext.PHPExcel');
        spl_autoload_unregister(array('YiiBase','autoload'));
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        spl_autoload_register(array('YiiBase','autoload'));

        switch ($type) {
            case 'all': {
                $fieldsToExport = ['firstName' => 'Ім\'я',
                    'middleName' => 'По-батькові',
                    'secondName' => 'Прізвище',
                    'email' => 'Електронна пошта',
                    'city0.title_ua' => 'Місто',
                    'country0.title_ua' => 'Країна',
                    'reg_time' => 'Час реєстрації'];
                $exporter = new ExcelExporter('StudentReg', $fieldsToExport);
                $exporter->setCriteria('cancelled=' . StudentReg::ACTIVE);
            }
            break;
            case 'students':{
                $fieldsToExport = ['firstName' => 'Ім\'я',
                    'middleName' => 'По-батькові',
                    'secondName' => 'Прізвище',
                    'email' => 'Електронна пошта',
                    'student.start_date'=>'Надано роль',
                    'educform' => 'Форма',
                    'city0.title_ua' => 'Місто',
                    'country0.title_ua' => 'Країна',
                    'trainerData.fullName'=>'Тренер',
                    'reg_time' => 'Час реєстрації'];
                $criteria =  new CDbCriteria();
                $criteria->alias = 't';
                $criteria->join = 'inner join user_student us on t.id = us.id_user';
                $criteria->condition = 't.cancelled='.StudentReg::ACTIVE.' and us.end_date IS NULL';
                $criteria->group = 't.id';
                $exporter = new ExcelExporter('StudentReg', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
            break;
            case 'offlineStudents':{
                $fieldsToExport = ['user.firstName' => 'Ім\'я',
                    'user.middleName' => 'По-батькові',
                    'user.secondName' => 'Прізвище',
                    'user.email' => 'Електронна пошта',
                    'trainerData.fullName' => 'Тренер',
                    'group.name' => 'Група',
                    'subgroupName.name'=>'Підгрупа',
                    'start_date' => 'Додано',
                    'user.phone' => 'Телефон',];
                $criteria =  new CDbCriteria();
                $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
                $criteria->condition = 't.end_date IS NULL';
                $exporter = new ExcelExporter('OfflineStudents', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'teachers':{
                $fieldsToExport = ['user.firstName' => 'Ім\'я',
                    'user.middleName' => 'По-батькові',
                    'user.secondName' => 'Прізвище',
                    'user.email' => 'Електронна пошта',
                    ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('user.cancelled='.StudentReg::ACTIVE);
                $exporter = new ExcelExporter('Teacher', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'authors':{
                $fieldsToExport = ['user.firstName' => 'Ім\'я',
                    'user.middleName' => 'По-батькові',
                    'user.secondName' => 'Прізвище',
                    'user.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('user.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserAuthor', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'withoutRoles':{
                $fieldsToExport = ['firstName' => 'Ім\'я',
                    'middleName' => 'По-батькові',
                    'secondName' => 'Прізвище',
                    'email' => 'Електронна пошта',
                    'reg_time' => 'Зареєстровано',
                    'city0.title_ua' => 'Місто',
                    'country0.title_ua' => 'Країна',
                ];
                $criteria =  new CDbCriteria();
                $criteria->alias = 't';
                $criteria->join = 'left join user_student us on us.id_user=t.id';
                $criteria->join .= ' left join teacher tt on tt.user_id=t.id';
                $criteria->addCondition('t.cancelled='.StudentReg::ACTIVE);
                $criteria->addCondition('us.id_user IS NULL and tt.user_id IS NULL');
                $exporter = new ExcelExporter('StudentReg', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'admins':{
                $fieldsToExport = ['user.firstName' => 'Ім\'я',
                    'user.middleName' => 'По-батькові',
                    'user.secondName' => 'Прізвище',
                    'user.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('user.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserAdmin', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'accountants':{
                $fieldsToExport = ['idUser.firstName' => 'Ім\'я',
                    'idUser.middleName' => 'По-батькові',
                    'idUser.secondName' => 'Прізвище',
                    'idUser.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('idUser.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserAccountant', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'contentManagers':{
                $fieldsToExport = ['idUser.firstName' => 'Ім\'я',
                    'idUser.middleName' => 'По-батькові',
                    'idUser.secondName' => 'Прізвище',
                    'idUser.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('idUser.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserContentManager', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'consultants':{
                $fieldsToExport = ['idUser.firstName' => 'Ім\'я',
                    'idUser.middleName' => 'По-батькові',
                    'idUser.secondName' => 'Прізвище',
                    'idUser.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('idUser.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserTeacherConsultant', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'trainers':{
                $fieldsToExport = ['idUser.firstName' => 'Ім\'я',
                    'idUser.middleName' => 'По-батькові',
                    'idUser.secondName' => 'Прізвище',
                    'idUser.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('idUser.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserTrainer', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'tenants':{
                $fieldsToExport = ['user.firstName' => 'Ім\'я',
                    'user.middleName' => 'По-батькові',
                    'user.secondName' => 'Прізвище',
                    'user.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('user.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserTenant', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'supervisors':{
                $fieldsToExport = ['user.firstName' => 'Ім\'я',
                    'user.middleName' => 'По-батькові',
                    'user.secondName' => 'Прізвище',
                    'user.email' => 'Електронна пошта',
                    'start_date' => 'Призначено'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('user.cancelled='.StudentReg::ACTIVE.' AND end_date IS NULL');
                $exporter = new ExcelExporter('UserSuperVisor', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
            case 'blockedUsers':{
                $fieldsToExport = ['registeredUser.firstName' => 'Ім\'я',
                    'registeredUser.middleName' => 'По-батькові',
                    'registeredUser.secondName' => 'Прізвище',
                    'registeredUser.email' => 'Електронна пошта',
                    'locked_date' => 'Дата блокування',
                    'lockedBy.fullName' => 'Заблоковано користувачем'
                ];
                $criteria =  new CDbCriteria();
                $criteria->addCondition('registeredUser.cancelled='.StudentReg::DELETED);
                $exporter = new ExcelExporter('UserBlocked', $fieldsToExport);
                $exporter->setCriteria($criteria);
            }
                break;
        }


        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
        $objWriter = new PHPExcel_Writer_Excel2007($exporter->getDocument());
        $objWriter->save('php://output');
        Yii::app()->end();

    }

    public function actionSaveExcelFile(){
        if (!file_exists(Yii::app()->basePath . "/../files/emailsBase")) {
            mkdir(Yii::app()->basePath . "/../files/emailsBase");
        }
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], Yii::getpathOfAlias('webroot').'/files/emailsBase/email_base.xlsx');
        }
    }

    public function actionImportExcel(){
        $phpExcelPath = Yii::getPathOfAlias('ext.PHPExcel');
        spl_autoload_unregister(array('YiiBase','autoload'));
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        spl_autoload_register(array('YiiBase','autoload'));

        $emailsCategory = Yii::app()->request->getPost('categoryId');
        $filepath=Yii::getpathOfAlias('webroot').'/files/emailsBase/email_base.xlsx';
        $exporter = new ExcelImporter('users_email',1,$filepath, $emailsCategory);
        $exporter->importExcelToMySQL();
    }

    public function actionAddNewEmail(){
        $email = Yii::app()->request->getPost('email');
        $emailsCategory = Yii::app()->request->getPost('categoryId');
        $userEmail= new UsersEmailDatabase();
        $userEmail->email=$email;
        $userEmail->category=$emailsCategory;
        $userEmail->save();
    }

    public function actionGetUsersEmailList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UsersEmailDatabase', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionRemoveEmail(){
        $email = Yii::app()->request->getPost('email');
        $model= UsersEmailDatabase::model()->findByAttributes(array('email'=>$email));
        $model->delete();
    }

    public function actionTruncateEmailsTable(){
        $emailsCategory = Yii::app()->request->getPost('categoryId');
        UsersEmailDatabase::model()->deleteAllByAttributes(array('category'=>$emailsCategory));
    }

    public function actionRemoveEmailCategory(){
        $emailsCategory = Yii::app()->request->getPost('categoryId');
        if(UsersEmailDatabase::model()->deleteAllByAttributes(array('category'=>$emailsCategory))){
            EmailsCategory::model()->deleteByPk($emailsCategory);
        }
    }

    public function actionGetEmailsCategoryList()
    {
        echo  CJSON::encode(EmailsCategory::model()->findAll());
    }

    public function actionGetEmailCategoryData($id)
    {
        echo CJSON::encode(EmailsCategory::model()->findByPk($id));
    }

    public function actionCreateEmailCategory()
    {
        $title=Yii::app()->request->getParam('name');

        $emailCategory= new EmailsCategory();
        $emailCategory->title=$title;
        $emailCategory->save();
    }

    public function actionUpdateEmailCategory()
    {
        $id=Yii::app()->request->getPost('id');
        $title=Yii::app()->request->getPost('name');

        $emailCategory=EmailsCategory::model()->findByPk($id);
        $emailCategory->title=$title;
        $emailCategory->save();
    }
}