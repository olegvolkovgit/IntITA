<?php

/**
 * This is the model class for table "lectures".
 *
 * The followings are the available columns in table 'lectures':
 * @property integer $id
 * @property string $image
 * @property string $alias
 * @property integer $idModule
 * @property integer $order
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property integer $idType
 * @property integer $durationInMinutes
 * @property integer $preLecture
 * @property integer $nextLecture
 * @property integer $isFree
// * @property integer $rate
 * @property integer $understand_rating
 * @property integer $interesting_rating
 * @property integer $accessibility_rating
 * @property integer $verified
 *
 * The followings are the available model relations:
 * @property LectureType $type
 * @property Module $module
 */
class Lecture extends CActiveRecord
{
    const MAX_RAIT = 6;
    const FREE = 1;
    const PAID = 0;
    const NOVERIFIED = 0;
    const VERIFIED = 1;
    public $logo = array();
    public $oldLogo;
    public $module_title;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'lectures';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idModule, order, title_ua, durationInMinutes', 'required', 'message' => Yii::t('validation', '0576')),
            array('idModule, order, idType, verified', 'numerical', 'integerOnly' => true),
//            array('idModule, order, idType, rate, verified', 'numerical', 'integerOnly' => true),
            array('durationInMinutes', 'numerical', 'integerOnly' => true, 'min' => 0, "tooSmall" => Yii::t('validation', '057'), 'message' => Yii::t('validation', '0577')),
            array('image', 'length', 'max' => 255),
            array('alias', 'length', 'max' => 10),
            array('image', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true),
            array('title_ua, title_ru, title_en', 'length', 'max' => 255),
            array('title_ua', 'match', 'pattern' => "/".Yii::app()->params['titleUAPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('title_ru', 'match', 'pattern' => "/".Yii::app()->params['titleRUPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('title_en', 'match', 'pattern' => "/".Yii::app()->params['titleENPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            // The following rule is used by search().
            array('id, image, alias, idModule, order, title_ua, title_ru, title_en, idType, verified, durationInMinutes, isFree, ModuleTitle, understand_rating, interesting_rating, accessibility_rating', 'safe', 'on' => 'search'),
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
            'lectureEl' => array(self::HAS_MANY, 'LectureElement', 'id_lecture'),
            'ModuleTitle' => array(self::BELONGS_TO, 'Module', 'idModule'),
            'module' => array(self::BELONGS_TO, 'Module', 'idModule'),
            'type' => array(self::BELONGS_TO, 'LectureType', 'idType'),
            'pages' => array(self::HAS_MANY, 'LecturePage', 'id_lecture', 'order' => 'pages.page_order ASC'),
            'consultations'=>array(self::HAS_MANY,'Consultationscalendar', ['id'=>'id_lecture']),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'image' => 'Image',
            'alias' => 'Псевдонім',
            'idModule' => 'Модуль',
            'order' => 'Порядок',
            'title_ua' => 'Назва українською',
            'title_ru' => 'Назва російською',
            'title_en' => 'Назва англійською',
            'idType' => 'Тип',
            'isFree' => 'Безкоштовно',
            'durationInMinutes' => 'Тривалість лекції(хв)',
            'understand_rating' => 'Рейтинг заняття по зрозумiлостi',
            'interesting_rating' => 'Рейтинг заняття по цiкавостi',
            'accessibility_rating' => 'Рейтинг заняття по доступностi',
            'verified' => 'Підтверджено адміністратором',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('idModule', $this->idModule, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('t.title_ua', $this->title_ua, true);
        $criteria->compare('title_ru', $this->title_ru, true);
        $criteria->compare('title_en', $this->title_en, true);
        $criteria->compare('idType', $this->idType, true);
        $criteria->compare('isFree', $this->isFree, true);
        $criteria->compare('durationInMinutes', $this->durationInMinutes, true);
        $criteria->compare('understand_rating', $this->understand_rating);
        $criteria->compare('interesting_rating', $this->interesting_rating);
        $criteria->compare('accessibility_rating', $this->accessibility_rating);
        $criteria->compare('verified', $this->verified);

        $criteria->with = array('ModuleTitle');
        $criteria->compare('ModuleTitle.title_ua', $this->ModuleTitle, true);//???? ModuleTitle.module_name change on ModuleTitle.title_ua
        $criteria->addCondition('`order`>0');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '50',
            ),
            'sort' => array('attributes' => array(
                'defaultOrder' => array(
                    'order' => CSort::SORT_ASC,
                ),
                'ModuleTitle' => array(
                    'asc' => $expr = 'ModuleTitle.title_ua',
                    'desc' => $expr . ' DESC',
                ),
                'order' => array(
                    'asc' => $expr = '`order`',
                    'desc' => $expr . ' DESC',
                ),
                'title_ua' => array(
                    'asc' => $expr = 'title_ua',
                    'desc' => $expr . ' DESC',
                ),
                'title_ru' => array(
                    'asc' => $expr = 'title_ru',
                    'desc' => $expr . ' DESC',
                ),
                'title_en' => array(
                    'asc' => $expr = 'title_en',
                    'desc' => $expr . ' DESC',
                ),
                'idType' => array(
                    'asc' => $expr = 'idType',
                    'desc' => $expr . ' DESC',
                ),
                'isFree' => array(
                    'asc' => $expr = 'isFree',
                    'desc' => $expr . ' DESC',
                ),
            )),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Lecture the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function pagesList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('id_lecture=' . $this->id);
        $criteria->order = 'page_order ASC';
        return LecturePage::model()->findAll($criteria);
    }

    public function loadContent($id = 1)
    {
        $lectureElements = LectureElement::model()->findAll(array(
            'select' => 'id_lecture, block_order',
            'condition' => 'id_lecture =:id',
            'params' => array(':id' => $id),
            'order' => 'block_order ASC',
        ));

        if (count($lectureElements) == 0) {
            return false;
        } else {
            $contentList = array();
            for ($i = count($lectureElements); $i > 0; $i--) {
                array_push($contentList,
                    LectureElement::model()->findByPk(array('id_lecture' => $id, 'block_order' => $i))
                );
            }
            return $contentList;
        }

    }

    public function getLecturesTitles($id)
    {
        $list = Lecture::model()->findAllByAttributes(array('idModule' => $id));
        $titles = array();
        $titleParam = Lecture::getTypeTitleParam();
        foreach ($list as $item) {
            array_push($titles, $item->$titleParam);
        }
        return $titles;
    }

    public static function unableLecture($idLecture)
    {

        Lecture::model()->updateByPk($idLecture, array('order' => 0));
    }

    public static function getLessonCont($id)
    {
        $summary = [];

        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture_page';
        $criteria->addCondition('id_lecture=' . $id);
        $criteria->order = 'page_order ASC';
        $cont = LecturePage::model()->findAll($criteria);
        $i = 0;
        foreach ($cont as $type) {
            $summary[$i] = $type->page_title;
            $i++;
        }
        return $summary;
    }

    public function getAllLecturePages()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('id_lecture=' . $this->id);

        return LecturePage::model()->findAll($criteria);
    }

    public static function getTextList($idLecture, $order)
    {
        $idElement = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order))->id_block;

        $page = Yii::app()->db->createCommand()
            ->select('page')
            ->from('lecture_element_lecture_page')
            ->where('element=:element', array(':element' => $idElement))
            ->queryScalar();

        $model = LecturePage::model()->findByPk($page);
        return $model->getBlocksListById();
    }

