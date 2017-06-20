<?php

class TeacherConsultant extends Role
{
    private $errorMessage = "";
    private $dbModel;
    private $modules;
    private $students;
    private $user;

    public function tableName()
    {
        return "user_teacher_consultant";
    }

    /**
     * @param $organization Organization
     * @return string sql for check role teacher consultant.
     */
    public function checkRoleSql($organization=null){
        $condition=$organization?' and utc.id_organization='.$organization:'';
        return 'select "teacher_consultant" from user_teacher_consultant utc where utc.id_user = :id and utc.end_date IS NULL'.$condition;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function title()
    {
        return "Викладач";
    }

    public function attributes(StudentReg $user, $organization=null)
    {
        if ($this->user == null)
            $this->user = $user;

        return array(
            array(
                'key' => 'module',
                'title' => 'Модулі',
                'type' => 'module-list',
                'value' => $this->getModules()
            ),
            array(
                'key' => 'students',
                'title' => 'Студенти',
                'type' => 'hidden',
                'value' => $this->getStudents()
            )
        );
    }

    private function getModules()
    {
        if ($this->modules == null) {
            $this->modules = $this->loadModules();
        }

        return $this->modules;
    }

    private function getStudents()
    {
        if ($this->students == null) {
            $this->students = $this->loadStudents();
        }

        return $this->students;
    }

    private function loadStudents()
    {
        $records = Yii::app()->db->createCommand()
            ->select('u.id, GROUP_CONCAT(DISTINCT u.secondName, u.firstName, u.middleName, u.email ORDER BY u.id ASC SEPARATOR " ") title, u.email, tcs.start_date, tcs.end_date')
            ->from('teacher_consultant_student tcs')
            ->rightJoin('user u', 'u.id=tcs.id_student')
            ->where('id_teacher=:id AND tcs.end_date IS NULL', array(':id' => $this->user->id))
            ->group('u.id')
            ->queryAll();

        return $records;
    }

    private function loadModules()
    {
        $organization=Yii::app()->user->model->getCurrentOrganizationId();
        $records = Yii::app()->db->createCommand()
            ->select('id_module id, language lang, m.title_ua title, tcm.start_date, tcm.end_date, m.cancelled')
            ->from('teacher_consultant_module tcm')
            ->join('module m', 'm.module_ID=tcm.id_module')
            ->join('user_teacher_consultant utc', 'utc.id_user=tcm.id_teacher')
            ->where('id_teacher=:id AND tcm.end_date IS NULL and utc.end_date IS NULL and utc.id_organization=:id_org 
            and m.id_organization=:id_org', array(':id' => $this->user->id, ':id_org'=>$organization))
            ->queryAll();

        return $records;
    }

    public function checkBeforeDeleteRole(StudentReg $user, $organization=null)
    {
        return true;
    }

    public function checkBeforeSetRole(StudentReg $user, $organization=null){
        return true;
    }

    public function checkBeforeSetAttribute(StudentReg $user){
        $user = RegisteredUser::userById($user->id);
        if($user->isTeacherConsultant())
            return true;
        else {
            $this->errorMessage="Призначити модуль не вдалося. Користувачу не призначена роль викладача";
            return false;
        }
    }

    public function checkBeforeUnsetAttribute($userId, $module){
        $user = RegisteredUser::userById($userId);
        $model=Module::model()->findByPk($module);

        if(!$user->isTeacherConsultant() || $model->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id) {
            $this->errorMessage="Ти не можеш скасувати модуль викладачу в межах даної організації";
            return false;
        }
        return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkBeforeUnsetAttribute($user->id, $value)) {
                    if (Yii::app()->db->createCommand()->
                    update('teacher_consultant_module', array(
                        'end_date' => date("Y-m-d H:i:s"),
                    ), 'id_teacher=:user and id_module=:module and end_date IS NULL', array(':user' => $user->id, 'module' => $value))
                    ) {
                        $user->notify('teacher_consultant' . DIRECTORY_SEPARATOR . '_cancelModule',
                            array(Module::model()->findByPk($value)),
                            'Скасовано модуль', Yii::app()->user->getId());
                        return true;
                    } else {
                        $this->errorMessage = "Скасувати модуль не вдалося";
                        return false;
                    }
                }else{
                    return false;
                }
                break;
            default:
                $this->errorMessage="Виконати операцію не вдалося";
                return false;
        }
    }

