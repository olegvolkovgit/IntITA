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
 * @property string $iconIsDone
 * @property integer $preLecture
 * @property integer $nextLecture
 * @property string $idTeacher
 * @property string $lectureUnwatchedImage
 * @property string $lectureOverlookedImage
 * @property string $lectureTimeImage
 *
 * The followings are the available model relations:
 * @property LectureElement[] $lectureElements
 */
class Lecture extends CActiveRecord
{
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
            array('image, alias, language, idModule, order, title, idType, durationInMinutes, maxNumber, iconIsDone, preLecture, nextLecture, idTeacher, lectureUnwatchedImage, lectureOverlookedImage, lectureTimeImage', 'required'),
            array('idModule, order, idType, durationInMinutes, maxNumber, preLecture, nextLecture', 'numerical', 'integerOnly' => true),
            array('image, iconIsDone, lectureUnwatchedImage, lectureOverlookedImage, lectureTimeImage', 'length', 'max' => 255),
            array('alias', 'length', 'max' => 10),
            array('language', 'length', 'max' => 6),
            array('title', 'length', 'max' => 100),
            array('idTeacher', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, image, alias, language, idModule, order, title, idType, durationInMinutes, maxNumber, iconIsDone, preLecture, nextLecture, idTeacher, lectureUnwatchedImage, lectureOverlookedImage, lectureTimeImage', 'safe', 'on' => 'search'),
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
            'iconIsDone' => 'Icon Is Done',
            'preLecture' => 'Pre Lecture',
            'nextLecture' => 'Next Lecture',
            'idTeacher' => 'Id Teacher',
            'lectureUnwatchedImage' => 'Lecture Unwatched Image',
            'lectureOverlookedImage' => 'Lecture Overlooked Image',
            'lectureTimeImage' => 'Lecture Time Image',
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
        $criteria->compare('iconIsDone', $this->iconIsDone, true);
        $criteria->compare('preLecture', $this->preLecture);
        $criteria->compare('nextLecture', $this->nextLecture);
        $criteria->compare('idTeacher', $this->idTeacher, true);
        $criteria->compare('lectureUnwatchedImage', $this->lectureUnwatchedImage, true);
        $criteria->compare('lectureOverlookedImage', $this->lectureOverlookedImage, true);
        $criteria->compare('lectureTimeImage', $this->lectureTimeImage, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Lecture3 the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function getThisMedal()
    {
        return 'Зараховано';//$this->thisLessonInfo[5]; // Медалька
    }

    // Попередній урок

    function getPreNumber()
    {
        return 2;//$this->preLessonInfo[0];  // Номер
    }

    function getPreName()
    {
        return $this->title;//$this->preLessonInfo[1]; // Назва
    }

    function getPreType()
    {
        return 'лекція';//$this->preLessonInfo[2]; // Тип
    }

    function getPreDur()
    {
        return '40хв';//$this->preLessonInfo[3]; //	Тривалість
    }

    function getPreRait()
    {
        return '4.5';//$this->preLessonInfo[4]; //	Рейтинг
    }

    function getPreMedal()
    {
        return 'Зараховано';//$this->preLessonInfo[5]; // Медалька
    }

    // Наступний урок

    function getPostNumber()
    {
        return '4';//$this->postLessonInfo[0];  // Номер
    }

    function getPostName()
    {
        return $this->title;//$this->postLessonInfo[1]; // Назва
    }

    function getPostType()
    {
        return 'лекція';//$this->postLessonInfo[2]; // Тип
    }

    function getPostDur()
    {
        return '40хв';//$this->postLessonInfo[3]; //	Тривалість
    }

    function getPostRait()
    {
        return '4.5';//$this->postLessonInfo[4]; //	Рейтинг
    }

    function getPostMedal()
    {
        return 'Не зараховано';//$this->postLessonInfo[5]; // Медалька
    }

    function getPost()
    {
        return 'True';  // Існування елемента
    }

    function getPre()
    {
        return 'True';  // Існування елемента
    }

    public function getModuleInfoById($id){
        $module = new Module();
        $module->findByPk($id);
        return array(
            'moduleTitle' => $module->module_name,
            'countLessons' =>  $module->lesson_count,
            'idCourse' => $module->course,
        );
    }

    public function getCountLessons(){
       $tmp = new Module();
        return $tmp->findByPk($this->idModule)->lesson_count;
    }

    public function getCourseInfoById($id){
        $course = new Course;
        $course->findByPk($id);
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

    public function getTypeInfo($id){
        $type = Lecturetype::model()->findByPk($id);
        return array(
            'image' => $type->image,
            'text' => $type->text,
        );
    }

    public function getTeacherInfoById($id){
        $teacher = TeachersTemp::model()->findByPk($id);
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
}
