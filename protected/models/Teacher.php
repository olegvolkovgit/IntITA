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
 *
 */
class Teacher extends CActiveRecord
{
    public $avatar=array(),$oldAvatar;
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
            array('first_name, middle_name, last_name, user_id', 'required', 'message'=>'Поле не може бути пустим'),
            array('rate_knowledge, rate_efficiency, rate_relations, user_id, isPrint', 'numerical', 'integerOnly'=>true),
            array('first_name, middle_name, last_name', 'length', 'max'=>35),
            array('first_name, middle_name, last_name, first_name_en, middle_name_en, last_name_en', 'match', 'pattern'=>'/^[a-zа-яіїёA-ZА-ЯІЇЁ\s\'’]+$/u','message'=>'Недопустимі символи!'),
            array('tel', 'match','pattern'=>'/^[0-9]+$/u', 'message'=>'Недопустимі символи!', 'except'=>'imageUpload',),
            array('tel', 'length', 'max'=>13, 'except'=>'imageUpload',),
            array('foto_url, subjects', 'length', 'max'=>100),
            array('foto_url', 'file','types'=>'jpg, gif, png', 'allowEmpty' => true),
            array('readMoreLink', 'length', 'max'=>255),
            array('email, skype, first_name_en, middle_name_en, last_name_en', 'length', 'max'=>50),
            array('email','email', 'message'=>'Невірна електронна адреса'),
            array('profile_text_first,profile_text_short,profile_text_last', 'safe'),
            // The following rule is used by search().
            array('teacher_id, first_name, middle_name, last_name, foto_url, subjects, profile_text_first,
            profile_text_short, profile_text_last, readMoreLink, email, tel, skype, rate_knowledge, rate_efficiency,
            rate_relations, user_id, isPrint, first_name_en, middle_name_en, last_name_en', 'safe', 'on'=>'search'),
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
        $criteria=new CDbCriteria;
        $criteria->compare('teacher_id',$this->teacher_id);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('middle_name',$this->middle_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('foto_url',$this->foto_url,true);
        $criteria->compare('subjects',$this->subjects,true);
        $criteria->compare('profile_text_first',$this->profile_text_first,true);
        $criteria->compare('profile_text_short',$this->profile_text_short,true);
        $criteria->compare('profile_text_last',$this->profile_text_last,true);
        $criteria->compare('readMoreLink',$this->readMoreLink,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('tel',$this->tel,true);
        $criteria->compare('skype',$this->skype,true);
        $criteria->compare('rate_knowledge',$this->rate_knowledge);
        $criteria->compare('rate_efficiency',$this->rate_efficiency);
        $criteria->compare('rate_relations',$this->rate_relations);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('isPrint',$this->isPrint);
        $criteria->compare('first_name_en',$this->first_name_en,true);
        $criteria->compare('middle_name_en',$this->middle_name_en,true);
        $criteria->compare('last_name_en',$this->last_name_en,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => 20,
            ),
        ));
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Teacher the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function getHideIp ($ip)
    {
        $pos =  strripos($ip, '.');
        $arr = str_split($ip);
        for($i=0;$i<$pos;$i++){
            if($arr[$i]!=='.') $arr[$i]='*';
        }
        return implode("", $arr);
    }
    public function getAverageRateKnwl ($id)
    {
        $countKn = Response::model()->count("knowledge>0 and about=$id and is_checked=1");
        $sum = Yii::app()->db->createCommand()
            ->select('sum(knowledge)')
            ->from('response')
            ->where('about=:id and is_checked=1', array(':id'=>$id))
            ->queryRow();
        return round($sum['sum(knowledge)']/$countKn);
    }
    public function getAverageRateBeh ($id)
    {
        $countBeh = Response::model()->count("behavior>0 and about=$id and is_checked=1");
        $sum = Yii::app()->db->createCommand()
            ->select('sum(behavior)')
            ->from('response')
            ->where('about=:id and is_checked=1', array(':id'=>$id))
            ->queryRow();
        return round($sum['sum(behavior)']/$countBeh);
    }
    public function getAverageRateMot ($id)
    {
        $countMot = Response::model()->count("motivation>0 and about=$id and is_checked=1");
        $sum = Yii::app()->db->createCommand()
            ->select('sum(motivation)')
            ->from('response')
            ->where('about=:id and is_checked=1', array(':id'=>$id))
            ->queryRow();
        return round($sum['sum(motivation)']/$countMot);
    }
    public function getAverageRate ($id)
    {
        return round(($this->getAverageRateBeh($id)+$this->getAverageRateMot($id)+$this->getAverageRateKnwl($id))/3);
    }

    public static function isTeacher($user){
        if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => $user))){
            return Teacher::model()->findByAttributes(array('user_id' => $user))->teacher_id;
        }
        return false;
    }
    public static function isTeacherCanEdit($user, $modules){
        $criteria = new CDbCriteria();
        $criteria->addInCondition('idModule', $modules);
        $criteria->addCondition('idTeacher='.$user);
        return TeacherModule::model()->exists($criteria);
    }
    protected function beforeSave()
    {
        if (($this->scenario == "update") && empty($this->avatar['tmp_name']['foto_url']))
        {
            $this->foto_url=$this->oldAvatar;
        } else if(($this->scenario=="update") && (!empty($this->avatar['tmp_name']['foto_url']))){
            $src=Yii::getPathOfAlias('webroot')."/images/teachers/".$this->oldAvatar;
            if (is_file($src))
                unlink($src);
        }
        if (($this->scenario=="insert" || $this->scenario=="update")&& !empty($this->avatar['tmp_name']['foto_url']))
        {
            if(!copy($this->avatar['tmp_name']['foto_url'],Yii::getPathOfAlias('webroot')."/images/teachers/".$this->avatar['name']['foto_url']))
                throw new CHttpException(500);
        }
        return true;
    }

    protected function beforeDelete()
    {
        $src=Yii::getPathOfAlias('webroot')."/images/teachers/".$this->foto_url;
        if (is_file($src))
            unlink($src);
        return true;
    }


    public static function updateFirstText($id, $firstText){
        return Teacher::model()->updateByPk($id, array('profile_text_first' => $firstText));
    }

    public static function updateSecondText($id, $secondText){
        return Teacher::model()->updateByPk($id, array('profile_text_last' => $secondText));
    }


    public static function getAllTeachersId(){
        $teachers = Teacher::model()->findAllBySql('select teacher_id from teacher order by teacher_id');
        $result = [];
        for($i = 0; $i < count($teachers); $i++){
            array_push($result, $teachers[$i]['teacher_id']);
        }
        return $result;
    }

    public static function getFullName($id){
        $teacher = Teacher::model()->findByPk($id);
        return $teacher->last_name." ".$teacher->first_name." ".$teacher->middle_name;
    }

    public static function getLectureTeacher($idLecture){
        $criteria = new CDbCriteria();
        $criteria->select = "teacher_id";
        $criteria->addCondition("isPrint=1");
        $criteria->order = 'rating ASC';
        $teachers = Teacher::model()->findAll($criteria);

        foreach($teachers as $key){
            if(TeacherModule::model()->exists('idTeacher=:idTeacher and idModule=:idModule', array(
                ':idTeacher' => $key->teacher_id,
                ':idModule' => Lecture::model()->findByPk($idLecture)->idModule
            ))){
                return $key->teacher_id;
            }
        }
        return 0;
    }
}