    public static function getLectureIdByModuleOrder($idModule, $order)
    {
        return Lecture::model()->findByAttributes(array(
            'idModule' => $idModule,
            'order' => $order
        ));
    }

    public function getLectureByModuleOrder($order)
    {
        return Lecture::model()->findByAttributes(array(
            'idModule' => $this->module->module_ID,
            'order' => $order
        ));
    }

    public static function getAllNotVerifiedLectures()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule > 0 and `order` > 0 and `verified` = 0');

        return Lecture::model()->findAll($criteria);
    }

    public function isVerified()
    {
        return $this->verified;
    }

    public static function getAllVerifiedLectures()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule > 0 and `order` > 0 and `verified` = 1');

        return Lecture::model()->findAll($criteria);
    }

    public function isFinished($idUser)
    {
        $passedPages = $this->getFinishedPages($idUser);
        $passedLecture = Lecture::isPassedLecture($passedPages);

        return $passedLecture;
    }

    public function getFinishedPages($user)
    {
        $pages = $this->pages;

        $result = [];
        for ($i = 0, $count = count($pages); $i < $count; $i++) {
            $result[$i]['order'] = $pages[$i]->page_order;
            $result[$i]['isDone'] = LecturePage::isQuizDone($pages[$i]->quiz, $user);
            $result[$i]['title'] = $pages[$i]->page_title;

            if (LecturePage::isQuizDone($pages[$i]->quiz, $user) == false) {
                $result = LecturePage::setNoAccessPages($result, $count, $i, $pages);
                break;
            }
        }
        return $result;
    }

    public static function isPassedLecture($passedPages)
    {
        for ($i = 0, $count = count($passedPages); $i < $count; $i++) {
            if (!$passedPages[$i]['isDone']) return false;
        }
        return true;
    }

    public static function getLectureDuration($id)
    {
        return Lecture::model()->findByPk($id)->durationInMinutes . Yii::t('lecture', '0076');
    }

    public static function getLectureTitle($id)
    {
        $titleParam = Lecture::getTypeTitleParam();
        $title = Lecture::model()->findByPk($id)->$titleParam;
        if ($title == '') {
            return CHtml::encode(Lecture::model()->findByPk($id)->title_ua);
        } else {
            return CHtml::encode($title);
        }
    }

    public function accessPages($user, $editMode = 0, $isAdmin = 0)
    {
        /*Sort page_order by Ascending*/
        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture_page';
        $criteria->order = 'page_order ASC';
        $criteria->condition = 'id_lecture=' . $this->id;

        $pages = LecturePage::model()->findAll($criteria);

        $result = [];
        if ($editMode || $isAdmin) {
            for ($i = 0, $count = count($pages); $i < $count; $i++) {
                $result[$i]['order'] = $pages[$i]->page_order;
                $result[$i]['isDone'] = true;
                $result[$i]['isQuizDone'] = LecturePage::isQuizDone($pages[$i]->quiz, $user);
                $result[$i]['title'] = $pages[$i]->page_title;
            }
        } else {
            for ($i = 0, $count = count($pages); $i < $count; $i++) {
                $result[$i]['order'] = $pages[$i]->page_order;
                $result[$i]['isDone'] = LecturePage::isQuizDone($pages[$i]->quiz, $user);
                $result[$i]['isQuizDone'] = $result[$i]['isDone'];
                $result[$i]['title'] = $pages[$i]->page_title;

                if (LecturePage::isQuizDone($pages[$i]->quiz, $user) == false) {
                    $result[$i]['isDone'] = true;
                    $result = LecturePage::setNoAccessPages($result, $count, $i + 1, $pages);
                    break;
                }
            }
        }

        return $result;
    }


    public function title()
    {
        $titleParam = "title_" . CommonHelper::getLanguage();
        if ($this->$titleParam == '') {
            return CHtml::encode($this->title_ua);
        } else {
            return CHtml::encode($this->$titleParam);
        }
    }

    public function titleForBreadcrumbs()
    {
        $titleParam = "title_" . CommonHelper::getLanguage();
        if ($this->$titleParam == '') {
            return $this->title_ua;
        } else {
            return $this->$titleParam;
        }
    }

    public static function getLectureTypeTitle($idType)
    {
        if (LectureType::model()->exists('id=:idType', array(':idType' => $idType))) {
            $titleParam = Lecture::getTypeTitleParam();
            return LectureType::model()->findByPk($idType)->$titleParam;
        } else {
            return '';
        }
    }

    public static function getTypeTitleParam()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $title;
    }

    public function nextLectureId()
    {
        $sqlNextLectureId =
            "SELECT id FROM lectures WHERE idModule=" . $this->idModule . " AND `order` > " . $this->order . " ORDER BY `order` ASC LIMIT 1";
        $nextLectureId = Yii::app()->db->createCommand($sqlNextLectureId)->queryScalar();
        return $nextLectureId;
    }

    public function saveLectureContent()
    {

        foreach ($this->pages as $key => $page) {
            $textList = $page->getBlocksListById();
            $dataProvider = LectureElement::getLectureText($textList);
            $langs = ['ua', 'ru', 'en'];
            $types = ['video', 'text', 'quiz'];
            foreach ($langs as $lang) {
                $messages = Translate::getLectureContentMessagesByLang($lang);
                foreach ($types as $type) {
                    switch ($type) {
                        case 'video':
                            $html = Yii::app()->controller->renderPartial('/lesson/_videoTab',
                                array('page' => $page, 'message' => $messages['639']), true);
                            break;
                        case 'text';
                            $html = Yii::app()->controller->renderPartial('/lesson/_textListTab',
                                array('dataProvider' => $dataProvider, 'editMode' => 0, 'user' => 49, 'message' => $messages['422']), true);
                            break;
                        case 'quiz':
                            $html = Yii::app()->controller->renderPartial('/lesson/_quiz',
                                array('page' => $page, 'editMode' => 0, 'user' => 49, 'message' => $messages['89']), true);
                            break;
                        default:
                            $html = '';
                            break;
                    };
                    $file = StaticFilesHelper::pathToLecturePageHtml($this->idModule, $this->id, $key + 1, $lang, $type);
                    file_put_contents($file, $html);
                }
            }
        }
    }

    public function deleteLectureContent()
    {
        $path = StaticFilesHelper::pathToDeleteLecturePageHtml($this->idModule, $this->id);
        if ($handle = opendir($path)) {
            while (($file = readdir($handle))) {
                if (is_file("$path/$file"))
                    unlink("$path/$file");
            }
            closedir($handle);
        }
    }

    public function removeOldTemplatesDirectory()
    {
        $dir = StaticFilesHelper::pathToDeleteLecturePageHtml($this->idModule, $this->id);
        if (file_exists(Yii::getpathOfAlias('webroot') . '/' . $dir) &&
            !file_exists(Yii::getpathOfAlias('webroot') . '/' . $dir . '/images')
        ) {
            if ($objs = glob($dir . "/*")) {
                foreach ($objs as $obj) {
                    is_dir($obj) ? removeDirectory($obj) : unlink($obj);
                }
            }
            rmdir($dir);
        }
    }

    public static function lectureToTemplate($id)
    {
        $lecture = Lecture::model()->findByPk($id);
        if ($lecture && $lecture->verified == 1) {
            $lecture->saveLectureContent();
        }
    }

    public static function setLectureNotVerified($id)
    {
        $lecture = Lecture::model()->findByPk($id);
        if ($lecture && $lecture->verified == 1) {
            $lecture->verified = 0;
            $lecture->save();
        }
    }

    public function isLastLecture()
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture';
        $criteria->order = '`order` DESC';
        $criteria->condition = 'idModule=' . $this->idModule . ' and `order`>0';
        if (isset(Lecture::model()->find($criteria)->id) && Lecture::model()->find($criteria)->id == $this->id)
            return true;
        else return false;
    }

    /**
     * @throws CDbException
     */
    public function decreaseOrderByOne()
    {
        $this->order--;
        $this->update(array('order'));
    }

    public  function getLecturesList($count, $page, $searchCondition, $sorting=null)
    {
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->join = 'LEFT JOIN module m on m.module_ID=t.idModule';
        $criteria->addCondition('t.idModule>0 and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' and t.`order` > 0');
        $criteria->order = 't.isFree DESC';
        $criteria->compare('t.title_ua', urldecode($searchCondition), true);
        $criteria->with = array('module','type');
        $criteria->compare('module.title_ua', urldecode($searchCondition), true,'OR');
        $countOfLectures = count(Lecture::model()->findAll($criteria));
        $criteria->offset = $page*$count -$count;
        $criteria->limit = $count;
        if ($sorting) {
            $order = '';
            foreach (array_keys($sorting) as $key)
                $order = $order . $key . ' ' . $sorting[$key];
            $criteria->order = $order;
        }
        return JsonForNgDatatablesHelper::returnJson($this->model()->findAll($criteria),null,$countOfLectures,['type','module']);
    }

    /*
     *
     * @param $type int (0 - not verified, 1 - verified)
     * @return JSON for table in admin
     */
    public static function getLecturesListByStatus($isVerified)
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'l';
        $criteria->join = 'LEFT JOIN module m on m.module_ID=l.idModule';
        $criteria->addCondition('l.idModule > 0 and l.`order` > 0 
        and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $criteria->addCondition('l.verified = ' . $isVerified);

        $lectures = Lecture::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($lectures as $record) {
            $row = array();
            $row["module"] = CHtml::encode(($record->idModule) ? $record->ModuleTitle->title_ua : "");
            $row["lesson_url"] = Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0));
            $row["order"] = $record->order;
            $row["title"] = $record->title_ua;
            $row["type"] = $record->type->title_ua;
            $row["id"] = $record->id;

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function getAllLecturesList()
    {
        $criteria = new CDbCriteria();

        $criteria->addCondition('idModule > 0 and `order` > 0');
        $lectures = Lecture::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($lectures as $record) {
            $row = array();
            $row["module"] = CHtml::encode(($record->idModule) ? $record->ModuleTitle->title_ua : "");
            $row["lesson_url"] = Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0));
            $row["order"] = $record->order;
            $row["title"] = $record->title_ua;
            $row["type"] = $record->type->title_ua;
            $row["id"] = $record->id;

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function getOrganizationLecturesList($organization)
    {
        $criteria = new CDbCriteria();
        $criteria->alias='t';
        $criteria->join = 'LEFT JOIN module m on m.module_ID=t.idModule';
        $criteria->addCondition('t.idModule>0 and m.id_organization='.$organization.' and t.`order` > 0');
        $lectures = Lecture::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($lectures as $record) {
            $row = array();
            $row["module"] = CHtml::encode(($record->idModule) ? $record->ModuleTitle->title_ua : "");
            $row["lesson_url"] = Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0));
            $row["order"] = $record->order;
            $row["title"] = $record->title_ua;
            $row["type"] = $record->type->title_ua;
            $row["id"] = $record->id;

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public function setFree()
    {
        $this->isFree = self::FREE;
        if($this->module->id_organization==Yii::app()->user->model->getCurrentOrganization()->id)
            return $this->save();
    }

    public function setPaid()
    {
        $this->isFree = self::PAID;
        if($this->module->id_organization==Yii::app()->user->model->getCurrentOrganization()->id)
            return $this->save();
    }

    public function setVerified()
    {
        $this->verified = self::VERIFIED;
        if($this->module->id_organization==Yii::app()->user->model->getCurrentOrganization()->id)
            return $this->save();
    }

    public function setNoVerified()
    {
        $this->verified = self::NOVERIFIED;
        if($this->module->id_organization==Yii::app()->user->model->getCurrentOrganization()->id)
            return $this->save();
    }

    public function createNewBlockCKE($htmlBlock, $idType, $pageOrder)
    {

        $model = new LectureElement();
        $model->id_lecture = $this->id;
        $model->block_order = LectureElement::getNextOrder($this->id);
        $model->html_block = $htmlBlock;
        $model->id_type = $idType;
        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'block_order' => $model->block_order))->id_block;

        LecturePage::addTextBlock($id, $pageId);
    }

    /**
     * Shifts up lesson element.
     * @param $elementOrder - order of element to be shifted
     * @throws CDbException
     */
    public function upElement($elementOrder)
    {
        $criteria = new CDbCriteria();
        $criteria->order = "block_order ASC";
        $criteria->join = "LEFT JOIN lecture_element_lecture_page ON element=id_block";
        $criteria->condition = "id_lecture=:id_lecture " .
            "AND lecture_element_lecture_page.page = " .
            "(SELECT page FROM lecture_element_lecture_page WHERE element=" .
            "(SELECT id_block FROM lecture_element WHERE id_lecture=:id_lecture AND block_order=:block_order))";
        $criteria->params = array(':id_lecture' => $this->id, ':block_order' => $elementOrder);

        $lectureElementModels = LectureElement::model()->findAll($criteria);

        foreach ($lectureElementModels as $key => $element) {
            if ($element->block_order == $elementOrder && $key != 0) {
                $prevElement = $lectureElementModels[$key - 1];

                $swapOrder = $prevElement->block_order;
                $prevElement->block_order = $element->block_order;
                $element->block_order = $swapOrder;

                $prevElement->update(array('block_order'));
                $element->update(array('block_order'));
                break;
            }
        }
    }

    /**
     * Shifts down lesson element.
     * @param $elementOrder - order of element to be shifted
     * @throws CDbException
     */
    public function downElement($elementOrder)
    {
        $criteria = new CDbCriteria();
        $criteria->order = "block_order ASC";
        $criteria->join = "LEFT JOIN lecture_element_lecture_page ON element=id_block";
        $criteria->condition = "id_lecture=:id_lecture " .
            "AND lecture_element_lecture_page.page = " .
            "(SELECT page FROM lecture_element_lecture_page WHERE element=" .
            "(SELECT id_block FROM lecture_element WHERE id_lecture=:id_lecture AND block_order=:block_order))";
        $criteria->params = array(':id_lecture' => $this->id, ':block_order' => $elementOrder);

        $lectureElementModels = LectureElement::model()->findAll($criteria);

        foreach ($lectureElementModels as $key => $element) {
            if ($element->block_order == $elementOrder && $key != count($lectureElementModels) - 1) {
                $nextElement = $lectureElementModels[$key + 1];

                $swapOrder = $nextElement->block_order;
                $nextElement->block_order = $element->block_order;
                $element->block_order = $swapOrder;

                $nextElement->update(array('block_order'));
                $element->update(array('block_order'));
                break;
            }
        }
    }

    /**
     * Returns $id_block of first occurrence of quiz in lecture
     * @return bool $id_block which is the quiz or false
     * @throws CDbException
     */
    public function getFirstQuiz()
    {
        $length = count($this->lectureEl);
        for ($i = 0; $i < $length; $i++) {
            $lecture = $this->lectureEl[$i];
            if ($lecture->isQuiz()) {
                return $lecture->id_block;
            }
        }
        return false;
    }

    /**
     * Returns $id_block of last occurrence of quiz in lecture
     * @return bool $id_block which is the quiz or false
     * @throws CDbException
     */
    public function getLastQuiz()
    {
        for ($i = count($this->lectureEl) - 1; $i >= 0; $i--) {
            $lecture = $this->lectureEl[$i];
            if ($lecture->isQuiz()) {
                return $lecture->id_block;
            }
        }
        return false;
    }

    public function createNewBlock($htmlBlock, $idType, $pageOrder)
    {
        $model = new LectureElement();
        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = LectureElement::getNextOrder(Yii::app()->request->getPost('idLecture'));
        $model->html_block = $htmlBlock;
        $model->id_type = $idType;
        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        LecturePage::addTextBlock($model->id_block, $pageId);
    }

    public function deleteLectureElement($elementOrder)
    {
        foreach ($this->lectureEl as $element) {
            if ($element->block_order == $elementOrder) {
                if ($element->id_type == LectureElement::TASK) {
                    Task::deleteTask($element->id_block);
                }
                Yii::app()->db->createCommand()->delete('lecture_element_lecture_page', 'element=:id', array(':id' => $element->id_block));
                $element->delete();
                return;
            }
        }
    }

    public function isFree()
    {
        return $this->isFree == Lecture::FREE;
    }

    public function freeLabel()
    {
        return ($this->isFree()) ? 'безкоштовна' : 'платна';
    }

    public function saveBlock($order, $content, $userId)
    {
        $lectureElement = LectureElement::model()->findByAttributes(array('id_lecture' => $this->id, 'block_order' => $order));
    }

    public function addVideo($htmlBlock, $pageOrder, $userId)
    {
        $lectureElement = new LectureElement();
        $lectureElement->id_lecture = $this->id;
        $lectureElement->block_order = 0;
        $lectureElement->html_block = $htmlBlock;
        $lectureElement->id_type = LectureElement::VIDEO;
        $lectureElement->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $lectureElement->id_lecture, 'page_order' => $pageOrder))->id;
        LecturePage::addVideo($pageId, $lectureElement->id_block);
    }

    public function deleteVideo($pageOrder, $userId)
    {
        $modelLecturePage = LecturePage::model()->findByAttributes(array('id_lecture' => $this->id, 'page_order' => $pageOrder));

        if ($modelLecturePage->video) {
            $element = LectureElement::model()->findByPk($modelLecturePage->video);
            LecturePage::model()->updateByPk($modelLecturePage->id, array('video' => NULL));

            $element->delete();
        }

    }

    public function lastLectureOrder()
    {
        $sqlLastOrder =
            "SELECT `order` FROM lectures WHERE idModule=" . $this->idModule . "  ORDER BY `order` DESC LIMIT 1";
        $lastLectureOrder = Yii::app()->db->createCommand($sqlLastOrder)->queryScalar();
        return $lastLectureOrder;
    }

    /**
     * Clear regular DB from lecture (pages and elements)
     * @throws CDbException
     */
    public function removeLectureRecords() {
        //remove lecture pages

        $lecturePages = LecturePage::model()->findAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id));

        $builder = Yii::app()->db->schema->getCommandBuilder();
        foreach ($lecturePages as $lecturePage) {
            $command = $builder->createDeleteCommand('lecture_element_lecture_page', new CDbCriteria(array(
                "condition" => "page=" . $lecturePage->id
            )));
            $command->query();
        }

        foreach ($lecturePages as $lecturePage) {
            $lecturePage->delete();
        }

        $lectureElements = LectureElement::model()->findAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id));

        $quizzes = [];

        foreach ($lectureElements as $lectureElement) {

            if ($lectureElement->isQuiz()) {
                if (!array_key_exists($lectureElement->id_type, $quizzes)) {
                    $quizzes[$lectureElement->id_type] = [];
                }
                array_push($quizzes[$lectureElement->id_type], $lectureElement->id_block);
            }
        }

        RevisionQuizFactory::deleteFromRegularDB($quizzes);

        $quizTypes = LectureElement::TEST . ', ' . LectureElement::TASK . ', ' . LectureElement::PLAIN_TASK . ', ' . LectureElement::SKIP_TASK;
        LectureElement::model()->deleteAll("id_lecture=:id_lecture AND id_type NOT IN ($quizTypes)", array(':id_lecture' => $this->id));

        $this->delete();
        $this->removeOldTemplatesDirectory();
    }

    public function lectureTypeSymbol()
    {
        switch ($this->idType) {
            case '2':
                return 'E';
                break;
            case '3':
            case '4':
                return 'P';
                break;
            default:
                return 'E';
                break;
        };
    }

    public function lectureTypeTooltip()
    {
        $param=Yii::app()->session["lg"]?"title_".Yii::app()->session["lg"]:"title_ua";
        switch ($this->idType) {
            case '2':
            case '3':
            case '4':
                return $this->type->$param;
                break;
            default:
                return LectureType::model()->findByPk(2)->$param;
                break;
        };
    }

    public function updateRatingLectures($rate, $ratingName){

        $oldRating = $this->$ratingName;

        if($oldRating == NULL){
            $this->$ratingName = $rate;
            $this->save();
            return;
        }

        $count = LecturesRating::model()->count('id_lecture = :id_lecture and '.$ratingName.' is not NULL', array(':id_lecture' => $this->id));
        $newRating = ($count*$oldRating + $rate)/($count + 1);

        $newRating = round($newRating);

        $this->$ratingName = $newRating;
        $this->save();
    }

    public static function getAverageRatingLecture($idModule){
        $result = array();
        $id_user = Yii::app()->user->getId();
        $module = Module::model()->findByPk($idModule);
        $isRatingExist = ModuleRating::model()->exists('id_module=:id_module and `id_module_revision`=:id_module_revision and `id_user`=:id_user',
                                                        array('id_module' => $idModule,
                                                              'id_module_revision' => $module->id_module_revision,
                                                              'id_user' => $id_user
                                                            ));
        if($isRatingExist){
            $oldRating = ModuleRating::model()->findByAttributes(array('id_user' => $id_user, 'id_module' => $idModule));
            $result['understand_rating'] = $oldRating->understand_rating;
            $result['interesting_rating'] = $oldRating->interesting_rating;
            $result['accessibility_rating'] = $oldRating->accessibility_rating;
            $result['comment'] = $oldRating->comment;

            return json_encode($result);

        }else{
            $criteria = new CDbCriteria();
            $criteria->alias = 'lr';
            $criteria->join = 'LEFT JOIN lectures l on l.id = lr.id_lecture';
            $criteria->addCondition('l.idModule = '.$idModule.'');

            $data = LecturesRating::model()->findAll($criteria);
            if($data){
                $res_und = 0;
                $res_inter = 0;
                $res_acc = 0;
                foreach ($data as $item){
                    $res_und +=  $item->understand_rating;
                    $res_inter +=  $item->interesting_rating;
                    $res_acc +=  $item->accessibility_rating;
                }
                $len = count($data);
                $result['understand_rating'] = round($res_und / $len);
                $result['interesting_rating'] = round($res_inter / $len);
                $result['accessibility_rating'] = round($res_acc / $len);
                $result['comment'] = '';
            }else{
                $result['understand_rating'] = 0;
                $result['interesting_rating'] = 0;
                $result['accessibility_rating'] = 0;
                $result['comment'] = '';
            }

            return json_encode($result);
        }
    }

    public static function getAverageRatingModule($moduleId){
        $result = array();

        $count1 = Lecture::model()->count('idModule = :moduleId and understand_rating is not NULL', array(':moduleId' => $moduleId));

        $criteria = new CDbCriteria;
        $criteria->select='sum(understand_rating) as understand_rating';  // подходит только то имя поля, которое уже есть в модели
        $criteria->condition='idModule=:moduleId';
        $criteria->params=array(':moduleId'=>$moduleId);
        $sum1 = Lecture::model()->find($criteria)->getAttribute('understand_rating');

        $result['understand_rating'] = round($sum1 / $count1);

        $count2 = Lecture::model()->count('idModule = :moduleId and interesting_rating is not NULL', array(':moduleId' => $moduleId));
        $criteria = new CDbCriteria;
        $criteria->select = 'sum(interesting_rating) as interesting_rating';
        $criteria->condition = 'idModule = :moduleId';
        $criteria->params = array(':moduleId' => $moduleId);
        $sum2 = Lecture::model()->find($criteria)->getAttribute('interesting_rating');

        $result['interesting_rating'] = round($sum2 / $count2);

        $count3 = Lecture::model()->count('idModule = :moduleId and accessibility_rating is not NULL', array(':moduleId' => $moduleId));
        $criteria = new CDbCriteria;
        $criteria->select = 'sum(accessibility_rating) as accessibility_rating';
        $criteria->condition = 'idModule = :moduleId';
        $criteria->params = array(':moduleId' => $moduleId);
        $sum3 = Lecture::model()->find($criteria)->getAttribute('accessibility_rating');

        $result['accessibility_rating'] = round($sum3 / $count3);

        return json_encode($result);
    }

    public static function getRatingData($id_lecture, $id_user){
        $result = array();
        $user_ratings = LecturesRating::model()->findByAttributes(array('id_user'=> $id_user, 'id_lecture' => $id_lecture));
        if($user_ratings != NULL){
            $understand_rating = $user_ratings->understand_rating;
            $interesting_rating = $user_ratings->interesting_rating;
            $accessibility_rating = $user_ratings->accessibility_rating;

            if($understand_rating != NULL){
                $result['understand_rating'] = $understand_rating;
            };
            if($interesting_rating != NULL){
                $result['interesting_rating'] = $interesting_rating;
            };
            if($accessibility_rating != NULL){
                $result['accessibility_rating'] = $accessibility_rating;
            };

            if($understand_rating < 5 || $interesting_rating < 5 || $accessibility_rating < 5){
                $result['comment'] = $user_ratings->comment;
            }
        }else{
            $result['understand_rating'] = 0;
            $result['interesting_rating'] = 0;
            $result['accessibility_rating'] = 0;
            $result['comment'] = '';
        }
//        var_dump($result); die;
        return json_encode($result);
    }

}