    public function addRoleFormList($query, $organization)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id=s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_teacher_consultant u ON u.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
        and (u.id_user IS NULL or u.end_date IS NOT NULL or (u.end_date IS NULL and u.id_organization!='.$organization.'))');
        $criteria->group = 's.id';

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkBeforeSetAttribute($user)){
                    if (!$this->checkModule($user->id, $value)) {
                        if (Yii::app()->db->createCommand()->
                        insert('teacher_consultant_module', array(
                            'id_teacher' => $user->id,
                            'id_module' => $value
                        ))){
                            $revisionRequest=MessagesTeacherConsultantRequest::model()->findByAttributes(array('id_module'=>$value,'id_teacher'=>$user->id,'cancelled'=>0));
                            if($revisionRequest){
                                $revisionRequest->setApproved();
                            }
                            $this->notify($user, $value);
                            return true;
                        }else{
                            $this->errorMessage = "Призначити модуль викладачу не вдалося";
                            return false;
                        }
                    } else {
                        return false;
                    }
                }else{
                    return false;
                }
            default:
                return false;
        }
    }

    public function setStudentAttribute(StudentReg $teacher, $student, $module)
    {
        if (Yii::app()->db->createCommand()->
        insert('teacher_consultant_student', array(
            'id_teacher' => $teacher->id,
            'id_module' => $module,
            'id_student' => $student
        ))){
            $teacher->notify('teacher_consultant' . DIRECTORY_SEPARATOR . '_assignNewStudent', array(
                StudentReg::model()->findByPk($student),
                Module::model()->findByPk($module)
            ), 'Призначено нового студента', Yii::app()->user->getId());
            return true;
        }
        return false;
    }


    public function checkStudent($module, $student)
    {
        if (Yii::app()->db->createCommand('select id_teacher from teacher_consultant_student where id_module=' . $module .
            ' and id_student=' . $student . ' and end_date IS NULL')->queryScalar()) {
            $this->errorMessage = "Для даного студента вже призначено викладача.";
            return false;
        } else return true;
    }

    public function checkModule($teacher, $module)
    {
        $model=Module::model()->findByPk($module);
        if($model->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id) {
            $this->errorMessage="Викладачу не можна призначити модуль, який не належить його організації";
            return true;
        }
        if (empty(Yii::app()->db->createCommand('select id_module from teacher_consultant_module where id_module=' . $module .
                ' and id_teacher=' . $teacher . ' and end_date IS NULL')->queryAll())) {
            return false;
        } else {
            $this->errorMessage = "Для даного викладача вже призначено цей модуль";
            return true;
        }
    }

    public function checkOfflineGroupModule($group, $module)
    {
        if (empty(Yii::app()->db->createCommand('select id_module from offline_groups_teacher_consultant_module where id_module=' . $module .
            ' and id_group=' . $group . ' and end_date IS NULL')->queryAll())) {
            return false;
        } else {
            $this->errorMessage = "Для даного модуля вже призначено викладача";
            return true;
        }
    }

    public function existOpenTaskAnswers(StudentReg $teacher)
    {
        return (count($this->openPlainTaskAnswers($teacher)) > 0);
    }

    public function openPlainTaskAnswers(StudentReg $teacher)
    {
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'ans';
        $criteria->join = 'LEFT JOIN plain_task_answer_teacher pt ON pt.id_plain_task_answer = ans.id';
        $criteria->condition = 'pt.id_teacher = ' . $teacher->id . ' and end_date IS NOT NULL';

        return PlainTaskAnswer::model()->findAll($criteria);
    }

    /**
     * Return true if this student assigned for this teacher-consultant for chosen module. Used before canceling student
     * for teacher-consultant.
     * @param $teacher
     * @param $module
     * @param $student
     * @return bool
     */
    public function checkCancelStudent($teacher, $module, $student)
    {
        if(Module::model()->findByPk($module)->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id)
            return false;
        if (Yii::app()->db->createCommand('select id_teacher from teacher_consultant_student where id_module=' . $module .
                ' and id_teacher=' . $teacher . ' and id_student=' . $student . ' and end_date IS NULL')->queryScalar() == 0
        ) {
            return false;
        } else return true;
    }

    public function cancelStudentAttribute(StudentReg $teacher, $student, $module)
    {
        if(Yii::app()->db->createCommand()->
        update('teacher_consultant_student', array(
            'end_date' => date("Y-m-d H:i:s"),
        ), 'id_teacher=:teacher and id_student=:student and id_module=:module', array(
            ':teacher' => $teacher->id,
            ':student' => $student,
            ':module' =>$module
        ))){
            $teacher->notify('teacher_consultant' . DIRECTORY_SEPARATOR . '_cancelStudent', array(
                StudentReg::model()->findByPk($student),
                Module::model()->findByPk($module)
            ), 'Скасовано студента', Yii::app()->user->getId());
            return true;
        }
        return false;
    }

    public static function teacherConsultantsByQuery($query, $organization){
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id=s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_teacher_consultant utc ON utc.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
		and utc.id_user IS NOT NULL and utc.end_date IS NULL and utc.id_organization='.$organization);
        $criteria->group = 's.id';

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key=>$model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public function isTeachModule($teacher, $module){
        if (empty(Yii::app()->db->createCommand('select count(id_module) from teacher_consultant_module where id_module=' . $module .
            ' and id_teacher=' . $teacher . ' and end_date IS NULL')->queryAll())) {
            return true;
        }
        else return false;
    }

    public function activeModules(StudentReg $teacher)
    {
        $records = Yii::app()->db->createCommand()
            ->select('id_module id, language lang, m.title_ua title, tcm.start_date')
            ->from('teacher_consultant_module tcm')
            ->join('module m', 'm.module_ID=tcm.id_module')
            ->where('id_teacher=:id and tcm.end_date IS NULL and m.cancelled=:isCancel 
            and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id, array(
                ':id' => $teacher->id,
                ':isCancel' => Module::ACTIVE
            ))
            ->group('id')
            ->queryAll();

        return $records;
    }

    public function activeStudents(StudentReg $teacher){
        $criteria = new CDbCriteria();
        $criteria->alias = 's';
        $criteria->join = 'left join teacher_consultant_student tcs on tcs.id_student = s.id';
        $criteria->join .= ' left join module m on m.module_ID = tcs.id_module';
        $criteria->addCondition('id_teacher='.$teacher->id.' and tcs.end_date IS NULL 
        and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $criteria->group = 's.id';

        return StudentReg::model()->findAll($criteria);
    }

    public function activeStudentsModules(StudentReg $teacher){
        $records = Yii::app()->db->createCommand()
            ->select('tcs.id_student, tcs.id_module, 
            u.firstName, u.secondName, u.email, m.title_ua, m.language')
            ->from('teacher_consultant_student tcs')
            ->leftJoin('user u', 'u.id=tcs.id_student')
            ->leftJoin('module m', 'm.module_ID=tcs.id_module')
            ->where('tcs.id_teacher=:id_teacher and tcs.end_date IS NULL 
            and m.id_organization=:id_org and u.cancelled=:u_status',
                array(
                    ':id_teacher'=>$teacher->id,
                    ':id_org' =>Yii::app()->user->model->getCurrentOrganization()->id,
                    ':u_status' => StudentReg::ACTIVE,
                    ),'')
            ->queryAll();

        return $records;
    }

    public function notify(StudentReg $user, $idModule){
        $user->notify('teacher_consultant'. DIRECTORY_SEPARATOR . '_notifyTeacherConsultant', array(Module::model()->findByPk($idModule)), 'Надано права викладача для модуля', Yii::app()->user->getId());
    }

    function getMembers($criteria = null)
    {
        return UserTeacherConsultant::model()->findAll($criteria);
    }

    //cancel teacher_consultant role
    public function cancelRole(StudentReg $user, $organizationId = null)
    {
        if(!$this->checkBeforeDeleteRole($user)){
            return false;
        }

        if(Yii::app()->db->createCommand()->
        update($this->tableName(), array(
            'end_date'=>date("Y-m-d H:i:s"),
            'cancelled_by'=>Yii::app()->user->getId(),
        ), 'id_user=:id and end_date IS NULL', array(':id'=>$user->id))){
            $this->cancelModulesRights($user);
            $this->cancelTeacherStudents($user);
            $this->notifyCancelRole($user);
            $this->updateRolesRoom();
            return true;
        }
        return false;
    }

    //cancel rules for all teacher_consultant's modules
    public function cancelModulesRights(StudentReg $user)
    {
        if(Yii::app()->db->createCommand()->
        update('teacher_consultant_module', array(
            'end_date'=>date("Y-m-d H:i:s"),
        ), 'id_teacher=:id and end_date IS NULL', array(':id'=>$user->id))){
            return true;
        }
        return false;
    }

    //cancel teacher's students
    public function cancelTeacherStudents(StudentReg $user)
    {
        if(Yii::app()->db->createCommand()->
        update('teacher_consultant_student', array(
            'end_date'=>date("Y-m-d H:i:s"),
        ), 'id_teacher=:id and end_date IS NULL', array(':id'=>$user->id))){
            return true;
        }
        return false;
    }

    public function activeStudentsModulesByGroup($groupId){
        $records = Yii::app()->db->createCommand()
            ->select('tcs.id_student, tcs.id_module, 
            u.firstName, u.secondName, u.email, m.title_ua, m.language')
            ->from('teacher_consultant_student tcs')
            ->leftJoin('user u', 'u.id=tcs.id_student')
            ->leftJoin('module m', 'm.module_ID=tcs.id_module')
            ->leftJoin('offline_students os', 'tcs.id_student = os.id_user')
            ->leftJoin('offline_subgroups osg', 'osg.id = os.id_subgroup')
            ->leftJoin('offline_groups og', 'og.id = osg.group')
            ->where('tcs.id_teacher=:id_teacher and tcs.end_date IS NULL 
            and m.id_organization=:id_org and u.cancelled=:u_status and og.id=:id_group 
            and og.id_organization=:id_org and os.end_date IS NULL',
                array(
                    ':id_teacher'=>Yii::app()->user->getId(),
                    ':id_org' =>Yii::app()->user->model->getCurrentOrganization()->id,
                    ':u_status' => StudentReg::ACTIVE,
                    ':id_group' => $groupId,
                ),'')
            ->queryAll();

        return $records;
    }

    public function activeStudentsModulesWithoutGroup(){
        $studentsId = array();
        foreach (OfflineStudents::model()->with('group')->findAll(
            array('order'=>'id_user',
                'condition'=>'end_date is NULL and group.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id,
                'select'=>'id_user',
                'distinct'=>true)) as $row) {
            array_push($studentsId, $row->id_user);
        }

        $records = Yii::app()->db->createCommand()
            ->select('tcs.id_student, tcs.id_module, 
            u.firstName, u.secondName, u.email, m.title_ua, m.language')
            ->from('teacher_consultant_student tcs')
            ->leftJoin('user u', 'u.id=tcs.id_student')
            ->leftJoin('module m', 'm.module_ID=tcs.id_module')

            ->leftJoin('user_service_access sa', 'sa.userId=tcs.id_student')
            ->leftJoin('acc_module_service ms', 'ms.service_id=sa.serviceId')
            ->leftJoin('acc_course_service cs', 'cs.service_id=sa.serviceId')
            ->leftJoin('course_modules cm', 'cm.id_course=cs.course_id')
            ->leftJoin('teacher_consultant_module tcm', '(tcm.id_module=cm.id_module or tcm.id_module=ms.module_id) 
            and tcm.id_teacher=tcs.id_teacher')

            ->where(array(
                'and',
                'tcs.id_teacher=:id_teacher and tcs.end_date IS NULL 
            and m.id_organization=:id_org and u.cancelled=:u_status 
            and sa.endDate>=NOW() and tcm.end_date is null and tcm.id_teacher=:id_teacher',
                array('not in', 'u.id',$studentsId)),
                array(
                    ':id_teacher'=>Yii::app()->user->getId(),
                    ':id_org' =>Yii::app()->user->model->getCurrentOrganization()->id,
                    ':u_status' => StudentReg::ACTIVE,
                ))
            ->queryAll();

        return $records;
    }
}