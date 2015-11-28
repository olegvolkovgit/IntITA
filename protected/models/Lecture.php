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
 * @property integer $rate
 * @property integer $verified
 *
 */
class Lecture extends CActiveRecord
{
    const MAX_RAIT = 6;
    public $logo=array();
    public $oldLogo;
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
            array('idModule, order, title_ua, durationInMinutes', 'required', 'message'=>Yii::t('validation','0576')),
            array('idModule, order, idType, rate, verified', 'numerical', 'integerOnly' => true),
            array('durationInMinutes', 'numerical', 'integerOnly' => true, 'min'=>0,"tooSmall"=>Yii::t('validation','057'), 'message'=>Yii::t('validation','0577')),
            array('image', 'length', 'max' => 255),
            array('alias', 'length', 'max' => 10),
            array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty' => true),
            array('title_ua, title_ru, title_en', 'length', 'max' => 255),
            array('title_ua, title_ru, title_en', 'match', 'pattern'=>"/^[=а-яА-ЯёЁa-zA-Z0-9ЄєІіЇї.,\/<>:;`'?!~* ()+-]+$/u",'message'=>Yii::t('error','0416')),
            // The following rule is used by search().
            array('id, image, alias, idModule, order, title_ua, title_ru, title_en, idType, verified, durationInMinutes, isFree, ModuleTitle, rate', 'safe', 'on' => 'search'),
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
            'lectureEl' => array(self::HAS_MANY, 'LectureElement','id_lecture'),
            'ModuleTitle' => array(self::BELONGS_TO, 'Module', 'idModule'),
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
            'rate' => 'Рейтинг заняття',
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
        $criteria->compare('title_ua', $this->title_ua, true);
        $criteria->compare('title_ru', $this->title_ru, true);
        $criteria->compare('title_en', $this->title_en, true);
        $criteria->compare('idType', $this->idType, true);
        $criteria->compare('isFree', $this->isFree, true);
        $criteria->compare('durationInMinutes', $this->durationInMinutes, true);
        $criteria->compare('rate', $this->rate);
        $criteria->compare('verified', $this->verified);

