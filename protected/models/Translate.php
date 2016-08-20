<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id_record
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * The followings are the available model relations:
 * @property Sourcemessages $source
 * @property MessageComment $comment
 */
class Translate extends CActiveRecord
{
    public $comment;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'translate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, language, translation', 'required'),
            array('id', 'numerical', 'integerOnly' => true),
            array('language', 'length', 'max' => 16),
            // The following rule is used by search().
            array('id_record, id, language, translation', 'safe', 'on' => 'search'),
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
            'source' => array(self::BELONGS_TO, 'Sourcemessages', 'id'),
            'comment' => array(self::HAS_ONE, 'MessageComment', 'message_code'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_record' => 'Id запису',
            'id' => 'ID повідомлення',
            'language' => 'Мова',
            'translation' => 'Переклад',
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

        $criteria->compare('id_record', $this->id_record);
        $criteria->compare('id', $this->id);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('translation', $this->translation, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Translate the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function addNewRecord($id, $language, $translation)
    {
        $model = new Translate();

        $model->id = $id;
        $model->language = $language;
        $model->translation = $translation;

        return $model->save();
    }

    // create messages for create international schema of course
    public static function getMessagesForSchemabyLang($lang)
    {
        $arr = [];

        $startMessages = 667;
        $endMessages = 671;

        for ($i = $startMessages; $i <= $endMessages; $i++)
        {
            $messages = Translate::model()->findAllByAttributes(array('id'=>$i,'language' => $lang));
            array_push($arr,$messages[0]->translation);
        }
        $exam = Translate::model()->findAllByAttributes(array('id'=>'0673','language' => $lang));
        array_push($arr,$exam[0]->translation);

        return $arr;
    }

    public static function getMessagesByLevel($idMessages,$lang)
    {
        if(empty($lang)) $lang = 'ua';
        $messages = Translate::model()->findAllByAttributes(array('id' => $idMessages,'language' => $lang));

        return $messages[0]->translation;
    }

    public static function getLectureContentMessagesByLang($lang){
        $arr = [];
        $messagesArray = ['639', '422', '89'];

        for($i = 0, $count = count($messagesArray); $i < $count; $i++)
        {
            $messages = Translate::model()->findAllByAttributes(array('id'=>$messagesArray[$i],'language' => $lang));
            $arr[$messagesArray[$i]] = $messages[0]->translation;
        }
        return $arr;
    }

    public static function getTranslatesList($page = 0, $pageCount=10) {
        $command = Yii::app()->db->createCommand();
        $command->select('tr.id, tr.language, s.category, tr.translation, c.comment, tr.id_record')->from('translate tr')->
                leftJoin('sourcemessages s', 's.id = tr.id')->leftJoin('message_comment c', 'c.message_code = tr.id')->
                limit($pageCount)->offset($page*$pageCount -$pageCount);
        return $command->queryAll();

//        $return = array('data' => array());
//
//        foreach ($result as $record) {
//            $row = array();
//            $row["id"] = $record["id"];
//            $row["language"] = $record["language"];
//            $row["category"] = CHtml::encode($record["category"]);
//            $row["comment"] = CHtml::encode($record["comment"]);
//            $row["translation"]["text"]=CHtml::encode($record['translation']);
//            $row["translation"]["link"] = "'".Yii::app()->createUrl("/_teacher/_admin/translate/view", array("id"=>$record["id_record"]))."'";
//            array_push($return['data'], $row);
//        }
//
//        return json_encode($return);
    }

    public function getData(){
        return $this->with('source', 'comment')->findAll();
    }
}
