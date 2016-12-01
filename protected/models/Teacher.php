<?php

/**
 * This is the model class for table "teacher".
 *
 * The followings are the available columns in table 'teacher':
 * @property string $profile_text_first
 * @property string $profile_text_short
 * @property string $profile_text_last
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
 * @property integer $cancelled
 *
 * @property StudentReg $user
 * @property Module $modules
 * @property Module $modulesActive
 */
class Teacher extends CActiveRecord
{
    const SHOW = 1;
    const HIDE = 0;
    const ACTIVE = 0;
    const DELETED = 1;

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
            array('user_id', 'unique', 'message' => 'Такий користувач уже призначений співробітником'),
            array('first_name_en, middle_name_en, last_name_en,first_name_ru,
             middle_name_ru,last_name_ru, user_id', 'required', 'message' => 'Поле не може бути пустим'),
            array('rate_knowledge, rate_efficiency, rate_relations, user_id, isPrint', 'numerical', 'integerOnly' => true),
            array('first_name_en, middle_name_en, last_name_en', 'match', 'pattern' => '/^([a-zA-Z0-9_ ])+$/', 'message' => 'Недопустимі символи!'),
            array('first_name_ru, middle_name_ru, last_name_ru', 'match', 'pattern' => '/^([а-яА-ЯёЁ ])+$/u', 'message' => 'Недопустимі символи!'),
            array('profile_text_first,profile_text_short,profile_text_last', 'safe'),
            // The following rule is used by search().
            array('profile_text_first, profile_text_short, profile_text_last, rate_knowledge, rate_efficiency,
            rate_relations, user_id, isPrint, first_name_en, middle_name_en, last_name_en,first_name_ru, middle_name_ru,
            last_name_ru, cancelled',
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
            'user' => array(self::BELONGS_TO, 'StudentReg', 'user_id'),
            'modules' => array(self::MANY_MANY, 'Module', 'teacher_module(idTeacher, idModule)'),
            'responses' => array(self::MANY_MANY, 'Response', 'teacher_response(id_teacher, id_response)'),
            'modulesActive' => array(self::MANY_MANY, 'Module', 'teacher_module(idTeacher, idModule)',
                'condition'=>'modulesActive_modulesActive.end_time IS NULL and modulesActive.cancelled = '.Module::ACTIVE),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'profile_text_first' => 'Текст профілю (1)',
            'profile_text_short' => 'Короткий опис (сторінка викладачів)',
            'profile_text_last' => 'Текст профілю (2)',
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
            'cancelled' => 'Видалений',
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
        $criteria->compare('profile_text_first', $this->profile_text_first, true);
        $criteria->compare('profile_text_short', $this->profile_text_short, true);
        $criteria->compare('profile_text_last', $this->profile_text_last, true);
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
        $criteria->compare('cancelled', $this->cancelled, true);

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

    public function behaviors() {
        return [
            'ngTable' => [
                'class' => 'NgTableProviderTeacher'
            ]
        ];
    }


    public function primaryKey(){
        return 'user_id';
    }

    public function getValidationErrors() {
        $errors=[];
        foreach($this->getErrors() as $key=>$attribute){
            foreach($attribute as $error){
                array_push($errors,$error);
            }
        }
        return implode(", ", $errors);
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

            $teacher->updateByPk($teacher->user_id, array('rate_knowledge' => $knowledgeAve));
            $teacher->updateByPk($teacher->user_id, array('rate_efficiency' => $behaviorAve));
            $teacher->updateByPk($teacher->user_id, array('rate_relations' => $motivationAve));
            $teacher->updateByPk($teacher->user_id, array('rating' => round(($knowledgeAve + $behaviorAve + $motivationAve) / 3)));
        } else {
            $teacher->updateByPk($teacher->user_id, array('rate_knowledge' => 0));
            $teacher->updateByPk($teacher->user_id, array('rate_efficiency' => 0));
            $teacher->updateByPk($teacher->user_id, array('rate_relations' => 0));
            $teacher->updateByPk($teacher->user_id, array('rating' => 0));
        }
    }

    public static function updateFirstText($id, $firstText)
    {
        $teacher=Teacher::model()->findByPk($id);
        $teacher->profile_text_first=$firstText;
        return $teacher->update('profile_text_first');
    }

    public static function updateSecondText($id, $secondText)
    {
        $teacher=Teacher::model()->findByPk($id);
        $teacher->profile_text_last=$secondText;
        return $teacher->update('profile_text_last');
    }


    public static function getAllTeachersId()
    {
        $teachers = Teacher::model()->findAllBySql('select user_id from teacher order by user_id');
        $result = [];
        for ($i = 0; $i < count($teachers); $i++) {
            array_push($result, $teachers[$i]['user_id']);
        }
        return $result;
    }

    public function addConsult($numcon, $date, $idlecture)
    {
        $calendar = new Consultationscalendar();

        $user = Yii::app()->request->getPost('userid');
        if (Consultationscalendar::consultationFree($user, $numcon, $date)) {
            $calendar->start_cons = substr($numcon, 0, 5);
            $calendar->end_cons = substr($numcon, 6, 5);
            $calendar->date_cons = $date;
            $calendar->teacher_id = $this->user_id;
            $calendar->user_id = $user;
            $calendar->lecture_id = $idlecture;
            $calendar->save();
            $calendar = new Consultationscalendar();
        }
    }

    public static function getTeacherSchedule($teacher, $user, $tab)
    {
        switch ($tab) {
            case '1':
                $criteria = new CDbCriteria;
                $criteria->alias = 'consultationscalendar';
                if ($teacher)
                    $criteria->addCondition('user_id=' . $teacher->user_id);
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
                    $criteria->addCondition('user_id=' . $teacher->user_id);
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
        return $this->user->secondName . " " . $this->user->firstName . " " . $this->user->middleName;
    }

    public static function generateTeachersList()
    {
        $teachers = Teacher::model()->findAll();
        $result = [];
        foreach ($teachers as $key=>$teacher) {
            $result[$key]['id'] = $teacher->user_id;
            $result[$key]['alias'] = $teacher->user->firstName . " " . $teacher->user->secondName . ", " . $teacher->user->email;
        }
        return $result;
    }

    public static function generateTeacherRolesList($id)
    {
        $model = RegisteredUser::userById($id);
        return $model->getRoles();
    }

    public function lastName()
    {
        if (isset(Yii::app()->session['lg'])) {
            if (Yii::app()->session['lg'] == 'en' && $this->last_name_en != '') {
                return $this->last_name_en;
            }
            if (Yii::app()->session['lg'] == 'ru' && $this->last_name_ru != 'не указано') {
                return $this->last_name_ru;
            }
        }
        return $this->user->secondName;
    }

    public function getLastFirstName()
    {
        $last = $this->user->secondName;
        $first = $this->user->firstName;
        if (isset(Yii::app()->session['lg'])) {
            if (Yii::app()->session['lg'] == 'en') {
                if ($this->last_name_en != '') $last = $this->last_name_en;
                if ($this->first_name_en != '') $first = $this->first_name_en;
            }
            if (Yii::app()->session['lg'] == 'ru'){
                if ($this->last_name_ru != '' && $this->last_name_ru != 'не указано') $last = $this->last_name_ru;
                if ($this->first_name_ru != '' && $this->first_name_ru != 'не указано') $first = $this->first_name_ru;
            }
        }
        return $last . " " . $first;
    }

    public function firstName()
    {
        if (isset(Yii::app()->session['lg'])) {
            if (Yii::app()->session['lg'] == 'en' && $this->first_name_en != '') {
                return $this->first_name_en;
            }
            if (Yii::app()->session['lg'] == 'ru' && $this->first_name_ru != 'не указано') {
                return $this->first_name_ru;
            }
        }
        return $this->user->firstName;
    }

    public function middleName()
    {
        if (isset(Yii::app()->session['lg'])) {
            if (Yii::app()->session['lg'] == 'en' && $this->middle_name_en != '') {
                return $this->middle_name_en;
            }
            if (Yii::app()->session['lg'] == 'ru' && $this->middle_name_ru != 'не указано') {
                return $this->middle_name_ru;
            }
        }
        return $this->user->middleName;
    }

    public static function getAllTrainers()
    {
        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->join = 'LEFT JOIN trainer_student ut ON ut.trainer = user_id';

        return Teacher::model()->findAll($criteria);
    }

    public static function isTeacherAuthorModule($idUser, $idModule)
    {
        $user = RegisteredUser::userById($idUser);
        if($user->isAuthor()){
            $model = new Author();
            return !$model->checkModule($idUser, $idModule);
        }
        return false;
    }

    public static function isTeacherIdAuthorModule($idTeacher, $idModule)
    {
        $author = TeacherModule::model()->findByAttributes(
            array('idTeacher'=>$idTeacher,'idModule'=>$idModule), 'end_time IS NULL'
        );
        if (isset($author)) return true; else return false;
    }

    public function getStatus()
    {
        if ($this->isPrint)
            return 'видимий';
        else return 'невидимий';
    }

    public static function teachersList()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'cancelled = '.Teacher::ACTIVE;
        $users = Teacher::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($users as $record) {
            $row = array();
            $row["name"]["id"] = $record->user_id;
            $row["name"]["name"] = $record->user->secondName." ".$record->user->firstName." ".$record->user->middleName;
            $row["name"]["title"] = addslashes($record->user->secondName." ".$record->user->firstName." ".$record->user->middleName);
            $row["email"]["title"] = $record->user->email;
            $row["email"]["url"] = $row["name"]["url"] = Yii::app()->createUrl('/_teacher/user/index',
                array('id' => $record->user_id));
            if($record->isShow()){
                $row["status"] = "видимий";
                $row["changeStatus"]["title"] = "приховати";
                $row["changeStatus"]["link"] = Yii::app()->createUrl("/_teacher/_admin/teachers/delete", array('id'=>$record->user_id));
            } else {
                $row["status"] = 'невидимий';
                $row["changeStatus"]["title"] = "показати";
                $row["changeStatus"]["link"] = Yii::app()->createUrl("/_teacher/_admin/teachers/restore", array("id"=>$record->user_id));
            }
            $row["mailto"] = Yii::app()->createUrl('/cabinet/#/newmessages/receiver/').$record->user_id;

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public function avatar(){
        return $this->user->avatar;
    }

    public function skype(){
        return $this->user->skype;
    }

    public function email(){
        return $this->user->email;
    }

    public function phone(){
        return $this->user->phone;
    }

    public function isShow(){
        return $this->isPrint == Teacher::SHOW;
    }

    public function isHide(){
        return $this->isPrint == Teacher::HIDE;
    }

    public function setShowMode(){
        $this->isPrint = Teacher::SHOW;
        return $this->save();
    }

    public function setHideMode(){
        $this->isPrint = Teacher::HIDE;
        return $this->save();
    }

    public function isActive(){
        return $this->cancelled == Teacher::ACTIVE;
    }

    public function isDeleted(){
        return $this->cancelled == Teacher::DELETED;
    }

    public function setActive(){
        $this->isPrint = Teacher::ACTIVE;
        $this->save();
    }

    public function setDeleted(){
        $this->isPrint = Teacher::DELETED;
        $this->save();
    }

    public function changeVisibleStatus(){
        if($this->isShow()){
            return $this->setHideMode();
        } else {
            return $this->setShowMode();
        }
    }

    public static function teachersByQuery($query)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, phone, skype, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t ON t.user_id = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and t.cancelled='.Teacher::ACTIVE);
        $data = StudentReg::model()->findAll($criteria);
        $result = array();
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName." ".$model->firstName." ".$model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["tel"] = $model->phone;
            $result["results"][$key]["skype"] = $model->skype;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public static function teachersByQueryAndModule($query, $module)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, phone, skype, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher_consultant_module tcm ON tcm.id_teacher = s.id';
        $criteria->addCondition('tcm.id_teacher IS NOT NULL and end_date IS NULL and tcm.id_module='.$module);
        $criteria->group = 's.id';
        $data = StudentReg::model()->findAll($criteria);
        $result = array();
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName." ".$model->firstName." ".$model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["tel"] = $model->phone;
            $result["results"][$key]["skype"] = $model->skype;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public static function teacherConsultantsByQueryAndModule($query, $module)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, phone, skype, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN user_teacher_consultant utc ON utc.id_user = s.id';
        $criteria->join .= ' LEFT JOIN teacher_consultant_module tcm ON tcm.id_teacher = utc.id_user';
        $criteria->addCondition('utc.id_user IS NOT NULL and utc.end_date IS NULL and tcm.end_date IS NULL and s.cancelled ='.StudentReg::ACTIVE .' and tcm.id_module = '.$module);
        $data = StudentReg::model()->findAll($criteria);

        $result = array();
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName." ".$model->firstName." ".$model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["tel"] = $model->phone;
            $result["results"][$key]["skype"] = $model->skype;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public static function usersWithoutCoworkersByQuery($query){
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, phone, skype, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t ON t.user_id = s.id';
        $criteria->addCondition('t.user_id IS NULL');
        $data = StudentReg::model()->findAll($criteria);

        $result = array();
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName." ".$model->firstName." ".$model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["tel"] = $model->phone;
            $result["results"][$key]["skype"] = $model->skype;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }
}