        $criteria->with=array('ModuleTitle');
        $criteria->compare('ModuleTitle.module_name',$this->ModuleTitle,true);
        $criteria->addCondition('`order`>0');

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => '50',
            ),
            'sort'=>array('attributes'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                ),
                'ModuleTitle'=>array(
                    'asc' => $expr='ModuleTitle.title_ua',
                    'desc' => $expr.' DESC',
                ),
                'order'=>array(
                    'asc' => $expr='`order`',
                    'desc' => $expr.' DESC',
                ),
                'title_ua'=>array(
                    'asc' => $expr='title_ua',
                    'desc' => $expr.' DESC',
                ),
                'title_ru'=>array(
                    'asc' => $expr='title_ru',
                    'desc' => $expr.' DESC',
                ),
                'title_en'=>array(
                    'asc' => $expr='title_en',
                    'desc' => $expr.' DESC',
                ),
                'idType'=>array(
                    'asc' => $expr='idType',
                    'desc' => $expr.' DESC',
                ),
                'isFree'=>array(
                    'asc' => $expr='isFree',
                    'desc' => $expr.' DESC',
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

    function getPreId(){
        return Lecture::model()->findByAttributes(array('order'=>$this->order-1,'idModule'=>$this->idModule))->id;
    }

    function getPreName()
    {
        return Lecture::model()->findByAttributes(array('order'=>$this->order-1,'idModule'=>$this->idModule))->title;
    }

    function getPreType()
    {
        $typeId = Lecture::model()->findByAttributes(array('order'=>$this->order-1,'idModule'=>$this->idModule))->idType;
        $type = LectureType::model()->findByPk($typeId);
        $titleParam = LectureHelper::getTypeTitleParam();
        return array(
            'text' => $type->$titleParam,
            'image' => $type->image,
        );
    }

    function getPreDur()
    {
        return Lecture::model()->findByAttributes(array('order'=>$this->order-1,'idModule'=>$this->idModule))->durationInMinutes.Yii::t('lecture','0076');
    }


    function getPostType()
    {
        $typeId = Lecture::model()->findByAttributes(array('order'=>$this->order+1,'idModule'=>$this->idModule))->idType;
        $type = LectureType::model()->findByPk($typeId);
        $titleParam = LectureHelper::getTypeTitleParam();
        return array(
            'text' => $type->$titleParam,
            'image' => $type->image,
        );
    }


    function getPostRait($id)
    {
        return Lecture::model()->findByPk($id)->rate;
    }


    function getPostId(){
        return Lecture::model()->findByAttributes(array('order'=>$this->order+1,'idModule'=>$this->idModule))->id;
    }

    public function getModuleInfoById($idCourse){
        $module = Module::model()->findByPk($this->idModule);
        $titleParam = ModuleHelper::getModuleTitleParam();
        return array(
            'moduleTitle' => $module->$titleParam,
            'countLessons' =>  $module->lesson_count,
            'idCourse' => $idCourse,
        );
    }

    public function getCourseInfoById($idCourse){
        $course = Course::model()->findByPk($idCourse);
        return array(
            'courseTitle' => CourseHelper::getCourseName($idCourse),
            'courseLang' =>  $course->language,
        );
    }

    public function getLectureInfoByOrder($order){
        $lecture = Lecture::model()->findBySql('order=:order',	array(':order' == $order));
        return array(
            'order' => $lecture->order,
            'title' =>  $lecture->title_ua,
            'typeImage' => $this->getTypeInfo($lecture->idType),
            'typeText' => $this->getTypeInfo($lecture->idType),
            'duration' => $lecture->durationInMinutes,
        );
    }

    public function getTypeInfo(){
        $type = LectureType::model()->findByPk($this->idType);
        $titleParam = LectureHelper::getTypeTitleParam();
        return array(
            'image' => $type->image,
            'text' => $type->$titleParam,
        );
    }

    public function getTeacherInfoById(){
        $teacher = Teacher::model()->findByPk($this->idTeacher);
        return array(
            'full_name' => $teacher->last_name.' '.$teacher->first_name.' '.$teacher->middle_name,
            'email' =>  $teacher->email,
            'tel' => $teacher->tel,
            'skype' => $teacher->skype,
            'readMoreLink' => $teacher->readMoreLink,
            'photo' => $teacher->foto_url,
        );
    }

    public function loadContent($id = 1){
        $lectureElements = LectureElement::model()->findAll(array(
            'select'=>'id_lecture, block_order',
            'condition'=>'id_lecture =:id',
            'params'=>array(':id'=>$id),
            'order'=> 'block_order ASC',
        ));

        if (count($lectureElements) == 0){
            return false;
        } else {
            $contentList = array();
            for ($i = count($lectureElements); $i > 0; $i--){
                array_push($contentList,
                    LectureElement::model()->findByPk(array('id_lecture'=>$id,'block_order'=>$i))
                );
            }
            return $contentList;
        }

    }

    public static function addNewLesson($module, $title_ua, $title_ru, $title_en, $teacher){
        $lecture = new Lecture();
        $lecture->title_ua = $title_ua;
        $lecture->title_ru = $title_ru;
        $lecture->title_en = $title_en;
        $lecture->idModule = $module;
        $order = Lecture::model()->count("idModule=$module and `order`>0");
        $lecture->order = ++$order;
        $lecture->idTeacher = $teacher;
        $lecture->alias = 'lecture'.$order;

        $lecture->save();

        return $order;
    }

    public function getLecturesTitles($id)
    {
        $list = Lecture::model()->findAllByAttributes(array('idModule' => 1));
        $titles = array();
        $titleParam = LectureHelper::getTypeTitleParam();
        foreach ($list as $item) {
            array_push($titles, $item->$titleParam);
        }
        return $titles;
    }

    public static function unableLecture($idLecture){

        Lecture::model()->updateByPk($idLecture, array('order' => 0));
    }

    public function getLectureTypeText(){
        $type = LectureType::model()->findByPk($this->id);
        $titleParam = LectureHelper::getTypeTitleParam();
        return $type->$titleParam;
    }

    public static function getLessonCont($id){
        $summary=[];

        $criteria= new CDbCriteria;
        $criteria->alias = 'lecture_page';
        $criteria->addCondition('id_lecture='.$id);
        $criteria->order = 'page_order ASC';
        $cont =  LecturePage::model()->findAll($criteria);
        $i=0;
        foreach($cont as $type){
            $summary[$i] = $type->page_title;
            $i++;
        }
        return $summary;
    }

    public static function getTextList($idLecture, $order)
    {
        $idElement = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order))->id_block;
        $page = Yii::app()->db->createCommand()
            ->select('page')
            ->from('lecture_element_lecture_page')
            ->where('element=:element', array(':element'=>$idElement))
            ->queryScalar();
        $textList = LecturePage::getBlocksListById($page);
        return $textList;
    }

    public static function getLectureIdByModuleOrder($idModule, $order){
        return Lecture::model()->findByAttributes(array(
            'idModule' => $idModule,
            'order' => $order
        ));
    }

    public static function getLink($id){
        return '<a href="'.Yii::app()->createUrl("lesson/index", array("id" => $id, "idCourse" => "0")).'">'.
        LectureHelper::getLectureTitle($id).'</a>';
    }

    public static function getAllNotVerifiedLectures(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule > 0 and `order` > 0 and `verified` = 0');

        return Lecture::model()->findAll($criteria);
    }

    public function isVerified(){
        return $this->verified;
    }

    public static function getAllVerifiedLectures(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule > 0 and `order` > 0 and `verified` = 1');

        return Lecture::model()->findAll($criteria);
    }

    protected function afterSave(){
        if($this->verified == 1) {
            $this->verified = 0;
            $this->save();
        }

    }
}
