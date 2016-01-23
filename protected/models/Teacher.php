<?php

/**
 * This is the model class for table "teacher".
 *
 * The followings are the available columns in table 'teacher':
 * @property integer $teacher_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $foto_url
 * @property string $subjects
 * @property string $profile_text_first
 * @property string $profile_text_short
 * @property string $profile_text_last
 * @property string $readMoreLink
 * @property string $email
 * @property string $tel
 * @property string $skype
 * @property integer $rate_knowledge
 * @property integer $rate_efficiency
 * @property integer $rate_relations
 * @property integer $user_id
 * @property integer $rating
 * @property integer $isPrint
 * @property string $first_name_en
 * @property string $middle_name_en
 * @property string $last_name_en
 * @property string $first_name_ru
 * @property string $middle_name_ru
 * @property string $last_name_ru
 *
 */
class Teacher extends CActiveRecord
{
    public $avatar = array(), $oldAvatar;
    //array of teacher modules

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'teacher';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, middle_name, last_name,first_name_en, middle_name_en, last_name_en,first_name_ru,
             middle_name_ru,last_name_ru, user_id','required', 'message' => 'Поле не може бути пустим'),
            array('rate_knowledge, rate_efficiency, rate_relations, user_id, isPrint', 'numerical', 'integerOnly' => true),
            array('first_name, middle_name, last_name', 'length', 'max' => 35),
            array('first_name_en, middle_name_en, last_name_en','match', 'pattern'=>'/^([a-zA-Z0-9_])+$/', 'message' => 'Недопустимі символи!'),
            array('first_name_ru, middle_name_ru, last_name_ru','match', 'pattern'=>'/^([а-яА-ЯёЁ])+$/u', 'message' => 'Недопустимі символи!'),
            array('first_name, middle_name, last_name', 'match', 'pattern' => '/^[а-яіїёА-ЯІЇЁєЄ\s\'’]+$/u', 'message' => 'Недопустимі символи!'),
            array('tel', 'match', 'pattern' => '/^[0-9]+$/u', 'message' => 'Недопустимі символи!', 'except' => 'imageUpload',),
            array('tel', 'length', 'max' => 13, 'message' => 'Недопустимі символи!', 'except' => 'imageUpload'),
            array('subjects', 'length', 'max' => 100),
            array('foto_url', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
            array('readMoreLink', 'length', 'max' => 255),
            array('email, skype, first_name_en, middle_name_en, last_name_en', 'length', 'max' => 50),
            array('email', 'email', 'message' => 'Невірна електронна адреса'),
            array('profile_text_first,profile_text_short,profile_text_last', 'safe'),
            // The following rule is used by search().
            array('teacher_id, first_name, middle_name, last_name, foto_url, subjects, profile_text_first,
            profile_text_short, profile_text_last, readMoreLink, email, tel, skype, rate_knowledge, rate_efficiency,
            rate_relations, user_id, isPrint, first_name_en, middle_name_en, last_name_en,first_name_ru, middle_name_ru, last_name_ru',
                'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user'=>array(self::BELONGS_TO, 'StudentReg', 'user_id'),
            'modules'=>array(self::MANY_MANY, 'Module', 'teacher_module(idTeacher, idModule)'),
            'responses'=>array(self::MANY_MANY, 'Response', 'teacher_response(id_teacher, id_response)'),
            'teacherRoles' => array(self::HAS_MANY, 'TeacherRoles', 'teacher'),
            'roles' => array(self::HAS_MANY, 'Roles', 'role', 'through' => 'teacherRoles'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'teacher_id' => 'ID',
            'first_name' => 'Ім&#8217;я',
            'middle_name' => 'По батькові',
            'last_name' => 'Прізвище',
            'foto_url' => 'Фото',
            'subjects' => 'Предмети',
            'profile_text_first' => 'Текст профілю (1)',
            'profile_text_short' => 'Короткий опис (сторінка викладачів)',
            'profile_text_last' => 'Текст профілю (2)',
            'readMoreLink' => 'Посилання на профіль(детальніше)',
            'email' => 'Email',
            'tel' => 'Телефон',
            'skype' => 'Skype',
            'rate_knowledge' => 'Рівень знань',
            'rate_efficiency' => 'Рівень ефективності',
            'rate_relations' => 'Рівень відношення',
            'user_id' => 'ID користувача',
            'isPrint' => 'Статус',
            'first_name_en' => 'Ім&#8217;я (англійською)',
            'middle_name_en' => 'По батькові (англійською)',
            'last_name_en' => 'Прізвище (англійською)',
            'first_name_ru' => 'Ім&#8217;я (російською)',
            'middle_name_ru' => 'По батькові (російською)',
            'last_name_ru' => 'Прізвище (російською)',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('teacher_id', $this->teacher_id);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('middle_name', $this->middle_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('foto_url', $this->foto_url, true);
        $criteria->compare('subjects', $this->subjects, true);
        $criteria->compare('profile_text_first', $this->profile_text_first, true);
        $criteria->compare('profile_text_short', $this->profile_text_short, true);
        $criteria->compare('profile_text_last', $this->profile_text_last, true);
        $criteria->compare('readMoreLink', $this->readMoreLink, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('skype', $this->skype, true);
        $criteria->compare('rate_knowledge', $this->rate_knowledge);
        $criteria->compare('rate_efficiency', $this->rate_efficiency);
        $criteria->compare('rate_relations', $this->rate_relations);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('isPrint', $this->isPrint);
        $criteria->compare('first_name_en', $this->first_name_en, true);
        $criteria->compare('middle_name_en', $this->middle_name_en, true);
        $criteria->compare('last_name_en', $this->last_name_en, true);
        $criteria->compare('first_name_ru', $this->first_name_ru, true);
        $criteria->compare('middle_name_ru', $this->middle_name_ru, true);
        $criteria->compare('last_name_ru', $this->last_name_ru, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Teacher the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

     public static function setAverageTeacherRatings($teacherId, $responsesIdList)
    {
        $teacher = Teacher::model()->findByAttributes(array('user_id' => $teacherId));

        $criteria = new CDbCriteria();
        $criteria->alias = 'response';
        $criteria->condition = "is_checked = 1";
        $criteria->addInCondition('id', $responsesIdList);

        $count = 'SELECT * FROM response WHERE ' . $criteria->condition;
        $commandCount = Yii::app()->db->createCommand($count);
        $countField = count($commandCount->queryAll(true, $criteria->params));
        if ($countField != 0) {
            $sqlKn = 'SELECT sum(knowledge) FROM response WHERE ' . $criteria->condition;
            $commandKn = Yii::app()->db->createCommand($sqlKn);
            $resultsKn = $commandKn->queryRow(true, $criteria->params);
            $knowledgeAve = round($resultsKn['sum(knowledge)'] / $countField);

            $sqlBh = 'SELECT sum(behavior) FROM response WHERE ' . $criteria->condition;
            $commandBh = Yii::app()->db->createCommand($sqlBh);
            $resultsBh = $commandBh->queryRow(true, $criteria->params);
            $behaviorAve = round($resultsBh['sum(behavior)'] / $countField);

            $sqlMt = 'SELECT sum(motivation) FROM response WHERE ' . $criteria->condition;
            $commandMt = Yii::app()->db->createCommand($sqlMt);
            $resultsMt = $commandMt->queryRow(true, $criteria->params);
            $motivationAve = round($resultsMt['sum(motivation)'] / $countField);

            $teacher->updateByPk($teacher->teacher_id, array('rate_knowledge' => $knowledgeAve));
            $teacher->updateByPk($teacher->teacher_id, array('rate_efficiency' => $behaviorAve));
            $teacher->updateByPk($teacher->teacher_id, array('rate_relations' => $motivationAve));
            $teacher->updateByPk($teacher->teacher_id, array('rating' => round(($knowledgeAve + $behaviorAve + $motivationAve) / 3)));
        } else {
            $teacher->updateByPk($teacher->teacher_id, array('rate_knowledge' => 0));
            $teacher->updateByPk($teacher->teacher_id, array('rate_efficiency' => 0));
            $teacher->updateByPk($teacher->teacher_id, array('rate_relations' => 0));
            $teacher->updateByPk($teacher->teacher_id, array('rating' => 0));
        }
    }

    public static function isTeacher($user)
    {
        if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => $user))) {
            return Teacher::model()->findByAttributes(array('user_id' => $user))->teacher_id;
        }
        return false;
    }

    public static function isTeacherCanEdit($user, $modules)
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('idModule', $modules);
        $criteria->addCondition('idTeacher=' . $user);
        return TeacherModule::model()->exists($criteria);
    }

    protected function beforeSave()
    {
        if(!Avatar::saveTeachersAvatar($this,'foto')){
            return false;
        }

        return true;
    }

    protected function beforeDelete()
    {
        $src = Yii::getPathOfAlias('webroot') . "/images/teachers/" . $this->foto_url;
        if (is_file($src))
            unlink($src);
        return true;
    }


    public static function updateFirstText($id, $firstText)
    {
        return Teacher::model()->updateByPk($id, array('profile_text_first' => $firstText));
    }

    public static function updateSecondText($id, $secondText)
    {
        return Teacher::model()->updateByPk($id, array('profile_text_last' => $secondText));
    }


    public static function getAllTeachersId()
    {
        $teachers = Teacher::model()->findAllBySql('select teacher_id from teacher order by teacher_id');
        $result = [];
        for ($i = 0; $i < count($teachers); $i++) {
            array_push($result, $teachers[$i]['teacher_id']);
        }
        return $result;
    }

    public static function getFullName($id)
    {
        $teacher = Teacher::model()->findByPk($id);
        return $teacher->last_name . " " . $teacher->first_name . " " . $teacher->middle_name;
    }

    public static function getLectureTeacher($idLecture)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "teacher_id";
        $criteria->addCondition("isPrint=1");
        $criteria->order = 'rating ASC';
        $teachers = Teacher::model()->findAll($criteria);

        foreach ($teachers as $key) {
            if (TeacherModule::model()->exists('idTeacher=:idTeacher and idModule=:idModule', array(
                ':idTeacher' => $key->teacher_id,
                ':idModule' => Lecture::model()->findByPk($idLecture)->idModule
            ))
            ) {
                return $key;
            }
        }
        return null;
    }

    public static function getTeacherConsult($lectureId)
    {
        $lecture = Lecture::model()->findByPk($lectureId);
        $teachersconsult = [];

        $criteria = new CDbCriteria;
        $criteria->alias = 'consultant_modules';
        $criteria->select = 'consultant';
        $criteria->addCondition('module=' . $lecture->idModule);
        $temp = ConsultantModules::model()->findAll($criteria);
        for ($i = 0; $i < count($temp); $i++) {
            array_push($teachersconsult, $temp[$i]->consultant);
        }

        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'teacher';
        $criteriaData->condition = 'isPrint = 1';
        $criteriaData->addInCondition('teacher_id', $teachersconsult, 'AND');

        $dataProvider = new CActiveDataProvider('Teacher', array(
            'criteria' => $criteriaData,
            'pagination' => false,
        ));
       //var_dump($dataProvider);
        return $dataProvider;
    }

    public static function addConsult($idteacher,$numcon,$date,$idlecture)
    {
        $calendar = new Consultationscalendar();

            if (Consultationscalendar::consultationFree($idteacher, $numcon, $date)) {
                $calendar->start_cons = substr($numcon, 0, 5);
                $calendar->end_cons = substr($numcon, 6, 5);
                $calendar->date_cons = $date;
                $calendar->teacher_id = $idteacher;
                $calendar->user_id = Yii::app()->request->getPost('userid');
                $calendar->lecture_id = $idlecture;
                $calendar->save();
                $calendar = new Consultationscalendar();
            }
        }

    public static function getTeacherSchedule($teacher,$user,$tab)
    {
        switch ($tab) {
            case '1':
                $criteria = new CDbCriteria;
                $criteria->alias = 'consultationscalendar';
                if ($teacher)
                    $criteria->addCondition('teacher_id=' . $teacher->teacher_id);
                else
                    $criteria->addCondition('user_id=' . $user);

                $data = new CActiveDataProvider('Consultationscalendar', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 50,
                    ),
                    'sort' => array(
                        'defaultOrder' => 'date_cons DESC',
                        'attributes' => array('date_cons'),
                    ),
                ));
                break;
            case '2':
                $data = new CActiveDataProvider('Consultationscalendar', array('data' => array()));
                break;
            case '3':
                $criteria = new CDbCriteria;
                $criteria->alias = 'consultationscalendar';
                if ($teacher)
                    $criteria->addCondition('teacher_id=' . $teacher->teacher_id);
                else
                    $criteria->addCondition('user_id=' . $user);

                $data = new CActiveDataProvider('Consultationscalendar', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 50,
                    ),
                    'sort' => array(
                        'defaultOrder' => 'date_cons DESC',
                        'attributes' => array('date_cons'),
                    ),
                ));
                break;
            case '4':
                $data = new CActiveDataProvider('Consultationscalendar', array('data' => array()));
                break;
            case '5':
                $data = new CActiveDataProvider('Consultationscalendar', array('data' => array()));
                break;
        }

        return $data;
    }

    public static function getTeacherAsPrint()
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'teacher';
        $criteria->order = 'rating DESC';
        $criteria->condition = 'isPrint=1';
        $dataProvider = new CActiveDataProvider('Teacher', array(
            'criteria' => $criteria,
            'Pagination' => false,
        ));

        return $dataProvider;
    }
    public function getName()
    {
        return $this->last_name . " " . $this->first_name . " " . $this->middle_name;
    }

    public static function generateTeachersList()
    {
        $teachers = Teacher::model()->findAll();
        $count = count($teachers);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $teachers[$i]->teacher_id;
            $result[$i]['alias'] = $teachers[$i]->first_name . " " . $teachers[$i]->last_name . ", " . $teachers[$i]->email;
        }
        return $result;
    }

    public static function generateTeacherRolesList($id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'role';
        $criteria->distinct = true;
        $criteria->order = 'role';
        $criteria->condition = 'teacher=' . $id;
        $roles = TeacherRoles::model()->findAll($criteria);
        $result = [];
        for ($i = 0, $count = count($roles); $i < $count; $i++) {
            $result[$i]['id'] = $roles[$i]->role;
            $result[$i]['alias'] = Roles::model()->findByPk($roles[$i]->role)->title_ua;
        }
        return $result;
    }

    public static function getTeacherName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en'  && Teacher::model()->findByPk($id)->first_name_en != ''
                && Teacher::model()->findByPk($id)->last_name_en != ''){
                return Teacher::model()->findByPk($id)->last_name_en." ".Teacher::model()->findByPk($id)->first_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->last_name." ".Teacher::model()->findByPk($id)->first_name;
    }

    public static function getTeacherLastName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && Teacher::model()->findByPk($id)->last_name_en != ''){
                return Teacher::model()->findByPk($id)->last_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->last_name;
    }

    public function lastName(){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && $this->last_name_en != ''){
                return $this->last_name_en;
            }
        }
        return $this->last_name;
    }

    public function getLastFirstName(){
        $last = $this->last_name;
        $first = $this->first_name;
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en'){
                if ($this->last_name_en != '') $last = $this->last_name_en;
                if ($this->first_name_en != '') $first = $this->first_name_en;
            }
        }
        return $last." ".$first;
    }

    public static function getTeacherFirstName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && Teacher::model()->findByPk($id)->first_name_en != ''){
                return Teacher::model()->findByPk($id)->first_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->first_name;
    }

    public function firstName(){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && $this->first_name_en != ''){
                return $this->first_name_en;
            }
        }
        return $this->first_name;
    }

    public function middleName(){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && $this->middle_name_en != ''){
                return $this->middle_name_en;
            }
        }
        return $this->middle_name;
    }

    public static function getTeacherMiddleName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && Teacher::model()->findByPk($id)->middle_name_en != ''){
                return Teacher::model()->findByPk($id)->middle_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->middle_name;
    }

    public static function getTeacherId($user){
        if ($user != 0 && Teacher::model()->exists('user_id=:user', array(':user' => $user))){
            return Teacher::model()->findByAttributes(array('user_id' => $user))->teacher_id;
        } else {
            return 0;
        }
    }

    public function roles(){
        return $this->roles;
    }

    public static function getAllTrainers()
    {
        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN teacher_roles ON teacher_roles.teacher = teacher_id';
        $criteria->addCondition ('teacher_roles.role = 1');

        $result = Teacher::model()->findAll($criteria);

        return $result;
    }

    public static function getTeacherNameByUserId($user){
        $idTeacher = Teacher::getTeacherId($user);
        return Teacher::getTeacherName($idTeacher);
    }

    public static function isTeacherAuthorModule($idUser,$idModule){
        if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => $idUser))) {
            $teacherId = Teacher::model()->findByAttributes(array('user_id' => $idUser));
            $author = TeacherModule::model()->findByAttributes(array('idTeacher' => $teacherId->teacher_id, 'idModule' => $idModule));
        }
        if(isset($author)) return true; else return false;
    }

    public static function getConsultantModules($teacher){
        $modules = ConsultantModules::getModulesByConsultant($teacher);
        $result = RoleAttribute::formatAttributeList($modules, 'module/index', 'idModule', true);
        return $result;
    }

    public static function getLeaderProjects($teacher){
        $projects = Project::getProjectsByLeader($teacher);
        $result = RoleAttribute::formatAttributeList($projects, 'project/index', 'id', false);
        return $result;
    }

    public static function getModulesByTeacher($id){
        $modulelist = [];
        $criteria = new CDbCriteria;
        $criteria->alias = 'teacher_modules';
        $criteria->select = 'idModule';
        $criteria->distinct = true;
        $criteria->addCondition('idTeacher=' . $id);
        $temp = TeacherModule::model()->findAll($criteria);
        for ($i = 0; $i < count($temp); $i++) {
            array_push($modulelist, $temp[$i]->idModule);
        }

        $titleParam = Module::getModuleTitleParam();

        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');

        $rows = Module::model()->findAll($criteriaData);

        $j=0;
        foreach ($rows as $row) {
            if ($row[$titleParam] == '')
                $title = 'title_ua';
            else $title = $titleParam;
            $module[$j]["idModule"] = $row['module_ID'];
            $module[$j]["title"] = $row[$title];
            $module[$j]["language"] = $row['language'];
            $j++;
        };

        return (!empty($module))?$module:[];
    }

    public function modules(){
        $modules = $this->modulesRoleArray();
        $result = RoleAttribute::formatAttributeList($modules, 'module/index', 'idModule', true);
        return $result;
    }

    public function modulesRoleArray(){
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('idModule'),
            'from' => 'teacher_module',
            'where' => 'idTeacher=:id',
            'order' => 'idModule',
            'params' => array(':id' => $this->teacher_id),
        ))->queryAll();
        $count = count($modules);
        $titleParam = Module::getModuleTitleParam();

        for($i = 0;$i < $count;$i++){
            $modules[$i]['id'] = $modules[$i]["idModule"];
            $modules[$i]['title'] = Module::model()->findByPk($modules[$i]["idModule"])->$titleParam;
        }

        return (!empty($modules))?$modules:[];
    }

    public function getTrainees(){
        $trainees = Yii::app()->db->createCommand(array(
            'select' => array('student'),
            'from' => 'trainer_student',
            'where' => 'trainer=:id',
            'order' => 'student',
            'params' => array(':id' => $this->teacher_id),
        ))->queryAll();

        return $trainees;
    }

    public function notCheckedPlainTask()
    {
        $trainerUser = TrainerStudent::getStudentByTrainer(Yii::app()->user->id);

        $teacherPlainTasksId = PlainTaskAnswer::TeacherPlainTask($this->teacher_id);

        if($teacherPlainTasksId){
        $newPlainTasksId = PlainTaskAnswer::newTeacherPlainTask($teacherPlainTasksId);

            $criteria = new CDbCriteria();
            $criteria->condition = 'id = :id';
            $criteria->params = array(':id' => $newPlainTasksId);


            $newPlainTasksModel = PlainTaskAnswer::model()->findAllByPk($newPlainTasksId);

        return $newPlainTasksModel;
        }
        else return null;
    }

    public function countNotCheckedPlainTask()
    {
        return count($this->notCheckedPlainTask());
    }

    public static function addTeacherAccess($teacher, $module){
        $model = new TeacherModule();
        if (!TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
            ':teacher' => $teacher,
            ':module' => $module,
        ))){
            $model->idTeacher = $teacher;
            $model->idModule = $module;
            if ($model->validate()){
                $model->save();
            }
        }
    }

    public function setTeacherRole($roleId){
        if (TeacherRoles::model()->exists('teacher=:teacher and role=:attribute', array('teacher'=>$this->teacher_id,
            'attribute'=>$roleId))){
            $model = TeacherRoles::model()->findByAttributes(array('teacher'=>$this->teacher_id, 'role'=>$roleId));
        } else{
            $model = new TeacherRoles();
            $model->teacher = $this->teacher_id;
            $model->role = $roleId;
        }
        $model->start_date = date("Y-m-d H:i");

        if ($model->validate()){
            $model->save();
            return true;
        }
        return false;
    }

    public function getStatus()
    {
        if($this->isPrint)
        return 'активний';
        else return 'видалений';
    }
}
