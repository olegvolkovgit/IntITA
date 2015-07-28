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
 * @property string $title
 * @property integer $idType
 * @property integer $durationInMinutes
 * @property integer $preLecture
 * @property integer $nextLecture
 * @property integer $isFree
 * @property integer $rate
 *
 */
class Lecture extends CActiveRecord
{
    const MAX_RAIT = 6;
    private $isPassed;
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
            array('idModule, order, title', 'required'),
            array('idModule, order, idType, durationInMinutes, rate', 'numerical', 'integerOnly' => true),
            array('image', 'length', 'max' => 255),
            array('alias', 'length', 'max' => 10),
            array('title', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, image, alias, idModule, order, title, idType, durationInMinutes,isFree, ModuleTitle, rate', 'safe', 'on' => 'search'),
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
            //'lectureElements' => array(self::HAS_MANY, 'LectureElement', 'id_lecture'),
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
            'title' => 'Назва',
            'idType' => 'Тип',
            'isFree' => 'Безкоштовно',
            'durationInMinutes' => 'Тривалість лекції(хв)',
            'rate' => 'Рейтинг заняття',
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('idModule', $this->idModule, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('idType', $this->idType, true);
        $criteria->compare('isFree', $this->isFree, true);
        $criteria->compare('durationInMinutes', $this->durationInMinutes, true);
        $criteria->compare('rate', $this->rate);


        $criteria->with=array('ModuleTitle');
        $criteria->compare('ModuleTitle.module_name',$this->ModuleTitle,true);

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
                    'asc' => $expr='ModuleTitle.module_name',
                    'desc' => $expr.' DESC',
                ),
                'order'=>array(
                    'asc' => $expr='`order`',
                    'desc' => $expr.' DESC',
                ),
                'title'=>array(
                    'asc' => $expr='title',
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

    function getThisMedal()
    {
        return 'Зараховано';
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
        return array(
            'text' => $type->text,
            'image' => $type->image,
        );
    }

    function getPreDur()
    {
        return Lecture::model()->findByAttributes(array('order'=>$this->order-1,'idModule'=>$this->idModule))->durationInMinutes.Yii::t('lecture','0076');
    }

    function getPreRait()
    {
        return '4.5';
    }

    function getPreMedal()
    {
        return 'Зараховано';
    }

     function getPostName()
    {
        return Lecture::model()->findByAttributes(array('order'=>$this->order+1,'idModule'=>$this->idModule))->title;
    }

    function getPostType()
    {
        $typeId = Lecture::model()->findByAttributes(array('order'=>$this->order+1,'idModule'=>$this->idModule))->idType;
        $type = LectureType::model()->findByPk($typeId);
        return array(
            'text' => $type->text,
            'image' => $type->image,
        );
    }

    function getPostDur()
    {
        return Lecture::model()->findByAttributes(array('order'=>$this->order+1,'idModule'=>$this->idModule))->durationInMinutes.Yii::t('lecture','0076');
    }

    function getPostRait()
    {
        return '4.5';
    }

    function getPostMedal()
    {
        return 'Не зараховано';
    }

    function getPostId(){
        return Lecture::model()->findByAttributes(array('order'=>$this->order+1,'idModule'=>$this->idModule))->id;
    }

    public function getModuleInfoById($idCourse){
        $module = Module::model()->findByPk($this->idModule);
        return array(
            'moduleTitle' => $module->module_name,
            'countLessons' =>  $module->lesson_count,
            'idCourse' => $idCourse,
        );
    }

    public function getCourseInfoById($idCourse){
        $course = Course::model()->findByPk($idCourse);
        return array(
            'courseTitle' => $course->course_name,
            'courseLang' =>  $course->language,
        );
    }

    public function getLectureInfoByOrder($order){
        $lecture = Lecture::model()->findBySql('order=:order',	array(':order' == $order));
        return array(
            'order' => $lecture->order,
            'title' =>  $lecture->title,
            'typeImage' => $this->getTypeInfo($lecture->idType),
            'typeText' => $this->getTypeInfo($lecture->idType),
            'duration' => $lecture->durationInMinutes,
        );
    }

    public function getTypeInfo(){
        $type = LectureType::model()->findByPk($this->idType);
        return array(
            'image' => $type->image,
            'text' => $type->text,
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

    public static function addNewLesson($module, $title, $lang, $teacher){
        $lecture = new Lecture();
        $lecture->title = $title;
        $lecture->idModule = $module;
//        $order = Yii::app()->db->createCommand()
//            ->select('order')
//            ->from('lectures')
//            ->order('order DESC')
//            ->limit('1')
//            ->queryRow()["order"];
        $order = Lecture::model()->count("idModule=$module and `order`>0");
        $lecture->order = ++$order;
        $lecture->language = $lang;
        $lecture->idTeacher = $teacher;
        $lecture->alias = 'lecture'.$order;
//        if (!$lecture->isNewRecord) {
            $lecture->save();
//        } else {
//            throw new CHttpException(422, 'Така лекція вже існує.');
//        }
        return $order;
    }

    public function getLecturesTitles($id)
    {
        $list = Lecture::model()->findAllByAttributes(array('idModule' => 1));
        $titles = array();
        foreach ($list as $item) {
            array_push($titles, $item->title);
        }
        return $titles;
    }

    public static function unableLecture($idLecture){

        Lecture::model()->updateByPk($idLecture, array('order' => 0));
    }

    public function getLectureTypeText(){
        $type = LectureType::model()->findByPk($this->id);
        return $type->text;
    }
    public static function getLessonCont($id){
        $summary=[];
        $cont =  LectureElement::model()->findAll("id_lecture=:id and id_type=:type", array(':type'=>'8', ':id'=>$id));
        $i=0;
        foreach($cont as $type){
            $summary[$i] =$type->html_block;
            $i++;
        }
        return $summary;
    }
}
