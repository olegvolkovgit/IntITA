<?php

/**
 * This is the model class for table "user_content_manager".
 *
 * The followings are the available columns in table 'user_content_manager':
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class UserContentManager extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_content_manager';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, start_date', 'required'),
            array('id_user', 'numerical', 'integerOnly' => true),
            array('end_date', 'safe'),
            // The following rule is used by search().
            array('id_user, start_date, end_date', 'safe', 'on' => 'search'),
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
            'idUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
        );
    }
    public function primaryKey()
    {
        return array('id_user', 'start_date');
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_user' => 'Id User',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
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

        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserContentManager the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string
     */
    public static function contentManagersList()
    {
        $sql = 'select * from user as u, user_content_manager as ua where u.id = ua.id_user';
        $admins = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($admins as $record) {
            $row = array();
            $row["id"]=$record["id"];
            $row["name"]["name"] = trim($record["secondName"] . " " . $record["firstName"] . " " . $record["middleName"]);
            $row["name"]["title"] = addslashes($record["secondName"] . " " . $record["firstName"] . " " . $record["middleName"]);
            $row["email"]["title"] = $record["email"];
            $row["email"]["url"] = $row["name"]["url"] = Yii::app()->createUrl('/_teacher/_admin/teachers/showTeacher',
                array('id' => $record['id']));
            $row["register"] = ($record["start_date"] > 0) ? date("d.m.Y", strtotime($record["start_date"])) : "невідомо";
            $row["cancelDate"] = ($record["end_date"]) ? date("d.m.Y", strtotime($record["end_date"])) : "";
            $row["profile"] = Config::getBaseUrl() . "/profile/" . $record["id"];
            $row["mailto"] = Yii::app()->createUrl('/_teacher/cabinet/index', array(
                'scenario' => 'message',
                'receiver' => $record["id"]
            ));
            $row["cancel"] = Yii::app()->createUrl('/_teacher/_admin/users/cancelRole');
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }


    public function counterOfModulesInCourse($id)
    {

        $sql = 'SELECT count(*) from course_modules where id_course=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();

        return $result;
    }

    /**
     * @param $id
     * @return int
     */
    public function counterOfLessonsInCourse($id)
    {

        $sql = 'SELECT id_module from course_modules where id_course=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$result) return 0;
        $arrayOfIdModules = [];
        foreach ($result as $key => $value) {
            $arrayOfIdModules[$key] = $value['id_module'];
        }
        $stringOfIdModules = join(',', $arrayOfIdModules);
        $sql2 = 'SELECT SUM(lesson_count) FROM `module`  where `module_ID` IN (' . $stringOfIdModules . ')';

        $result2 = Yii::app()->db->createCommand($sql2)->queryScalar();
        return $result2;
    }

    /**
     * @param $id
     * @return int
     */
    public function counterOfVideosInCourse($id)
    {

        $sql = 'SELECT id_module from course_modules where id_course=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$result) return 0;
        $arrayOfIdModules = [];
        foreach ($result as $key => $value) {
            $arrayOfIdModules[$key] = $value['id_module'];
        }
        $stringOfIdModules = join(',', $arrayOfIdModules);
        $sql2 = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on
		`lectures`.`id` = `lecture_element`.`id_lecture` where `lecture_element`.`id_type`=' . LectureElement::VIDEO . ' and `lectures`.`idModule` in (' . $stringOfIdModules . ')';
        $result2 = Yii::app()->db->createCommand($sql2)->queryScalar();

        return $result2;
    }

    /**
     * @param $id
     * @return int
     */
    public function counterOfTasksInCourse($id)
    {

        $sql = 'SELECT id_module from course_modules where id_course=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$result) return 0;
        $arrayOfIdModules = [];
        foreach ($result as $key => $value) {
            $arrayOfIdModules[$key] = $value['id_module'];
        }
        $stringOfIdModules = join(',', $arrayOfIdModules);
        $sql2 = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_element`.`id_lecture` where `lecture_element`.`id_type` IN (' . LectureElement::TASK . ',' . LectureElement::PLAIN_TASK . ',
 		' . LectureElement::SKIP_TASK . ',' . LectureElement::TEST . ',' . LectureElement::FINAL_TEST . ') and `lectures`.`idModule` in (' . $stringOfIdModules . ')';
        $result2 = Yii::app()->db->createCommand($sql2)->queryScalar();
        return $result2;
    }

    /**
     * @param $id
     * @return int
     */
    public function counterOfPartsInCourse($id)
    {
        $sql = 'SELECT id_module from course_modules where id_course=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$result) return 0;
        $arrayOfIdModules = [];
        foreach ($result as $key => $value) {
            $arrayOfIdModules[$key] = $value['id_module'];
        }
        $stringOfIdModules = join(',', $arrayOfIdModules);
        $sql2 = 'SELECT count(*) FROM `lecture_page` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_page`.`id_lecture` where  `lectures`.`idModule` in (' . $stringOfIdModules . ')';
        $result2 = Yii::app()->db->createCommand($sql2)->queryScalar();
        return $result2;
    }

    public function counterOfRevisionsInCourse($id)
    {
        $sql = 'SELECT id_module from course_modules where id_course=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryColumn();
        if (!$result) return 0;
        $counter = 0;
        foreach ($result as $value){
            $result2 = UserContentManager::counterOfRevisionsInModule($value);
            $counter += $result2;
        }

        return $counter;
    }

    public function counterOfLessonsInModule($id)
    {

        $sql = 'SELECT count(*) FROM `lectures` WHERE idModule=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function counterOfVideosInModule($id)
    {

        $sql = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on
		`lectures`.`id` = `lecture_element`.`id_lecture` where `lecture_element`.`id_type`=' . LectureElement::VIDEO . ' and `lectures`.`idModule`=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function counterOfTasksInModule($id)
    {
        $sql1 = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_element`.`id_lecture` where `lecture_element`.`id_type` IN (' . LectureElement::TASK . ',' . LectureElement::PLAIN_TASK . ', 
 		'. LectureElement::TEST . ',' . LectureElement::FINAL_TEST . ') and `lectures`.`idModule`=' . $id;
        $sql2 = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_element`.`id_lecture` where `lecture_element`.`id_type` IN ('. LectureElement::SKIP_TASK . ') and `lectures`.`idModule`=' . $id;
        $result1 = Yii::app()->db->createCommand($sql1)->queryScalar();
        $result2 = Yii::app()->db->createCommand($sql2)->queryScalar()/2;
        $result=$result1+$result2;

        return $result;
    }

    /**
     * @param $idLesson
     * @param $idModule
     * @return mixed
     */
    public function counterOfTasksInLesson($idLesson, $idModule)
    {

        $sql1 = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_element`.`id_lecture` where `lecture_element`.`id_type` IN (' . LectureElement::TASK . ',' . LectureElement::PLAIN_TASK . ',
 		' . LectureElement::TEST . ',' . LectureElement::FINAL_TEST . ') and `lectures`.`idModule`=' . $idModule . ' AND `lectures`.`id`=' . $idLesson;
        $sql2 = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_element`.`id_lecture` where `lecture_element`.`id_type` IN ('. LectureElement::SKIP_TASK . ') and `lectures`.`idModule`=' . $idModule . ' AND `lectures`.`id`=' . $idLesson;
        $result1 = Yii::app()->db->createCommand($sql1)->queryScalar();
        $result2 = Yii::app()->db->createCommand($sql2)->queryScalar()/2;
        $result=$result1+$result2;

        return $result;
    }

    /**
     * @param $idLesson
     * @param $idModule
     * @return mixed
     */
    public function counterOfPartsInLesson($idLesson, $idModule)
    {

        $sql = 'SELECT count(*) FROM `lecture_page` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_page`.`id_lecture` where  `lectures`.`idModule`=' . $idModule . ' AND `lectures`.`id`=' . $idLesson;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    /**
     * @param $idLesson
     * @param $idModule
     * @return mixed
     */
    public function counterOfVideosInLesson($idLesson, $idModule)
    {

        $sql = 'SELECT count(*) FROM `lecture_element` LEFT JOIN `lectures` on
		`lectures`.`id` = `lecture_element`.`id_lecture` where `lecture_element`.`id_type`=' . LectureElement::VIDEO . ' and `lectures`.`idModule`=' . $idModule . ' AND `lectures`.`id`=' . $idLesson;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    /**
     * @param $idLesson
     * @return int
     */
    public function counterOfWordsInLesson($idLesson)
    {

        $sql = 'SELECT * FROM `lecture_element`  where `id_type` IN (' . LectureElement::INSTRUCTION . ',
 		' . LectureElement::CODE . ',' . LectureElement::TEXT . ',' . LectureElement::EXAMPLE . ')  AND `lecture_element`.`id_lecture`=' . $idLesson;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $counter = 0;
        foreach ($result as $record) {
            $words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $record['html_block'], 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $counter += count($words);
        }
        return $counter;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function counterOfPartsInModule($id)
    {

        $sql = 'SELECT count(*) FROM `lecture_page` LEFT JOIN `lectures` on `lectures`.`id`
 		= `lecture_page`.`id_lecture` where  `lectures`.`idModule`=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    /**
     * @param $idPart
     * @param $idLesson
     * @return bool
     */
    public function counterOfRevisionsInModule($id)
    {
        $sql = 'SELECT count(*) FROM `vc_lecture` where  `vc_lecture`.`id_module`=' . $id;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();

        return $result;
    }

    public function existOfVideoInPart($idPart, $idLesson)
    {

        $sql = 'SELECT video FROM `lecture_page` where  `lecture_page`.`id_lecture`=' . $idLesson . ' AND `lecture_page`.`id` =' . $idPart;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * @param $idPart
     * @param $idLesson
     * @return bool
     */
    public function existOfTestInPart($idPart, $idLesson)
    {

        $sql = 'SELECT quiz FROM `lecture_page` where  `lecture_page`.`id_lecture`=' . $idLesson . ' AND `lecture_page`.`id` =' . $idPart;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * @param $idBlock
     * @param $idLesson
     * @return int
     */
    public function counterOfWordsInPart($idBlock, $idLesson)
    {
        $sql2 = 'SELECT * FROM lecture_element_lecture_page WHERE page=' . $idBlock;
        $result2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (!$result2) return 0;
        $arrayOfIdBlocks = [];
        foreach ($result2 as $key => $value) {
            $arrayOfIdBlocks[$key] = $value['element'];
        }
        $stringOfIdBlocks = join(',', $arrayOfIdBlocks);
        $sql = 'SELECT * FROM `lecture_element`  where `id_type` IN (' . LectureElement::INSTRUCTION . ',
 		' . LectureElement::CODE . ',' . LectureElement::TEXT . ',' . LectureElement::EXAMPLE . ')
 		 AND `lecture_element`.`id_lecture`=' . $idLesson . ' and `id_block` IN (' . $stringOfIdBlocks . ')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $counter = 0;
        foreach ($result as $record) {

            $words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $record['html_block'], 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $counter += count($words);

        }
        return $counter;
    }

    /**
     * @param $id
     * @return int|string
     */
    public static function listOfModules($id, $filter_id)
    {
        if ($id) {
            $return = array('data' => array());
            $sql2 = 'select * from course_modules where id_course=' . $id;
            $course2 = Yii::app()->db->createCommand($sql2)->queryAll();
            if(!$course2){
                return json_encode($return);
            }
            $arrayOfIdModules = [];
            foreach ($course2 as $key => $value) {
                $arrayOfIdModules[$key] = $value['id_module'];
            }
            $stringOfIdModules = join(',', $arrayOfIdModules);
            $sql = 'select * from module where module_ID in (' . $stringOfIdModules . ')';
            $course = Yii::app()->db->createCommand($sql)->queryAll();
            if(!$course){
                return json_encode($return);
            }
        } else {
            $return = array('data' => array());
            $sql = 'select * from module';
            $course = Yii::app()->db->createCommand($sql)->queryAll();
            if(!$course){
                return json_encode($return);
            }

        }
   

        foreach ($course as $record) {
            $row = array();
            $row["name"]["title"] = CHtml::encode($record['title_ua']);
            $row["name"]["url"] = $record["module_ID"];
            $row["lesson"]["title"] = UserContentManager::counterOfLessonsInModule($record["module_ID"]);
            $row["video"] = UserContentManager::counterOfVideosInModule($record["module_ID"]);
            $row["test"] = UserContentManager::counterOfTasksInModule($record["module_ID"]);
            $row["part"] = UserContentManager::counterOfPartsInModule($record["module_ID"]);
            $row["revision"] = UserContentManager::counterOfRevisionsInModule($record["module_ID"]);
            if (($filter_id == 1 && !$row['video']) || ($filter_id == 2 && !$row['test']) || ($filter_id == 3 && !$row['test'] && !$row['video'] ) || ($filter_id == 0))
                array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    /**
     * @return string
     */
    public static function listOfCourses($filter_id)
    {

        $sql = "SELECT * FROM course";
        $course = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($course as $record) {
            $row = array();
            $row["name"]["title"] = CHtml::encode($record['title_ua']);
            $row["name"]["url"] = $record["course_ID"];
            if ($record["modules_count"] === NULL)
                $record["modules_count"] = 0;
            $row["module"] = UserContentManager::counterOfModulesInCourse($record["course_ID"]);
            $row["lesson"] = UserContentManager::counterOfLessonsInCourse($record["course_ID"]);
            $row["video"] = UserContentManager::counterOfVideosInCourse($record["course_ID"]);
            $row["test"] = UserContentManager::counterOfTasksInCourse($record["course_ID"]);
            $row["part"] = UserContentManager::counterOfPartsInCourse($record["course_ID"]);
            $row["revision"] = UserContentManager::counterOfRevisionsInCourse($record["course_ID"]);
            if (($filter_id == 1 && !$row['video']) || ($filter_id == 2 && !$row['test']) || ($filter_id == 3 && !$row['test'] && !$row['video'])|| ($filter_id == 0))
                array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    /**
     * @param $idModule
     * @return string
     */
    public static function listOfLessons($idModule)
    {
        $sql = 'select * from lectures where idModule=' . $idModule;
        $course = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());
        if(!$course){
            return json_encode($return);
        }
        foreach ($course as $record) {
            $row = array();
            $row["name"]["title"] = $record['title_ua'];
            $row["name"]["url"] = $record["id"];
            $row["parts"] = UserContentManager::counterOfPartsInLesson($record["id"], $idModule);
            $row["video"] = UserContentManager::counterOfVideosInLesson($record["id"], $idModule);
            $row["tests"] = UserContentManager::counterOfTasksInLesson($record["id"], $idModule);
            $row["word"] = UserContentManager::counterOfWordsInLesson($record["id"]);
            $row["word"] = UserContentManager::counterOfWordsInLesson($record["id"]);
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    /**
     * @param $idLesson
     * @return string
     */
    public static function listOfParts($idLesson)
    {
        $return = array('data' => array());
        $sql = 'select * from lecture_page where id_lecture=' . $idLesson;
        $parts = Yii::app()->db->createCommand($sql)->queryAll();
        if(!$parts){
            return json_encode($return);
        }
        $sql2 = 'select lectures.idModule,lectures.order,course_modules.id_course  from lectures left JOIN course_modules on course_modules.id_module=lectures.idModule where lectures.id=' . $idLesson . ' group by `idModule`';
        $result = Yii::app()->db->createCommand($sql2)->queryAll();
        if(!$result){
            return json_encode($return);
        }

        foreach ($parts as $record) {
            $row = array();
            $row["name"]["title"] = $record['page_title'];
            $row["name"]["lecture_order"] = $result[0]['order'];
            $row["name"]["page_order"] = $record['page_order'];
            $row["name"]["id_module"] = $result[0]['idModule'];
            $row["name"]["link"] = Yii::app()->createUrl("lesson/index", array("id" => $record["id_lecture"], "idCourse" => 0));
            if (UserContentManager::existOfVideoInPart($record["id"], $idLesson)) {
                $row["video"] = '<div style="padding-left: 40%"><img src="/images/icons/right.png"></div>';
            } else {
                $row["video"] = '<div style="padding-left: 40%"><img src="/images/icons/wrong.png"></div>';
            }
            if (UserContentManager::existOfTestInPart($record["id"], $idLesson)) {
                $row["test"] = '<div style="padding-left: 40%"><img src="/images/icons/right.png"></div>';
            } else {
                $row["test"] = '<div style="padding-left: 40%"><img src="/images/icons/wrong.png"></div>';
            }

            $row["word"] = UserContentManager::counterOfWordsInPart($record["id"], $idLesson);

                array_push($return['data'], $row);



        }
        return json_encode($return);
    }
}
