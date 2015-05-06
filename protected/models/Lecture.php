<?php

/**
 * This is the model class for table "lectures".
 *
 * The followings are the available columns in table 'lectures':
 * @property integer $id
 * @property string $image
 * @property string $alias
 * @property string $language
 * @property integer $idModule
 * @property integer $order
 * @property string $title
 * @property integer $idType
 * @property integer $durationInMinutes
 * @property integer $maxNumber
 * @property integer $preLecture
 * @property integer $nextLecture
 * @property string $idTeacher
 *
 * The followings are the available model relations:
 * @property LectureElement[] $lectureElements
 */
class Lecture extends CActiveRecord
{
    const MAX_RAIT = 6;
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
            array('idModule, order, idType, durationInMinutes, maxNumber, preLecture, nextLecture', 'numerical', 'integerOnly' => true),
            array('image', 'length', 'max' => 255),
            array('alias', 'length', 'max' => 10),
            array('language', 'length', 'max' => 6),
            array('title', 'length', 'max' => 255),
            array('idTeacher', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, image, alias, language, idModule, order, title, idType, durationInMinutes, maxNumber, preLecture, nextLecture, idTeacher', 'safe', 'on' => 'search'),
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
            'lectureElements' => array(self::HAS_MANY, 'LectureElement', 'id_lecture'),
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
            'alias' => 'Alias',
            'language' => 'Language',
            'idModule' => 'Id Module',
            'order' => 'Order',
            'title' => 'Title',
            'idType' => 'Id Type',
            'durationInMinutes' => 'Duration In Minutes',
            'maxNumber' => 'Max Number',
            'preLecture' => 'Pre Lecture',
            'nextLecture' => 'Next Lecture',
            'idTeacher' => 'Id Teacher',
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
        $criteria->compare('language', $this->language, true);
        $criteria->compare('idModule', $this->idModule);
        $criteria->compare('order', $this->order);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('idType', $this->idType);
        $criteria->compare('durationInMinutes', $this->durationInMinutes);
        $criteria->compare('maxNumber', $this->maxNumber);
        $criteria->compare('preLecture', $this->preLecture);
        $criteria->compare('nextLecture', $this->nextLecture);
        $criteria->compare('idTeacher', $this->idTeacher, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array (
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            ),
            //
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
        return Lecture::model()->findByPk($this->id-1)->id;
    }

    function getPreName()
    {
        return Lecture::model()->findByPk($this->id-1)->title;
    }

    function getPreType()
    {
        $typeId = Lecture::model()->findByPk($this->id-1)->idType;
        $type = Lecturetype::model()->findByPk($typeId);
        return array(
            'text' => $type->text,
            'image' => $type->image,
        );
    }

    function getPreDur()
    {
        return Lecture::model()->findByPk($this->id-1)->durationInMinutes.Yii::t('lecture','0076');
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
        return Lecture::model()->findByPk($this->id+1)->title;
    }

    function getPostType()
    {
        $typeId = Lecture::model()->findByPk($this->id+1)->idType;
        $type = Lecturetype::model()->findByPk($typeId);
        return array(
            'text' => $type->text,
            'image' => $type->image,
        );
    }

    function getPostDur()
    {
        return Lecture::model()->findByPk($this->id+1)->durationInMinutes.Yii::t('lecture','0076');
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
        return Lecture::model()->findByPk($this->id+1)->id;
    }

    public function getModuleInfoById(){
        $module = Module::model()->findByPk($this->idModule);
        return array(
            'moduleTitle' => $module->module_name,
            'countLessons' =>  $module->lesson_count,
            'idCourse' => $module->course,
        );
    }

    public function getCourseInfoById(){
        $courseId = Module::model()->findByPk($this->idModule)->course;
        $course = Course::model()->findByPk($courseId);
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
        $type = Lecturetype::model()->findByPk($this->idType);
        return array(
            'image' => $type->image,
            'text' => $type->text,
        );
    }

    public function getTeacherInfoById(){
        $teacher = TeachersTemp::model()->findByPk($this->idTeacher);
        return array(
            'full_name' => $teacher->last_name.' '.$teacher->first_name.' '.$teacher->middle_name,
            'email' =>  $teacher->email,
            'tel' => $teacher->tel,
            'skype' => $teacher->skype,
            'readMoreLink' => $teacher->readMoreLink,
            'photo' => $teacher->smallImage,
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

    public static function addNewLesson($module, $title, $order, $lang){
        $lecture = new Lecture();
        $lecture->title = $title;
        $lecture->idModule = $module;
        $lecture->order = $order;
        $lecture->language = $lang;
        $lecture->alias = 'lecture'.$order;
//        if (!$lecture->isNewRecord) {
            return $lecture->save();
//        } else {
//            throw new CHttpException(422, 'Така лекція вже існує.');
//        }
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
        $type = Lecturetype::model()->findByPk($this->id);
        return $type->text;
    }
}
